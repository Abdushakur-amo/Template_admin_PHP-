<?php
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	$config = require 'application/config/db.php';
	$CONNECT = mysqli_connect($config['host'], $config['user'], $config['password'], $config['name']);
	function rowSQL($sql){
		global $CONNECT;
		$result = mysqli_query($CONNECT, $sql);
		$array = [];
		while ($Row = mysqli_fetch_assoc($result)) $array[] = $Row;
		return $array;
	}
	// Function - * - * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- *
	include 'application/function/users.php';
	// - * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * --
	function ReturnSmallComment($id_chat) {
		$result = rowSQL('SELECT * FROM `tr_chat_small` WHERE `id_chat` = '.$id_chat);
		if( empty($result) ) return 0;
		else return $result;
	}
	// - * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * --
	function demo($str) {
		echo '<pre>';
		var_dump($str);
		echo '</pre>';
		exit;
	}
	function ok($str) {
		echo '<pre>';
		print_r($str);
		echo '</pre>';
	}
	function useridDbAdmin($action) {
		if     ($action == 1) return 'Администратор';
		elseif ($action == 2) return 'Модератор';
		elseif ($action == 5) return 'Продавец';
		elseif ($action == -1) return 'Заблокирован';
	}
	function userSEX($action) {
		if     ($action == 2) return 'https://cdn1.iconfinder.com/data/icons/website-internet/48/website_-_female_user-512.png';
		elseif ($action == 1) return 'https://gist.kz/img/no-user-image.png';
		else return 'https://library.kissclipart.com/20180926/exw/kissclipart-user-male-female-icon-clipart-computer-icons-user-4216c615a543b7ae.png';
	}
	function jinsUserText($type){
		if ($type == 0)     return 'Нет пола';
		elseif ($type == 1) return 'Муж';
		elseif ($type == 2) return 'Жен';
	}
	function control_avatar($id_user){
		$avatar =  ($_SESSION['authorize']['sex'] == 1) ? 'men' : 'women';
		if( !file_exists('files/users/a_avatar-'.$id_user.'.jpg') ) return '/files/users/'.$avatar.'.jpg';
		return '/files/users/a_avatar-'.$id_user.'.jpg';
	}
	function controlImgTovar($id, $date){
		$a = [
			'sol'    => substr($date, 0, 4),
			'mon'    => substr($date, 5, 2),
			'ruz'    => substr($date, 8, 2),
		];
		$url = 'files/tovar/'.$a['mon'].'-'.$a['sol'].'/'.$id.'_0.jpg';
		if( file_exists($url) ) return $url;
		return '/assets/images/other-images/maintenance-bg.jpg';
	}
	function format992($phone){
		// Барои праверкаи +992
		if( preg_match('#^992#', $phone) && !preg_match('#^\+992#', $phone) )
			$phone = '+'.$phone;
		elseif( !preg_match('#^\+992#', $phone ) )
			$phone = '+992'.$phone;
		return $phone;
	}
	// Маҷмуй ҳар як қисм алоҳида
	function DateTimeFormatArray($dateDb, $local=false){
	    $array = [
	        'sol'    => substr($dateDb, 0, 4),
	        'mon'    => substr($dateDb, 5, 2),
	        'ruz'    => substr($dateDb, 8, 2),
	        'soat'   => substr($dateDb, 11, 2),
	        'daqiqa' => substr($dateDb, 14, 2),
	        'soniya' => substr($dateDb, 17, 2),
	    ];
		if($local){
			$array['soat'] = ($array['soat'] + 2);
			$array['soat'] = strval($array['soat']);
			if( iconv_strlen($array['soat']) != 2 ) $array['soat'] = '0'.$array['soat'];
		}
	    return $array;
	}
	// dateFormatTj: 23.2.2021  Переобразоват: 20.Январ.2023
	function dateFormatTj($text, $datatime = false){
		$result = DateTimeFormatArray($text);
		switch ($result['mon']) {
			case '01':$mon = 'Январь';break;
			case '02':$mon = 'Февраль';break;
			case '03':$mon = 'Март';break;
			case '04':$mon = 'Апрель';break;
			case '05':$mon = 'Май';break;
			case '06':$mon = 'Июнь';break;
			case '07':$mon = 'Июль';break;
			case '08':$mon = 'Август';break;
			case '09':$mon = 'Сентябрь';break;
			case '10':$mon = 'Октябрь';break;
			case '11':$mon = 'Ноябрь';break;
			case '12':$mon = 'Декабрь';break;
			default:$mon = 'Не найдено Функсияи: dataText()';break;
		}
		// Формати россияро ба Тоҷикистон гардонидан
		$result['soat'] = intval($result['soat']) + 2;
		if($datatime == true) return  $result['ruz'].'.'.$mon.'.'.$result['sol'].' / '.$result['soat'].':'.$result['daqiqa'].' <i class="anticon anticon-clock-circle"></i>';
	  else  return  $result['ruz'].'.'.$mon.'.'.$result['sol'];
	}
	// >>>>>>>>>>>>>>>>>>>>> SMS
	function call_api($url, $method, $params){
	    $curl = curl_init();
	    $data = http_build_query ($params);
	    if ($method == "GET") {
	        curl_setopt ($curl, CURLOPT_URL, "$url?$data");
	    }else if($method == "POST"){
	        curl_setopt ($curl, CURLOPT_URL, $url);
	        curl_setopt ($curl, CURLOPT_POSTFIELDS, $data);
	    }else if($method == "PUT"){
	        curl_setopt ($curl, CURLOPT_URL, $url);
	        curl_setopt ($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded','	Content-Length:'.strlen($data)));
	        curl_setopt ($curl, CURLOPT_POSTFIELDS, $data);
	    }else if ($method == "DELETE"){
	        curl_setopt ($curl, CURLOPT_URL, "$url?$data");
	        curl_setopt ($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
	    }else{
	        dd("Методӣ номуаян. POST, GET,");
	    }
	    curl_setopt_array($curl, array(
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_ENCODING => "",
	        CURLOPT_MAXREDIRS => 10,
	        CURLOPT_TIMEOUT => 30,
	        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	        CURLOPT_CUSTOMREQUEST => $method
	    ));

	    $response = curl_exec($curl);
	    $err = curl_error($curl);

	    curl_close($curl);
	    $arr = array();
	    if ($err) {
	        $arr['error'] = 1;
	        $arr['msg'] = $err;
	    } else {
	        $res = json_decode($response);
	        if (isset($res->error)){
	            $arr['error'] = 1;
	            $arr['msg'] = "Error Code: ". $res->error->code ." Message: " . $res->error->msg;
	        }else{
	            $arr['error'] = 0;
	            $arr['msg'] = $response;
	        }
	    }
	    return $arr;
	}
	function SStart($page, $int){
		$Res_Start = ($page - 1 ) * $int;
		return $Res_Start;
	}
	function PaginationUnic($url, $page, $ColBD, $LIMIT = 5) {
		$Page = $ColBD / $LIMIT;
		//А нужен ли переключатель?
		if ($Page > 1) {
			$end = $page - 1;
			$endPagination = 0;
			echo '<div class="m-t-20 text-right">
					<ul class="pagination justify-content-end">';
			if($page != 1)
				echo '<li><a style="display: flex;align-items: center;justify-content: center;" class="page-link" href="'.$url.$end.'"><</a></li>';
			for($i = ($page - 3); $i < ($Page + 1); $i++) {
				if ($i > 0 and $i <= ($page + 3)) {
					if ($page == $i) $Swch = 'active';
					else $Swch = '';
					echo '<li class="page-item '.$Swch.'"><a class="page-link" href="'.$url.$i.'">'.$i.'</a></li>';
					$endPagination = $i;
				}
			}
			$next = $page + 1;
			if($page != $endPagination)
				echo '<li><a style="display: flex;align-items: center;justify-content: center;" class="page-link" href="'.$url.$next.'">></a></li>';
			echo '</div></ul>';
		}
	}
