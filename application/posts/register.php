<?php
	if ( !empty($_POST) ) {
		$_POST['phone'] = format992($_POST['phone']);
		if( $_POST['password'] != $_POST['password2'] ) $this->view->message_ajax('Ошибка!', 'Повторный пароль не совподает!', 'error');
		if( $this->MSelect->SelectUsersID(0, 0, $_POST['phone']) ) $this->view->message_ajax('Status error!', 'Этот номер уже используется!', 'error');
		$_POST['password'] = md5($_POST['password']);
		$Code = random_int(10000, 99999);
		$mes = '<b>Ваш код подтверждения: '.$Code.'</b> <br> Никому не давайте код, даже если его требуют от имени компания!';
		mail($_POST['email'], 'Подтверждение account', $mes);
		$this->Send_SMS($_POST['phone'], $mes, $Code);
		$_SESSION['time_confir'] = ['post' => $_POST, 'code' => $Code];
		$this->view->location('/account/config');
	} //End $_POST
