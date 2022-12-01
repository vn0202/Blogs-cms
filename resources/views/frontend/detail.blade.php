@extends('frontend.layout.app')
@section('style')
    <link rel="stylesheet" href="{{asset('asset/frontend/css/style-detail.css')}}">
    <link rel="stylesheet" href="{{asset('asset/frontend/css/responsive-detail.css')}}">

@endsection
@section('content')
        <div class="new">
            <div class="new-header">
                <a href="{{route('frontend.home')}}" class="backward"><i class="fas fa-chevron-left"></i> <span class="backward-text">Quay lại</span></a>
                <p class="new-catogery">
                    <span class="lable-cat">Chuyên mục:</span>
                    <a href="{{route('frontend.list-post-by-category',$post->categories->slug)}}"> <span class="new-item-cat">{{$post->categories->title}}</span></a>
                </p>
            </div>
            <div class="new-body">
                <div class="new-title">
                    <p>{{$post->title}}</p>
                </div>
                <div class="new-some-infor">
                    <div class="new-author">
                        <a href="{{route('frontend.list-post-by-category',$post->categories->slug)}}"> <span class="new-item-cat">{{$post->categories->title}}</span></a>
                        <span class="new-item-author">{{$post->user->fullname}}</span>
                        <span class="new-item-cre-at">{{date_format($post->created_at,'d-m-Y')}}</span>
                    </div>
                    <div class="socials">
                        <a href="" class="social-link-mail">
                            <img src="{{asset('asset/frontend/images/icons/mail.png')}}" alt="" class="social-link-icon">
                            <span class="social-link-label">Gửi mail</span>
                        </a>
                        <a href="" class="social-link-face">
                            <img src="{{asset('asset/frontend/images/icons/facebook.png')}}" alt="" class="social-link-icon">
                            <span class="social-link-label">Chia sẻ</span>

                        </a>
                        <a href="" class="social-link-save">
                            <img src="{{asset('asset/frontend/images/icons/save.png')}}" alt="" class="social-link-icon">
                            <span class="social-link-label">Lưu</span>

                        </a>

                    </div>
                </div>
                <div class="new-body-main">
                    <img src="images/news/img.png" alt="" class="new-body-img">
                    <div class="new-body-main-content">
                        {!! $post->content !!}
                    </div>

                    <ul class="keywords" style="display:flex; flex-wrap: wrap;align-items: center">
                        @foreach($post->tags as $tag)
                            <li class="keywords-item" style="margin-bottom: 12px">
                                <a href="{{route('frontend.list-post-tag',$tag->slug)}}"> {{$tag->name}}</a>
                               </li>

                        @endforeach



                    </ul>

                </div>
                <div class="new-body-sub">

                    <div class="posts">
                        <div class="posts-label">
                            <p>
                                <span>Tin cùng chuyên mục</span>
                                <a href="{{route('frontend.list-post-by-category',$post->categories->slug)}}"><span class="post-label-cat">{{$post->categories->title}}</span></a>
                            </p>
                            <a href="{{route('frontend.list-post-by-category',$post->categories->slug)}}" class="post-label-see-all">Xem tất cả</a>
                            <a href="{{route('frontend.list-post-by-category',$post->categories->slug)}}" class="post-label-see-next">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                       <div id="posts-data">
                           @include('frontend.inc.list_post')
                       </div>


                    </div>

                </div>

            </div>

        </div>

@endsection
@section('script')
    <script>

    </script>
@endsection
