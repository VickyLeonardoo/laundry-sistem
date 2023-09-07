@extends('partials.admin.header')
@section('title','Create Discount')

@section('content')
@if (session('success'))
<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>
    Data Discount Berhasil Ditambahkan
</div>
@endif
<div class="card">

    <div class="card-header text-end">

        <a href="{{ route('admin.discount.show') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>Back</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.discount.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Nama Discount:</label>
                <input type="text" class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}" name="nama" value="{{ old('nama') }}">
                @error('nama')
                    <h6 class="text-danger">{{ $message }}</h6>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <h6 class="text-danger">{{ $message }}</h6>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tipe:</label>
                        <select name="tipeDiscount" class="form-control {{ $errors->has('tipeDiscount') ? 'is-invalid':'' }}">
                            <option value="" selected disabled>Pilih Tipe</option>
                            <option value="percent">Persen (%)</option>
                            <option value="harga">Harga (Rp.)</option>
                        </select>
                        @error('tipeDiscount')
                            <h6 class="text-danger">{{ $message }}</h6>
                        @enderror
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label>Nominal Discount:</label>
                        <input type="text" class="form-control {{ $errors->has('nominal') ? 'is-invalid':'' }}" name="nominal" value="{{ old('nominal') }}">
                        @error('nominal')
                            <h6 class="text-danger">{{ $message }}</h6>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Persyaratan Riwayat Order:</label>
                <input type="text" class="form-control {{ $errors->has('persyaratan') ? 'is-invalid':'' }}" name="persyaratan" value="{{ old('persyaratan') }}">
                @error('persyaratan')
                    <h6 class="text-danger">{{ $message }}</h6>
                @enderror
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control {{ $errors->has('status') ? 'is-invalid':'' }}">
                    <option value="" selected disabled>Pilih Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                @error('status')
                    <h6 class="text-danger">{{ $message }}</h6>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
