@extends('partials.pelanggan.header')
@section('title','Order List')

@section('content')
<section class="row">
    <div class="col-12 col-lg-12">
        <div class="row">
            <div class="card">
                <div class="card-header text-end">
                    <a href="{{ route('pelanggan.order.create') }}" class="btn btn-primary ">Create</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tracking No</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $order->transactionNo }}</td>
                                        <td>
                                            @if ($order->statusOrder == 'Menunggu Verifikasi')
                                                <span class="badge bg-light-warning">Menunggu Verifikasi</span>
                                            @elseif ($order->statusOrder == 'Diproses')
                                                <span class="badge bg-light-info">Diproses</span>
                                            @else
                                                <span class="badge bg-light-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('pelanggan.order.trackno',$order->transactionNo) }}" class="btn btn-primary btm-sm">Cek</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
