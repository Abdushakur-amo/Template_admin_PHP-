<section>
      <div class="container-fluid p-0">
        <div class="row m-0">
          <div class="col-12 p-0">
            <div class="login-card">
              <div class="login-main">
                <form action="/account/edit_password" method="post" class="theme-form login-form">
                  <h4 class="mb-3">В <?=$vars['name']?> ?</h4>
                  <div class="form-group">
                    <label>Новые пароль</label>
                    <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                      <input class="form-control" type="password" name="newPassword" required="" placeholder="*********">
                      <div class="show-hide"><span class="show"></span></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Повторни пароль</label>
                    <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                      <input class="form-control" type="password" name="confirmPassword" required="" placeholder="*********">
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Сохранить</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <style>
      .login-form .form-group label { text-transform: unset; }
    </style>
