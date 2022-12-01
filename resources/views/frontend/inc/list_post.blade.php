<div class="posts">
    <p class="posts-label">Danh sách tin: </p>


    <div class="list-posts">
    @foreach($posts as $post)

        <div class="posts-item" >

            <div class="posts-item-img-big">
                <a href="{{route('frontend.detail-post',['category'=>$post->categories->slug,'slug'=>$post->slug])}}">
                    <img src="{{asset($post->thumb)}}" alt="Hinh anh" class="posts-item-img" style="width:100%;border-radius: 16px">
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
                        <span style="margin-left: 4px;font-size: 14px"><i class="fas fa-eye"></i>{{$post->views}}</span>
                    </p>
                </a>
                <div class="posts-item-desc-big">
                    <a href="{{route('frontend.detail-post',['category'=>$post->categories->slug,'slug'=>$post->slug])}}">
                        <p class="posts-item-desc-content">
                            {!! $post->description !!}
                        </p>
                    </a>

                </div>
                <div class="posts-item-desc">
                    <div class="posts-item-img">
                        <a href="{{route('frontend.detail-post',['category'=>$post->categories->slug,'slug'=>$post->slug])}}">
                            <img src="{{asset($post->thumb)}}" alt="Hinh anh" style="border-radius: 16px">
                            <img src="{{asset('asset/frontend/images/icons/heart-white.png')}}" alt=""
                                 class="post-icon-fav">
                        </a>
                    </div>

                    <p class="posts-item-desc-content">
                        <a href="{{route('frontend.detail-post',['category'=>$post->categories->slug,'slug'=>$post->slug])}}">
                            {!! $post->description  !!}
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
