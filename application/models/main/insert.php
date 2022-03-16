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
	} // End Class
