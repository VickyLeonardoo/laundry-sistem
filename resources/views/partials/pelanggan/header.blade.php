<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Laundry|@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('assets') }}/css/main/app.css">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/shared/iconly.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/pages/datatables.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/extensions/sweetalert2/sweetalert2.min.css">
</head>
<body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="index.html"><img src="{{ asset('assets') }}/images/logo/logo.svg" alt="Logo"></a>
                        </div>
                        <div class="header-top-right">

                            <div class="dropdown">
                                <a href="#" id="topbarUserDropdown"
                                    class="user-dropdown d-flex align-items-center dropend dropdown-toggle "
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2">
                                        <img src="{{ asset('assets') }}/images/faces/1.jpgs" alt="Avatar">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name">{{ auth()->user()->name }}</h6>
                                        <p class="user-dropdown-status text-sm text-muted">Pelanggan</p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg"
                                    aria-labelledby="topbarUserDropdown">
                                    <li><a class="dropdown-item" href="#">My Account</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                                </ul>
                            </div>

                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @include('partials.pelanggan.navbar')

            </header>

            <div class="content-wrapper container">

                <div class="page-heading">
                    <h3>@yield('title')</h3>
                </div>
                <div class="page-content">
                    @yield('content')
                </div>

            </div>

            <footer>
                <div class="container">
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2021 &copy; Mazer</p>
                        </div>
                        <div class="float-end">
                            <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                    href="https://saugi.me">Saugi</a></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('assets') }}/js/bootstrap.js"></script>
    <script src="{{ asset('assets') }}/js/app.js"></script>
    <script src="{{ asset('assets') }}/js/pages/horizontal-layout.js"></script>

    {{-- <script src="{{ asset('assets') }}/extensions/apexcharts/apexcharts.min.js"></script> --}}
    {{-- <script src="{{ asset('assets') }}/js/pages/dashboard.js"></script> --}}
    <script src="{{ asset('assets') }}/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('assets') }}/js/pages/datatables.js"></script>
    <script src="{{ asset('assets') }}/extensions/sweetalert2/sweetalert2.min.js"></script>
    @if(session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Success"
            });
        </script>
    @endif
    @if(session('transactionNo'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Success"
            });
        </script>
    @endif
</body>

</html>
