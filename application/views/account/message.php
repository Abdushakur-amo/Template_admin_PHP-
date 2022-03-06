    <div class="page-header no-gutters" style="padding: 7px 30px;     margin-bottom: 0;">
        <div class="d-md-flex align-items-md-center justify-content-between">
            <div class="media m-v-10 align-items-center">
                <div class="avatar avatar-image avatar-lg">
                    <img src="<?=control_avatar($this->route['uid'])?>">
                </div>
                <div class="media-body m-l-15">
                    <h4 class="m-b-0"><a href="/profil/<?=$this->route['uid']?>"><?=TR_Users($this->route['uid'], 'name')?></a></h4>
                    <p class="m-b-0 text-muted font-size-13 m-b-0">
                        <span><?=$vars['UOnine']?></span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="cart" style="background: #fff;padding:10px">
        <div class="conversation-body">
        <?php $Recipient = 0; $img = '<div class="m-r-10"><div class="avatar avatar-image" style="background: none;"></div></div>';?>
        <? foreach( $vars['message'] as $ValMessage ) : ?>
            <?php  $img = '<div class="m-r-10"><div class="avatar avatar-image" style="background: none;"></div></div>';?>
            <? if($ValMessage['id_user'] == $_SESSION['authorize']['id'] ) : ?>
                <?php
                    $Recipient = 0;
                    $Status = ( $ValMessage['status'] ) ? '<i class="opacity-04 far fa-eye"></i>' : '<i class="opacity-04 anticon anticon-clock-circle"></i>';


                ?>
                <div class="msg msg-sent">
                    <div class="bubble">
                        <div class="bubble-wrapper">
                            <span><?=$ValMessage['message']?></span><br>
                            <div class="date_message"> <span style="font-size: 10px;margin-right: 5px;"><?=$ValMessage['time']?></span>  <?=$Status?></div>
                        </div>
                    </div>
                </div>
            <? else : ?>
                <div class="msg msg-recipient">
                    <div class="bubble">
                        <div class="bubble-wrapper">
                            <span><?=$ValMessage['message']?></span><br>
                            <div class="date_message"> <span style="font-size: 10px;"><?=$ValMessage['time']?></span> </div>
                        </div>
                    </div>
                </div>
            <? endif; ?>
        <? endforeach; ?>
        <br>
        </div>
    </div>
    <div class="page-header no-gutters my-top-footer" style="clear: both;padding: 7px 30px; justify-content: space-between;display: flex">
        <div class="input-group">
            <textarea class="form-control" aria-label="With textarea" id="textSMS"></textarea>
        </div>
        <button class="btn btnClick btn-default m-r-5">Отправить <i class="fab fa-telegram-plane"></i></button>
    </div>

<style>
    .input-group {
        width: 90%;
    }
    .date_message {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }
    .bubble {
        padding: 10px;
        border-radius: 10px;
        color: #000;
    }

    .msg.msg-sent .bubble {
        background: var(--light);
        margin: 3px 0;
    }
    .msg.msg-recipient .bubble {
        background: #cbf8ff;
    }

    .bubble:after {
        content: ' ';
        width: 30px;
        height: 20px;
        position: absolute;
        transform: matrix3d(2, 1, 0, 0, 2, 3, 0, 0, 0, 0, 1, 0, 0, 3, 4, 5);
    }

    .msg.msg-sent .bubble:after {
        background: var(--light);
        right: 10px;
    }

    .msg.msg-recipient .bubble:after{
        background: #cbf8ff;
        left: 67px;
    }

    .msg.msg-sent {
        width: 85%;
        float: right;
        display: flex;
        justify-content: flex-end;
    }

    .msg.msg-recipient {
        width: 85%;
        display: flex;
        justify-content: flex-start;
        margin: 10px 0;
    }

</style>

<script>

    let btnClick = document.querySelector('.btnClick');
    let textSMS = document.querySelector('#textSMS');
    let Did = '<?=$this->route['did']?>';
    let Uid = '<?=$this->route['uid']?>';

    btnClick.onclick = function(){
        if( textSMS.value ) {
            Ajax_All('sendSMS', arr = [textSMS.value, Did, Uid], '/message/dialog/'+Did+'/user/'+Uid);
        }

    }


</script>
