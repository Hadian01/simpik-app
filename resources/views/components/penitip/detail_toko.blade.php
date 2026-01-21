<div class="card" style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
    <h5 class="mb-3">Detail {{ $nama_toko }}</h5>

    <div class="row mb-3">
        <div class="col-md-6">
            <p><strong>Pemilik:</strong><br>{{ $pemilik }}</p>
            <p><strong>Email:</strong><br>{{ $email }}</p>
            <p><strong>No. HP:</strong><br>{{ $no_hp }}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Alamat:</strong><br>{{ $alamat }}</p>
            <p><strong>Jam Operasional:</strong><br>{{ $jam_operasional }}</p>
            <p><strong>Tgl. Berdiri:</strong><br>{{ $start_operasional }}</p>
        </div>
    </div>

    <div>
        <p><strong>Deskripsi:</strong></p>
        <p style="text-align: justify;">{{ $deskripsi }}</p>
    </div>
</div>
