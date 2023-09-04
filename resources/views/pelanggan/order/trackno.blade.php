@extends('partials.pelanggan.header')
@section('title','')

@section('content')
<section class="row">
    @if ($order)
    <div class="card">
        <div class="card-header">
            <h4>{{ $order->trackingNo }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-xl-6">
                    <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" class="form-control" readonly value="{{ auth()->user()->name }}">
                    </div>
                    <div class="form-group">
                        <label>Metode Pembayaran:</label>
                        <select name="statusOrder" class="form-control">
                            <option value="" @readonly(true) disabled selected>Pilih Metode Pembayaran</option>
                            <option value="Cash On Deal">Cash On Deal</option>
                            <option value="Online">Online</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="form-group">
                        <label>Tanggal Order:</label>
                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($order->tglOrder)->isoFormat('D MMMM Y') }}">
                        {{-- <input type="text" class="form-control" value="{{ $order->tglOrder }}"> --}}
                    </div>
                    <div class="form-group">
                        <label>Status Pembayaran:</label>
                        @if ($order->statusOrder == 'Menunggu Verifikasi')
                            <input type="text" class="form-control" readonly value="--">
                        @elseif ($order->statusOrder == 'Diproses')
                            <select name="statusPembayaran" class="form-control">
                                <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
                                <option value="Terbayar">Terbayar</option>
                            </select>
                        @endif
                    </div>
                    @if ($order->statusOrder == 'Diproses')
                        <a href="#" class="btn btn-primary form-control">Proses Pembayaran</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <h3>Daftar Item</h3>
        </div>
        <div class="card-body">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>Jenis Barang</th>
                        <th>Berat</th>
                        <th>Tanggal Diantar</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalHarga = 0; // Inisialisasi variabel total harga
                    @endphp
                    @foreach ($order->orderitem as $orderList)
                    <tr>
                        <td>{{ $orderList->jenis_barang_id }}</td>
                        <td>{{ $orderList->berat }}</td>
                        <td>{{ \Carbon\Carbon::parse($orderList->tglDiantar)->isoFormat('D MMMM Y') }}</td>
                        <td>{{ $orderList->harga * $orderList->berat }}</td>
                    </tr>
                    @php
                        $totalHarga += ($orderList->harga * $orderList->berat); // Menambahkan harga setiap elemen ke total
                    @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="text-end">
                        <th></th>
                        <th></th>
                        <th>Total Harga</th>
                        <th>{{ $totalHarga }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    @else
    <h3>No Transaction No Found</h3>
    @endif
</section>
@endsection
