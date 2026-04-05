<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID user yang terima notifikasi
            $table->string('type'); // Jenis notif: pengajuan_baru, pengajuan_approved, etc
            $table->string('title'); // Judul notifikasi
            $table->text('message'); // Pesan notifikasi
            $table->json('data')->nullable(); // Data tambahan (pengajuan_id, produk_id, etc)
            $table->boolean('is_read')->default(false); // Status baca
            $table->timestamps();
            
            $table->foreign('user_id')->references('user_id')->on('tbl_user')->onDelete('cascade');
            $table->index(['user_id', 'is_read']); // Index untuk query cepat
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
