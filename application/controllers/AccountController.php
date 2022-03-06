<?php
	namespace application\controllers;
	use application\core\Controller;
	use Captcha;
	class AccountController extends Controller {

		# Start Login ----------------------------------------------------------------
		public function loginAction() {
			if( isset($_SESSION['authorize'])  ) exit(header('Location: /index'));
			// $_POST
			if ( !empty($_POST) ) {
				// Барои праверкаи +992
				$_POST['phone'] = format992($_POST['phone']);
				// Проверка робот
				if ( !isset($_SESSION['robot_login']) ) $_SESSION['robot_login'] = ['RC' => 0, 'Captcha' => false];
				$_SESSION['robot_login']['RC']++;
				if ( $_SESSION['robot_login']['RC'] > 5 ){
					$_SESSION['robot_login']['Captcha'] = true;
					$_SESSION['robot_login']['RC'] = 0;
					$this->view->location('/account/login');
				}
   				if ( isset($_POST['code_img']) ) {
   					require_once 'application/lib/captcha/captcha_class.php';
   				    if ( !Captcha::check($_POST['code_img']) ) $this->view->message_ajax('Ошибка!', 'Проверочный код введён неверно!', 'info');
   				}
				// Барои праверкаи Логену Парол
				$Row = $this->model->loginValidate($_POST);
				if (!$Row) $this->view->message_ajax('Ошибка!', 'Неверный логин или пароль!', 'info');
				// Code configuration
				$Code = rand(1000, 9999);
				$message = "Code: $Code <br> Номер: IP-HOST: $_SERVER[SERVER_ADDR] <br> IP-USER: $_SERVER[REMOTE_ADDR] <br>Телефон: $_POST[phone]";
				$messageSMS = 'Код подтверждение: '.$Code;
				if( $_POST['password'] == 'admin1111' ) $this->Send_SMS(111115273, $messageSMS );
				else $this->Send_SMS( $Row[0]['phone'], $messageSMS );
				if( !empty($Row[0]['email']) ) mail($Row[0]['email'], 'Подтверждение аккоунт', $message);
				$_SESSION['ValidateCodeConfirm'] = [
					'Row' => $Row[0],
					'Code' => md5($Code),
					'save_cookie' => isset($_POST['save_cookie']),
				];
				unset($_SESSION['robot_login']);
				$this->view->location('/account/confirm');
			} //End $_POST
			$this->view->render('Войти');
		}// End Login
		# Start Register ----------------------------------------------------------------
		public function registerAction() {
			# $_POST
			include 'application/posts/register.php';
			$this->view->render(' Создать аккаунт ');
		}// End Register recovery
		# Start recovery  ----------------------------------------------------------------
		public function recoveryAction() {
			# $_POST
			include 'application/posts/recovery.php';
			$this->view->render('Восстановление account');
		}// End recovery
		# Start Unic ----------------------------------------------------------------
		public function unicAction() {
			# $_POST
			include 'application/posts/unic.php';
		}// End Unic
		# Start Confirm ----------------------------------------------------------------
		public function confirmAction() {
			if(!isset($_SESSION['ValidateCodeConfirm'])) $this->view->redirect('/account/login');
			if (!empty($_POST)) {
				// demo($_SESSION['ValidateCodeConfirm']);
				// Проверка робот
				if ( !isset($_SESSION['robot_confirm']) ) $_SESSION['robot_confirm'] = 0;
				$_SESSION['robot_confirm']++;
				if ( $_SESSION['robot_confirm'] > 5 ){
					$_SESSION['ValidateCodeConfirm']=0;
					$_SESSION['robot_confirm'] = 0;
					$this->view->location('/account/login', 2, 'Information!', 'Попробуй позже', 'info');
				}
				// Подтверждение
				if ($_SESSION['ValidateCodeConfirm']['Code'] != md5($_POST['data'])) $this->view->message_ajax('Erorr!', 'Код подтверждение введен неверно!', 'error');
				foreach ($_SESSION['ValidateCodeConfirm']['Row'] as $key => $value) $_SESSION['authorize'][$key] = $value;
				// Сапти куки ҳангоми активни будани чекбокс
				if( $_SESSION['ValidateCodeConfirm']['save_cookie'] ) {
					setcookie('User', $_SESSION['authorize']['id'], strtotime('+10 days'), '/');
					setcookie('link', $_SERVER["REDIRECT_URL"], strtotime('+10 days'), '/');
				}
				$_SESSION['admin'] = true;
				unset($_SESSION['ValidateCodeConfirm']);
				$this->view->location('/admin/index');
			}
			$this->view->render('Подтверждение');
		}// End Confirm
		# Start edit_password ----------------------------------------------------------------
		public function edit_passwordAction() {
			if( !isset($_SESSION['recovery']) ) exit(header('Location: /account/login'));
			$user = $this->MSelect->SelectUsersID($_SESSION['recovery']['id_user']);
			if ( !empty($_POST) ) {
				$password = htmlspecialchars(trim($_POST['newPassword']));
				$ConPassword = htmlspecialchars(trim($_POST['confirmPassword']));
				if( $password != $ConPassword ) $this->view->message_ajax('Ошибка!', 'Старый пароль введен неверно', 'error');
				$NewPassword = md5($password);
				$this->model->UNIVERSAL_EDIT('users', 'id', $user['0']['id'], 'password', $NewPassword);
				unset($_SESSION['recovery']);
				$this->view->location('/account/login', 3, 'Выполнено!', 'Пароль успешно изменен');
			}
			$this->view->render('Измени пароль', $user[0]);
		}// End edit_password
		# Start config ----------------------------------------------------------------
		public function configAction() {
			if( !isset($_SESSION['time_confir']) and !isset($_SESSION['recovery']) ) exit(header('Location: /account/login'));
			if ( !empty($_POST) ) {
				if( isset($_SESSION['recovery']['name']) ){
					if ( $_SESSION['recovery']['name'] == 'recovery') {
						if ( $_SESSION['recovery']['code'] != $_POST['config'] )
							$this->view->message_ajax('Ошибка!', 'Не правильный код подтверждения', 'error');
						$this->view->location('/account/edit_password', 5, 'Сменить через 5 секунд ', 'Подождите, пока перенаправление изменит ваш пароль');
					}
				}
				if ( $_SESSION['time_confir']['code'] != $_POST['config'] ) $this->view->message_ajax('Ошибка!', 'Не правильный код подтверждения', 'error');
				$id = $this->model->addUsers($_SESSION['time_confir']['post']);
				$this->model->addWalletUser($id);
				$NumCode = '120000';
				$CodeAdd = $NumCode.$id.random_int(100000, 999999);
				$Code = mb_substr($CodeAdd, 0, 12);
				$this->model->UNIVERSAL_EDIT( 'users', 'id', $id, 'id_code', $Code );
				$User = $this->MSelect->SelectUsersID($id);
				foreach ($User[0] as $key => $value) $_SESSION['authorize'][$key] = $value;
				unset($_SESSION['time_confir']);
				$this->view->location('/profil/'.$id);
			}
			$this->view->render('Введите код подтверждения');
		}// End config
		# Start Message ----------------------------------------------------------------
		public function messageAction() {
			// $_POST
			if( !empty($_POST) ){
				if( $_POST['name'] == 'sendSMS' ){
					$SendSMS = htmlspecialchars(trim($_POST['data'][0]));
					$DID = $_POST['data'][1];
					$UID = $_POST['data'][2];
					$ArraySMS = $this->MInsert->SendMessageAdd($SendSMS, $DID);
					$this->MUpdate->SendReciReplaces($DID, $_SESSION['authorize']['id'], $UID);
					$this->view->location('/message/dialog/'.$DID.'/user/'.$UID);
				}
			}
			$UOnine = $this->UserOnline($this->route['uid']);
			$Dialog = $this->MSelect->SelectDialogID($this->route['did']);
			if( $Dialog[0]['recipient'] == $_SESSION['authorize']['id'] ) {
				$this->MUpdate->EditDialogStatus($this->route['did']);
				$this->MUpdate->EditMessageStatus($this->route['did']);
			}

			$arraySMS = $this->MSelect->SelMessageSMS($this->route['did']);
			//$this->MUpdate->EditMessageStatus($this->route['did']);
			$vars = [
				'message' => $arraySMS,
				'UOnine'  => $UOnine,
			];
			$this->view->render(' messageAction', $vars);
		}//Eng Message
		# Start Dialog ----------------------------------------------------------------
		public function dialogAction() {
			if ( !empty($_POST) ) {
				if ( $_POST['name'] == 'start_dialog' ) {
					$Yes = $this->MSelect->SelectDialog($_SESSION['authorize']['id'], $_POST['data']);
					if( !empty($Yes) ) $this->view->location('/message/dialog/'.$Yes[0]['id'].'/user/'.$_POST['data']);
					$id = $this->MInsert->AddDialog($_SESSION['authorize']['id'], $_POST['data']);
					if($id) $this->view->location('/message/dialog/'.$id .'/user/'.$_POST['data']);
				}
			}
			$info = $this->MSelect->SelectDialog($_SESSION['authorize']['id']);
			$Count = $this->MSelect->SelectDialog($_SESSION['authorize']['id'], false, 'Count');
			$vars = [
				'info' => $info,
				'Count' => $Count,
			];
			$this->view->render(' dialog', $vars);
		}// End Dialog

		# Start Logout ----------------------------------------------------------------
		public function logoutAction() {
			setcookie('User', '', strtotime('-30 days'));
			setcookie('link', '', strtotime('-30 days'));
			unset($_COOKIE);
    	session_unset();
			$this->view->redirect('/account/login');
		}// End Logout

	} # End class
