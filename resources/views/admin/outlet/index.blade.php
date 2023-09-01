@extends('partials.admin.header')

@section('title','Outlet List')

@section('content')
@if (session('success'))
<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>
    Data Outlet Dihapus
</div>
@endif
<div class="card">
    <div class="card-header text-end">
        <a href="{{ route('admin.outlet.create') }}" class="btn btn-primary">Tambah</a>
    </div>
    <div class="card-body">
        <table class="table" id="table1">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($outlets as $outlet)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $outlet->alamat }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $outlet->foto) }}" width="50">
                    </td>
                    <td>
                        <a href="{{ route('admin.outlet.edit',$outlet->id) }}" class="btn btn-info btn-sm">Edit</a>
                        <a href="{{ route('admin.outlet.destroy',$outlet->id) }}" onclick="return confirm('Ingin Hapus Data?')" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
