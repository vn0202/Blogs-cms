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
            display: none;
            border: 1px solid #ccc;
            box-shadow: 1px 3px 3px 1px #ccc;
            min-width: 200px;
        }

        #choose-list {
            display: block;
            max-width: 200px;
        }

        .menu-item {
            position: relative;
            padding: 4px 12px;

        }

        .menu-item:hover {
            background-color: #ccc;
        }

        .sub-menu {
            position: absolute;
            border: 1px solid #ccc;
            box-shadow: 1px 3px 3px 1px #ccc;
            min-width: 200px;
            left: 100%;
            top: 0;
        }

        .category {
            display: none;
        }

        .list-tag {
            list-style: none;
            box-shadow: 1px 1px 1px 1px #ccc;
            display: none;


        }

        .list-tag-item {
            padding: 8px;

        }

        .list-tag-item:hover {
            background-color: #ccc;

        }

        .list-tag-choose {
            display: inline-block;
        }

        .list-tag-choose-item {
            display: inline-block;
            padding: 4px 8px;
            background-color: #CCCCCC;
            border-radius: 16px;
            margin-right: 4px;

        }

#list-tag{
    max-height:400px;
    overflow: auto;
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

                <form id="quickForm" action="" method="POST" enctype="multipart/form-data">

                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input value="{{ old('title') }}" type="text" name="title" class="form-control" id="title"
                                   placeholder="Enter title">
                        </div>
                        @error('title')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror


                        <div class="test123" id="test123">
                                   <div style="display: flex;justify-content: space-between">
                                       <div>
                            <label>Tag</label>
                            <ul class="list-tag-choose">
                            </ul>
                                       </div>
                                       <p class="add-tag text-purple">+add</p>
                                   </div>

                            <select class="js-example-basic-multiple form-control" name="tagcheck[]" multiple="multiple" id="mySelect2Tag">

                            </select>


                        </div>
                        <div class="form-group ">
                            <label for="name">Danh muc cha:</label>
                            <input type="hidden" name="category" value="" id="category">
                            <span class="category "></span>
                            <div class="test">
                                <span class="btn btn-primary " id="choose-list">--Chon danh muc--</span>
                                <ul class="main-menu " id="main-menu">
                                    @foreach ($categories as $category)
                                        <li class="menu-item" data-id="{{$category->id}}"
                                            data-value="{{$category->title}}">
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
                        @error('category')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                        <div class="form-group">
                            <label for="description">Mô tả ngắn</label>
                            <textarea  type="text" name="description" class="form-control ckeditor"
                                    placeholder="Enter description">
                          {{ old('description') }}
                            </textarea>
                        </div>
                        @error('description')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                        <div class="form-group">
                            <label for="content">Nội dung: </label>
                            <textarea name="content"  class="form-control ckeditor"
                                      placeholder="Enter content">{{old('content')}}</textarea>
                        </div>
                        @error('content')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                        <div class="form-group w-50">
                            <label>Ảnh bài viết</label>
                            <input type="file" id="upload" onchange="loadFile(event)" name="thumb">
                            <img id="output" style="max-width: 500px; object-fit: cover">

                            </img>
                        </div>
                        @error('thumb')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                        <div class="form-group">
                            <label>Kích hoạt</label>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" value="1" type="radio" id="active" name="status">
                                <label for="active" class="custom-control-label">Có</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" value="0" type="radio" id="no_active" name="status"
                                       checked="">
                                <label for="no_active" class="custom-control-label">Không</label>
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
    @include('admin.inc.model')

@endsection
@section('script')
    <script>
        var loadFile = function (event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

        $(document).ready(function () {
            //select 2
            $('.add-tag').click(function(){
                $('.model-over').css('display','flex');
            })
            $('.icon-close').click(function (){
                $('.model-over').css('display','none');
            })
            $('.cancel').click(function (e){
                e.preventDefault();
                $('.model-over').css('display','none');
            })
            $(".list-tag-item").click(function (e) {
                e.stopPropagation();
                $('#list-tag').slideUp();
                let val = $(this).attr('data-value');
                let id = $(this).attr('data-id');

                let list_tag_items = $(".list-tag-choose-item");
                 let flag = true;
                 for(var i =0; i < list_tag_items.length; i++)
                 {

                     if(list_tag_items[i].getAttribute('data-id') == id)
                     {
                         flag = false;
                         break;
                     }

                 }
                if(flag) {
                    let html = `<li class="list-tag-choose-item" data-id="${id}">
                  <input type=text name=tagcheck[] checked value=${id} hidden>${val}</li>`
                    $('.list-tag-choose').append(html);
                    $('.list-tag-choose-item').click(function () {
                        $(this).remove();
                    });
                }


            });




            $('#tag').focusin(function (event) {
                $('#list-tag').slideDown();

            });
            $('#tag').mouseup(function (event){
                $('#list-tag')
            })


            $('.list-tag-choose-item').click(function(){
                $(this).remove();
            });




            $(document).mouseup(function (e) {
                if ($(e.target).closest("#test123").length
                    === 0) {
                    $("#list-tag").slideUp();
                }
            });
            $('#submit-add-tag').click(function (e){
                e.preventDefault();
                let val = $('#model_title').val();
                if(!val.trim())
                {
                    $('.card-body').append(`<p class='text-danger text-center'  >Ban chua nhap ten tag</p>`)
                }
                else {
                    $.ajax({
                        url: "{{route('admin.tags.create-tag-ajax')}}",
                        method: 'POST',
                        data: {
                            search: val,
                            _token: "{{csrf_token()}}"
                        },
                        dataType: 'json',
                        success: function (response) {
                            $('.model-over').css('display','none');

                        },

                        error: function (xhr, status, error) {
                            alert(error)
                        }

                    });
                }
            })


        })


    </script>
    <script src="{{asset('asset/js/handle_list_category.js')}}"></script>

@endsection

