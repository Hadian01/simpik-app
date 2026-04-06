@extends('layouts.app', ['userType' => 'penjual'])

@section('title', 'Lengkapi Data Toko')

@section('content')
<div class="container-fluid">

    <h2 class="mb-4">Lengkapi Data Toko</h2>

    @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('info') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

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

    <form method="POST" action="{{ route('penjual.store_toko') }}" enctype="multipart/form-data">
        @csrf

        {{-- =========================
            BANNER TOKO
        ========================== --}}
        <div class="card mb-4" style="border-radius:12px;">
            <div class="card-body">
                <h5 class="mb-3">Banner Toko</h5>

                <div class="mb-3">
                    <input type="file" class="form-control" name="banner">
                    <small class="text-muted">
                        Rekomendasi ukuran: 1200 x 400 px
                    </small>
                </div>
            </div>
        </div>

        {{-- =========================
            INFORMASI TOKO
        ========================== --}}
        <div class="row">

            {{-- DETAIL TOKO --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100" style="border-radius:12px;">
                    <div class="card-body">
                        <h5 class="mb-3">Detail Toko</h5>

                        <div class="form-group">
                            <label>Nama Toko</label>
                            <input type="text" class="form-control" name="nama_toko" value="{{ old('nama_toko', $penjual->nama_toko ?? '') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Nama Pemilik</label>
                            <input type="text" class="form-control" name="pemilik" value="{{ old('pemilik', $penjual->nama_pemilik ?? '') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', $penjual->email ?? Auth::guard('usermanual')->user()->email) }}" required>
                        </div>

                        <div class="form-group">
                            <label>No. HP</label>
                            <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp', $penjual->no_hp ?? '') }}" required>
                        </div>
                    </div>
                </div>
            </div>

            {{-- OPERASIONAL --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100" style="border-radius:12px;">
                    <div class="card-body">
                        <h5 class="mb-3">Operasional & Alamat</h5>

                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="{{ old('alamat', $penjual->alamat_toko ?? '') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Start Jam Operasional</label>
                            <input type="time"
                                   class="form-control"
                                   name="jam_operasional_buka"
                                   value="{{ old('jam_operasional_buka', $penjual->jam_buka ? $penjual->jam_buka->format('H:i') : '') }}"
                                   required>
                        </div>
                        <div class="form-group">
                            <label>End Jam Operasional</label>
                            <input type="time"
                                   class="form-control"
                                   name="jam_operasional_tutup"
                                   value="{{ old('jam_operasional_tutup', $penjual->jam_tutup ? $penjual->jam_tutup->format('H:i') : '') }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Berdiri</label>
                            <input type="date" class="form-control" name="tgl_berdiri" value="{{ old('tgl_berdiri', $penjual->tanggal_join ? $penjual->tanggal_join->format('Y-m-d') : '') }}" required>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- =========================
            DESKRIPSI TOKO
        ========================== --}}
        <div class="card mb-4" style="border-radius:12px;">
            <div class="card-body">
                <h5 class="mb-3">Deskripsi Toko</h5>

                <textarea class="form-control"
                          name="deskripsi"
                          rows="4"
                          placeholder="Ceritakan tentang toko Anda..."
                          required>{{ old('deskripsi', $penjual->deskripsi_toko ?? '') }}</textarea>
            </div>
        </div>

        {{-- =========================
            ACTION
        ========================== --}}
        <div class="text-right">
            <button type="submit" class="btn btn-purple px-5">
                Simpan Data Toko
            </button>
        </div>

    </form>

</div>
@endsection
