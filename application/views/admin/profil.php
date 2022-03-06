<div class="container"><?//ok($_SESSION);?>
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="d-md-flex align-items-center">
                        <div class="text-center text-sm-left ">
                            <div class="avatar avatar-image" style="width: 150px; height:150px">
                                <img src="<?=control_avatar($vars['User']['id'])?>" alt="">
                            </div>
                        </div>
                        <div class="text-center text-sm-left m-v-15 p-l-30">
                            <h2 class="m-b-5"><?=$vars['User']['name']?></h2>
                            <p class="text-opacity font-size-13"># <?=format_cart($vars['User']['id_code'])?></p>
                            <p><?=$vars['Online']?></p>
                            <p class="text-dark m-b-20"><?=jinsUserText($vars['User']['sex'])?></p>
                            <h2><span class="badge badge-pill badge-default"><?=$vars['Wallet']?> TJS</span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="d-md-block d-none border-left col-1"></div>
                        <div class="col">
                            <ul class="list-unstyled m-t-10">
                                <li class="info_profil">
                                    <p class="font-weight-semibold text-dark">
                                        <span><i class="text-info anticon anticon-mail"></i> E-mail: </span>
                                    </p>
                                    <p class="font-weight-semibold"><?=$vars['User']['email']?></p>
                                </li>
                                <li class="info_profil">
                                    <p class="font-weight-semibold text-dark">
                                        <span><i class="text-info anticon anticon-phone"></i> Телефон: </span>
                                    </p>
                                    <p class="font-weight-semibold"> <?=$vars['User']['phone']?></p>
                                </li>
                                <li class="info_profil">
                                    <p class="font-weight-semibold text-dark">
                                        <span><i class="text-info anticon anticon-compass"></i> Адрес: </span>
                                    </p>
                                    <p class="font-weight-semibold"> <?=$vars['User']['city']?></p>
                                </li>
                            </ul>
                            <div class="d-flex font-size-22 m-t-15">
                                <a href="javascript:void(0);" onclick="Ajax_All('start_dialog', '<?=$this->route['id']?>', '/dialog/<?=$_SESSION['authorize']['id']?>' )" class="text-gray p-r-20" title="Отправить сообщение">
                                    <i class="far fa-envelope"></i>
                                </a>
                                <?php if($_SESSION['authorize']['id'] == $this->route['id']) : ?>
                                    <a href="/setting/<?=$_SESSION['authorize']['id']?>" class="text-gray p-r-20">
                                        <i class="fas fa-cog"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5>Обо мне</h5>
                    <p><?=$vars['User']['text']?></p>
                    <a href="/admin/setting/<?=$_SESSION['authorize']['id']?>"><span>Изменить</span></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Я пригласил (0)</h5>
                    <p>NONE</p>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .info_profil{
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }



</style>
