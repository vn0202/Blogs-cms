@extends('admin.layout.admin')

@section('style')
    <style>
        .limit-line-2 {
            overflow: hidden;
            display: block;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .limit-line-1 {
            overflow: hidden;
            display: block;
            display: -webkit-box;
            line-height: 1.8rem;
            height: 3rem;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;

        }

        .list-categories-item, .list-tag-item {
            padding-left: 8px;
        }

        .list-categories-item.item-active, .list-tag-item.item-active {
            background-color: #007bff;
        }

        .category-drop, .tag-drop {
            display: none;
            padding: 40px 0 20px;
        }
    </style>
@endsection
@section('content')

    @if(session('nopermission'))
        @include('admin.inc.model_nopermission')
    @endif
    @if(session('success'))
        <p class="alert-success text-center">{{session('success')}}</p>
    @endif
    @if(session('failure'))
        <p class="alert-warning text-center">{{session('failure')}}</p>
    @endif
    <div class="row mb-3 justify-content-between">
        <div class="col-6 d-flex  align-items-baseline">
            <a href="{{route('admin.posts.add-post')}}" class="btn btn-primary col-2" style="height: 38px;">
                <p>Thêm</p>
            </a>
            <p class="ml-4">Show {{$posts->firstItem()}} to {{$posts->lastItem()}} of {{$posts->total()}} entires
                @if($isFilter)
                    ( filter of {{$posts->total()}} entires )
                @endif
            </p>
            <a href="{{route('admin.posts.index')}}" class="ml-4 text-purple text-decoration-underline col-3">Reset</a>
        </div>
        <nav class="navbar navbar-light bg-light float-right">
            <form class="form-inline">
                <input class="form-control mr-sm-2" value="{{ $search ?? '' }}" name="search" type="search"
                       placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </nav>

    </div>
    <div class="row mb-3">
        <div class="mx-2"><i class="fas fa-filter"></i></div>
        <div class="mr-2 bg-light shadow-sm position-relative">
            <span class="mr-1 filter-category">Category</span><i class="fas fa-caret-down"></i>
            <div class="category-drop position-absolute  bg-white   shadow-lg ">
                <input type="text" class="rounded-lg mb-3" style="max-width: 100%;outline-style: none" id="search-cat">

                <ul class=" list-categories overflow-auto " style="padding:0; max-height: 250px; ">
                    @forelse(\App\Models\Category::all() as $cat)
                        <li class="py-2 list-categories-item" data-id="{{$cat->id}}">
                            <a href="{{Request::fullUrlWithQuery(['category_id'=>$cat->id])}}"
                               class="text-dark w-100 d-block">{{$cat->title}}</a>
                        </li>
                        @endforeach
                </ul>
            </div>
        </div>
        <div class="bg-light shadow-sm">
            <span class="mr-1 filter-tag">Tag</span><i class="fas fa-caret-down "></i>
            <div class="tag-drop position-absolute  bg-white   shadow-lg ">
                <input type="text" class="rounded-lg mb-3" style="max-width: 100%;outline-style: none" id="search-tag">

                <ul class=" list-tags overflow-auto bg-white " style="padding:0; max-height: 250px; ">
                    @forelse(\App\Models\Tag::all() as $tag)
                        <li class="py-2 list-tag-item" data-id="{{$tag->id}}">
                            <a href="{{Request::fullUrlWithQuery(['tag_id'=>$tag->id])}}"
                               class="text-dark d-block">{{$tag->name}}</a>
                        </li>
                        @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div id="data-table">
        @include('admin.inc.post_data')
    </div>

@endsection
@section('script')
    <script>
        function addevent(select) {
            let list_items = $(`${select}`);
            list_items.hover(function () {
                for (var i = 0; i < list_items.length; i++) {
                    list_items[i].classList.remove('item-active');
                }
                $(this).addClass('item-active');
            })
        }

        $(document).ready(function () {


            //handle pagination without reload page
            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                getMorePosts(page);
                //hanle set query for page
                window.history.replaceState({},'',`?page=${page}`);


            })

            function getMorePosts(page) {
                $.ajax({
                    url: "{{route('admin.posts.get-more-post')}}" + "?page=" + page,
                    type: "GET",
                    success: function (data) {
                        $('#data-table').html(data);
                    }
                })
            }
            //end handle

            //handle filter

            $(document).mouseup(function (e) {


                if ($(e.target).closest('.category-drop').length == 0) {
                    $('.category-drop').css('display', 'none')
                }
                if ($(e.target).closest('.tag-drop').length === 0) {
                    $('.tag-drop').css('display', 'none')
                }

            })
            $('.filter-category').click(function () {
                $('.category-drop').css('display', 'block')
            })
            $('.filter-tag').click(function () {

                $('.tag-drop').css('display', 'block')

            })
            $('.list-categories-item:first-child').addClass('item-active');
            addevent('.list-categories-item');
            addevent('.list-tag-item')
            let url = "{{route('admin.posts.index')}}";
            //handle search by cat
            $('#search-cat').keyup(function (e) {
                let searchValue = $(this).val();
                $.ajax({
                    url: "{{route('admin.posts.filter-post')}}",
                    method: "GET",
                    data: {
                        search: searchValue,
                        type: 1,
                    },
                    dataType: 'json',
                    success: function (response) {
                        let queryString = new URL(window.location.href);
                          let domain = window.location.href.split('?')[0];
                        queryString.searchParams.forEach(function (value,key){

                            if(key != 'tag_id')
                            {
                                queryString.searchParams.delete(key);
                            }
                        })
                        if (response.length == 0) {
                            $('.list-categories').empty();
                            $('.list-categories').append('<li class="text-center">No result</li>')
                        } else {
                            let len = response.length;
                            let html = '';
                            for (var i = 0; i < len; i++) {
                                queryString.searchParams.set('category_id', response[i].id);
                                let newUrl = domain + "?" + queryString.searchParams.toString();
                             console.log(newUrl)
                                html += `<li class= "py-2 list-categories-item" data-id="${response[i].id}">
                                     <a href="${newUrl}" class="text-dark d-block"> ${response[i].title}</a>
                                         </li>`
                            }
                            $('.list-categories').empty();
                            $('.list-categories').append(html);
                            let list_items = $('.list-categories-item');
                            addevent('.list-categories-item');
                        }
                    },
                    error: function (xhr, status, error) {
                        alert(error)
                    }

                })
            })
            //hanhle filter by tag
            $('#search-tag').keyup(function (e) {
                let searchValue = $(this).val();

                $.ajax({
                    url: "{{route('admin.posts.filter-post')}}",
                    method: "GET",
                    data: {
                        search: searchValue,
                        type: 2,
                    },
                    dataType: 'json',
                    success: function (response) {
                        let queryString = new URL(window.location.href);
                        let domain = window.location.href.split('?')[0];

                        queryString.searchParams.forEach(function (value,key){

                            if(key != 'category_id')
                            {
                                queryString.searchParams.delete(key);
                            }
                                })
                        if (response.length == 0) {
                            $('.list-tags').empty();
                            $('.list-tags').append('<li class="text-center">No result</li>')
                        } else {
                            let len = response.length;
                            let html = '';
                            for (var i = 0; i < len; i++) {
                                queryString.searchParams.set('tag_id', response[i].id);

                                let newUrl = domain + "?" + queryString.searchParams.toString();

                                html += `<li class= "py-2 list-tag-item" data-id="${response.id}">
                                    <a href="${newUrl}" class="text-dark d-block">${response[i].name}</a>
                                         </li>`
                            }
                            $('.list-tags').empty();
                            $('.list-tags').append(html);

                            addevent('.list-tag-item');
                        }
                    },
                    error: function (xhr, status, error) {
                        alert(error)
                    }

                })
            })
            $('.list-categories-item').click(function () {
                $('.category-drop').css('display', 'none');
            })

        })
    </script>
@endsection
