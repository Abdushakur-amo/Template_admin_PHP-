<?php

	function CodeAndTelUser($code) {
		$result = rowSQL('SELECT `id`, `id_code`, `name`, `tel` FROM `users` WHERE `tel` = '.$code.' or `id_code` = '.$code);
		if( empty($result) ) return false;
		else return $result[0];
	}
	function cookie($id) {
		$result = rowSQL('SELECT * FROM `users` WHERE `id` = '.$id);
		if( empty($result) ) return false;
		else return $result[0];
	}
	function TR_Users($id, $select) {
		$result = rowSQL('SELECT '.$select.' FROM `users` WHERE `id` = '.$id);
		if( !empty($result) ) return $result[0][$select];
		else return false;
	}
	function User_UNIC($id, $val) {
		$result = rowSQL('SELECT `'.$val.'` FROM `users` WHERE `id` = '.$id);
		if( !empty($result) ) return $result[0][$val];
		else return false;
	}
