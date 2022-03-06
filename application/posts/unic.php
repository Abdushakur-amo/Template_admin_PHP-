<?php
    if ( !empty($_POST) ) {

        if ($_POST['name'] == 'search_user_pay' ) {
            $code = SubStrCode($_POST['data']);
            $user = $this->MSelect->SearchUserCodePay($code);
            $class = 'text-success';
            $id = 0;
            if( empty($user) ) {
                $user = 'Ползовател не найденно';
                $class = 'text-danger';
            }
            else{
                $u_name = $user['0']['name'];
                $id = $user['0']['id'];
                $user =  $u_name;
            }
            $array1 = [
                'name' => 'search_user_pay',
                'user' => $user,
                'id' => $id,
                'class' => $class,
            ];
            exit($this->my_json_encode($array1));
        }
    } # End All $_POST
?>
