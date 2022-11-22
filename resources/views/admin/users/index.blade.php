@extends('admin.layout.admin')
@section('content')
    <div class="row">
    <div class="col-4   ">
        <a href="{{route('admin.users.create')}}" class="btn btn-primary col-2 mb-3" style="height: 42px;">
            <p>Thêm</p>
        </a>
    </div>

    </div>
    <div id="crudTable_wrapper" class="mb-2">
        <table class="table table-hover text-wrap bg-white ">
            <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th class="sorting" data-id="1">Họ và tên</th>
                <th class="sorting" data-id="2">Tên đăng nhập</th>
                <th class="sorting" data-id="3">Email</th>
                <th class="sorting" data-id="4">Role</th>
                <th style="width: 150px;">Option</th>
            </tr>
            </thead>
            <tbody>

            @foreach($users as $key => $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->fullname}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{\App\Helpers\Helpers::get_role($user->role)}}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{route('admin.users.edit-user',$user->id)}}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{route('admin.users.delete-user',$user->id)}}" class="btn btn-danger btn-sm"
                           onclick="return confirm('Bạn có chắc muốn xóa người dùng này không?')">
                            <i class="fa fa-trash"></i>
                        </a>
                        <a class="btn btn-success btn-sm" href="">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="row mt-2 justify-content-end " id="paginate" >

            <div class="col-sm-12 col-md-4 ">
                <div class="" >
                    {!! $users->appends(request()->all())->links() !!}
                </div>
            </div>
        </div>
    </div>
        @endsection
        @section('script')
            <script>
                $(document).ready(function () {

                   $('.sorting').click(function () {
                          let type = "desc";
                        $(this).toggleClass('default');
                        if($(this).hasClass('default')){
                             type = "asc";
                        }

                        let id = this.getAttribute('data-id');
                        $.ajax(
                            {
                                type: 'POST',
                                enctype: 'multipart/form-data',
                                url: "{{ route('admin.users.sort') }}",
                                data: {
                                    _token: "{{csrf_token()}}",
                                    id: id,
                                    type: type,
                                },

                                dataType:'json',
                                success: function (respone) {
                                   let  data = respone.data;
                                   console.log(data);
                                    let length = data.length;
                                    let html = ``;
                                    for (let i = 0; i < length; i++) {
                                        let role = data[i].role == 1 ? "Admin" : (data[i].role ==2 ? 'Editor' : "User") ;
                                       var id = data[i].id;
                                      var routeEdit = "{{route('admin.users.edit-user',":id")}}";
                                      var routeDelete = "{{route('admin.users.delete-user',":id")}}"
                                      routeEdit = routeEdit.replace(':id',id);
                                      routeDelete = routeDelete.replace(':id',id);
                                        html += `<tr>
                                            <td>${data[i].id}</td>
                                            <td>${data[i].fullname}</td>
                                            <td>${data[i].name}</td>
                                            <td>${data[i].email}</td>
                                            <td>${role}</td>
                                              <td>
                         <a class="btn btn-primary btn-sm" href="${routeEdit}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="${routeDelete}" class="btn btn-danger btn-sm"
                           onclick="return confirm('Bạn có chắc muốn xóa người dùng này không?')">
                            <i class="fa fa-trash"></i>
                        </a>
                        <a class="btn btn-success btn-sm" href="">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                       </td>
                                                  </tr>`;

                                    }
                                    $('tbody').html(html);
                                    $('#paginate').html('');
                                },

                                error: function (xhr, status, error) {
                                    alert(error)
                                }

                            }
                        )

                    })
                })
            </script>
@endsection
