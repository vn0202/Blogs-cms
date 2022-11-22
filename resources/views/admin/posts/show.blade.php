@extends('admin.layout.admin')
@section('content')

            <div class="row">

                <div class="col-md-12">

                    <div class="card card-primary">
                        @if(!$post)
                            <p class="text-center text-danger ">Bài viết hiện không tồn tại</p>
                        @else
                            <form id="quickForm" action="" method="POST">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Title</label>
                                        <input disabled value="{{ $post->title }}" type="text" name="title" class="form-control" id="title" placeholder="Enter title">
                                    </div>
                                    <div class="form-group">
                                        <label for="parent">Danh mục cha</label>
                                        <input disabled name="category_id" class="form-control" value="{{\App\Models\Category::find($post->category)->title}}">
                                        </input>
                                    </div>

                                    <div class="form-group">
                                        <label>Tag</label>
                                          @if($list_tags->all())
                                                  @foreach($list_tags as $tag)
                                                <span  style="background-color: #CCCCCC; border-radius: 16px;margin-right: 4px ">
                                                #{{\App\Models\Tag::find($tag->tag_id)->name}}
                                                </span>

                                            @endforeach
                                              @else
                                              -
                                              @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Mô tả ngắn</label>
                                        <input disabled value="{{ $post->description }}" type="text" name="description" class="form-control" id="description" placeholder="Enter description">
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Mô tả chi tiết</label>
                                        <p class="">{!! $post->content !!}</p>
                                    </div>
                                    <div class="form-group w-50">
                                        <label>Ảnh bài viết</label>
                                        <div id="image_show">
                                            <a href="{{asset( $post->thumb )}}" target="_blank">
                                                <img src="{{asset($post->thumb)}}" width="300px;" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng thái</label>
                                        <p>{{ $post->status == 1 ? 'Đang kích hoạt' : 'Chưa kích hoạt'}}</p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{route('admin.posts.edit-post',$post->id)}}" class="btn btn-primary">Sửa</a>
                                    <a href="" class="btn btn-danger">Xóa</a>
                                </div>
                                @csrf
                            </form>

                        @endif
                    </div>

                </div>
                <div class="col-md-6">
                </div>

            </div>



@endsection
