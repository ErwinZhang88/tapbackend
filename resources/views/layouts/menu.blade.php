<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <!-- <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
            Home
            <span class="right badge badge-danger">New</span>
            </p>
        </a>
        </li> -->
        <li class="nav-item {{ isset($page) && $page == 'menu' ? 'menu-open' : ''}}">
        <a href="{{ route('admin.menu.index') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
            Menu
            </p>
        </a>
        </li>
        <li class="nav-item {{ isset($page) && $page == 'category' ? 'menu-open' : ''}}">
        <a href="{{ route('admin.category.index') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
            Category
            </p>
        </a>
        </li>
        <li class="nav-item {{ isset($page) && $page == 'banner' ? 'menu-open' : ''}}">
        <a href="{{ route('admin.banner.index') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
            Banner
            </p>
        </a>
        </li>
        
        @foreach(\App\Menu::orderBy('id', 'asc')
        ->where('parent_id', 0)->get() as $menu)
        <li class="nav-item {{ isset($page) && $page == $menu->nicename ? 'menu-open' : ''}}">
        <a href="{{ route('admin.content',['eventid' => $menu->id ]) }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
            {{ $menu->name }}
            </p>
        </a>
        </li>
        @endforeach
        <li class="nav-item {{ isset($page) && $page == 'operasionals' ? 'menu-open' : ''}}">
        <a href="{{ route('admin.content',['eventid' => 2]) }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
            Setting
            </p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="nav-link">
            <i class="nav-icon far fa-circle text-info"></i>
            <p>Logout</p>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </li>
    </ul>
</nav>