<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tamu', function (Blueprint $table) {

            $table->id('id_tamu');

            $table->string('kode_tiket')->unique();

            $table->dateTime('tanggal_konsultasi');

            $table->enum('pelaku_usaha', [
                'Pelaku Usaha',
                'Instansi Pemerintah'
            ]);

            $table->string('nik', 20);

            $table->string('nama_lengkap', 100);

            $table->string('nama_perusahaan_instansi', 150);

            $table->string('jabatan', 100);

            $table->string('email', 100);

            $table->string('no_hp', 20);

            $table->unsignedBigInteger('id_tujuan');

            $table->text('permasalahan');

            $table->longText('solusi')->nullable();

            $table->unsignedBigInteger('id_pegawai')->nullable();

            $table->enum('status', [
                'Baru',
                'Diproses',
                'Selesai'
            ])->default('Baru');

            $table->string('pdf_path')->nullable();

            $table->longText('ttd_tamu')->nullable();

            $table->longText('ttd_pegawai')->nullable();

            $table->timestamp('email_sent_at')->nullable();

            $table->timestamps();

            $table->foreign('id_tujuan')
                ->references('id_tujuan')
                ->on('tujuan_konsultasi')
                ->onDelete('cascade');

            $table->foreign('id_pegawai')
                ->references('id_pegawai')
                ->on('data_pegawai')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tamu');
    }
};
