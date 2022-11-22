@extends('admin.layout.admin')
@section('style')
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        ul {
            list-style: none;
        }
        #main-menu {
            display:none;
            border: 1px solid #ccc;
            box-shadow: 1px 3px 3px 1px #ccc;
            min-width:200px;
        }
        #choose-list{
            display: block;
            max-width: 200px;
        }
        .menu-item{
            position: relative;
            padding:4px 12px;

        }
        .menu-item:hover{
            background-color: #ccc;
        }
        .sub-menu{
            position: absolute;
            border: 1px solid #ccc;
            box-shadow: 1px 3px 3px 1px #ccc;
            min-width: 200px;
            left:100%;
            top:0;
        }
        .category{
            display:none;
        }
    </style>
@endsection

@section('content')
    <div class="row">

        <div class="col-md-12">

            <div class="card card-primary">
                @if(session('success'))
                    <p class="alert-success text-center">{{session('success')}}</p>
                    @endif
                <form id="quickForm" action="{{route('admin.categories.handle-edit',$cat->id)}}" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input value="{{$cat->title}}" type="text" name="title" class="form-control" id="name" placeholder="Enter name">
                        </div>
                        @error('title')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        <div class="form-group ">
                            <label for="name">Danh muc cha:</label>
                            <input type="hidden" name="category" value="" id="category">
                            <span class="category "></span>
                            <div class="test">
                                <span class="btn btn-primary " id="choose-list">{{$cat_title}}</span>
                                <ul class="main-menu "  id="main-menu">
                                    @foreach ($categories as $category)
                                        <li class="menu-item" data-id="{{$category->id}}" data-value="{{$category->title}}">
                                            <span>  {{ $category->title }}</span>

                                            @if(count($category->childrenCategories))
                                                <ul class="sub-menu sub-menu-{{$category->id}}" style="display:none">
                                                    @foreach ($category->childrenCategories as $childCategory)
                                                        @include('admin.inc.child_cat', ['child_category' => $childCategory])
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>

                                    @endforeach
                                </ul>
                            </div>

                        </div>


                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    @csrf
                </form>
            </div>

        </div>
        <div class="col-md-6">
        </div>

    </div>
@endsection
@section('script')
    <script src="{{asset('asset/js/handle_list_category.js')}}"></script>
@endsection
