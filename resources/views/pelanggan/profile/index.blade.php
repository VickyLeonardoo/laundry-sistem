@extends('partials.pelanggan.header')

@section('title', 'Profile')

@section('content')
<section class="row">
    @if (session('error'))
        <div class="alert alert-light-danger color-danger"><i class="bi bi-check-circle"></i>
            Ganti Password Gagal, Password Lama kamu tidak Sesuai. Periksa Password Lama Kamu.
        </div>
    @elseif (session('sukses'))
        <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>
            {{ session('sukses') }}
        </div>
    @endif
    <div class="col-lg-8">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3>Informasi Pribadi</h3>
                    <hr>
                </div>
                <div class="card-body">
                   <form action="{{ route('pelanggan.profile.update') }}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="">Nama:</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}" value="{{ auth()->user()->name }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email:</label>
                            <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}" value="{{ auth()->user()->email }}">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">No Hp:</label>
                            <input type="text" name="noHp" class="form-control {{ $errors->has('noHp') ? 'is-invalid':'' }}" value="{{ auth()->user()->noHp }}">
                            @error('noHp')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Update Profile">
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
    <div class=" col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Password</h3>
                <hr>
            </div>
            <div class="card-body">
                <form action="{{ route('pelanggan.profile.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Old Password</label>
                        <input type="password" name="oldPassword" class="form-control {{ $errors->has('oldPassword') ? 'is-invalid':'' }}">
                        @error('oldPassword')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">New Password</label>
                        <input type="password" name="newPassword" class="form-control {{ $errors->has('newPassword') ? 'is-invalid':'' }}">
                        @error('newPassword')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Confirm New Password</label>
                        <input type="password" name="confirmNewPassword" class="form-control" {{ $errors->has('is-invalid') ? '':'' }}>
                        @error('confirmNewPassword')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Change Password">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
