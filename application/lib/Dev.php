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
	// Function - * - * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -
	include 'application/function/TB_tr_users.php';


	function CodeAndTelUserYoShop($code) {
		$result = rowSQL('SELECT * FROM `user_klent` WHERE `tel` = '.$code.' or `idPardokht` = '.$code);
		if( empty($result) ) return false;
		else return $result[0];
	}

	function User_UNIC($id, $val) {
		$result = rowSQL('SELECT `'.$val.'` FROM `users` WHERE `id` = '.$id);
		if( !empty($result) ) return $result[0][$val];
		else return false;
	}

	// <!-- Просмотр / Для каждое ползователь -->
	function you_view($material, $id_view) {
		$id = ( isset($_SESSION['authorize']['id']) ) ? $_SESSION['authorize']['id'] : 0;
		$result = rowSQL('SELECT * FROM `tr_view` WHERE `id_user` = '.$id.' AND `material` = '.$material.' AND `id_view` = '.$id_view);
		if( empty($result) ) return false;
		else return true;
	}

	function ReturnSmallComment($id_chat) {
		$result = rowSQL('SELECT * FROM `tr_chat_small` WHERE `id_chat` = '.$id_chat);
		if( empty($result) ) return 0;
		else return $result;

	}



	// - * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -
	function format_cart($id){
		$array = [
	        '1' => substr($id, 0, 4),
	        '2' => substr($id, 4, 3),
	        '3' => substr($id, 7, 5),
	    ];
	    return $array[1].' '.$array[2].' '.$array[3];
	}
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

	function statusPay($action) {
		if($action == -1) return 'закрыть';
		elseif($action == 0) return 'на продаже';
		elseif($action == 1) return 'не выбрань'; // Бадан ягон фикр мекунам
		elseif ($action == 2) return 'Продано';
		elseif ($action == 3) return 'отменено';
		elseif ($action == 4) return 'ждёт покупателя  &nbsp;<i class="anticon anticon-loading"></i>';
	}

	function statusPayClass($action) {
		if($action == -1) return 'f-close';
		elseif($action == 0) return 'f-price';
		elseif($action == 1) return 'f-none'; // Бадан ягон фикр мекунам
		elseif ($action == 2) return 'f-prodan';
		elseif ($action == 3) return 'f-undo';
		elseif ($action == 4) return 'f-pay';
	}


	function jinsUserText($type){
		if ($type == 0)     return 'Нет пола';
		elseif ($type == 1) return 'Муж';
		elseif ($type == 2) return 'Жен';
	}

	function type_history($type){
		if ($type == 1)     return 'Покупка акции';
		elseif ($type == 2) return 'Перевод на счет трейдера';
		elseif ($type == 3) return 'Снятие наличых';
		elseif ($type == 4) return 'Зачисленные средства';
		elseif ($type == 5) return 'Перевод на YOSHOP';
		elseif ($type == 6) return 'Пополнение баланса';
		elseif ($type == 7) return 'Прибыль акции';
		elseif ($type == 8) return 'Зачисленная сумма покупки акции';
		elseif ($type == 9) return 'Администратор отменил акции';
		elseif ($type == 10) return 'Инвестиционный портфель';
		elseif ($type == 11) return 'Пополнение из инвестиционный портфель';

	}

	function result_title($type){
		if ($type == -1)     return 'Ваш заявка отменено';
		elseif ($type == 1)  return 'Перевод на Хумо Онлайн';
		else if ($type == 2) return 'Перевод на Корти Миллӣ';
		else if ($type == 3) return 'Ваш заявка на перевод выполнено';
	}

	function result_title_icon($type){
		if ($type == -1)     return '<i class="icon-send anticon anticon-rollback"></i>';
		elseif ($type == 1)  return '<i class="icon-send anticon anticon-swap"></i>';
		else if ($type == 2) return '<i class="icon-send anticon anticon-swap"></i>';
		else if ($type == 3) return '<i class="icon-send anticon anticon-check-circle"></i>';
	}

	function type_history_color($type, $text){
		if ($type == 1)     return "<span style='color:#f00;'>-".$text." TJS</span>";
		elseif ($type == 2) return "<span style='color:#f00;'>-".$text." TJS</span>";
		elseif ($type == 3) return "<span style='color:#f00;'>-".$text." TJS</span>";
		elseif ($type == 4) return "<span style='color:#060;'>+".$text." TJS</span>";
		elseif ($type == 5) return "<span style='color:#f00;'>-".$text." TJS</span>";
	}

	function type_history_icon($type){
		if ($type == 1)     return '<i style="color: #666;" class=" anticon anticon-stock"></i>';
		elseif ($type == 2) return '<i style="color: #666;" class="fas fa-exchange-alt"></i>';
		elseif ($type == 3) return '<i style="color: #666;" class="fas fa-exchange-alt"></i>';
		elseif ($type == 4) return '<i style="color: #666;" class="fas fa-exchange-alt"></i>';
		elseif ($type == 5) return '<i style="color: #666;" class="fas fa-exchange-alt"></i>';
		elseif ($type == 6) return '<i style="color: #666;" class="fas fa-exchange-alt"></i>';
		elseif ($type == 7) return '<i style="color: #666;" class="fas fa-exchange-alt"></i>';
		elseif ($type == 8) return '<i style="color: #666;" class="fas fa-exchange-alt"></i>';
		elseif ($type == 10) return '<i class="anticon anticon-dot-chart"></i>';
	}


	function SubStrCode($code){
	    $code = mb_substr($code, 0, 15);
	    $if = mb_substr($code, 0, 4);
	    if($if == '1200' || strlen($code) == 12 ) return $code;
	    elseif( $if == '992' ) return format992($code);
		else return format992($code);
	}

	function SubStrCodeYoShop($code){
	    $code = mb_substr($code, 0, 15);
	    $if = mb_substr($code, 0, 4);
	    if($if == '1200' || strlen($code) == 12 ) return $code;
	    else return $code;
	}

	function control_avatar($id_user){
		$avatar =  ($_SESSION['authorize']['sex'] == 1) ? 'men' : 'women';
		if( !file_exists('files/users/a_avatar-'.$id_user.'.jpg') ) return '/files/users/'.$avatar.'.jpg';
		return '/files/users/a_avatar-'.$id_user.'.jpg';
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


	// dateFormatTj: 23.2.2021
	// Переобразоват: 20.Январ.2023
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


	// dateFormatTj: 23.2.2021
	// Переобразоват: 20.Январ.2023
	function dateFormatCode($text, $datatime = false, $soniya=false){
		$result = DateTimeFormatArray($text);
		// Формати россияро ба Тоҷикистон гардонидан
		$result['soat'] = $result['soat'] + 2;
		if($soniya) return  $result['ruz'].'.'.$result['mon'].'.'.$result['sol'].' / '.$result['soat'].':'.$result['daqiqa'].':'.$result['soniya'];
		elseif($datatime) return  $result['ruz'].'.'.$result['mon'].'.'.$result['sol'].' / '.$result['soat'].':'.$result['daqiqa'];
	    else  return  $result['ruz'].'.'.$result['mon'].'.'.$result['sol'];
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
