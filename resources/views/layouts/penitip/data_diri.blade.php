@extends('layouts.app', ['userType' => 'penitip'])

@section('title', 'Data Diri Penitip')

@section('content')
<div class="container-fluid">

    <h2 class="mb-4">Data Diri Penitip</h2>

    <form method="POST" action="#" enctype="multipart/form-data">
        @csrf

        {{-- =========================
            FOTO PROFIL (OPSIONAL)
        ========================== --}}
        <div class="card mb-4" style="border-radius:12px;">
            <div class="card-body">
                <h5 class="mb-3">Foto Profil</h5>

                <input type="file" class="form-control" name="foto_profil">
                <small class="text-muted">
                    Format JPG / PNG, maksimal 2MB
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
                            <input type="text" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>No. HP</label>
                            <input type="text" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option>Laki-laki</option>
                                <option>Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>

            {{-- IDENTITAS --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100" style="border-radius:12px;">
                    <div class="card-body">
                        <h5 class="mb-3">Identitas</h5>

                        <div class="form-group">
                            <label>NIK / No KTP</label>
                            <input type="text" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Upload KTP</label>
                            <input type="file" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- =========================
            INFORMASI BANK (OPSIONAL)
        ========================== --}}
        <div class="card mb-4" style="border-radius:12px;">
            <div class="card-body">
                <h5 class="mb-3">Informasi Bank (Opsional)</h5>

                <div class="row">
                    <div class="col-md-4">
                        <label>Nama Bank</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>No. Rekening</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Nama Pemilik Rekening</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        {{-- =========================
            ACTION
        ========================== --}}
        <div class="text-right">
            <button type="submit"
                    class="btn px-5"
                    style="background:#9B8CFF;color:white;">
                Simpan Data Diri
            </button>
        </div>

    </form>

</div>
@endsection