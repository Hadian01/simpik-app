@extends('layouts.auth')

@section('title', 'Lupa Password')

@section('content')
<div class="container-fluid min-vh-100">

    <div class="row min-vh-100">

        <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
            <img src="{{ asset('images/logo.jpg') }}" alt="SIMPIK Logo" style="width: 250px; height: 250px; object-fit: cover; border-radius: 50%;">
        </div>

        {{-- KANAN : FORM FORGOT PASSWORD --}}
        <div class="col-md-6 d-flex align-items-center justify-content-center"
            style="background:#B9B4FF;">

            <div class="bg-white p-4"
                 style="width:360px; border-radius:12px;">

                <h4 class="text-center mb-2"><strong>Lupa Password</strong></h4>
                <p class="text-center text-muted small mb-4">
                    Masukkan email Anda dan kami akan mengirimkan link untuk reset password
                </p>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session('status'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{ session('status') }}
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

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" 
                               name="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}"
                               placeholder="nama@email.com"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('login') }}" class="btn btn-sm" style="background:transparent;color:#9B8CFF;border:1px solid #9B8CFF;">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit"
                                class="btn btn-sm px-4"
                                style="background:#9B8CFF;color:white;">
                            Kirim Link Reset
                        </button>
                    </div>
                </form>

            </div>

        </div>

    </div>

</div>
@endsection
