@extends('layouts.app', ['userType' => 'penitip'])

@section('title', 'Data Diri Penitip')

@section('content')
<div class="container-fluid">

    <h2 class="mb-4">Data Diri Penitip</h2>

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

    <form method="POST" action="{{ route('penitip.update_data_diri') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- =========================
            FOTO PROFIL
        ========================== --}}
        <div class="card mb-4" style="border-radius:12px;">
            <div class="card-body">
                <h5 class="mb-3">Foto Profil</h5>

                @if($penitip->foto_profile && $penitip->foto_profile !== 'default.jpg')
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $penitip->foto_profile) }}" 
                             alt="Profile Photo" 
                             class="rounded-circle border"
                             style="width: 100px; height: 100px; object-fit: cover;">
                        <p class="text-muted mt-2 mb-0"><small>Foto profil saat ini</small></p>
                    </div>
                @endif

                <input type="file" class="form-control" name="foto_profile" accept="image/*">
                <small class="text-muted">
                    Format JPG / PNG, maksimal 2MB. Kosongkan jika tidak ingin mengubah.
                </small>
            </div>
        </div>

        {{-- =========================
            INFORMASI PRIBADI
        ========================== --}}
        <div class="row">

            <div class="col-md-6 mb-4">
                <div class="card h-100" style="border-radius:12px;">
                    <div class="card-body">
                        <h5 class="mb-3">Informasi Pribadi</h5>

                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $penitip->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="{{ Auth::guard('usermanual')->user()->email }}" disabled>
                            <small class="text-muted">Email tidak dapat diubah</small>
                        </div>

                        <div class="form-group">
                            <label>No. HP</label>
                            <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp', $penitip->no_hp) }}" required>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ALAMAT --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100" style="border-radius:12px;">
                    <div class="card-body">
                        <h5 class="mb-3">Alamat</h5>

                        <div class="form-group">
                            <label>Alamat Lengkap</label>
                            <textarea class="form-control" name="alamat" rows="5" required>{{ old('alamat', $penitip->alamat) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- =========================
            INFORMASI BANK
        ========================== --}}
        <div class="row">
            
            <div class="col-12 mb-4">
                <div class="card" style="border-radius:12px;">
                    <div class="card-body">
                        <h5 class="mb-3">Informasi Bank</h5>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Bank</label>
                                    <input type="text" class="form-control" name="nama_bank" value="{{ old('nama_bank', $penitip->nama_bank) }}" placeholder="Contoh: BCA, Mandiri, BNI">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nomor Rekening</label>
                                    <input type="text" class="form-control" name="no_rekening" value="{{ old('no_rekening', $penitip->no_rekening) }}" placeholder="Contoh: 1234567890">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Atas Nama</label>
                                    <input type="text" class="form-control" name="atas_nama" value="{{ old('atas_nama', $penitip->atas_nama) }}" placeholder="Nama sesuai rekening">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        {{-- =========================
            ACTION
        ========================== --}}
        <div class="text-right">
            <button type="submit"
                    class="btn btn-purple px-5">
                Simpan Perubahan
            </button>
        </div>

    </form>

</div>
@endsection