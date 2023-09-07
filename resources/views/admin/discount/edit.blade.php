@extends('partials.admin.header')
@section('title','Update Discounts')

@section('content')
@if (session('success'))
<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>
    Data Discount Berhasil Diupdate
</div>
@endif
<div class="card">
    <div class="card-header text-end">
        <a href="{{ route('admin.discount.show') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.discount.update',$discount->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Discount:</label>
                <input type="text" class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}" name="nama" value="{{ $discount->nama }}">
                @error('nama')
                    <h6 class="text-danger">{{ $message }}</h6>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Deskripsi</label>
                <textarea name="deskripsi" class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}" rows="3">{{ $discount->deskripsi }}</textarea>
                @error('deskripsi')
                    <h6 class="text-danger">{{ $message }}</h6>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tipe:</label>
                        <select name="tipeDiscount" class="form-control">
                            <option value="" disabled>--Pilih Tipe--</option>
                            <option value="percent" {{ $discount->tipeDiscount == 'percent' ? 'selected':'' }}>Persen (%)</option>
                            <option value="harga" {{ $discount->tipeDiscount == 'harga' ? 'selected':'' }}>Harga (Rp.)</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label>Nominal Discount:</label>
                        <input type="text" class="form-control {{ $errors->has('nominal') ? 'is-invalid':'' }}" name="nominal" value="{{ $discount->nominal }}">
                        @error('nominal')
                            <h6 class="text-danger">{{ $message }}</h6>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Persyaratan Riwayat Order:</label>
                <input type="text" class="form-control {{ $errors->has('persyaratan') ? 'is-invalid':'' }}" name="persyaratan" value="{{ $discount->persyaratan }}">
                @error('persyaratan')
                    <h6 class="text-danger">{{ $message }}</h6>
                @enderror
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="active" {{ $discount->status == 'active' ? 'selected':'' }} >Active</option>
                    <option value="inactive" {{ $discount->status == 'inactive' ? 'selected':'' }}>Inactive</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
