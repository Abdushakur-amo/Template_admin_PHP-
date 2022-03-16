<?php
	//./././././././././././././././././././././././
	// - Admin Select
	//./././././././././././././././././././././././
	use application\lib\Db;
	class ModelsAdminSelect  {
		public $db;
		public function __construct(){
			# Работа с баз данных
			$this->db = new Db;
		}
		public function SelectUsersID($id, $count=false, $phone=false){
			if($count) return $this->db->row(" SELECT COUNT(`id`) FROM `users`");
			elseif($phone) return $this->db->row(" SELECT * FROM `users` WHERE phone = $phone ");
			return $this->db->row(" SELECT * FROM `users` WHERE id = $id ");
		}
		public function SelectChatID($ID, $foreach=false){
			$result = $this->db->row(" SELECT * FROM `chat` WHERE id = $ID");
			if($foreach) {
				foreach ($result as $value) {
					$result = ['info' => $value, 'name' => users($value['id_user'], 'name')];
				}
			}
			return $result;
		}
		public function UserSelectVal($id_user, $val=false) {
			if( !$val ) return $this->db->row("SELECT * FROM Wallet WHERE id_user = $id_user ");
			else {
				$result = $this->db->row("SELECT $val FROM Wallet WHERE id_user = $id_user ");
				return ( isset($result['0'][$val]) ) ? floatval($result['0'][$val]) : false;
			}
		}
		public function select_post($count=false) {
			if($count) return $this->db->row(" SELECT COUNT(`id`) FROM `products`");
			return $this->db->row("SELECT * FROM products ");
		}

	} // End Class
