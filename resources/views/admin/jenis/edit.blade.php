@extends('partials.admin.header')
@section('title','Update Discounts')

@section('content')
@if (session('success'))
<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>
    Data Jenis Barang Berhasil Diupdate
</div>
@endif
<div class="card">
    <div class="card-header text-end">
        <a href="{{ route('admin.jenis.show') }}" class="btn btn-primary">Back</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.jenis.update',$jenisbarang->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Discount:</label>
                <input type="text" class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}" name="nama" value="{{ $jenisbarang->nama }}">
                @error('nama')
                    <h6 class="text-danger">{{ $message }}</h6>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Satuan:</label>
                        <select name="satuan" class="form-control">
                            <option value="KG" {{ $jenisbarang->satuan == 'KG' ? 'selected': '' }}>KG</option>
                            <option value="Item" {{ $jenisbarang->satuan == 'Item' ? 'selected': '' }}>Item</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label>Harga:</label>
                        <input type="text" class="form-control {{ $errors->has('harga') ? 'is-invalid':'' }}" name="harga" value="{{ $jenisbarang->harga }}">
                        @error('harga')
                            <h6 class="text-danger">{{ $message }}</h6>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
