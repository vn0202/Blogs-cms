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
  @include('frontend.inc.list_post')
  @else
        <p class="text-warning text-center">Hiện chưa có bài viết nào của danh mục này </p>
        @endif
@endsection
