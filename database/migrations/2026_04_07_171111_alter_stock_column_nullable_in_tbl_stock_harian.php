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
        DB::statement('ALTER TABLE tbl_stock_harian ALTER COLUMN stock TYPE integer USING stock::integer');
        DB::statement('ALTER TABLE tbl_stock_harian ALTER COLUMN stock DROP NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE tbl_stock_harian ALTER COLUMN stock SET NOT NULL');
    }
};
