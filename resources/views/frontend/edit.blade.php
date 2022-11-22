<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('asset/admin/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{asset('asset/frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('asset/frontend/css/responsive.css')}}">
</head>
<body>

<section class="content " style="width:100%">
    <div class="container-fluid">
        <div class="container mt-3">
            <div class="row">
                @include('frontend.inc.header')

            </div>
            <div class="row" style="margin-top: 150px; ">
                    <div class="row">
                        <h1>Your profile</h1>

                    </div>
                    <form action="" method="POST" enctype="multipart/form-data" style="margin:0 auto">
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
                                <a href="{{route('frontend.home')}}" class="btn btn-danger mr-1">back</a>

                                <button class="px-4 btn btn-sm btn-primary">Save</button>
                            </div>
                        </div>
                    </form>


            </div>
        </div>
    </div>
</section>

<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>

</body>
</html>
