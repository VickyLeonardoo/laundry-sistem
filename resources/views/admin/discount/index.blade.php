@extends('partials.admin.header')

@section('title','Discount List')

@section('content')
@if (session('success'))
<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>
    Data Discount Dihapus
</div>
@endif
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
                        <th>Tipe</th>
                        <th>Nominal</th>
                        <th>Persyaratan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($discounts as $discount)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $discount->nama }}</td>
                        <td>{{ $discount->tipeDiscount }}</td>
                        <td>{{ $discount->nominal }}</td>
                        <td>{{ $discount->persyaratan }}</td>
                        <td>
                            @if ($discount->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.discount.edit',$discount->id) }}" class="btn btn-info btn-sm">Edit</a>
                            <a href="{{ route('admin.discount.destroy',$discount->id) }}" onclick="return confirm('Ingin Hapus Data?')" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
