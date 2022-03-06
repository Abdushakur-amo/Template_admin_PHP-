<!-- Page Sidebar Start-->
<header class="main-nav">
  <div class="sidebar-user text-center">
    <a class="setting-primary" href="/admin/setting/<?=$_SESSION['authorize']['id']?>"><i data-feather="settings"></i></a>
    <img class="img-90 rounded-circle" src="<?=control_avatar($_SESSION['authorize']['id'])?>">
    <div class="badge-bottom"><span class="badge badge-primary">New</span></div>
    <a href="/admin/profil/<?=$_SESSION['authorize']['id']?>"><h6 class="mt-3 f-14 f-w-600"><?=$_SESSION['authorize']['name']?></h6></a>
    <p class="mb-0 font-roboto">Описание</p>
    <!-- <ul>
      <li><span><span class="counter">19.8</span>TJS</span>
        <p>Сумма</p>
      </li>
      <li><span>123</span>
        <p>Технология</p>
      </li>
      <li><span><span class="counter">12</span></span>
        <p>Друзя</p>
      </li>
    </ul> -->
  </div>
  <? include 'application/add/menu.php'; ?>
</header>
<!-- Page Sidebar Ends-->
