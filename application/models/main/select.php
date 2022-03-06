<?php 
	//./././././././././././././././././././././././
	// - Main Select
	//./././././././././././././././././././././././
	use application\lib\Db;
	class ModelsMainSelect  {

		public $db;
		public function __construct(){
			# Работа с баз данных
			$this->db = new Db;
		}


		public function Test(){
			return 'В на класс: ModelsMainSelect'; 
		}

		public function SelectTR_kharidor($phone){
			return $this->db->row('SELECT `phone` FROM tr_send_kharidor WHERE `phone` = "'.$phone.'" ');
		}

		public function SearchAlls($text){
			return $this->db->row('SELECT * FROM tr_axia WHERE `name` LIKE "%'.$text.'%" OR `id` LIKE "%'.$text.'%" LIMIT 0, 99');
		}
		


	} // End Class