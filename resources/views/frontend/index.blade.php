@extends('frontend.layout.app')
@section('style')
    <link rel="stylesheet" href="{{asset('asset/frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('asset/frontend/css/responsive.css')}}">
@endsection
@section('content')
    @include('frontend.inc.slider')
    <div class="main-container">
        @include('frontend.inc.list_category')
        <div class="news">
            <div class="news-label">
                <img src="{{asset('asset/frontend/images/icons/list.png')}}" alt="" class="new-lable-icon">
                <span class="new-lable-title">Tin tức</span>
            </div>
            <div class="list-new" style="display:flex">
                @if(isset($posts[0]))
                    <div class="list-new-item-main" style="margin:0 auto">
                        <div class="new-item">
                            <a href="{{route('frontend.detail-post',['category'=>$posts[0]->categories->slug,'slug'=>$posts[0]->slug])}}">
                                <div class="list-new-item-img"
                                     style="background-image: url('{{asset($posts[0]->thumb)}}')">
                                    <img src="{{asset('asset/frontend/images/icons/heart-white.png')}}" alt="" class="label-fav">
                                </div>
                                <div class="new-item-desc">
                                    <p class="item-desc-title">
                                        {{$posts[0]->title}}
                                    </p>
                                    <div class="item-desc-author">
                                        <a href="{{route('frontend.list-post-by-category',$posts[0]->categories->slug)}}"> <span class="new-item-cat">{{$posts[0]->categories->title}}</span></a>
                                        <span class="new-item-author">{{$posts[0]->user->fullname}}</span>
                                        <span class="new-item-cre-at">{{date_format($posts[0]->created_at,"d-m-Y")}}</span>
                                    </div>
                                    <div class="item-desc-content">
                                        {{$posts[0]->description}}
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
                @if(isset($posts[1]))
                    <div class="list-new-item-sub">

                        <div class="new-item">
                            <a href="{{route('frontend.detail-post',['category'=>$posts[1]->categories->slug,'slug'=>$posts[1]->slug])}}">
                                <div class="list-new-item-img" style="background-image: url('{{asset($posts[1]->thumb)}}')">
                                    <img src="{{asset('asset/frontend/images/icons/heart-white.png')}}" alt="" class="label-fav">
                                </div>
                                <div class="new-item-desc">
                                    <p class="item-desc-title">
                                        {{$posts[1]->title}}
                                    </p>
                                    <div class="item-desc-author">
                                        <a href="{{route('frontend.list-post-by-category',$posts[0]->categories->slug)}}"> <span class="new-item-cat">{{$posts[1]->categories->title}}</span></a>
                                        <span class="new-item-author">{{$posts[1]->user->fullname}}</span>
                                        <span class="new-item-cre-at">{{date_format($posts[1]->created_at,'d-m-Y')}}</span>
                                    </div>
                                    <div class="item-desc-content">
                                        {{$posts[1]->description}}
                                    </div>
                                </div>
                            </a>
                        </div>
                        @if(isset($posts[2]))
                            <div class="new-item">
                                <a href="{{route('frontend.detail-post',['category'=>$posts[2]->categories->slug,'slug'=>$posts[2]->slug])}}">
                                    <div class="list-new-item-img" style="background-image: url('{{asset($posts[2]->thumb)}}')">
                                        <img src="{{asset('asset/frontend/images/icons/heart-white.png')}}" alt="" class="label-fav">
                                    </div>
                                    <div class="new-item-desc">
                                        <p class="item-desc-title">
                                            {{$posts[2]->title}}
                                        </p>
                                        <div class="item-desc-author">
                                            <a href="{{route('frontend.list-post-by-category',$posts[2]->categories->slug)}}"> <span class="new-item-cat">{{$posts[2]->categories->title}}</span></a>
                                            <span class="new-item-author">{{$posts[2]->user->fullname}}</span>
                                            <span class="new-item-cre-at">{{date_format($posts[2]->created_at,'d-m-Y')}}</span>
                                        </div>
                                        <div class="item-desc-content">
                                            {{$posts[2]->description}}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif

                    </div>
                @endif

            </div>
        </div>
        {{--    @include('frontend.inc.video')--}}
        @include('frontend.inc.list_post')

    </div>
    <div id="footer">

    </div>


@endsection


