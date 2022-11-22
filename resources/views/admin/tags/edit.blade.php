@extends('admin.layout.admin')
@section('content')

    <div class="row">

        <div class="col-md-12">

            <div class="card card-primary">
                @if(session('success'))
                    <p class="alert-success text-center">{{session('success')}}</p>
                @endif
                <form id="quickForm" action="{{route('admin.tags.handle-edit',$tag->id)}}" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{$tag->name}}">
                        </div>
                        @error('name')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror
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
