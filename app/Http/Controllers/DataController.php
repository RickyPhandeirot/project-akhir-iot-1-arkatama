<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Device;
use App\Service\WhatsappNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class DataController extends Controller
{
    public function index()
    {
        return Data::orderBy('created_at', 'desc')
        ->limit(100)
        ->get();
    }

    public function store (Request $request)
    {
        $data = new Data;
        $data->device_id = $request->device_id;
        $data->data = $request->data;
        $data->save();

        if (Device::where('id', $request->device_id)->exists()) {
            $device = Device::find($request->device_id);
            $device->current_value = $request->data;
            $device->save();

            }
            //  Tambahkan logika pengecekan di sini
        //   $deviceId = 3;
        //      $nilaiMaksimalSensor = 300; // contoh nilai maksimal sensor

        //      if ($request->device_id == $deviceId && $request->data > $nilaiMaksimalSensor) {
        //          // Panggil fungsi untuk mengirimkan notifikasi peringatan
        //          WhatsappNotificationService::notifikasiKebocoranGasMassal($request->data, $deviceId);
        //   }

        // if ($request->device_id == 3 && $request->data > 100) { // ganti 100 dengan ambang batas gas yang Anda inginkan
        //     $this->sendAlert($request->data);
        // }
        if ($request->device_id == 3 && $request->data > 100) {
            $lastAlertTime = Cache::get('last_alert_time_device_3');

            // Ambang batas waktu (dalam detik) untuk menghindari spam, misalnya 300 detik (5 menit)
            $alertInterval = 300;

            // Mengecek apakah sudah lewat dari waktu interval
            if (is_null($lastAlertTime) || (time() - $lastAlertTime) > $alertInterval) {
                $this->sendAlert($request->data);
                // Memperbarui timestamp terakhir pengiriman alert
                Cache::put('last_alert_time_device_3', time());
            }
        }

        return response()->json([
            "message" => "Data telah Ditambahkan."
        ], 201);
    }



    public function show(string $id)
    {
        return Data::where('device_id', $id)->orderBy('created_at', 'DESC')->get();
    }

    public function web_show(string $id){
        $device = Device::find($id);

        // Mengambil data sensor dengan paginasi
        $data = Data::where('device_id', $id)->orderBy('created_at', 'DESC')->simplepaginate(10); // Ganti 10 dengan jumlah data per halaman yang Anda inginkan

        return view('pages.datasensor', [
            "title" => "device",
            "device" => $device,
            "data" => $data
        ]);
    }

    private function sendAlert($gasValue)
    {

        $message = "Peringatan! Tingkat gas mencapai TINGKAT BERBAHAYA";
        $message .= PHP_EOL;
        $message .= PHP_EOL;
        $message .= 'Dikirimkan pada tanggal ' . date('Y-m-d H:i:s') . ' oleh IoT With Capy';
        $this->sendWhatsAppMessage($message);
    }

    private function sendWhatsAppMessage($message)
    {
        $token = env('FONNTE_API_TOKEN'); // Pastikan Anda sudah menambahkan token di file .env
        $phone = env('TARGET_PHONE_NUMBER'); // Pastikan Anda sudah menambahkan nomor telepon di file .env

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $phone,
                'message' => $message,
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
