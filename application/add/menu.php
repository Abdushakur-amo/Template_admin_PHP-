<nav>
  <div class="main-navbar">
    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
    <div id="mainnav">
      <ul class="nav-menu custom-scrollbar">
        <li class="back-btn">
          <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
        </li>
        <li class="sidebar-main-title">
          <div>
            <h6>Все каталоий</h6>
          </div>
        </li>
        <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="user"></i><span>Ползовател INFO</span></a>
          <ul class="nav-submenu menu-content">
            <li><a href="/admin/setting/<?=$_SESSION['authorize']['id']?>">Настройка</a></li>
            <li><a href="/admin/profil/<?=$_SESSION['authorize']['id']?>">Профиль</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
  </div>
</nav>
