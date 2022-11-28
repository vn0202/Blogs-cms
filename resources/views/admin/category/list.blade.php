@extends('admin.layout.admin')
@section('content')
    <div class="row mb-3">
        <div class="col-9 d-flex align-items-baseline">
            <a href="{{route('admin.categories.add-cat')}}" class="btn btn-primary col-1" style="height: 42px;">
                <p>Thêm</p>
            </a>
            <p class="ml-4">Show {{$categories->firstItem()}} to {{$categories->lastItem()}} of {{$categories->total()}} entires
                @if($isFilter)
                    ( filter of {{$categories->total()}} entires )
                @endif
            </p>
            <a href="{{route('admin.categories.list-cat')}}" class="ml-4 text-purple text-decoration-underline col-3">Reset</a>
        </div>

        <nav class="navbar navbar-light bg-light float-right">

            <form class="form-inline" action="">
                <input class="form-control mr-sm-2" value="{{ $search ?? '' }}" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </nav>

    </div>
    <div id="crudTable_wrapper" class="mb-2">
        @if(session('success'))
            <p class="alert-success text-center">{{session('success')}}</p>
        @endif
        @if(session('failure'))
            <p class="alert-danger text-center">{{session('failure')}}</p>
        @endif
        <table class="table table-hover text-wrap bg-white ">
            <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th>Title</th>
                <th>Slug</th>

                <th>Cat parent</th>
                <th>Creator</th>
                <th>Date create</th>
                <th>Last Update</th>
                <th style="width: 150px;">Option</th>
            </tr>
            </thead>
            <tbody>

            @foreach($categories as $key => $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->title}}</td>
                    <td>{{$category->slug}}</td>
                    <td>{{$category->childItSelf->title?? "Danh mục gốc "}}</td>
                    <td>{{$category->user->fullname}}</td>
                    <td>{{date($category->created_at)}}</td>
                    <td>{{$category->updated_at}}</td>

                    <td>

                        <a class="btn btn-primary btn-sm" href="{{route('admin.categories.edit-cat',$category->id)}}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{route('admin.categories.destroy-cat',$category->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có thực sự muốn xóa danh mục này?')">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="row mt-2 justify-content-end">
            <div class="col-sm-12 col-md-4">
                {!! $categories->appends(request()->all())->links() !!}
            </div>
        </div>
    </div>
@endsection
