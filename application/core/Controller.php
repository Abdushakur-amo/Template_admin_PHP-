<?php
namespace application\core;
use application\core\View;
abstract class Controller {
	public $route;
	public $view;
	public $acl;
	public $MSelect;
	public $MInsert;
	public $MUpdate;
	public function __construct($route) {
		$this->route = $route;
		if (!$this->checkAcl()) {
			if ( !isset($_COOKIE['User']) and !isset($_SESSION['authorize']['id']) ) exit(header('Location: /account/login'));
			View::errorCode(403, 'У Вас нет прав для доступа к этой странице! <br> <br> <b>'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL'].'</b>');
		}

		$this->view = new View($route);
		# Выключатель дополнители класс / demo($MInsert->Test());
		$this->model 	= $this->loadModel($route['controller']);
		$this->MSelect 	= $this->ModelsSelect($route);
		$this->MInsert 	= $this->ModelsInsert($route);
		$this->MUpdate 	= $this->ModelsUpdate($route);
		# Save Cookie
		if ( isset($_COOKIE['User']) and !isset($_SESSION['authorize']['id']) ) $this->Save_Cooke();
		# NotificationAll
		$_SESSION['chat_users'] = $this->model->SelectChat(0, 3);
		if(isset($_SESSION['authorize']['id'])){
			if($_SERVER["REQUEST_URI"] == '/') header('location: /index');
			# User Online
			$this->model->UpdateUserOnlain($_SESSION['authorize']['id']);
			$_SESSION['User_online'] = $this->UserOnline($_SESSION['authorize']['id']);
			# SMS Message
			$_SESSION['NewMessage'] = $this->NewMessage($_SESSION['authorize']['id']);
		}
	}
	# - .- .-  User Online  .- .- .- .;
	public function UserOnline($id_user){
		$Info = $this->model->SelectorUserOnlain($id_user, $_SERVER['SERVER_ADDR']);
		$Online = $this->model->SelectUserProfils($id_user);
		$html   = '<div> В сеть <i class="fa fa-spin fa-refresh"></i>';
		$NotHtml   = '<em>был(а) '.dateFormatTj($Online[0]["online"], 'time').'</em>';
		if( !empty($Info) ) return $html;
		else return $NotHtml;
	}
	# - .- .-  Выключатель дополнители класс Models: Select / Insert / UpDate  .- .;
	public function loadModel($name) {
		$path = 'application\models\\'.ucfirst($name);
		if (class_exists($path)) return new $path($this->route);
	}
	public function ModelsSelect($route){
		include 'application/models/'.$route["controller"].'/select.php';
		$NameClass = 'Models'.ucfirst($route["controller"]).ucfirst('select');
		if (class_exists($NameClass))
			return new $NameClass;
		else demo($NameClass.' Не сушествует class: /application/models/'.$route["controller"].'/'.$NameClass);
	}
	public function ModelsInsert($route){
		include 'application/models/'.$route["controller"].'/insert.php';
		$NameClass = 'Models'.ucfirst($route["controller"]).ucfirst('insert');
		if (class_exists($NameClass))
			return new $NameClass;
		else demo($NameClass.' Не сушествует class: /application/models/'.$route["controller"].'/'.$NameClass);
	}
	public function ModelsUpdate($route){
		include 'application/models/'.$route["controller"].'/update.php';
		$NameClass = 'Models'.ucfirst($route["controller"]).ucfirst('update');
		if (class_exists($NameClass))
			return new $NameClass;
		else demo($NameClass.' Не сушествует class: /application/models/'.$route["controller"].'/'.$NameClass);
	}
	# - .- .- .- .- .- 	# New Message .- .- .- .- .- .- .;
	public function NewMessage($id_user) {
		$return = $this->model->SelectDialogNotifi($id_user, 0);
		return $return[0]["COUNT(`id`)"];
	}
	public function ValidateSumma($Summa) {
		$Summa = floatval($Summa);
		if( $Summa <= 0 ) return false;
		return $Summa;
	}
	public function Save_Cooke() {
		$Row = $this->model->SelectorAll('users', 'id', $_COOKIE['User']);
		foreach ($Row[0] as $key => $value) $_SESSION['authorize'][$key] = $value;
		$_SESSION['admin'] = true;
		$this->view->redirect('/admin/index');
	}
	public function checkAcl() {
		$this->acl = require 'application/acl/'.$this->route['controller'].'.php';
		if ($this->isAcl('all')) return true;
		elseif (isset($_SESSION['authorize']['id']) and $this->isAcl('authorize')) return true;
		elseif (!isset($_SESSION['authorize']['id']) and $this->isAcl('guest')) return true;
		elseif (isset($_SESSION['admin']) and $this->isAcl('admin')) return true;
		return false;
	}
	public function isAcl($key) {
		return in_array($this->route['action'], $this->acl[$key]);
	}
	public function my_json_encode($array) {
		if (!$array) $array = 'null_search';
		return json_encode($array, JSON_UNESCAPED_UNICODE);
	}
	#  .- .-  SEND SMS  .- .-
	public function Send_SMS($phone_number, $message='Test message', $id=true, $block=true) {
		if( $block ){
			$configSMS = require 'application/config/set_sms.php';
    		$txn_id = uniqid($id); //ID сообщения в вашей базе данных, оно должно быть уникальным для каждого сообщения
    		$str_hash = hash('sha256',$txn_id.';'.$configSMS['login'].';'.$configSMS['sender'].';'.$phone_number.';'.$configSMS['hash']);
    		$params = array(
    		    "from" => $configSMS['sender'],
    		    "phone_number" => $phone_number,
    		    "msg" => $message,
    		    "str_hash" => $str_hash,
    		    "txn_id" => $txn_id,
    		    "login"=>$configSMS['login'],
    		);
    		$result = call_api($configSMS['server'], "GET", $params);
    		if ((isset($result['error']) && $result['error'] == 0)){
        		$response = json_decode($result['msg']);
        		return $response;
    		}
    		else return $result;
		}
		else return false;
	}
} // End Class
