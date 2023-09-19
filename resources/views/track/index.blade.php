<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>E-Laundry|@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets') }}/css/main/app.css">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

                    <div class="card">
                        <div class="card-header">
                            <span class="badge bg-primary ">Tracking Laundry</span>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Nomor Orderan:</label>
                                <input type="text" id="orderNo" class="form-control" placeholder="Cth: LNDXXXXXXXXXX" value="{{ old('orderNo') }}" required>
                            </div>
                            <div class="form-group">
                                <a href="#" id="searchLink" class="btn btn-primary"><i class="fas fa-search"></i> Cari</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="{{ asset('assets') }}/js/bootstrap.js"></script>
    <script src="{{ asset('assets') }}/js/app.js"></script>
    <script src="{{ asset('assets') }}/js/pages/horizontal-layout.js"></script>

    {{-- <script src="{{ asset('assets') }}/extensions/apexcharts/apexcharts.min.js"></script> --}}
    {{-- <script src="{{ asset('assets') }}/js/pages/dashboard.js"></script> --}}
    <script src="{{ asset('assets') }}/extensions/jquery/jquery.min.js"></script>
    <script>
        // Mendapatkan elemen-elemen HTML yang diperlukan
        const orderNoInput = document.getElementById('orderNo');
        const searchLink = document.getElementById('searchLink');

        // Menambahkan event listener untuk mengarahkan tautan ke URL yang sesuai
        searchLink.addEventListener('click', function() {
            const orderNo = orderNoInput.value;
            window.location.href = `/track/${orderNo}`;
        });
    </script>
</body>

</html>
