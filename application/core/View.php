<?php
namespace application\core;
class View {
	public $path;
	public $route;
	public $layout = 'default';
	public function __construct($route) {
		$this->route = $route;
		$this->path = $route['controller'].'/'.$route['action'];
	}
	public function render($title, $vars = []) {
		extract($vars);
		$path = 'application/views/'.$this->path.'.php';
		if (file_exists($path)) {
			ob_start();
			require $path;
			$content = ob_get_clean();
			if($this->route["controller"] == 'account') require 'application/views/layouts/account.php';
			else require 'application/views/layouts/'.$this->layout.'.php';
		}	else  $this->errorCode('404', 'Вид в папку | '.$path. ' не найденыо!');
	}
	public function redirect($url) {
		header('location: '.$url);
		exit;
	}
	public static function errorCode($code, $text) {
		http_response_code($code);
		$path = 'application/views/errors/'.$code.'.php';
		if (file_exists($path))	require $path;
		exit("application/views/errors/$code | не найденыо!");
	}
	public function message($status, $message) {
		exit(json_encode(['status' => $status, 'message' => $message]));
	}
	public function message_ajax($title=false, $message=false, $icon='success', $button="OK", $reset=false) {
		exit('{
			"name":"message",
			"title":"'.$title.'",
			"message":"'.$message.'",
			"icon" : "'.$icon.'",
			"button" : "'.$button.'",
			"reset" : "'.$reset.'",
			"locat_function" : "default"
		}');
	}
	public function location($url, $time=false, $title=false, $message=false, $icon='success', $button="OK") {
		//$_SERVER["REQUEST_URI"]
		exit(json_encode(
			[
				'url' 		=> $url,
				'time' 		=> $time,
				'title' 	=> $title,
				'message'	=> $message,
				'icon'		=> $icon,
				'button'	=> $button,
			]
		));
	}
} # End class
