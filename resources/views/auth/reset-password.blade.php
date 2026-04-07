@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
<div class="container-fluid min-vh-100">

    <div class="row min-vh-100">

        <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
            LOGO
        </div>

        {{-- KANAN : FORM RESET PASSWORD --}}
        <div class="col-md-6 d-flex align-items-center justify-content-center"
            style="background:#B9B4FF;">

            <div class="bg-white p-4"
                 style="width:360px; border-radius:12px;">

                <h4 class="text-center mb-2"><strong>Reset Password</strong></h4>
                <p class="text-center text-muted small mb-4">
                    Masukkan password baru Anda
                </p>

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

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    
                    <input type="hidden" name="token" value="{{ $token }}">
                    
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" 
                               name="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               value="{{ $email ?? old('email') }}"
                               required
                               readonly>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Password Baru <span class="text-danger">*</span></label>
                        <input type="password" 
                               name="password" 
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               required>
                        <small class="text-muted">Minimal 4 karakter</small>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" 
                               name="password_confirmation" 
                               class="form-control"
                               id="password_confirmation"
                               required>
                        <small id="confirmPasswordHelp" class="form-text text-muted d-none">
                            Password tidak cocok
                        </small>
                    </div>

                    <div class="text-right mt-4">
                        <button type="submit"
                                class="btn btn-sm px-4"
                                style="background:#9B8CFF;color:white;">
                            Reset Password
                        </button>
                    </div>
                </form>

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
    const helpBlock = document.getElementById('confirmPasswordHelp');
    
    if (confirmation && password !== confirmation) {
        this.classList.add('is-invalid');
        helpBlock.classList.remove('d-none');
        helpBlock.classList.add('text-danger');
    } else {
        this.classList.remove('is-invalid');
        helpBlock.classList.add('d-none');
    }
});

document.getElementById('password').addEventListener('input', function() {
    const confirmation = document.getElementById('password_confirmation');
    if (confirmation.value) {
        confirmation.dispatchEvent(new Event('input'));
    }
});
</script>
@endpush
