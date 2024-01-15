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
        Schema::create('laporan_kendalas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Tambahkan kolom user_id
            $table->unsignedBigInteger('member_id'); // Tambahkan kolom member_id
            $table->text('pesan');
            $table->string('status');
            // Tambahkan atribut lain sesuai kebutuhan
            $table->timestamps();

            // Tambahkan foreign key constraint ke tabel users dan members
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kendalas');
    }
};
