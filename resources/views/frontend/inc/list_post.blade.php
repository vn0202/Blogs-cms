<div class="posts">
    <p class="posts-label">Danh sách tin: </p>

    @php
        $i=0;
    @endphp
    <div class="list-posts">
    @foreach($posts as $post)
{{--        @php--}}
{{--            if($i == 5)--}}
{{--               { break;}--}}
{{--            $i++;--}}
{{--        @endphp--}}
        <div class="posts-item" data-id="{{$i}}">

            <div class="posts-item-img-big">
                <a href="{{route('frontend.detail-post',['category'=>$post->categories->slug,'slug'=>$post->slug])}}">
                    <img src="{{asset($post->thumb)}}" alt="Hinh anh" class="posts-item-img" style="width:100%">
                    <img src="{{asset('asset/frontend/images/icons/heart-white.png')}}" alt="" class="post-icon-fav">
                </a>
            </div>
            <div class="posts-item-infor">
                <a href="{{route('frontend.detail-post',['category'=>$post->categories->slug,'slug'=>$post->slug])}}">
                    <p class="posts-item-title">{{$post->title}}</p>
                    <p class="posts-infor">
                        <a href="{{route('frontend.list-post-by-category',$post->categories->slug)}}"> <span
                                class="new-item-cat">{{$post->categories->title}}</span></a>
                        <span class="new-item-author">{{$post->user->fullname}}</span>
                        <span class="new-item-cre-at">{{date_format($post->created_at,"d-m-Y")}}</span>
                    </p>
                </a>
                <div class="posts-item-desc-big">
                    <a href="{{route('frontend.detail-post',['category'=>$post->categories->slug,'slug'=>$post->slug])}}">
                        <p class="posts-item-desc-content">
                            {{$post->description}}
                        </p>
                    </a>

                </div>
                <div class="posts-item-desc">
                    <div class="posts-item-img">
                        <a href="{{route('frontend.detail-post',['category'=>$post->categories->slug,'slug'=>$post->slug])}}">
                            <img src="{{asset($post->thumb)}}" alt="Hinh anh">
                            <img src="{{asset('asset/frontend/images/icons/heart-white.png')}}" alt=""
                                 class="post-icon-fav">
                        </a>
                    </div>

                    <p class="posts-item-desc-content">
                        <a href="{{route('frontend.detail-post',['category'=>$post->categories->slug,'slug'=>$post->slug])}}">
                            {{$post->description}}
                        </a>

                    </p>
                </div>
            </div>

        </div>
    @endforeach
    </div>

    <div class="row mt-2 justify-content-end">
        <div class="col-sm-12 col-md-4">
            {!! $posts->links() !!}
        </div>
    </div>

</div>
