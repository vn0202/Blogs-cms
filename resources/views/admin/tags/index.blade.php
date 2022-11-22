@extends('admin.layout.admin')
@section('content')
    <div class="row mb-3">
        <div class="col-9 d-flex align-items-baseline">
            <a href="{{route('admin.tags.create')}}" class="btn btn-primary col-2" style="height: 38px;">
                <p>Thêm</p>
            </a>
            <p class="ml-4">Show {{$tags->firstItem()}} to {{$tags->lastItem()}} of {{$tags->total()}} entires
                @if($isFilter)
                    ( filter of {{$tags->total()}} entires )
                @endif
            </p>
            <a href="{{route('admin.tags.index')}}" class="ml-4 text-purple text-decoration-underline ">Reset</a>

        </div>

        <nav class="navbar navbar-light bg-light float-right">
            <form class="form-inline">
                <input class="form-control mr-sm-2" value="{{ $search ?? '' }}" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </nav>
    </div>
    <div id="crudTable_wrapper" class="mb-2">
        @if(session('success'))
            <p class="alert-success text-center py-2"> {{session('success')}}</p>
        @endif
            @if(session('failure'))
                <p class="alert-warning text-center py-2"> {{session('failure')}}</p>
            @endif

        <table class="table table-hover text-wrap bg-white ">
            <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th>Tên</th>
                <th>Slug</th>
                <th>create_at</th>
                <th>Last update</th>
                <th style="width: 150px;">Option</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $key => $tag)
                <tr>
                    <td>{{$tag->id}}</td>
                    <td>{{$tag->name}}</td>
                    <td>{{$tag->slug}}</td>
                    <td>{{$tag->created_at}}</td>
                    <td>{{$tag->updated_at}}</td>
                    <td>

                        <a class="btn btn-primary btn-sm" href="{{route('admin.tags.edit-tag',$tag->id)}}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{route('admin.tags.delete-tag',$tag->id)}}" class="btn btn-danger btn-sm"
                           onclick="return confirm('Are you sure to delete this item?')">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="row mt-2 justify-content-end">
            <div class="col-sm-12 col-md-4">
                {!! $tags->appends(request()->all())->links() !!}
            </div>
        </div>
    </div>
@endsection
