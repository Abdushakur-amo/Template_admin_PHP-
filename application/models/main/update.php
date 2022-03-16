<?php
	//./././././././././././././././././././././././
	// - Main UpDate
	//./././././././././././././././././././././././
	use application\lib\Db;
	class ModelsMainUpdate  {
		public $db;
		public function __construct(){
			# Работа с баз данных
			$this->db = new Db;
		}
	} // End Class
