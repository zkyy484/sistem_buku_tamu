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
        Schema::create('data_pegawai', function (Blueprint $table) {
            $table->id('id_pegawai');
            $table->string('nama_pegawai', 100);
            $table->string('nip', 30)->unique();
            $table->string('email')->unique();
            $table->string('jabatan', 100);

            $table->unsignedBigInteger('id_sub_bagian');

            $table->string('no_hp', 20);
            $table->text('alamat')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->foreign('id_sub_bagian')
                ->references('id_sub_bagian')
                ->on('sub_bagian')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pegawai');
    }
};
