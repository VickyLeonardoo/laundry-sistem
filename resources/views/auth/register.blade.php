
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/main/app.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/pages/auth.css">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <div id="auth">
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <a href="{{ url('register') }}"><img src="{{ asset('assets') }}/images/logo/logo.svg" alt="Logo"></a>
            </div>
            <h1 class="auth-title">Sign Up</h1>
            <p class="auth-subtitle mb-5">Input your data to register to our website.</p>

            <form action="{{ route('simpan.pendaftaran') }}" method="POST">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" placeholder="Nama">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                    @error('name')
                        <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl {{ $errors->has('email') ? 'is-invalid':'' }}" value="{{ old('email') }}" name="email" placeholder="Email" value="{{ old('email') }}">
                    <div class="form-control-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    @error('email')
                        <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="number" class="form-control form-control-xl {{ $errors->has('noHp') ? 'is-invalid':'' }}" value="{{ old('noHp') }}" name="noHp" placeholder="Nomor HP" value="{{ old('noHp') }}">
                    <div class="form-control-icon">
                        <i class="bi bi-telephone"></i>
                    </div>
                    @error('noHp')
                        <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl {{ $errors->has('password') ? 'is-invalid':'' }}" value="{{ old('password') }}" name="password" placeholder="Password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    @error('password')
                        <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl {{ $errors->has('password_confirmation') ? 'is-invalid':'' }}" value="{{ old('password_confirmation') }}" name="password_confirmation" placeholder="Confirm Password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    @error('password_confirmation')
                        <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class='text-gray-600'>Already have an account? <a href="{{ url('login') }}" class="font-bold">Log
                        in</a>.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
</div>

    </div>
</body>

</html>
