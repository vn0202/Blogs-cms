@extends('admin.layout.admin')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6" >

            <div class="small-box bg-info" >
                <div class="inner">
                    <h3>{{\App\Models\Post::count()}}</h3>
                    <p>Tổng số bài viết</p>
                </div>
                <a href="{{route('admin.posts.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{\App\Models\Category::count()}}</h3>
                    <p>Tổng số category</p>
                </div>

                <a href="{{route('admin.categories.list-cat')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{\App\Models\Tag::count()}}</h3>
                    <p>Tổng số tag</p>
                </div>
                <a href="{{route('admin.tags.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{\App\Models\User::count()}}</h3>
                    <p>Tổng số users</p>
                </div>

                <a href="{{route('admin.users.list-users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
</div>

@endsection
