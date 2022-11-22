@extends('frontend.layout.app')
@section('style')
    <link rel="stylesheet" href="{{asset('asset/frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('asset/frontend/css/responsive.css')}}">
    @endsection
@section('content')
    @include('frontend.inc.list_category')
    <div class="news">
        <div class="news-label">
            <img src="{{asset('asset/frontend/images/icons/list.png')}}" alt="" class="new-lable-icon">
            <span class="new-lable-title">Tin tức</span>
        </div>
    </div>
    @if(!$posts->count())
        <p>Không tồn tại bài viết nào </p>
        @else
    @include('frontend.inc.list_post')
    @endif
@endsection
