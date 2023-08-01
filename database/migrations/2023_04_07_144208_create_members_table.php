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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable()->index();
            $table->string('nama', 255);
            $table->string('desa', 25);
            $table->string('kecamatan', 25);
            $table->string('alamat_lengkap', 255);
            $table->string('idpel', 10)->unique();
            $table->string('paket');
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
