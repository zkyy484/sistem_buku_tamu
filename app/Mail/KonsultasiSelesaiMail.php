<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KonsultasiSelesaiMail extends Mailable
{
    use Queueable, SerializesModels;

    public $konsultasi;

    public $pdfPath;

    public function __construct($konsultasi, $pdfPath)
    {
        $this->konsultasi = $konsultasi;

        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->subject('Hasil Konsultasi Anda')
            ->view('emails.konsultasi_selesai')
            ->attach(storage_path('app/public/' . $this->pdfPath));
    }
}