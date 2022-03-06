<?php
	//./././././././././././././././././././././././
	// - Account Insert
	//./././././././././././././././././././././././
	use application\lib\Db;
	class ModelsAdminInsert  {
		public $db;
		public function __construct(){
			# Работа с баз данных
			$this->db = new Db;
		}

		public function AddMessageChat($message) {
			$params = [
				'id'  		=> null,
				'id_user'  	=> $_SESSION['authorize']['id'],
				'admin'  	=> 0,
				'answer'    => 0,
				'my_like'   => 0,
				'message'  	=> $message,
				'date'  	=> date("Y-m-d H:i:s"),
			];
			$this->db->query('INSERT INTO chat VALUES (:id, :id_user, :admin, :answer, :my_like, :message, :date)', $params);
			return $this->db->lastInsertId();
		}

	} // End Class
