@extends('partials.admin.header')
@section('title', 'Edit Orderan')
@section('content')
    @if (session('success'))
        <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>
            Orderan Berhasil Diselesaikan.
        </div>
    @endif
    @if ($order)
        <section class="row">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-lg-9">
                            <h4>{{ $order->transactionNo }}</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            @csrf
                            <div class="col-12 col-xl-6">
                                <div class="form-group">
                                    <label>Nama:</label>
                                    <input type="text" class="form-control" disabled readonly
                                        value="{{ $order->user->name }}">
                                </div>
                                <div class="form-group">
                                    <label>Metode Pembayaran:</label>
                                    <input type="text" class="form-control" disabled readonly
                                        value="{{ $order->modePembayaran }}">
                                </div>
                                @if ($order->statusOrder == 'Diproses')
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-success"
                                            formaction="{{ route('admin.order.diproses.selesai.order', $order->id) }}">Proses
                                            Selesai</button>
                                    </div>
                                @endif

                            </div>
                            <div class="col-12 col-xl-6">
                                <div class="form-group">
                                    <label>Tanggal Order:</label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ \Carbon\Carbon::parse($order->tglOrder)->isoFormat('D MMMM Y') }}">
                                    {{-- <input type="text" class="form-control" disabled value="{{ $order->tglOrder }}"> --}}
                                </div>
                                <div class="form-group">
                                    <label>Status Pembayaran:</label>
                                    <input type="text" class="form-control" disabled readonly
                                        value="{{ $order->statusPembayaran }}">
                                </div>
                                @if ($order->statusPembayaran != 'Terbayar')
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-primary" formaction="{{ route('admin.order.diproses.selesai.pembayaran',$order->id) }}">Pembayaran Selesai</button>
                                    </div>
                                @endif

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
                                    <th>{{ $totalHarga }}</th>
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
                                    <th>{{ $totalHarga }}</th>
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
                                    <th>{{ $totalHarga }}</th>
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
