<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item {{ Route::is('admin.dashboard') ? 'active':'' }} ">
            <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-item  has-sub {{ Route::is('admin.outlet.*','admin.discount.*','admin.jenis.*') ? 'active':'' }}">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-stack"></i>
                <span>Master Data</span>
            </a>
            <ul class="submenu {{ Route::is('admin.outlet.*','admin.discount.*','admin.jenis.*') ? 'active':'' }}">
                <li class="submenu-item {{ Route::is('admin.outlet.*') ? 'active':'' }}">
                    <a href="{{ route('admin.outlet.show') }}">
                        <i class="fas fa-store"></i>
                        Outlet</a>
                </li>
                <li class="submenu-item {{ Route::is('admin.jenis.*') ? 'active':'' }}">
                    <a href="{{ route('admin.jenis.show') }}">
                        <i class="fas fa-tshirt"></i>
                        Jenis Barang</a>
                </li>
                <li class="submenu-item {{ Route::is('admin.discount.*') ? 'active':'' }}">
                    <a href="{{ route('admin.discount.show') }}">
                        <i class="fas fa-percent"></i>
                        Discount</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item has-sub {{ Route::is('admin.order.menunggu.*','admin.order.diproses.*','admin.order.selesai.*') ? 'active':'' }}">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-collection-fill"></i>
                <span>Order List</span>
            </a>
            <ul class="submenu {{ Route::is('admin.order.menunggu.*','admin.order.diproses.*','admin.order.selesai.*') ? 'active':'' }}">
                <li class="submenu-item {{ Route::is('admin.order.menunggu.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.order.menunggu.show') }}">Menunggu</a>
                </li>
                <li class="submenu-item {{ Route::is('admin.order.diproses.*') ? 'active':'' }}">
                    <a href="{{ route('admin.order.diproses.show') }}">Proses</a>
                </li>
                <li class="submenu-item {{ Route::is('admin.order.selesai.*') ? 'active':'' }}">
                    <a href="{{ route('admin.order.selesai.show') }}">Selesai</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="{{ url('logout') }}" class='sidebar-link'>
                <i class="fas fa-sign-out"></i>
                <span>Sign Out</span>
            </a>
        </li>
    </ul>
</div>
