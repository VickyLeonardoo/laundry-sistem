<nav class="main-navbar">
    <div class="container">
        <ul>
            <li class="menu-item">
                <a href="{{ route('pelanggan.dashboard') }}" class='menu-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-item  has-sub">
                <a href="#" class='menu-link'>
                    <i class="fas fa-shopping-basket"></i>
                    <span>Order</span>
                </a>
                <div class="submenu ">
                    <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                    <div class="submenu-group-wrapper">
                        <ul class="submenu-group">
                            <li class="submenu-item  ">
                                <a href="{{ route('pelanggan.order.show') }}" class='submenu-link'>View Order</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="{{ route('pelanggan.order.create') }}" class='submenu-link'>New Order</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>

            <li class="menu-item  has-sub">
                <a href="#" class='menu-link'>
                    <i class="fa-solid fa-percent" style="color: #ffffff;"></i>
                    <span>Promo</span>
                </a>
                <div class="submenu ">
                    <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                    <div class="submenu-group-wrapper">
                        <ul class="submenu-group">
                            <li class="submenu-item">
                                <a href="{{ route('pelanggan.promo.show') }}" class='submenu-link'>Daftar Promo</a>
                            </li>
                            <li class="submenu-item">
                                <a href="{{ route('pelanggan.promo.voucher') }}" class='submenu-link'>Voucher Saya</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
