@extends('admin.layout.admin')
@section('content')
            <div class="row">
        <div class="col-md-12" style="max-width: 800px">
            <div class="card card-primary">
                <form id="quickForm" action="{{route('admin.users.handle-edit-user',$user->id)}}" method="POST">
                    @if(session('success'))
                        <p class="alert-success text-center">{{session('success')}}</p>
                    @endif
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="name" placeholder="Enter name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email" placeholder="Enter email" readonly>
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" class="custom-select">
                                <option value="1" {{$user->role == 1 ? "selected" : false}}>Admin</option>
                                <option value="2" {{$user->role == 2 ? "selected" : false}}>Editor</option>
                                <option value="3" {{$user->role == 3 ? "selected" : false}}>User</option>
                            </select>
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
