@extends('admin.layout.admin')
@section('content')
    <section class="content " style="width:100%; max-width: 1000px">
        <div class="container-fluid">
            <div class="container mt-3">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="card p-3 text-center">
                    <div class="d-flex flex-row justify-content-center mb-3 align-items-center">
                        <div class="image"> <img src="{{{asset($user->avatar)}}}" class="rounded-circle" style="width:120px; height:120px;object-fit: cover" id="output"> <span><i class='bx bxs-camera-plus'></i></span> </div>
                        <div class="d-flex flex-column ms-3 user-details ml-2">
                            <h4 class="mb-0">{{$user->name}}</h4>
                            <div class="ratings"> <span>4.0</span> <i class='bx bx-star ms-1'></i> </div> <span class="text-green">{{\App\Helpers\Helpers::get_role($user->role)}}</span>
                        </div>
                    </div>
                    <h4>Edit Profile</h4>
                    @if(session('success'))
                        <p class="alert-success">{{session('success')}}</p>
                        @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inputs">
                                <label>Name</label>
                                <input class="form-control" type="text" placeholder="fullname" name="fullname" value="{{$errors->has('fullname') ?  $user->fullname :(empty(old('fullname')) ? $user->fullname : old('fullname'))}}">
                            </div>
                            @error('fullname')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="inputs">
                                <label>Username</label>
                                <input class="form-control" type="text" placeholder="Email" name="username" value="{{$errors->has('username') ?  $user->name :(empty(old('username')) ? $user->name : old('username'))}}">
                            </div>
                            @error('username')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="inputs">
                                <label>Email</label>
                                <input class="form-control" type="text" placeholder="Email" value="{{$errors->has('email') ?  $user->email :(empty(old('email')) ? $user->email : old('email')) }}" name="email">
                            </div>
                            @error('email')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="inputs">
                                <label>Password</label>
                                <input class="form-control" type="password" placeholder="enter your password" name="password" >
                            </div>
                            @error('password')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="inputs">
                                <label>confirm password</label>
                                <input class="form-control" type="password" placeholder="enter your newpassword" name="password_confirmation" >
                            </div>
                            @error('password_confirmation')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="inputs">
                                <label class="d-block">Avatar: </label>
                                <input  type="file"  name="avatar" onchange="loadFile(event)">
                            </div>
                            @error('avatar')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3 gap-2 d-flex justify-content-center">
                         <button class="px-4 btn btn-sm btn-primary">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>

@endsection
@section('script')
    <script>

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endsection
