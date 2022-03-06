<section>
  <div class="container-fluid p-0">
    <div class="row">
      <div class="col-12">
        <div class="login-card">
          <form action="/account/login" method="post" class="theme-form login-form">
            <h4>Администратор</h4>
            <br>
            <div class="form-group">
              <label>Телефон</label>
              <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                <input class="form-control" type="number" name="phone" required="" placeholder="+992 XX XXX XX XX">
              </div>
            </div>
            <div class="form-group">
              <label>Введите пароль</label>
              <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                <input class="form-control" type="password" required="" name="password" placeholder="Пароль">
                <div class="show-hide"><span class="Покозат"></span></div>
              </div>
            </div>
            <?php if( isset($_SESSION['robot_login']['Captcha'])) : ?>
                <div class="form-group">
                    <label class="font-weight-semibold" for="password">Введите код с картинка:</label>
                    <img src="/application/lib/captcha/captcha.php"/>
                    <div class="input-affix m-b-10">
                        <i class="prefix-icon anticon anticon-issues-close"></i>
                        <input type="text" class="form-control" id="code_img" name="code_img" placeholder="_ _ _ _ _">
                    </div>
                    <!-- <a class="btn"><i class="anticon anticon-redo"></i></a> -->
                </div>
            <?php endif; ?>
            <div class="form-group">
              <div class="checkbox">
                <input id="save_cookie" type="checkbox" name="save_cookie">
                <label for="save_cookie">Запомнить мне</label>
              </div><a class="link" href="/account/recovery" >Забыли пароль?</a>
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-block" type="submit" name="submit">Вход</button>
            </div>
            <div class="login-social-title">
              <h5>Новый аккаунт</h5>
            </div>
            <div class="form-group">
              <ul class="login-social">
                <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="linkedin"></i></a></li>
                <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="twitter"></i></a></li>
                <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="facebook"></i></a></li>
                <li><a href="https://www.instagram.com/login" target="_blank"><i data-feather="instagram"></i></a></li>
              </ul>
            </div>
            <p>Зарегистрировать новый аккаунт <a class="ms-2" href="/account/register">Создать</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<style>
.login-form .form-group label {
  text-transform: none;
}
</style>
