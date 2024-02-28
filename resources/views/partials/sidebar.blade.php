<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="/adminlte/dist/img/enclave-logo.png" class="brand-image img-circle elevation-3" style="opacity: .8">
        {{-- <i class="fa-brands fa-google"></i> --}}
        <span class="brand-text font-weight-normal"><span class="text-danger font-weight-bold">N</span>CLAVE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/" class="nav-link {{ $page == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-table-columns"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/furnitures" class="nav-link {{ $page == 'furnitures' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chair"></i>
                        <p>
                            Furnitures
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/categories" class="nav-link {{ $page == 'categories' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-swatchbook"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ str_contains($page, 'material') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ str_contains($page, 'material') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sheet-plastic"></i>
                        <p>
                            Materials
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/material1s" class="nav-link {{ $page == 'material1s' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Materials 1</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/material2s" class="nav-link {{ $page == 'material2s' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Materials 2</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/material3s" class="nav-link {{ $page == 'material3s' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Materials 3</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/material4s" class="nav-link {{ $page == 'material4s' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Materials 4</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/suppliers" class="nav-link {{ $page == 'suppliers' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Supplier
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/orders" class="nav-link {{ $page == 'orders' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            PO
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
