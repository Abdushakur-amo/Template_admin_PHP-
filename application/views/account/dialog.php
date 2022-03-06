<!-- ID dialog or URL никакое рол неиграетӣ -->
<div class="container">
    <h2><?=$title?> <?=TR_Users($_SESSION['authorize']['id'], 'name')?></h2>
    <div class="cord">
    <?php foreach ($vars['info'] as $value) : ?>
        <?php
            $html = '';
            $class = ' ';
            if( $value['recipient'] == $_SESSION['authorize']['id'] && $value['status'] == 0 ) {
                $class = 'YourSendMessage';
            }
            elseif($value['sender'] == $_SESSION['authorize']['id']){
                if( $value['status'] == 1 )
                    $html = 'Просмотрено <i class="far fa-eye"></i>';
                elseif( $value['status'] == 0 )
                    $html = 'Не просмотренно <i class="far fa-eye-slash"></i>';
            }
            else $html = '';
        ?>
        <a class="chat-list-item p-h-25" href="/message/dialog/<?=$value['id']?>/user/<?=InfoUSend($value['sender'], $value['recipient'], 'id')?>">
            <div class=" <?=$class?>  media align-items-center" style="position: relative;">
                <div class="avatar avatar-image">
                    <img src="<?=control_avatar($value['sender'])?>">
                </div>
                <div class="p-l-15">
                    <h5 class="m-b-0"><?=InfoUSend($value['sender'], $value['recipient'])?></h5>
                    <!-- <p class="msg-overflow m-b-0 text-dark ">
                        Wow, that was cool!
                    </p> -->
                    <span class="font-size-12 text-muted"><?=$html?></span>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
    </div>
</div>
<?php
    function InfoUSend($send, $reci, $sel='name'){
        if( $send != $_SESSION['authorize']['id'] ) return TR_Users($send, $sel);
        elseif( $reci != $_SESSION['authorize']['id'] ) return TR_Users($reci, $sel);
        else return 'Error! name_sms_return';
    }
?>
<style>
    .YourSendMessage{
        border: solid 1px #de44364f;
        border-radius: 4px;
        padding: 5px;
    }
</style>
