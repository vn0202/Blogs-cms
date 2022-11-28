

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
<tr style="width:100%; ">
    <td colspan="3" align="center" >
{!! $users->links() !!}
    </td>
</tr>



