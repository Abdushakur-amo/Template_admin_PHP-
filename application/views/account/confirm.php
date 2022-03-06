<section>
      <div class="container-fluid p-0">
        <div class="row m-0">
          <div class="col-12 p-0">
            <div class="login-card">
              <div class="login-main">
                <form class="theme-form login-form">
                  <h4 class="mb-3">Введите код подтверждения</h4>
                  <div class="form-group">
                    <span>Вам отправлен код на указанный номер с email и SMS</span>
                    <div class="row">
                      <input class="form-control text-input" type="number" placeholder="_ _ _ _">
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary btn-block confirm-click" type="submit">Подтвердить</button>
                  </div>
                  <p>Отправите смс еще раз<a class="ms-2" href="login.html">Повторить SMS</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
<script>
	let click = document.querySelector('.confirm-click');
	let CodeVal = document.querySelector('.text-input');
	click.onclick = function(){
	  if(!CodeVal.value) alert('Введите код!');
	  else Ajax_All('confirm_login', CodeVal.value, '/account/confirm');
	}
</script>
<style>
.login-form h4 {text-transform: unset;}
</style>
