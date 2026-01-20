{{-- MODAL STATUS PENGAJUAN --}}
<div class="modal fade" id="modalStatusPengajuan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius:12px;">

            {{-- HEADER --}}
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-clock-history"></i>
                    Status Pengajuan Penitip
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            {{-- BODY --}}
            <div class="modal-body">

                {{-- STATUS BADGE --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <strong>Toko:</strong> Toko Kue Maju<br>
                        <small class="text-muted">Pengajuan Anda sebagai penitip</small>
                    </div>

                    {{-- STATUS (DUMMY) --}}
                    @php
                        // ganti nanti dari backend
                        $status = 'pending'; // pending | approved | rejected
                    @endphp

                    @if($status === 'pending')
                        <span class="badge badge-warning px-3 py-2">
                            ⏳ Menunggu Approval
                        </span>
                    @elseif($status === 'approved')
                        <span class="badge badge-success px-3 py-2">
                            ✔️ Disetujui
                        </span>
                    @elseif($status === 'rejected')
                        <span class="badge badge-danger px-3 py-2">
                            ❌ Ditolak
                        </span>
                    @endif
                </div>

                {{-- TIMELINE --}}
                <ul class="list-group mb-4">

                    <li class="list-group-item">
                        <strong>📨 Pengajuan Dikirim</strong><br>
                        <small class="text-muted">20 Januari 2026, 10:30</small>
                    </li>

                    <li class="list-group-item">
                        <strong>🔍 Sedang Diproses Admin</strong><br>
                        <small class="text-muted">20 Januari 2026, 14:00</small>
                    </li>

                    @if($status === 'approved')
                        <li class="list-group-item list-group-item-success">
                            <strong>✅ Disetujui</strong><br>
                            <small>Selamat! Anda resmi menjadi penitip.</small>
                        </li>
                    @elseif($status === 'rejected')
                        <li class="list-group-item list-group-item-danger">
                            <strong>❌ Ditolak</strong><br>
                            <small>Silakan ajukan ulang dengan perbaikan.</small>
                        </li>
                    @endif
                </ul>

                {{-- CATATAN ADMIN (HANYA JIKA REJECTED) --}}
                @if($status === 'rejected')
                    <div class="alert alert-danger">
                        <strong>Catatan Admin:</strong><br>
                        Produk belum sesuai standar toko. Silakan perbaiki kualitas dan ajukan ulang.
                    </div>
                @endif

                {{-- ACTION --}}
                <div class="text-center">
                    <button class="btn btn-secondary" data-dismiss="modal">
                        Tutup
                    </button>

                    @if($status === 'rejected')
                        <button class="btn btn-warning ml-2" data-dismiss="modal">
                            Ajukan Ulang
                        </button>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
