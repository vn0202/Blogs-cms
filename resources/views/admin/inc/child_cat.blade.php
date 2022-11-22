<li class="menu-item" data-id="{{$child_category->id}}" data-value="{{$child_category->title}}">{{ $child_category->title }}
    @if (count($child_category->categories))
        <ul class="sub-menu sub-menu-{{$child_category->id}} " style="display: none">
            @foreach ($child_category->categories as $childCategory)
                @include('admin.inc.child_cat', ['child_category' => $childCategory])
            @endforeach
        </ul>
    @endif
</li>

