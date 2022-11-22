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

    document.getElementById('.btn-search').addEventListener('click',function (e){
        e.preventDefault();
    })

    //handle click to see more
    {{--    $(document).ready(function(){--}}
    {{--    $('.see-more').click(function (){--}}
    {{--        let last_number = $('.list-posts > div:nth-last-child(1)').attr('data-id');--}}
    {{--        $.ajax(--}}
    {{--            {--}}
    {{--                url: "{{route('frontend.handle-click-see')}}",--}}
    {{--                method:"GET",--}}
    {{--                data:{--}}
    {{--                    _token:"{{csrf_token()}}",--}}
    {{--                    last_number:last_number,--}}
    {{--                    category: {{$_GET['category'] ?? 0}}--}}
    {{--                },--}}

    {{--                dataType:'json',--}}
    {{--                success:function (response)--}}
    {{--                {--}}
    {{--                    console.log(response);--}}
    {{--                    let id = last_number;--}}
    {{--                    let leng = response.length;--}}
    {{--                    let html=``;--}}
    {{--                    for( var i= 0; i < leng; i++ )--}}
    {{--                    {--}}
    {{--                        id++;--}}
    {{--                        html += `<div class="posts-item" data-id="${id}">--}}

    {{--        <div class="posts-item-img-big">--}}
    {{--            <a href="detail.html">--}}
    {{--                <img src="${response[i].thumb}" alt="Hinh anh" class="posts-item-img">--}}
    {{--                <img src="{{asset('asset/frontend/images/icons/heart-white.png')}}" alt="" class="post-icon-fav">--}}
    {{--            </a>--}}
    {{--        </div>--}}
    {{--        <div class="posts-item-infor">--}}
    {{--            <a href="detail.html">--}}
    {{--                <p class="posts-item-title">${response[i].title}</p>--}}
    {{--                <p class="posts-infor">--}}
    {{--                    <a href="social.html"> <span--}}
    {{--                            class="new-item-cat">${response[i].category.title}</span></a>--}}
    {{--                     <span class="new-item-author">${response[i].user.fullname}</span>--}}
    {{--                    <span class="new-item-cre-at">${response[i].created_at}</span>--}}
    {{--                </p>--}}
    {{--            </a>--}}
    {{--            <div class="posts-item-desc-big">--}}
    {{--                <a href="detail.html">--}}
    {{--                    <p class="posts-item-desc-content">--}}
    {{--                     ${response[i].description}--}}
    {{--                    </p>--}}
    {{--                </a>--}}

    {{--            </div>--}}
    {{--            <div class="posts-item-desc">--}}
    {{--                <div class="posts-item-img">--}}
    {{--                    <a href="detail.html">--}}
    {{--                        <img src=${response[i].thumb} alt="Hinh anh">--}}
    {{--                        <img src="{{asset('asset/frontend/images/icons/heart-white.png')}}" alt=""--}}
    {{--                             class="post-icon-fav">--}}
    {{--                    </a>--}}
    {{--                </div>--}}

    {{--                <p class="posts-item-desc-content">--}}
    {{--                    <a href="detail.html">--}}

    {{--                      ${response[i].description}--}}
    {{--                    </a>--}}

    {{--                </p>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    {{--    </div>`--}}
    {{--                    }--}}


    {{--                    $('.list-posts').append(html);--}}
    {{--                },--}}
    {{--                error:function (xhr,status,error)--}}
    {{--                {--}}
    {{--                    alert(error);--}}
    {{--                }--}}


    {{--            }--}}

    {{--        )--}}

    {{--    })--}}
    {{--})--}}

</script>

</body>
</html>
