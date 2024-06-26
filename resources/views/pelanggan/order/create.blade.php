@extends('partials.pelanggan.header')
@section('title','Order')

@section('content')
<section class="row">
    @if(session('transactionNo'))
        <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>
            Berhasil Menambahkan Orderan, Silahkan Berikan Barang kamu ke petugas Laundry untuk Dilakukan
            Verifikasi.
        </div>
    @elseif (session('errOrder'))
        <div class="alert alert-light-danger color-danger"><i class="bi bi-check-circle"></i>
            Gagal Menambahkan Orderan, Kamu Sudah Membuat 3 Orderan Hari ini, Namun Jangan Kahwatir, Silahkan datang ke Outlet untuk melakukan Penambahan Item pada Orderan Kamu Sebelumnya. Point Orderan Kamu akan ditambahkan pada Orderan Sebelumnya ...
        </div>
    @else
    @endif
    <div class="col-12 col-lg-12">
        <div class="row">
            <div class="card">
                <div class="card-header text-end">
                    <a href="{{ route('pelanggan.order.show') }}" class="btn btn-primary "><i class="fas fa-arrow-left"></i>Back</a>
                </div>
                <div class="card-body">
                    <label>Tracking NO</label>
                    @if(session('transactionNo'))
                        <input type="text" class="form-control" value="{{ session('transactionNo') }}"
                            readonly>
                        <br>
                        <div class="alert alert-light-warning color-warning"><i class="bi bi-check-circle"></i>
                            Klik "View Order" untuk Melihat Orderan
                        </div>
                        <div class="text-end">
                            <a href="{{ route('pelanggan.order.trackno',session('transactionNo')) }}" class="btn btn-primary text-end">View Order</a>
                        </div>
                    @elseif (session('errOrder'))
                    <input type="text" class="form-control" value="--" readonly>
                        <small class="text-danger">Klik "Get Tracking No" untuk Melihat Daftar Orderan Sebelumnya Tracking</small>
                    @else
                        <input type="text" class="form-control" value="--" readonly>
                        <small class="text-danger">Klik "Get Tracking No" untuk mendapatkan Nomor Tracking</small>
                    @endif
                    {{-- @if (!$transactionNo)
                        <input type="text" class="form-control" value="--" readonly>
                    @else
                        <input type="text" class="form-control" value="{{ $transactionNo }}" readonly>
                    @endif--}}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>Order</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('pelanggan.order.createTrackno') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nomor Hp</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->noHp }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nomor Hp</label>
                            <select name="discount_id" class="form-control">
                                @if ($vouchers)
                                    <option value="" selected disabled>--Pilih Voucher--</option>
                                    @foreach ($vouchers as $voucher)
                                        <option value="{{ $voucher->discount_id }}">{{ $voucher->discount->nama }}</option>
                                    @endforeach
                                @else
                                    <option value="">--Kamu Tidak Punya Voucher--</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Get Tracking No" class="btn btn-primary form-control">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
