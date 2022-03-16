<?php
	//./././././././././././././././././././././././
	// - Account UpDate
	//./././././././././././././././././././././././
	use application\lib\Db;
	class ModelsAccountUpdate  {
		public $db;
		public function __construct(){
			# Работа с баз данных
			$this->db = new Db;
		}
		public function EditTheWalletUsers($id_user, $summa){
			$params = ['summa' => $summa];
			$this->db->query("UPDATE `Wallet` SET  summa = :summa WHERE id_user = $id_user", $params);
			return true;
		}
		public function EditDialogStatus($id_dialog) {
			$params = ['status' 	=> 1,];
			$this->db->query("UPDATE `dialog` SET  status = :status WHERE id = $id_dialog", $params);
			return true;
		}
		public function SendReciReplaces($DID, $my_id, $you_id) {
			$params = [
				'status' 	=> 0,
				'sender' 	=> $my_id,
				'recipient' => $you_id,
				'date' => date("Y-m-d H:i:s"),
			];
			$this->db->query("UPDATE `dialog` SET  status = :status,  sender = :sender, recipient = :recipient, date = :date WHERE id = $DID", $params);
			return true;
		}
		public function EditMessageStatus($id_dialog) {
			$params = [ 'status' => 1, 'date' => date("Y-m-d H:i:s"), ];
			$this->db->query("UPDATE `message` SET  status = :status, date = :date WHERE id_dialog = $id_dialog", $params);
			return true;
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
