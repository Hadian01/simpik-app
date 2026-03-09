<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambahkan kolom foto_produk jika belum ada
        Schema::table('tbl_produk', function (Blueprint $table) {
            if (!Schema::hasColumn('tbl_produk', 'foto_produk')) {
                $table->string('foto_produk')->nullable()->after('status_produk');
            }
        });

        // Konversi aman created_at jika tipe saat ini adalah 'time'
        $col = DB::select("SELECT data_type FROM information_schema.columns WHERE table_name = 'tbl_produk' AND column_name = 'created_at'");
        if (!empty($col) && isset($col[0]->data_type) && $col[0]->data_type === 'time without time zone' || (!empty($col) && isset($col[0]->data_type) && $col[0]->data_type === 'time')) {
            // Tambah kolom temporer
            DB::statement('ALTER TABLE tbl_produk ADD COLUMN IF NOT EXISTS created_at_tmp timestamp without time zone');
            // Isi created_at_tmp dengan tanggal sekarang + waktu lama (jika kolom time)
            DB::statement("UPDATE tbl_produk SET created_at_tmp = (current_date + created_at)");
            // Hapus kolom lama dan ganti nama temporer
            DB::statement('ALTER TABLE tbl_produk DROP COLUMN created_at');
            DB::statement('ALTER TABLE tbl_produk RENAME COLUMN created_at_tmp TO created_at');
            DB::statement('ALTER TABLE tbl_produk ALTER COLUMN created_at SET NOT NULL');
        }

        // Perbaiki tbl_pengajuan_detail - rename kolom typo jika ada
        Schema::table('tbl_pengajuan_detail', function (Blueprint $table) {
            if (Schema::hasColumn('tbl_pengajuan_detail', 'craeted_at')) {
                $table->renameColumn('craeted_at', 'created_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_produk', function (Blueprint $table) {
            if (Schema::hasColumn('tbl_produk', 'foto_produk')) {
                $table->dropColumn('foto_produk');
            }
        });

        // Jika kolom created_at bertipe timestamp, kembalikan ke time (simpan hanya waktu)
        $col = DB::select("SELECT data_type FROM information_schema.columns WHERE table_name = 'tbl_produk' AND column_name = 'created_at'");
        if (!empty($col) && isset($col[0]->data_type) && $col[0]->data_type === 'timestamp without time zone') {
            DB::statement('ALTER TABLE tbl_produk ADD COLUMN IF NOT EXISTS created_at_tmp time without time zone');
            DB::statement('UPDATE tbl_produk SET created_at_tmp = created_at::time');
            DB::statement('ALTER TABLE tbl_produk DROP COLUMN created_at');
            DB::statement('ALTER TABLE tbl_produk RENAME COLUMN created_at_tmp TO created_at');
        }

        Schema::table('tbl_pengajuan_detail', function (Blueprint $table) {
            if (Schema::hasColumn('tbl_pengajuan_detail', 'created_at')) {
                $table->renameColumn('created_at', 'craeted_at');
            }
        });
    }
};
