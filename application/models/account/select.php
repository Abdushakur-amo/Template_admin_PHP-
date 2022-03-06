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

		public function SelHistiryPay($Count=false, $Stert=0, $End=1){
			// DESC LIMIT $Stert, $End
			if( $Count ) return $this->db->row(" SELECT COUNT(`id`) FROM `tr_history_pay`");
			return $this->db->row(" SELECT * FROM `tr_history_pay` ORDER BY `id` DESC ");
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

		public function SelectSummaSend($type, $id_user){
			$return = $this->db->row(" SELECT `summa` FROM `tr_transactions_history` WHERE type = $type AND id_user = $id_user");
			$summaAll = 0;
			foreach($return as $val) $summaAll += floatval($val['summa']);
			return $summaAll;
		}

		public function ActiveSummaAxia($id_user){
			$return = $this->db->row(" SELECT `summa`, `id_axia` FROM `tr_user_trans` WHERE  id_user = $id_user ORDER BY `id` DESC");
			$A = 0;
			$B = 0;
			foreach ($return as $value) {
				if( prodaniAxia($value['id_axia'], 4) ) $A += $value['summa']; // ждёт покупателя
				if( prodaniAxia($value['id_axia'], 0) ) $B += $value['summa']; // на продаже
			}
			$All = ($A + $B);
			$Array = [ 'A' => $A, 'B' => $B, 'All' => $All];
			return $Array;
		}


		public function ASAxiaAndPribl($id_user){
			$return = $this->db->row(" SELECT `summa`, `id_axia` FROM `tr_user_trans` WHERE  id_user = $id_user ORDER BY `id` DESC");
			$MyDokhod = 0; $foiz = 0; $SummaAll = 0;
			foreach ($return as $value) {
				// Сумма даход
				if( prodaniAxia($value['id_axia'], 4) || prodaniAxia($value['id_axia'], 0)  ){
					$foiz = UnikTableAxia($value['id_axia'], 'foiz');
               		$MyDokhod += ($value['summa'] * $foiz / 100);
               		$SummaAll += $value['summa'];

				}
			}
			$All = ($SummaAll + $MyDokhod);
			$Array = ['Dokhoa' => $MyDokhod, 'Summa' => $SummaAll, 'All' => $All];
			return $Array;
		}


		public function SelectDepozit($id_user, $id=0){
			if(!$id) return $this->db->row(" SELECT * FROM `tr_depozit` WHERE id_user = $id_user ORDER BY `id` DESC");
			$return = $this->db->row(" SELECT * FROM `tr_depozit` WHERE id_user = $id_user AND id = $id ORDER BY `id` DESC");
			return $return;
		}

		public function SelectInfoDepozit(){
			$return = $this->db->row(" SELECT * FROM `tr_info_depozit` ORDER BY `id` DESC");
			return $return;
		}



		// Потом даработваем!!!
		// public function YoShopCodePay($text){
		// 	return $this->db->row(" SELECT `id`, `name` FROM `user_klent` WHERE phone = '$text' ");
		// }

	} // End Class
