@extends('layouts.app', ['userType' => 'penitip'])

@section('title', 'Ubah Password')

@section('content')
<div class="container-fluid">

    <h2 class="mb-4">Ubah Password</h2>

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
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card" style="border-radius:12px;">
                <div class="card-body p-4">
                    <h5 class="mb-4">Ganti Password</h5>

                    <form method="POST" action="{{ route('penitip.update_password') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="current_password">Password Saat Ini <span class="text-danger">*</span></label>
                            <input type="password" 
                                   class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" 
                                   name="current_password" 
                                   required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="new_password">Password Baru <span class="text-danger">*</span></label>
                            <input type="password" 
                                   class="form-control @error('new_password') is-invalid @enderror" 
                                   id="new_password" 
                                   name="new_password" 
                                   required>
                            <small class="text-muted">Minimal 4 karakter</small>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="new_password_confirmation">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                            <input type="password" 
                                   class="form-control" 
                                   id="new_password_confirmation" 
                                   name="new_password_confirmation" 
                                   required>
                            <small id="confirmPasswordHelpBlock" class="form-text text-muted d-none">
                                Password tidak cocok
                            </small>
                        </div>

                        <div class="text-right mt-4">
                            <a href="{{ route('penitip.daftar_toko') }}" class="btn btn-sm px-4" style="background:transparent;color:#9B8CFF;border:1px solid #9B8CFF;">Batal</a>
                            <button type="submit" class="btn btn-sm px-4" style="background:#9B8CFF;color:white;">
                                Ubah Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
// Password confirmation validation
document.getElementById('new_password_confirmation').addEventListener('input', function() {
    const password = document.getElementById('new_password').value;
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
document.getElementById('new_password').addEventListener('input', function() {
    const confirmation = document.getElementById('new_password_confirmation');
    if (confirmation.value) {
        confirmation.dispatchEvent(new Event('input'));
    }
});
</script>
@endpush
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
