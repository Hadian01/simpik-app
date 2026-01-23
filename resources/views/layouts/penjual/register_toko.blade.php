@extends('layouts.app', ['userType' => 'penjual'])

@section('title', 'Lengkapi Data Toko')

@section('content')
<div class="container-fluid">

    <h2 class="mb-4">Lengkapi Data Toko</h2>

    <form method="POST" action="#" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" name="nama_toko" required>
                        </div>

                        <div class="form-group">
                            <label>Nama Pemilik</label>
                            <input type="text" class="form-control" name="pemilik" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="form-group">
                            <label>No. HP</label>
                            <input type="text" class="form-control" name="no_hp" required>
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
                            <input type="text" class="form-control" name="alamat" required>
                        </div>

                        <div class="form-group">
                            <label>Start Jam Operasional</label>
                            <input type="text"
                                   class="form-control"
                                   name="jam_operasional"
                                   placeholder="Contoh: 05.00 "
                                   required>
                        </div>
                        <div class="form-group">
                            <label>End Jam Operasional</label>
                            <input type="text"
                                   class="form-control"
                                   name="jam_operasional"
                                   placeholder="Contoh: 12.00"
                                   required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Berdiri</label>
                            <input type="date" class="form-control" name="tgl_berdiri" required>
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
                          required></textarea>
            </div>
        </div>

        {{-- =========================
            ACTION
        ========================== --}}
        <div class="text-right">
            <button type="submit"
                    class="btn px-5"
                    style="background:#9B8CFF;color:white;">
                Simpan Data Toko
            </button>
        </div>

    </form>

</div>
@endsection
