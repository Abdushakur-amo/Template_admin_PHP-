<section>
      <div class="container-fluid p-0">
        <div class="row m-0">
          <div class="col-12 p-0">
            <div class="login-card">
              <div class="login-main">
                <form action="/account/config" method="post" class="theme-form login-form">
                  <h4 class="mb-3"><?=$title?></h4>
                  <div class="form-group">
                    <p>Вам отправлен SMS с кодом на указанный номер (или email)</p>
                    <input class="form-control" type="number" name="config" placeholder="XXХXX">
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary btn-block" name="submit" type="submit">Подтвердить</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
<style>
.login-form p { text-align: unset; }
.login-form h4 {text-transform: unset;}
</style>
