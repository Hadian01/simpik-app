@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="container-fluid min-vh-100">
    <div class="row min-vh-100 no-gutters">

        {{-- KIRI : LOGO --}}
        <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
            <div class="rounded-circle border d-flex align-items-center justify-content-center"
                 style="width:220px;height:220px;">
                <h3 class="m-0">LOGO</h3>
            </div>
        </div>

        {{-- KANAN : FORM REGISTER --}}
        <div class="col-md-6 d-flex align-items-center justify-content-center"
             style="background:#B9B4FF;">

            <div class="bg-white p-4"
                 style="width:360px; border-radius:12px;">

                <h4 class="text-center mb-4"><strong>Register</strong></h4>

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

                <form method="POST" action="{{ route('register.post') }}">
                    @csrf

                    <div class="form-group">
                        <label>Tipe Akun <span class="text-danger">*</span></label>
                        <select name="user_type" class="form-control @error('user_type') is-invalid @enderror" required>
                            <option value="">Pilih Tipe</option>
                            <option value="penjual" {{ old('user_type') == 'penjual' ? 'selected' : '' }}>Penjual</option>
                            <option value="penitip" {{ old('user_type') == 'penitip' ? 'selected' : '' }}>Penitip</option>
                        </select>
                        @error('user_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Email"
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Password <span class="text-danger">*</span></label>
                        <input type="password"
                               id="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Minimal 4 karakter"
                               required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password"
                               id="password_confirmation"
                               name="password_confirmation"
                               class="form-control"
                               placeholder="Password Confirmation"
                               required>
                        <small id="confirmPasswordHelpBlock" class="form-text text-muted d-none">
                            Password tidak cocok
                        </small>
                    </div>

                    <div class="text-right">
                        <button type="submit"
                                class="btn btn-sm"
                                style="background:#9B8CFF;color:white;">
                            Register
                        </button>
                    </div>

                </form>

                <div class="text-center mt-3">
                    <small>Sudah punya akun? <a href="{{ route('login') }}">Login</a></small>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
// Password confirmation validation
document.getElementById('password_confirmation').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmation = this.value;
    const helpBlock = document.getElementById('confirmPasswordHelpBlock');
    
    if (confirmation && password !== confirmation) {
        this.classList.add('is-invalid');
        helpBlock.classList.remove('d-none');
        helpBlock.classList.add('text-danger');
    } else {
        this.classList.remove('is-invalid');
        helpBlock.classList.add('d-none');
    }
});

// Also check when password field changes
document.getElementById('password').addEventListener('input', function() {
    const confirmation = document.getElementById('password_confirmation');
    if (confirmation.value) {
        confirmation.dispatchEvent(new Event('input'));
    }
});
</script>
@endpush
