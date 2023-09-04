<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item {{ Route::is('pelanggan.dashboard') ? 'active':'' }}">
            <a href="{{ route('pelanggan.dashboard') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-item  has-sub">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-stack"></i>
                <span>Components</span>
            </a>
            <ul class="submenu">
                <li class="submenu-item">
                    <a href="component-alert.html">Alert</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item  has-sub">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-collection-fill"></i>
                <span>Extra Components</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="extra-component-avatar.html">Avatar</a>
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
