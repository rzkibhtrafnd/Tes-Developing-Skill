<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Struktur dari tabel `table_a`
        Schema::create('table_a', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kode_toko_baru')->unique();
            $table->integer('kode_toko_lama')->nullable();
            $table->boolean('status')->default(true);
        });

        // 2. Struktur dari tabel `table_b`
        Schema::create('table_b', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kode_toko');
            $table->decimal('nominal_transaksi', 8, 2);

            $table->foreign('kode_toko')
                    ->references('kode_toko_baru')
                    ->on('table_a')
                    ->onDelete('cascade');
        });

        // 3. Struktur dari tabel `table_c`
        Schema::create('table_c', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kode_toko')->unique();
            $table->string('area_sales', 10);
            $table->collation('utf8mb4_unicode_ci');
        });

        // 4. Struktur dari tabel `table_d`
        Schema::create('table_d', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sales', 255)->unique();
            $table->string('nama_sales', 20);
            $table->collation('utf8mb4_unicode_ci');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('table_d');
        Schema::dropIfExists('table_c');
        Schema::dropIfExists('table_b');
        Schema::dropIfExists('table_a');
    }
};