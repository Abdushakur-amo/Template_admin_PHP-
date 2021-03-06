<?php
	namespace application\controllers;
	use application\core\Controller;
	class AdminController extends Controller {
    # Start Index ----------------------------------------------------------------
    public function indexAction() {
      $this->view->render('Главная страница');
    } // End Index
		# Start Profil
		public function profilAction() {
			$User = $this->model->SelectUserProfils($this->route['id']);
			if( empty($User) ) exit('Ползователь не найден! <br> <p><a href="/profil/'.$_SESSION["authorize"]["id"].'">Переитти в профиль</a></p>');
			$Wallet = $this->MSelect->UserSelectVal($this->route['id'], 'summa');
			$OnlineDate = $this->UserOnline($this->route['id']);
			$vars = [
				'User' => $User['0'],
				'Wallet'  => $Wallet,
				'Online' => $OnlineDate,
			];
			$this->view->render('Главная страница ', $vars);
		}// End Profil
		# Start Setting ----------------------------------------------------------------
		public function settingAction() {
			if( !empty($_POST) ){
				if( !isset($_POST['name']) ) $_POST['name'] = false;
				if( isset($_POST['namefileuploda']) ){
					if ( !in_array( $_FILES['avater']['type'], array("image/gif", "image/jpeg", "image/png") ) )
						$this->view->message_ajax('Ошибка!', 'Фото должен быть jpeg/gif/png и не более 5 мб', 'error');
					$this->model->UploadAvatar($_FILES["avater"]["tmp_name"], $_SESSION['authorize']['id']);
					$this->view->message_ajax('Выполнено', 'Для изменения обновите страницу');
				}
				if( $_POST['name'] == 'editNewPassword' ){
					$oldPassword = $_POST['data'][0];
					$newPassword  = $_POST['data'][1];
					$confirmPassword = $_POST['data'][2];
					if(empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) $this->view->message_ajax('Ошибка!', 'Пустые поля', 'info');
					$password = $this->MSelect->SelectUsersID($_SESSION['authorize']['id']);
					if( md5($oldPassword) != $password[0]['password'] ) $this->view->message_ajax('Ошибка!', 'Текущий пароль введен неверно', 'error');
					if($newPassword != $confirmPassword) $this->view->message_ajax('Ошибка!', 'Повтор пароль не совпадает', 'error');
					$result = $this->MUpdate->editPassword(md5($newPassword), $_SESSION['authorize']['id']);
					if( !$result ) $this->view->message_ajax('Ошибка!', 'Обратитесь к Администратору', 'error');
					$this->view->location('/admin/setting/'.$_SESSION['authorize']['id'], 2, 'Выполнено', ' ');
				}
				else{
					$id = $this->MUpdate->UpdateProfils($_SESSION['authorize']['id'], $_POST);
					$this->view->message_ajax('Выполнено', ' ');
				}
			}
			$info = $this->MSelect->SelectUsersID($_SESSION['authorize']['id']);
			$vars = [
				'info' => $info[0],
			];
			$this->view->render('Настройка', $vars);
		}// End Setting
		# Start Chat ----------------------------------------------------------------
		public function chatAction() {
			if (!empty($_POST)) {
				if( $_POST['name'] == 'dalet_chat_id' ){
					$this->model->DeletMessageChat($_POST['data']);
					$this->view->message_ajax('Ваш отзыв удалена!', ' ');
				}
				if( $_POST['name'] == 'add_chat' ){
					$message = htmlspecialchars(trim($_POST['data']));
					$id = $this->MInsert->AddMessageChat($message);
					$infoPOST = $this->MSelect->SelectChatID($id);
					$this->view->location('/admin/chat/1');
				}
			}
			$Count = $this->model->SelectChat(0, 0, 'Count');
			$info = $this->model->SelectChat(SStart($this->route['page'], 20), 20);
			$vars = [
				'info' => $info,
				'Count' => $Count[0]["COUNT(`id`)"],
			];
			$this->view->render('Групповой Чат', $vars);
		}// End Chat
		# Start Products ----------------------------------------------------------------
		public function productsAction(){
			$array = $this->MSelect->select_post();

			$vars = [
				'posts' => $array,
			];
			$this->view->render('Все продукти компания', $vars);
		}
		# Start Add_products ----------------------------------------------------------------
		public function add_productsAction(){
			// unset($_SESSION['img_count']);
			// unset($_SESSION['info_images_upload']);
			if(!empty($_POST)){

				$idT = $this->model->addTovar($_POST);
				if($idT){
					if(isset($_SESSION['img_count'])){
						$i = -1;
						$Root = $_SERVER['DOCUMENT_ROOT'];
						mkdir('files/tovar/'.date('m-Y'));
						foreach ($_SESSION['info_images_upload'] as $name_jpg) {
							$i++;
							rename($Root.'/files/tovar/'.$name_jpg, $Root.'/files/tovar/'.date('m-Y').'/'.$idT.'_'.$i.'.jpg');
						}
						unset($_SESSION['img_count']);
						unset($_SESSION['info_images_upload']);
					}
					$this->view->message_ajax('Выполнено', 'Status OK', 'success');
				}
			}
			if( !empty($_FILES) ){
				$this->model->upload_images($_FILES["file"]["tmp_name"], $_SESSION['authorize']['id']);
			}
			$this->view->render('Добавить товар');
		}
		# Start Single_poduct ----------------------------------------------------------------
		public function single_poductAction(){

		}
		# Start Categories ----------------------------------------------------------------
		public function categoriesAction(){
			$this->view->render('categories Чат');
		}
		# Start Add_working ----------------------------------------------------------------
		public function add_workingAction(){
			$this->view->render('Добавить работы');
		}
		# Start Add_working ----------------------------------------------------------------
		public function workingsAction(){
			$this->view->render('Все наш работы');
		}


} //End class
