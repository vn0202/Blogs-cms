@extends('frontend.layout.app')
@section('style')
    <link rel="stylesheet" href="{{asset('asset/frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('asset/frontend/css/responsive.css')}}">
@endsection
@section('content')
    @include('frontend.inc.list_category')
    <div class="news-label">
        <img src="{{asset('asset/frontend/images/icons/list.png')}}" alt="" class="new-lable-icon">
        <span class="new-lable-title">{{$title}}</span>
    </div>
    @if(!empty($posts->count()))
        <div id="posts-data">
            @include('frontend.inc.list_post')
        </div>

    @else
        <p class="text-warning text-center">Hiện chưa có bài viết nào của danh mục này </p>
    @endif
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            //handle pagination without reload page by ajax
            let currentUrl = window.location.href
            let slugCat = currentUrl.split('category/')[1];
            slugCat = slugCat.split('?')[0];

            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                let page = $(this).attr('href').split('?page=')[1];
                getMorePosts(page, slugCat);
                //set query page
                window.history.replaceState({},'',`?page=${page}`);
              //scroll to top of page
                window.scrollTo({ top: 0, behavior: 'smooth' });

            })

            function getMorePosts(page, slugCat) {
                $.ajax({
                    url: "{{route('frontend.list-post-by-category','')}}" + `/${slugCat}` + "?page=" + page,
                    type: "GET",
                    success: function (data) {
                        $('#posts-data').html(data);
                    }

                })
            }
        })
    </script>
@endsection
