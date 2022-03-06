<?php 
	//./././././././././././././././././././././././
	// - Main Insert 
	//./././././././././././././././././././././././
	use application\lib\Db;
	class ModelsMainInsert  {
		public $db;
		public function __construct(){
			# Работа с баз данных
			$this->db = new Db;
		}
		public function Test(){
			return 'В на класс: ModelsMainInsert'; 
		}

		public function SendKharidor($post){
			$params = [
				'id' => null,
				'name' => $post['name'],
				'phone' => format992($post['phone']),
				'action' => 0,
				'id_user' => $_SESSION['authorize']['id'],
				'date' => date("Y-m-d H:i:s"),
			];
			$this->db->query('INSERT INTO tr_send_kharidor VALUES(:id, :name, :phone, :action, :id_user, :date)', $params);
			return $this->db->lastInsertId();
		}
	


	} // End Class