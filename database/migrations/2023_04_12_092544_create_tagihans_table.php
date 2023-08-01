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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id');
            $table->foreignId('user_id');
            $table->integer('desa')->nullable();
            $table->integer('kecamatan')->nullable();
            $table->date('tanggal_tagihan');
            $table->date('tanggal_jatuh_tempo');
            $table->string('keterangan')->nullable();
            $table->double('denda')->nullable();
            $table->enum('status', ['baru', 'angsur', 'lunas']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
