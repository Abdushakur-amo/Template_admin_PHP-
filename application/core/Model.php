<?php
namespace application\core;
use application\lib\Db;
abstract class Model {
	public $db;
	public function __construct($route) {
		# Работа с баз данных
		$this->db = new Db;
	}
	public function SelectorUserOnlain($id_user, $ip) {
		return $this->db->row("SELECT * FROM online WHERE id_user = $id_user");
	}
	public function UpdateUserOnlain($id_user){
		$info = $this->SelectorUserOnlain($id_user, $_SERVER['SERVER_ADDR']);
		if( empty($info) ){
			$params = [
				'id'  		=> null,
				'id_user' => $id_user,
				'ip' 			=> $_SERVER['SERVER_ADDR'],
				'date'  	=> date('Y-m-d H:i:s'),
			];
			$this->db->query('INSERT INTO online VALUES (:id, :id_user, :ip, :date)', $params);
			return $this->db->lastInsertId();
		}
		else{
			$this->db->query("UPDATE `online` SET  date = NOW() WHERE id_user = $id_user");
			$this->db->query("UPDATE `users` SET  online = NOW() WHERE id = $id_user");
		}
		$this->db->query("DELETE FROM `online` WHERE `date` < SUBTIME(NOW(), '0 0:02:0')");
		return true;
	}
	public function SelectUserProfils($id, $count=false){
		if( $count ) return $this->db->row("SELECT COUNT('id') FROM `users` ");
		elseif( $id == 'Users') return $this->db->row("SELECT * FROM `users` ");
		else return $this->db->row("SELECT * FROM `users` WHERE id = $id ");
	}
	public function SelectorOne($tables, $wehre, $text, $td1=null, $td2=null, $td3=null, $td4=null, $td5=null) {
		$params = [ $wehre  => $text ];
		$result = $this->db->row('SELECT '.$td1.' '.$td2.' '.$td3.' '.$td4.' '.$td5.' FROM '.$tables.' WHERE '.$wehre.' = :'.$wehre.' ', $params);
		return $result;
	}
	public function SelectDialogNotifi($id_user, $status){
		return $this->db->row(" SELECT COUNT(`id`) FROM `dialog` WHERE recipient = $id_user AND status = $status");
	}
	public function UNIVERSAL_EDIT( $table, $WHERE, $WHEREID, $cell1, $Val1, $WHERE2=false, $wehreVal=false ){
		if( $WHERE2 and $wehreVal ){
			$params = [
				$WHERE  	=> $WHEREID,
				$WHERE2  	=> $wehreVal,
				$cell1  	=> $Val1,
			];
			$this->db->query('UPDATE '.$table.' SET  '.$cell1.' = :'.$cell1.' WHERE '.$WHERE.' = :'.$WHERE.' and '.$WHERE2.' = :'.$WHERE2.' ', $params);
		} else{
			$params = [$WHERE  	=> $WHEREID,$cell1  	=> $Val1,];
			$this->db->query('UPDATE '.$table.' SET  '.$cell1.' = :'.$cell1.' WHERE '.$WHERE.' = :'.$WHERE.' ', $params);
			return  $this->SelectorAll($table, $WHERE, $WHEREID);
		}
	}
	public function UNIVERSAL_DELETE($table, $p1, $val1, $p2=false, $val2=false, $p3=false, $val3=false){
		if($p3){
			$params = [ $p1  => $val1, $p2  => $val2, $p3  => $val3 ];
			$this->db->query('DELETE FROM '.$table.' WHERE '.$p1.' = :'.$p1.' and '.$p2.' = :'.$p2.' and '.$p3.' = :'.$p3, $params);
		}
		elseif($p2){
			$params = [ $p1  => $val1, $p2  => $val2 ];
			$this->db->query('DELETE FROM '.$table.' WHERE '.$p1.' = :'.$p1.' and '.$p2.' = :'.$p2, $params);
		}
		else{
			$params = [ $p1  => $val1 ];
			$this->db->query('DELETE FROM '.$table.' WHERE '.$p1.' = :'.$p1, $params);
		}
	} # End public
	public function SelectorAll($tables, $tip = false, $select = false, $typenasiya = false, $textNasiya = false) {
		if($tip){
			if( $typenasiya ){
				$params = [ $tip  => $select, $typenasiya => $textNasiya];
				$result = $this->db->row('SELECT * FROM '.$tables.' WHERE '.$tip.' = :'.$tip.' and '.$typenasiya.' = :'.$typenasiya.'  ORDER BY `date` DESC ', $params);
			}  else{
				$params = [ $tip  => $select, ];
				$result = $this->db->row('SELECT * FROM '.$tables.' WHERE '.$tip.' = :'.$tip.' ORDER BY `date` DESC', $params);
			}

		} else $result = $this->db->row('SELECT * FROM '.$tables);
			return $result;
	}
	public function insertInto_universal($table, $params, $values) {
		$this->db->query('INSERT INTO '.$table.' VALUES ('.$values.')', $params);
		return $this->db->lastInsertId();
	}
	public function SelectChat($Stert=0, $End=1, $Count=false){
		if( $Count ) return $this->db->row(" SELECT COUNT(`id`) FROM `chat`");
		return $this->db->row(" SELECT * FROM `chat` ORDER BY `id` DESC LIMIT $Stert, $End");
	}
} // End class
