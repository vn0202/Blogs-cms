<table class="table table-hover text-wrap bg-white ">
<thead>
    <tr>
        <th style="width: 50px;">ID</th>
        <th class="sorting" data-id="1">Họ và tên:</th>
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

