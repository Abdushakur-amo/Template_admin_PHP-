<section>
      <div class="container-fluid p-0">
        <div class="row m-0">
          <div class="col-12 p-0">
            <div class="login-card">
              <form action="/account/register" method="post" class="theme-form login-form" style="max-width: 700px;width: 100%;">
                <h4><?=$title?></h4>
                <div class="form-group">
                  <label>Имя и Фамилия</label>
                  <div class="small-group">
                    <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                      <input class="form-control" type="text" required="" placeholder="Имя" name="name">
                    </div>
                    <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                      <input class="form-control" type="text" required="" placeholder="Фамилия" name="lastname">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>E-mail</label>
                  <div class="input-group"><span class="input-group-text"><i class="icofont icofont-ui-email"></i></span>
                    <input class="form-control" type="email" name="email" required="" placeholder="Test@gmail.com">
                  </div>
                <div class="form-group">
                  <label>Телефон</label>
                  <div class="input-group"><span class="input-group-text"><i class="icofont icofont-ui-contact-list"></i></span>
                    <input class="form-control" type="number" name="phone" required="" placeholder="+992 _ _ _ _ _ _">
                  </div>
                </div></div>
                <div class="form-group">
                  <label>Пароль</label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                    <input class="form-control" type="password" name="password" required="" placeholder="*********">
                    <div class="show-hide"><span class="show"></span></div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Подтвердить пароль</label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                    <input class="form-control" type="password" name="password2" required="" placeholder="*********">
                    <div class="show-hide"><span class="show"></span></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="radio radio-primary" style="margin: 0 20px 0 5px;float: left;">
                    <input id="radioinline1" name="sex" type="radio"  value="1">
                    <label class="mb-0" for="radioinline1">Муж</label>
                    <i class="icofont icofont-business-man-alt-1"></i>
                  </div>
                  <div class="radio radio-primary col">
                    <input id="radioinline2" name="sex" type="radio"  value="2">
                    <label class="mb-0" for="radioinline2">Жен</label>
                    <i class="icofont icofont-girl-alt"></i>
                  </div>
                </div>
                <div class="form-group" style="margin: 0;">
                  <button class="btn btn-primary btn-block" name="submit" type="submit">Создать</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <style media="screen">
    .login-form .form-group label {text-transform: unset;}
    </style>
