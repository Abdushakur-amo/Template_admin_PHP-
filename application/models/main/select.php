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
	} // End Class
