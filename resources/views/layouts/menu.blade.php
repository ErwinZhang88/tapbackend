<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
        <a href="{{ route('home') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
            Home
            <span class="right badge badge-danger">New</span>
            </p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('menu') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
            Menu
            </p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('category') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
            Category
            </p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('post') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
            Tentang Kami
            </p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('post') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
            Kepimpinan
            </p>
        </a>
        </li>
        <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon far fa-circle text-info"></i>
            <p>Informational</p>
        </a>
        </li>
    </ul>
</nav>