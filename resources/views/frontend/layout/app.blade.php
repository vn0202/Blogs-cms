<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>

    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
          integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="{{asset('asset/admin/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('style')

</head>
<body>
@include('frontend.inc.header')
<div id="container">
    <div id="main">
        @yield('content')

    </div>
@include('frontend.inc.modal_menu')
</div>
<script>
    document.querySelector(".header-nav-menu-icon").onclick = function () {

        document.querySelector('.modal-over').classList.add('active')
    }
    document.querySelector(".modal-icon-close").onclick = function () {

        document.querySelector('.modal-over').classList.remove('active')
    }
    let listNavItems = document.getElementsByClassName("header-nav-main-item-link");
    for (var i = 0; i < listNavItems.length; i++) {
        if (!listNavItems[i].classList.contains('active')) {
            listNavItems[i].onmouseover = function () {
                this.classList.add('active');
            }
            listNavItems[i].onmouseout = function () {
                this.classList.remove('active');

            }
        }

    }
    let listCatItems = document.getElementsByClassName('list-cats-item-link');
    for (var i = 0; i < listCatItems.length; i++) {
        if (!listCatItems[i].classList.contains('active')) {
            listCatItems[i].onmouseover = function () {
                this.classList.add('active');

            }
            listCatItems[i].onmouseout = function () {
                this.classList.remove('active');

            }
        }


    }
    //handle model menu

    let listModalItem = document.getElementsByClassName("modal-menu-item");
    for (var i = 0; i < listModalItem.length; i++) {
        if (!listModalItem[i].classList.contains('active')) {
            listModalItem[i].onmouseover = function () {
                this.classList.add('active');
            }
            listModalItem[i].onmouseout = function () {
                this.classList.remove('active');
            }
        }
    }





</script>
@yield('script')
</body>
</html>
