<div id="header">
    <div class="header-nav">
        <img src="{{asset('asset/frontend/images/icons/menu.png')}}" alt="" class="header-nav-menu-icon">
        <ul class="header-nav-main">
            <li class="header-nav-main-item">
                <a href="" class="header-nav-main-item-link">
                    Mua nhà
                </a>
            </li>
            <li class="header-nav-main-item">
                <a href="" class="header-nav-main-item-link">
                    Thuê nhà
                </a>
            </li>
            <li class="header-nav-main-item">
                <a href="" class="header-nav-main-item-link">
                    Khám phá
                </a>
            </li>
            <li class="header-nav-main-item">
                <a href="" class="header-nav-main-item-link active">
                    Blog
                </a>
            </li>
        </ul>
    </div>
    <div class="logo">
        <img src="{{asset('asset/frontend/images/icons/logo.png')}}" alt="" class="logo-img">
    </div>

    <div class="header-user ">
        <div class=" header-user-icon-notify has-active">
            <img src="{{asset('asset/frontend/images/icons/notify.png')}}" alt="" class="header-notify-icon">
        </div>
        <div class="header-user-icon-fav has-active">
            <img src="{{asset('asset/frontend/images/icons/heart-black.png')}}" alt="" class="header-fav-icon">

        </div>
        @if(!Auth::check())
        <div class="header-post">
            <a href="{{route('frontend.login')}}" class="header-post-link">
                Đăng nhập
            </a>
        </div>

        @endif
        @if(Auth::check())
        <div class="header-user-infor">
            <div class="user-infor">
                <p class="user-infor-name">{{Auth::user()->fullname}} </p>
                <p class="user-level">Intern</p>
            </div>
            <div class="user-avatar" style="background-image: url('{{asset(Auth::user()->avatar)}}')">
                <ul class="user-submenu">
                    <li class="user-submenu-item"><a href="{{route('frontend.edit')}}">Thong tin ca nhan</a></li>
                    <li class="user-submenu-item"><a href="{{route('frontend.logout')}}">Dang xuat</a></li>
                </ul>
            </div>

        </div>
            @endif

    </div>
</div>
