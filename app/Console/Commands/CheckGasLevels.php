<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CheckGasLevels extends Command
{
    protected $signature = 'check:gas-levels';
    protected $description = 'Check gas levels and send alert if threshold is exceeded';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $gas_threshold = 100; // Ambang batas nilai gas
        $api_key = 'E5uzGncyZ_#4mxej-AGB'; // Ganti dengan API key Anda
        $target = '6281244507755'; // Nomor telepon target dengan kode negara
        $countryCode = '62'; // Kode negara
        $message = 'Peringatan: Nilai gas melebihi ambang batas!';

        // Ambil nilai gas terbaru dari device_id = 3
        $gas_value = DB::table('data')
            ->where('device_id', 3)
            ->orderBy('created_at', 'desc')
            ->value('data'); // Ganti 'data' dengan nama kolom yang benar, misalnya 'gas_value'

        if ($gas_value !== null) {
            if ($gas_value > $gas_threshold) {
                $response = Http::asForm()->withHeaders([
                    'Authorization' => $api_key,
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ])->post('https://api.fonnte.com/send', [
                    'target' => $target,
                    'message' => $message,
                    'countryCode' => $countryCode,
                ]);

                // Menampilkan status dan respons API di konsol
                if ($response->successful()) {
                    $this->info("Pesan berhasil dikirim. Respons: " . $response->body());
                } else {
                    $this->error("Gagal mengirim pesan. Respons: " . $response->body());
                }
            } else {
                $this->info("Nilai gas aman: " . $gas_value);
            }
        } else {
            $this->info("Tidak ada data gas yang tersedia.");
        }
    }
}
