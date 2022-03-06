<?php
    if(!empty($_POST)){

        $SendInfo = format992($_POST['recovery']);

        $User = $this->MSelect->SelectUsersID(0, 0, $SendInfo);
        if( empty($User) ) $this->view->message_ajax('Ошибка! ', "По этому номеру $SendInfo ничего не найдено", 'error');
        $phone = substr($User['0']['phone'], 9);
        $new_password = substr(uniqid('5'), 9).$phone;
        $smsP = rand(11111, 99999);
        $_SESSION['recovery']  = [
            'code' => $smsP,
            'name' => 'recovery',
            'id_user' => $User[0]['id'],
        ];
        $message = "Код для восстановление аккоунд: ".$smsP;
        mail($User['0']['email'], 'Восстановление аккоунд', $message);
        $this->Send_SMS( $User['0']['phone'], $message,  $User['0']['id'] );
        $this->view->location( '/account/config');


    }
