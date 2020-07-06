<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
            Home
            <span class="right badge badge-danger">New</span>
            </p>
        </a>
        </li>
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
        <li class="nav-item {{ isset($page) && $page == 'tentangkami' ? 'menu-open' : ''}}">
        <a href="{{ route('admin.content',['eventid' => 1]) }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
            Tentang Kami
            </p>
        </a>
        </li>
        <li class="nav-item {{ isset($page) && $page == 'operasional' ? 'menu-open' : ''}}">
        <a href="{{ route('admin.content',['eventid' => 2]) }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
            Operasional
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