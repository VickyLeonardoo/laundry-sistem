@extends('partials.admin.header')
@section('title','Create Outle')

@section('content')
@if (session('success'))
<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>
    Data Outlet Berhasil Ditambahkan
</div>
@endif
<div class="card">

    <div class="card-header text-end">

        <a href="{{ route('admin.outlet.show') }}" class="btn btn-primary"><i class="fas fa-left-arrow"></i>Back</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.outlet.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Alamat*</label>
                <input type="text"
                    class="form-control {{ $errors->has('alamat') ? 'is-invalid':'' }}"
                    value="{{ old('alamat') }}" name="alamat" id="basicInput"
                    placeholder="Masukkan Alamat">
                @error('alamat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Foto</label>
                <input type="file"
                    class="form-control {{ $errors->has('foto') ? 'is-invalid':'' }}"
                    name="foto" id="basicInput">
                @error('foto')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
