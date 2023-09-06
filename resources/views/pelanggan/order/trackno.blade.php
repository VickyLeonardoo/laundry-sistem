@extends('partials.pelanggan.header')
@section('title','')

@section('content')
<section class="row">
    <div class="card">
        <div class="card-header ">
            <div class="row">
                <div class="col-12 col-xl-9">
                    <h4>{{ $order->transactionNo }}</h4>
                </div>
                <div class="col-12 col-xl-3 text-end">
                    <a href="{{ route('pelanggan.order.show') }}" class="btn btn-primary "><i class="fas fa-left-arrow"></i>Back</a>
                </div>
            </div>
        </div>
    </div>
    @if ($order)
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            @if ($order->statusPembayaran == 'Terbayar' && $order->statusOrder == 'Diproses')
                <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>
                    Terima Kasih. Kamu Telah Melakukan Pembayaran, Silahkan Tunggu Hingga Orderan Kamu Selesai Diproses.
                </div>
            @elseif ($order->statusPembayaran == 'Terbayar' && $order->statusOrder == 'Selesai')
                <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>
                    Orderan Kamu Telah Selesai, Silahkan ke Outlet untuk mengambil Orderan Kamu. Poin akan ditambahkan ketika kamu telah mengambil Orderan.
                </div>
            @elseif ($order->statusPembayaran == 'Menunggu Pembayaran' && $order->modePembayaran == 'Cash On Deal' && $order->statusOrder == 'Selesai')
                <div class="alert alert-light-warning color-warning"><i class="bi bi-exclamation-circle"></i>
                    Orderan Kamu Telah Selesai, kamu Memilih Metode Pembayaran Cash On Deal, Silahkan Membayar Di Kasir dan Ambil Orderan Anda.
                </div>

            @endif
            <form action="{{ route('pelanggan.order.metode',$order->id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-xl-6">
                        <div class="form-group">
                            <label>Nama:</label>
                            <input type="text" disabled class="form-control" readonly value="{{ auth()->user()->name }}">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Order:</label>
                            <input type="text" readonly disabled class="form-control" value="{{ \Carbon\Carbon::parse($order->tglOrder)->isoFormat('D MMMM Y') }}">
                        </div>
                        <div class="form-group">
                            <label>Status Order:</label>
                            <input type="text" readonly disabled class="form-control" value="{{ $order->statusOrder }}">
                        </div>
                    </div>
                    <div class="col-12 col-xl-6">
                        @if ($order->modePembayaran != NULL)
                            <div class="form-group">
                                <label>Metode Pembayaran:</label>
                                <input type="text" value="{{ $order->modePembayaran }}" class="form-control" readonly disabled>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Metode Pembayaran:</label>
                                <select name="modePembayaran" class="form-control">
                                    <option value="" @readonly(true) disabled selected>Pilih Metode Pembayaran</option>
                                    <option value="Cash On Deal" {{ $order->modePembayaran == 'Cash On Deal'? 'selected':''}}>Cash On Deal</option>
                                    <option value="Online" {{ $order->modePembayaran == 'Online'? 'selected':''}} >Online</option>
                                </select>
                            </div>
                        @endif
                        <div class="form-group">
                            @if ($order->statusOrder == 'Menunggu Verifikasi')
                            <label>Status Pembayaran:</label>
                                <input type="text" class="form-control" readonly disabled value="--">
                            @elseif ($order->statusOrder == 'Diproses')
                                <label>Status Pembayaran:</label>
                                <input type="text" class="form-control" readonly disabled value="{{ $order->statusPembayaran }}">
                            @endif
                        </div>
                        @if ($totalHarga != 0)
                            <div class="form-group">
                                <label for="">Total Pembayaran</label>
                                <input type="text" class="form-control" readonly disabled value="@currency($totalHarga)">
                            </div>
                        @endif
                        @if ($order->statusOrder == 'Diproses' && $order->modePembayaran != 'Online')
                            <button type="submit" class="btn btn-primary form-control">Pilih Metode</button>
                        @elseif ($order->statusOrder == 'Selesai' && $order->modePembayaran != 'Online' && $order->modePembayaran != 'Cash On Deal')
                            <button type="submit" class="btn btn-primary form-control">Pilih Metode</button>
                        @endif
                    </div>
                </div>
            </form>
            @if ($order->statusOrder == 'Diproses' && $order->modePembayaran == 'Online' && $order->statusPembayaran == 'Menunggu Pembayaran')
                <div class="row">
                    <div class="col-12 col-xl-6">
                    </div>
                    <div class="col-12 col-xl-6">
                        <button id="pay-button" class="btn btn-primary form-control">Proses Pembayaran!</button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if (!$orderItem)
        <div class="alert alert-light-warning color-warning"><i class="bi bi-check-circle"></i>
            Berhasil Membuat Orderan, Silahkan Berikan Barang kamu ke petugas Laundry untuk Dilakukan
            Penambahan Item Orderan.
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3>Daftar Item</h3>
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
                        <td>{{ $orderList->harga }}</td>
                    </tr>
                    @php
                        $totalHarga += $orderList->harga;
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

    @else
    <h3>No Transaction No Found</h3>
    @endif
</section>
@endsection
@section('script')
@if ( $snapToken )
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay('{{$snapToken}}', {
        onSuccess: function(result){
          /* You may add your own implementation here */
          alert("payment success!"); console.log(result);
        },
        onPending: function(result){
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
        },
        onError: function(result){
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
        },
        onClose: function(){
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      })
    });
</script>
@endif
@endsection
