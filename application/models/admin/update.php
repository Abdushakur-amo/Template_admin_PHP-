<?php
	//./././././././././././././././././././././././
	// - Admin UpDate
	//./././././././././././././././././././././././
	use application\lib\Db;
	class ModelsAdminUpdate  {

		public $db;
		public function __construct(){
			# Работа с баз данных
			$this->db = new Db;
		}

		public function UpdateProfils($id, $post) {
			$params = [
				'name' 	=> $post['name'],
				'email' => $post['email'],
				'phone' 	=> format992($post['phone']),
				'city' 	=> htmlspecialchars($post['city']),
				'text' 	=> htmlspecialchars($post['text']),
			];
			$this->db->query("UPDATE `users` SET  name = :name, email = :email, phone = :phone, city = :city, text = :text WHERE id = $id", $params);
			return $id;
		}
		
		public function editPassword($newPassword, $id) {
			$params = [
				'password' 	=> $newPassword,
			];
			$this->db->query("UPDATE `users` SET  password = :password WHERE id = $id", $params);
			return true;
		}

	} // End Class
