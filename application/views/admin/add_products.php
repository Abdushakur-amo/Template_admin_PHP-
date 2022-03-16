<!-- Plugins css start-->
  <link rel="stylesheet" type="text/css" href="/assets/css/dropzone.css">
<!-- Plugins css Ends-->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3><?=$title?></h3>
        </div>
        <div class="col-sm-6">
          <!-- Bookmark Start-->
          <div class="bookmark">
            <ul>
              <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Tables"><i data-feather="inbox"></i></a></li>
              <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
              <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
              <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
            </ul>
          </div>
          <!-- Bookmark Ends-->
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header pb-0">
              <h5>Информация о товаров</h5>
            </div>
            <div class="card-body add-post">
              <p>Загрузите изображения</p>
              <form class="dropzone" id="singleFileUpload" action="/add/products" enctype="multipart/form-data">
                <div class="m-0 dz-message needsclick"><i class="icon-cloud-up"></i>
                  <h6 class="mb-0">Переташите изображение сюда</h6>
                </div>
              </form>
              <form action="/add/products" method="post" class="row needs-validation" novalidate="">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="validationCustom01">Загаловка:</label>
                    <input name="title" class="form-control" id="validationCustom01" type="text" placeholder="Ноутбук LBM1122" required="true">
                  </div>
                  <div class="form-group">
                    <label for="validationCustom02">Цена:</label>
                    <input name="summa" class="form-control" id="validationCustom02" type="number" placeholder="_ _ _ _" required="true">
                  </div>
                  <div class="form-group">
                    <label for="validationCustom03">Описание:</label>
                    <textarea name="text" class="form-control"  rows="8" cols="80" required placeholder="Напишите информация о товаров..." id="validationCustom03"></textarea>
                  </div>
                </div>
                <div class="btn-showcase">
                  <button class="btn btn-primary" type="submit">Сохранить</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Plugins JS start-->
    <script src="/assets/js/dropzone/dropzone.js"></script>
    <script src="/assets/js/dropzone/dropzone-script.js"></script>
    <script src="/assets/js/form-validation-custom.js"></script>
    <script>
    // console.log(document.querySelector('.click_me'));


    </script>
    <!-- Plugins JS Ends-->
