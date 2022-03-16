              <div class="col-md-12 project-list">
                <div class="card">
                  <div class="row">
                    <div class="col-md-6 p-0">
                      <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>All</a></li>
                        <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="8"></line></svg>Doing</a></li>
                        <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>Done</a></li>
                      </ul>
                    </div>
                    <div class="col-md-6 p-0">
                      <div class="form-group mb-0 me-0"></div>
                      <a class="btn btn-primary" href="/add/product"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                        Добавить новыи
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <!--
              [id] => 9
      [title] => reewfgdgdf
      [summa] => 3453
      [parent] => 1
      [text] => fghfjhfg
      [up_date] => 2022-03-08 19:07:39
      [date] => 2022-03-08 19:07:39 -->
<div class="card">
  <div class="card-body">

                            <div class="row">
                              <?php if(empty($vars['posts'])) echo '<p>Товар нет в базза!</p>' ?>
                              <?php foreach ($vars['posts'] as $value) : ?>
                              <div class="col-xxl-4 col-lg-6">
                                <div class="project-box">
                                  <img class="mt-2 img-fluid" src="<?=controlImgTovar($value['id'], $value['date'])?>" alt="<?=$value['title']?>" data-original-title="" title="<?=$value['title']?>">
                                  <h5 class="pt-2"><?=$value['title']?></h5>
                                  <p><?=$value['text']?></p>
                                  <div class="row details">
                                    <div class="col-6"><span>Дата добавлено: </span></div>
                                    <div class="col-6 font-primary"><?=dateFormatTj($value['date'])?> </div>
                                    <div class="col-6"> <span>Дата обнавлено: </span></div>
                                    <div class="col-6 font-primary"><?=dateFormatTj($value['up_date'])?></div>
                                    <div class="col-6"> <span>Цена: </span></div>
                                    <div class="col-6 font-primary"><?=$value['summa']?> TJS</div>
                                  </div>
                                </div>
                              </div>
                            <?php endforeach; ?>
                            </div>

  </div>
</div>
