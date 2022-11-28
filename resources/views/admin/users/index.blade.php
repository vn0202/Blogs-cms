@extends('admin.layout.admin')
@section('content')
    <div class="row">
        <div class="col-4  ">
            <a href="{{route('admin.users.create')}}" class="btn btn-primary col-2 mb-3" style="height: 42px;">
                <p>Thêm</p>
            </a>
            <nav class="navbar navbar-light bg-light">
                <form class="form-inline">
                    <input class="form-control mr-sm-2" value="{{ $search ?? '' }}" name="search" type="search"
                           placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </nav>
        </div>

    </div>
    <div id="crudTable_wrapper" class="mb-2">
        <table class="table table-hover text-wrap bg-white ">
            <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th class="sorting" data-sorting_type="asc" data-column_name="fullname">Họ và tên <span class="fullname_sort_icon"><i class="fas fa-caret-down"></i></span></th>
                <th class="sorting" data-sorting_type="asc" data-column_name="name">Tên đăng nhập <span class="name_sort_icon"><i class="fas fa-caret-down"></i></span></th>
                <th class="sorting" data-sorting_type="asc" data-column_name="email">Email <span class="email_sort_icon"><i class="fas fa-caret-down"></i></span></th>
                <th class="sorting" data-sorting_type="asc" data-column-name="'role">Role <span class="role_sort_icon"><i class="fas fa-caret-down"></i></span></th>
                <th style="width: 150px;">Option</th>
            </tr>
            </thead>
            <tbody>
            @include('admin.inc.table_user')

            </tbody>
        </table>
        <input type="hidden" name="hidden_page" id="hidden_page" value="1">
        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id">
        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc">

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {

            function fetch_data(page, sort_type, sort_by) {
                $.ajax({
                    url: "{{route('admin.users.sort')}}" + `?page=${page}` + `&sortType=${sort_type}` + `&sortBy=${sort_by}`,
                    type: 'GET',
                    success: function (data) {
                        $('tbody').html('');
                        $('tbody').html(data);
                    },
                    error:function (xhr,status,error){
                        alert(error)
                    }
                })
            }
            $('.sorting').click(function () {
                var column_name = $(this).data('column_name');
                var sort_type = $(this).data('sorting_type');
                var resever_order = '';
                if (sort_type == 'asc') {
                    $(this).data('sorting_type', 'desc');
                    $("."+ column_name+"_sort_icon").html('');
                    $('.'+ column_name+"_sort_icon").html('<i class="fas fa-caret-up"></i>')
                    resever_order = 'desc';
                }
                if (sort_type == 'desc') {
                    $(this).data('sorting_type', 'asc');
                    resever_order = 'asc';
                    $('.'+column_name+"_sort_icon").html('');
                    $('.'+column_name+"_sort_icon").html('<i class="fas fa-caret-down"></i>')
                }
                $('#hidden_column_name').val(column_name);
                $('#hidden_sort_type').val(resever_order);
                var page = $('#hidden_page').val();
                fetch_data(page, resever_order, column_name);
            })
            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var column_name = $('#hidden_column_name').val();
                var sorting_type = $('#hidden_sort_type').val();
                fetch_data(page, sorting_type, column_name);
            })

        })
    </script>
@endsection
