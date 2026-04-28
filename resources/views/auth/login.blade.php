@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="container-fluid min-vh-100">

<div class="row min-vh-100">

        <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
            <img src="{{ asset('images/logo simpik.png') }}" alt="SIMPIK Logo" style="width: 250px; height: 250px; object-fit: cover; border-radius: 50%;">
        </div>

        {{-- KANAN : FORM LOGIN --}}
        <div class="col-md-6 d-flex align-items-center justify-content-center"
            style="background:#B9B4FF;">

            <div class="bg-white p-4"
                 style="width:360px; border-radius:12px;">

                <h4 class="text-center mb-4"><strong>LOGIN</strong></h4>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Password <span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <input type="password"
                                   id="loginPassword"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   required>
                            <span class="position-absolute" style="right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer;" onclick="togglePassword('loginPassword', this)">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="text-right mt-2">
                            <small><a href="{{ route('password.request') }}" style="color:#9B8CFF;">Lupa Password?</a></small>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit"
                                class="btn btn-sm"
                                style="background:#9B8CFF;color:white;">
                            Login
                        </button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <small>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></small>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
function togglePassword(fieldId, iconElement) {
    const passwordField = document.getElementById(fieldId);
    const icon = iconElement.querySelector('i');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        passwordField.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}
</script>
@endpush
