@extends('layouts.app', ['userType' => 'penjual'])

@section('title', 'Edit Data Toko')

@section('content')
<div class="container-fluid">

    <h2 class="mb-4">Edit Data Toko</h2>

    <form method="POST" action="{{ route('penjual.update_toko') }}\" enctype=\"multipart/form-data\">
        @csrf
        @method('PUT')

        {{-- =========================
            BANNER TOKO
        ========================== --}}
        <div class="card mb-4" style="border-radius:12px;">
            <div class="card-body">
                <h5 class="mb-3">Banner Toko</h5>

                @if($penjual->banner)
                    <div class="mb-3">
                        <img src="{{ asset('storage/banners/' . $penjual->banner) }}" 
                             alt="Current Banner" 
                             class="img-fluid rounded"
                             style="max-height: 200px;">
                        <p class="text-muted mt-2 mb-0"><small>Banner saat ini</small></p>
                    </div>
                @endif

                <div class="mb-3">
                    <input type="file" class="form-control" name="banner" accept="image/*">
                    <small class="text-muted">
                        Rekomendasi ukuran: 1200 x 400 px. Kosongkan jika tidak ingin mengganti banner.
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
                            <label>Nama Toko <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_toko" value="{{ old('nama_toko', $penjual->nama_toko) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Nama Pemilik <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="pemilik" value="{{ old('pemilik', $penjual->nama_pemilik) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', $penjual->email ?? Auth::guard('usermanual')->user()->email) }}" required>
                        </div>

                        <div class="form-group">
                            <label>No. HP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp', $penjual->no_hp) }}" required>
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
                            <label>Alamat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="alamat" value="{{ old('alamat', $penjual->alamat_toko) }}" required>
                        </div>

                        @php
                            $jam_buka = $penjual->jam_buka ? $penjual->jam_buka->format('H:i') : '';
                            $jam_tutup = $penjual->jam_tutup ? $penjual->jam_tutup->format('H:i') : '';
                        @endphp

                        <div class="form-group">
                            <label>Start Jam Operasional <span class="text-danger">*</span></label>
                            <input type="time"
                                   class="form-control"
                                   name="jam_operasional_buka"
                                   value="{{ old('jam_operasional_buka', $jam_buka) }}"
                                   required>
                        </div>
                        <div class="form-group">
                            <label>End Jam Operasional <span class="text-danger">*</span></label>
                            <input type="time"
                                   class="form-control"
                                   name="jam_operasional_tutup"
                                   value="{{ old('jam_operasional_tutup', $jam_tutup) }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Berdiri <span class="text-danger">*</span></label>
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
                          placeholder="Ceritakan tentang toko Anda...">{{ old('deskripsi', $penjual->deskripsi_toko) }}</textarea>
            </div>
        </div>

        {{-- =========================
            ACTION
        ========================== --}}
        <div class="text-right">
            <a href="{{ route('penjual.dashboard') }}" class="btn btn-sm px-5" style="background:transparent;color:#9B8CFF;border:1px solid #9B8CFF;">Batal</a>
            <button type="submit" class="btn btn-sm px-5" style="background:#9B8CFF;color:white;">
                Simpan Perubahan
            </button>
        </div>

    </form>

</div>
@endsection
