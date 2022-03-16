<?php
	//./././././././././././././././././././././././
	// - Account Insert
	//./././././././././././././././././././././././
	use application\lib\Db;
	class ModelsAccountInsert  {
		public $db;
		public function __construct(){
			# Работа с баз данных
			$this->db = new Db;
		}
		public function AddDialog($id_send, $id_reci) {
			$params = [
				'id' 		=> null,
				'sender' 	=> $id_send,
				'recipient' => $id_reci,
				'status' 	=> 0,
				'date' 		=> date("Y-m-d H:i:s"),
			];
			$this->db->query('INSERT INTO dialog VALUES(:id, :sender, :recipient, :status,  :date)', $params);
			return $this->db->lastInsertId();
		}
		public function SendMessageAdd($message, $id_dialog) {
			$params = [
				'id' 		=> null,
				'message' => $message,
				'id_dialog' => $id_dialog,
				'id_user' 	=> $_SESSION['authorize']['id'],
				'status' 	=> 0,
				'time' 		=> time(),
				'date' 		=> date("Y-m-d H:i:s"),
			];
			$this->db->query('INSERT INTO message VALUES(:id, :message, :id_dialog, :id_user, :status,  :time, :date)', $params);
			return $this->db->lastInsertId();
		}
	} // End Class
