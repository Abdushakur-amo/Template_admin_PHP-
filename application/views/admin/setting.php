
<?php

    //ok($vars);

?>
<div class="page-header no-gutters has-tab">
    <h2 class="font-weight-normal">Настройка</h2>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab-account">Лични данни</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab-network">Пока пуст</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab-notification">Пока пуст</a>
        </li> -->
    </ul>
</div>
<div class="container">
    <div class="tab-content m-t-15">
        <div class="tab-pane fade active show" id="tab-account">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?=$vars['info']['name']?></h4>
                </div>
                <div class="card-body">
                    <form action="/admin/setting/<?=$this->route['id']?>" method="post">
                        <div class="media align-items-center">
                            <div class="avatar avatar-image  m-h-10 m-r-15" style="height: 80px; width: 80px">
                                <img src="<?=control_avatar($vars['info']['id'])?>" alt="">
                            </div>
                            <div class="m-l-20 m-r-20">
                                <h5 class="m-b-5 font-size-18">Изменить аватар</h5>
                                <input type="file" class="form-control" name="avater" style="margin-bottom: 5px;">
                                <input type="text" class="form-control" name="namefileuploda" style="display: none;">
                                <button class="btn btn-primary" name="submit">Загрузить <i class="fas fa-download"></i></button>
                            </div>
                        </div>
                        <hr class="m-v-25">
                    </form>
                    <form action="/admin/setting/<?=$this->route['id']?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-semibold" for="userName">Имя:</label>
                                <input type="text" class="form-control"  name="name" id="userName" placeholder="User Name" value="<?=$vars['info']['name']?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-semibold" for="email">E-mail:</label>
                                <input type="email" class="form-control"  name="email" id="email" placeholder="email" value="<?=$vars['info']['email']?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="font-weight-semibold" for="phoneNumber">Телефон:</label>
                                <input type="text" class="form-control"  name="phone" id="phoneNumber" value="<?=$vars['info']['phone']?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="font-weight-semibold" for="dob">Адрес:</label>
                                <input type="text" class="form-control" name="city" id="dob" value="<?=$vars['info']['city']?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="font-weight-semibold" for="language">Обо мне</label>
                                <textarea class="form-control" name="text" aria-label="With textarea"><?=$vars['info']['text']?></textarea>
                            </div>
                        </div>
                        <button class="btn btn-primary" name="submit">Сохранить <i class="anticon anticon-save"></i></button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Изменит пароль</h4>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="font-weight-semibold">Текущи пароль:</label>
                            <input type="password" class="close-pass form-control" id="oldPassword" placeholder="Old Password">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="font-weight-semibold">Новый пароль:</label>
                            <input type="password" class="close-pass form-control" id="newPassword" placeholder="New Password">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="font-weight-semibold">Повтор пароль:</label>
                            <input type="password" class="close-pass form-control" id="confirmPassword" placeholder="Confirm Password">
                        </div>
                    </div>
                    <button class="btn btn-danger" id="click_submit_pass">Сохранить <i class="anticon anticon-save"></i></button>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab-network">
            <p> Пока пуст </p>
        </div>
        <div class="tab-pane fade" id="tab-notification">
            <p> Пока пуст </p>
        </div>
    </div>
</div>

<script>
    let password = document.querySelector('#click_submit_pass');
    let oldPassword = document.querySelector('#oldPassword');
    let NewPassword = document.querySelector('#newPassword');
    let confirmPassword = document.querySelector('#confirmPassword');

    password.onclick = function(){
        Ajax_All('editNewPassword', array=[oldPassword.value, NewPassword.value, confirmPassword.value], '/admin/setting/<?=$this->route['id']?>');
    }

</script>
