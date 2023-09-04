@extends('partials.admin.header')

@section('title','Orderan Menunggu Verifikasi')

@section('content')
<div class="card">
    <div class="card-header text-end">
        <a href="{{ route('admin.discount.create') }}" class="btn btn-primary">Tambah</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>Nomor HP</th>
                        <th>Tracking No</th>
                        <th>Tanggal Order</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->user->noHp }}</td>
                        <td>{{ $order->trackingNo }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->tglOrder)->isoFormat('D MMMM Y, H:m') }}</td>
                        <td>
                            <a href="" class="btn btn-primary">Periksa</a>
                            <a href="" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
