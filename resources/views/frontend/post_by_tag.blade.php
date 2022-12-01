@extends('frontend.layout.app')
@section('style')
    <link rel="stylesheet" href="{{asset('asset/frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('asset/frontend/css/responsive.css')}}">
@endsection
@section('content')
    @include('frontend.inc.list_category')
    <div class="news-label">

        <span class="new-lable-title">{{$title}} <span class="keywords-item">{{$tag}}</span></span>
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
        $(document).ready(function(){
            function getMorePosts(page,slugTag){
                $.ajax({
                    url:"{{route('frontend.list-post-tag','')}}" + `/${slugTag}`+ `?page=${page}`;
                    type:'GET',
                    success:function (data){
                        $('#posts-data').html(data);

                    }
                })
            }
            let slugTag = window.location.href.split('category/')[1];
            slugTag = slugTag.split('?')[0];
            $(document).on('click','.pagination a',function (event){
                event.preventDefault();
                let page = $(this).attr('href').split('?page=')[1];
               getMorePosts(page,slugTag);
               //scroll to top of page
                window.scrollTo({ top: 0, behavior: 'smooth' });
            })
        })
    </script>
    @endsection
