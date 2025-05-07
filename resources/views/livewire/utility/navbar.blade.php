<div>
  <div class="header-area" id="headerArea">
    <div class="container h-100 d-flex align-items-center justify-content-between rtl-flex-d-row-r">
        <div class="logo-wrapper"><a href="home.html"><img src="{{asset('assets/img/core-img/logo-white.png')}}" alt=""></a></div>
        <div class="navbar-logo-container d-flex align-items-center">
            <div class="cart-icon-wrap"><a href="cart.html"><i class="fa-solid fa-bag-shopping"></i><span>2</span></a></div>
            @auth
            <div class="user-profile-icon ms-2"><a href="profile.html"><img src="assets/img/bg-assets/9.jpg" alt=""></a></div>
            <div class="suha-navbar-toggler ms-2" data-bs-toggle="offcanvas" data-bs-target="#MavaOffcanvas" aria-controls="MavaOffcanvas">
                <div><span></span><span></span><span></span></div>
            </div>
            @else
            <div class="user-profile-icon ms-2"><a href="profile.html"><img src="{{asset('assets/img/bg-img/9.jpg')}}" alt=""></a></div>
            @endauth

        </div>
    </div>
</div>
<div class="offcanvas offcanvas-start suha-offcanvas-wrap" tabindex="-1" id="MavaOffcanvas" aria-labelledby="MavaOffcanvasLabel">
    <button class="btn-close btn-close-white" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    <div class="offcanvas-body">
        <div class="sidenav-profile">
            <div class="user-profile"><img src="assets/img/bg-assets/img/9.jpg" alt=""></div>
            <div class="user-info">
                <h5 class="mb-1 text-white user-name">User Name</h5>
                <p class="text-white available-balance"><span class="counter">499</span></p>
            </div>
        </div>
        <ul class="sidenav-nav ps-0">
            <li><a href="profile.html"><i class="fa-solid fa-user"></i>My Profile</a></li>
            <li><a href="notifications.html"><i class="fa-solid fa-bell lni-tada-effect"></i>Notifications<span class="ms-1 badge badge-warning">3</span></a></li>
            <li><a href="settings.html"><i class="fa-solid fa-sliders"></i>Settings</a></li>
            <li><a href="intro.html"><i class="fa-solid fa-toggle-off"></i>Sign Out</a></li>
        </ul>
    </div>
</div>
</div>
