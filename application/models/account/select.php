<?php
	//./././././././././././././././././././././././
	// - Account Select
	//./././././././././././././././././././././././
	use application\lib\Db;
	class ModelsAccountSelect  {
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
		public function SelectDialog($id_user, $tow=false, $Count=false){
			// DESC LIMIT $Stert, $End
			if($tow) return $this->db->row(" SELECT * FROM `dialog` WHERE (sender = $id_user OR recipient = $id_user) AND (sender = $tow OR recipient = $tow) ");
			elseif( $Count ) return $this->db->row(" SELECT COUNT(`id`) FROM `dialog` WHERE sender = $id_user OR recipient = $id_user");
			return $this->db->row(" SELECT * FROM `dialog` WHERE sender = $id_user OR recipient = $id_user ORDER BY `date` DESC ");
		}
		public function SelectDialogID($id){
			return $this->db->row(" SELECT * FROM `dialog` WHERE id = $id");
		}
		public function SelMessageSMS($Did, $Count=false){
			if( $Count ) return $this->db->row(" SELECT COUNT(`id`) FROM `message` id_dialog = $Did ");
			return $this->db->row(" SELECT * FROM `message` WHERE  id_dialog = $Did ORDER BY `id` ");
		}
		public function SearchUserCodePay($text){
			return $this->db->row(" SELECT `id`, `name` FROM `users` WHERE phone = '$text' OR id_code = '$text' ");
		}
		public function WalletTreder($id_user){
			$return = $this->db->row(" SELECT `summa` FROM `tr_user_pay` WHERE id_user = $id_user");
			return floatval($return[0]['summa']);
		}

	} // End Class
