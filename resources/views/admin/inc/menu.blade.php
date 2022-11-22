<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    <li class="nav-item">
        <a href="{{route('admin.home')}}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-header text-uppercase font-weight-bold">Data</li>
    <li class="nav-item">
        <a href="{{route('admin.posts.index')}}" class="nav-link">
            <i class="nav-icon far fa-newspaper"></i>
            <p>Articles</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('admin.categories.list-cat')}}" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>Categories</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('admin.tags.index')}}" class="nav-link">
            <i class="nav-icon fas fa-tag"></i>
            <p>Tags</p>
        </a>
    </li>

    <li class="nav-header text-uppercase font-weight-bold">Authentication</li>
    <li class="nav-item">
        <a href="{{route('admin.users.list-users')}}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Users</p>
        </a>
    </li>
    <li class="nav-item">
        <a onclick="return confirm('Bạn có muốn đăng xuất ?')" href="{{route('logout')}}" class="nav-link">
            <i class="nav-icon fas fa-power-off"></i>
            <p>
                Logout
            </p>
        </a>
    </li>

    <li class="nav-header text-uppercase font-weight-bold">Systems</li>
    <li class="nav-item">
        <a href="/admin/log-viewer" class="nav-link">
            <i class="nav-icon fas fa-terminal"></i>
            <p>Logs</p>
        </a>
    </li>

</ul>
