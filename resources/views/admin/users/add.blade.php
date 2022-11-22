@extends('admin.layout.admin')
@section('content')
            <div class="row">
        <div class="col-md-12" style="max-width: 800px">

            <div class="card card-primary">
                @if(session('success'))
                    <p class="alert-success text-center"> {{session('success')}}</p>
                    @endif
                <form id="quickForm" action="{{route('admin.users.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="fullname">Name</label>
                            <input value="{{old('fullname')}}" type="text" name="fullname" class="form-control" id="fullname" placeholder="Enter your fullname">
                        </div>
                        @error('fullname')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        <div class="form-group">
                            <label for="username">Name</label>
                            <input value="{{old('name')}}" type="text" name="username" class="form-control" id="username" placeholder="Enter name">
                        </div>
                        @error('username')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input value="{{old('email')}}" type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        @error('email')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input value="{{old('password')}}" type="password" name="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        @error('password')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        <div class="form-group">
                            <label for="password_confirmation">Confirm password</label>
                            <input value="{{old('password_confirmation')}}" type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Password">
                        </div>
                        @error('password_confirmation')
                        <p class="text-danger">{{$message}}</p>
                        @enderror

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" class="custom-select">
                                <option value="1">Admin</option>
                                <option value="2">Editor</option>
                                <option value="3" selected>User</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>

            </div>

        </div>


        <div class="col-md-6">
        </div>
 </div>
@endsection
