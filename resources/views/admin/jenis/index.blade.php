@extends('partials.admin.header')

@section('title','Jenis Barang List')

@section('content')
@if (session('success'))
<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>
    Data Jenis Barang Dihapus
</div>
@endif
<div class="card">
    <div class="card-header text-end">
        <a href="{{ route('admin.jenis.create') }}" class="btn btn-primary">Tambah</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jenisbarang as $jenis)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jenis->nama }}</td>
                            <td>{{ $jenis->satuan }}</td>
                            <td>{{ $jenis->harga }}</td>
                            <td>
                                <a href="{{ route('admin.jenis.edit',$jenis->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <a href="{{ route('admin.jenis.destroy',$jenis->id) }}" onclick="return confirm('Ingin Hapus Data?')" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
