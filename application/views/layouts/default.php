<?php include 'application/add/top.php'; ?>
<div class="box_load"><div class="loader-box"><div class="loader-7"></div></div></div>
<style>.box_load {position: absolute;top: 0;left: 0;right: 0;bottom: 0;display: flex;align-items: center;justify-content: center;z-index: -1;transition: all 500ms;background: #ffffffcc;opacity: 0;}.box_load.active{z-index: 1001;opacity: 1;}</style>
<div class="page-wrapper compact-wrapper" id="pageWrapper">
  <!-- Page Header Start-->
  <div class="page-main-header">
    <div class="main-header-right row m-0">
      <div class="main-header-left">
        <div class="logo-wrapper">
          <a href="/admin/index">
            <img class="img-fluid" src="/assets/images/logo/logo.png" alt="">
          </a>
        </div>
        <div class="dark-logo-wrapper">
          <a href="/admin/index">
            <img class="img-fluid" src="/assets/images/logo/dark-logo.png" alt="">
          </a>
        </div>
        <div class="toggle-sidebar">
          <i class="status_toggle middle fa fa-outdent" id="sidebar-toggle" style="font-size:1.3em"></i>
        </div>
      </div>
      <div class="left-menu-header col">
        <ul>
          <li>
            <form class="form-inline search-form">
              <div class="search-bg"><i class="fa fa-search"></i>
                <input class="form-control-plaintext" placeholder="Что вы ищете?">
              </div>
            </form><span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>
          </li>
        </ul>
      </div>
      <div class="nav-right col pull-right right-menu p-0">
        <ul class="nav-menus">
          <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
          <li class="onhover-dropdown">
            <div class="bookmark-box"><i data-feather="star"></i></div>
            <div class="bookmark-dropdown onhover-show-div">
              <div class="form-group mb-0">
                <div class="input-group">
                  <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                  <input class="form-control" type="text" placeholder="Search for bookmark...">
                </div>
              </div>
              <ul class="m-t-5">
                <li class="add-to-bookmark"><i class="bookmark-icon" data-feather="inbox"></i>Email<span class="pull-right"><i data-feather="star"></i></span></li>
                <li class="add-to-bookmark"><i class="bookmark-icon" data-feather="message-square"></i>Chat<span class="pull-right"><i data-feather="star"></i></span></li>
                <li class="add-to-bookmark"><i class="bookmark-icon" data-feather="command"></i>Feather Icon<span class="pull-right"><i data-feather="star"></i></span></li>
                <li class="add-to-bookmark"><i class="bookmark-icon" data-feather="airplay"></i>Widgets<span class="pull-right"><i data-feather="star">   </i></span></li>
              </ul>
            </div>
          </li>
          <li class="onhover-dropdown">
            <div class="notification-box"><i data-feather="bell"></i><span class="dot-animated"></span></div>
            <ul class="notification-dropdown onhover-show-div">
              <li>
                <p class="f-w-700 mb-0">You have 3 Notifications<span class="pull-right badge badge-primary badge-pill">4</span></p>
              </li>
              <li class="noti-primary">
                <div class="media"><span class="notification-bg bg-light-primary"><i data-feather="activity"> </i></span>
                  <div class="media-body">
                    <p>Delivery processing </p><span>10 minutes ago</span>
                  </div>
                </div>
              </li>
              <li class="noti-secondary">
                <div class="media"><span class="notification-bg bg-light-secondary"><i data-feather="check-circle"> </i></span>
                  <div class="media-body">
                    <p>Order Complete</p><span>1 hour ago</span>
                  </div>
                </div>
              </li>
              <li class="noti-success">
                <div class="media"><span class="notification-bg bg-light-success"><i data-feather="file-text"> </i></span>
                  <div class="media-body">
                    <p>Tickets Generated</p><span>3 hour ago</span>
                  </div>
                </div>
              </li>
              <li class="noti-danger">
                <div class="media"><span class="notification-bg bg-light-danger"><i data-feather="user-check"> </i></span>
                  <div class="media-body">
                    <p>Delivery Complete</p><span>6 hour ago</span>
                  </div>
                </div>
              </li>
            </ul>
          </li>
          <li>
            <div class="mode"><i class="fa fa-moon-o"></i></div>
          </li>
          <li class="onhover-dropdown"><i data-feather="message-square"></i>
            <ul class="chat-dropdown onhover-show-div">
              <?php  foreach ($_SESSION['chat_users'] as $Chat) : ?>
                <li>
                  <div class="media">
                    <img class="img-fluid rounded-circle me-3" src="<?=control_avatar($Chat['id_user'])?>">
                    <div class="media-body"><span><?=User_UNIC($Chat['id_user'], 'name')?></span>
                      <p class="f-12 light-font"><?=$Chat['message']?></p>
                      <!-- 985432253 988432253 -->
                    </div>
                    <!-- <p class="f-12">32 mins ago</p> -->
                  </div>
                </li>
              <?php endforeach; ?>
              <li class="text-center"> <a class="f-w-700" href="/admin/chat/1">Ешё... </a></li>
            </ul>
          </li>
          <li class="onhover-dropdown p-0">
            <button class="btn btn-primary-light" type="button"><a href="/logout"><i data-feather="log-out"></i>Выход / Exit</a></button>
          </li>
        </ul>
      </div>
      <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
  </div>
  <!-- Page Header Ends -->
  <div class="page-body-wrapper sidebar-icon">
    <!-- Start HEADER -->
    <? include 'application/add/header.php'; ?>
    <!-- End HEADER -->
    <div class="page-body">
      <div class="container-fluid dashboard-default-sec">
        <?php echo $content; ?>
      </div>
    </div>
  </div>
  <!-- footer start-->
  <footer class="footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 footer-copyright">
          <p class="mb-0">Copyright 05-03-2021 © Шаблон YAHYO.TJ</p>
        </div>
        <div class="col-md-6">
          <p class="pull-right mb-0">Шаблон администратор <i class="fa fa-heart font-secondary"></i></p>
        </div>
      </div>
    </div>
  </footer>
</div>
<?php include 'application/add/footer.php'; ?>
