<div id="crudTable_wrapper" class="mb-2">
    @if($posts->count())
        <table class="table table-hover text-wrap bg-white ">
            <thead>
            <tr>
                <th style="width: 50px;">ID</th>
                <th style="width:500px">Tiêu đề</th>
                <th>Tác giả</th>
                <th>Thể loại</th>
                <th>Kích hoạt</th>
                <th>Ngay xuat ban</th>
                <th style="width: 150px;">Option</th>
            </tr>
            </thead>
            <tbody>

            @foreach($posts as $key => $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td class="limit-line-1"  >{{$post->title}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->categories->title}}</td>
                    <td>{{$post->active == 0 ? "DRAF" : "PUBLISHED"}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{route('admin.posts.show-post',$post->id)}}">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="btn btn-primary btn-sm" href="{{route('admin.posts.edit-post',$post->id)}}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{route('admin.posts.delete-post',$post->id)}}" class="btn btn-danger btn-sm"
                           onclick="return confirm('Bạn có chắc muốn xóa bài viểt này không? ')">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    @else
        <p class="text-center  bg-white">
            Không tồn tại bài viết nào!
        </p>
    @endif
    <div class="row mt-2 justify-content-end">
        <div class="col-sm-12 col-md-4">
            {!! $posts->links() !!}
        </div>
    </div>
</div>
