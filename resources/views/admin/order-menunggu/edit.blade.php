@extends('partials.admin.header')
@section('title', 'Edit Orderan')
@section('content')
    @if ($order)
        <section class="row">
            @if (session('error'))
            <div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i>
                {{ session('error') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-lg-9">
                            <h4>{{ $order->transactionNo }}</h4>
                            @if ($order->is_discount == 'yes')
                                <small class="badge bg-info">{{ $order->discount->nama }}</small>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.order.menunggu.transaction.proses', ['transactionNo' => $transactionNo, 'hargaTotal' => $hargaTotal]) }}" method="POST">
                        <div class="row">
                            @csrf
                            <div class="col-12 col-xl-6">
                                <div class="form-group">
                                    <label>Nama:</label>
                                    <input type="text" class="form-control" readonly value="{{ $order->user->name }}">
                                </div>
                                <div class="form-group">
                                    <label>Metode Pembayaran:</label>
                                    <select name="statusOrder" class="form-control">
                                        <option value="" @readonly(true) disabled selected>Pilih Metode Pembayaran
                                        </option>
                                        <option value="Cash On Deal">Cash On Deal</option>
                                        <option value="Online">Online</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-xl-6">
                                <div class="form-group">
                                    <label>Tanggal Order:</label>
                                    <input type="text" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($order->tglOrder)->isoFormat('D MMMM Y') }}">
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
                                <div class="form-group">
                                    <input type="submit" value="Proses" class="btn btn-primary form-control">
                                </div>
                            </div>
                    </form>

                </div>
            </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-lg-9">
                            <h4>Daftar Item</h4>
                        </div>
                        <div class="col-12 col-lg-3 text-end">
                            <a href="{{ route('admin.order.menunggu.transaction.create', $order->transactionNo) }}"
                                class="btn btn-primary">Tambah Data Orderan</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Jenis Barang</th>
                                <th>Jumlah</th>
                                <th>Tanggal Diantar</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalHarga = 0;
                                $totalBerat = 0;
                                $totalItem = 0;
                                $totalPoin = 0;
                                $pointKg = 0;
                                $pointItem = 0;
                                $pointOrder = 0;
                            @endphp
                            @foreach ($order->orderitem as $orderList)
                                <tr>
                                    <td>{{ $orderList->jenis->nama }}</td>
                                    <td>
                                        @if ($orderList->jenis->satuan == 'KG')
                                            {{ $orderList->jumlah }} KG
                                        @else
                                            {{ $orderList->jumlah }} Item
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($orderList->tglDiantar)->isoFormat('D MMMM Y') }}</td>
                                    <td>{{ $orderList->jenis->harga * $orderList->jumlah }}</td>
                                </tr>
                                @php
                                    $totalHarga += $orderList->jenis->harga * $orderList->jumlah;
                                    if ($orderList->jenis->satuan == 'KG') {
                                        $totalBerat += $orderList->jumlah;
                                    } else {
                                        $totalItem += $orderList->jumlah;
                                    }
                                    $pointKg = floor($totalBerat / 5) * 2;
                                    $pointItem = $totalItem * 3;
                                    $pointOrder = $pointKg + $pointItem;
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            @if ($totalItem == '0' && $totalBerat == '0')
                            @elseif($totalItem == '0' && $totalBerat != '0')
                                <tr class="text-end">
                                    <th></th>
                                    <th></th>
                                    <th>Total Berat</th>
                                    <th>{{ $totalBerat }}</th>
                                </tr>
                                <tr class="text-end">
                                    <th></th>
                                    <th></th>
                                    <th>Total Poin</th>
                                    <th>{{ $pointOrder }}</th>
                                </tr>
                                <tr class="text-end">
                                    <th></th>
                                    <th></th>
                                    <th>Total Harga</th>
                                    <th>{{ $hargaTotal }}</th>
                                </tr>
                            @elseif($totalItem != 0 && $totalBerat == 0)
                                <tr class="text-end">
                                    <th></th>
                                    <th></th>
                                    <th>Total Item</th>
                                    <th>{{ $totalItem }}</th>
                                </tr>
                                <tr class="text-end">
                                    <th></th>
                                    <th></th>
                                    <th>Total Poin</th>
                                    <th>{{ $pointOrder }}</th>
                                </tr>
                                <tr class="text-end">
                                    <th></th>
                                    <th></th>
                                    <th>Total Harga</th>
                                    <th>{{ $hargaTotal }}</th>
                                </tr>
                            @else
                                <tr class="text-end">
                                    <th></th>
                                    <th></th>
                                    <th>Total Berat</th>
                                    <th>{{ $totalBerat }}</th>
                                </tr>
                                <tr class="text-end">
                                    <th></th>
                                    <th></th>
                                    <th>Total Item</th>
                                    <th>{{ $totalItem }}</th>
                                </tr>
                                <tr class="text-end">
                                    <th></th>
                                    <th></th>
                                    <th>Total Poin</th>
                                    <th>{{ $pointOrder }}</th>
                                </tr>
                                <tr class="text-end">
                                    <th></th>
                                    <th></th>
                                    <th>Total Harga</th>
                                    <th>{{ $hargaTotal }}</th>
                                </tr>
                            @endif

                        </tfoot>
                    </table>
                </div>
            </div>
        </section>
    @else
        <h2>NO Order Found</h2>
    @endif

@endsection
