<ul class="list-cats">
    <li class="list-cats-item">
        <a href="{{route('frontend.home')}}" class="list-cats-item-link {{empty($category) ? 'active' : false}}  ">Tất cả</a>
    </li>
    @foreach(\App\Models\Category::whereNull('category_id')->get() as $cat)
        <li class="list-cats-item">
            <a href="{{route('frontend.list-post-by-category',$cat->slug)}}" class="list-cats-item-link {{$category== $cat->id ? 'active': false}} ">{{$cat->title}}</a>
        </li>
    @endforeach



</ul>

<div>
    <form action="{{route('frontend.search')}}" method="post">
        @csrf
        <input type="text" placeholder="Tìm kiếm thông tin " style="padding:4px " name="search" id="search">
        <button class="btn btn-primary " id="btn-search">search </button>
    </form>
</div>


