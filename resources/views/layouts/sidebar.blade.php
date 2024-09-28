<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">CScorp LLC</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') || Route::is('profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('authors.index') }}" class="nav-link {{ Route::is('authors.*') || Route::is('books.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Authors</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
