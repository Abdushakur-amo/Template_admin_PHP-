<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller {

	public function indexAction() {
		if( isset($_SESSION['authorize']['id']) ) exit(header('Location: /admin/index'));
		$this->view->redirect('/account/login');
	}

} // End class
