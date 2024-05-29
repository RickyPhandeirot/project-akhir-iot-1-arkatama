@extends('layouts.dashboard')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LED Toggle</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <style>
            /* CSS untuk ikon LED */
            .led-on {
                color: yellow;
                /* Ganti warna sesuai keinginan Anda */
            }

            .led-off {
                color: rgb(206, 30, 30);
                /* Ganti warna sesuai keinginan Anda */
            }
        </style>
    </head>
    <body>
        <div class="container my-4">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row my-4">
                        <!-- LED Item 1 -->
                        <div class="col-sm-6 col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div class="d-flex align-items-start text-primary">
                                            <i class="fas fa-lightbulb fa-fw fa-4x led-icon led-1-icon led-off"></i>
                                            <div>
                                                <h6 class="p-0 m-0 fw-bold">LED 1</h6>
                                                <p class="p-0 m-0 text-muted">Pin: 2</p>

                                                <div>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch1" onclick="toggleLed(1)">
                                                        <label class="custom-control-label" for="customSwitch1">Toggle Switch</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- LED Item 2 -->
                        <div class="col-sm-6 col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div class="d-flex align-items-start text-primary">
                                            <i class="fas fa-lightbulb fa-fw fa-4x led-icon led-2-icon led-off"></i>
                                            <div>
                                                <h6 class="p-0 m-0 fw-bold">LED 2</h6>
                                                <p class="p-0 m-0 text-muted">Pin: 3</p>
                                                <div>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="customSwitch2" onclick="toggleLed(2)">
                                                        <label class="custom-control-label" for="customSwitch2">Toggle Switch</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <script>
            function toggleLed(ledId) {
                // Ganti warna ikon saat tombol diubah
                var icon = document.querySelector('.led-' + ledId + '-icon');
                if (icon) {
                    if (document.getElementById('customSwitch' + ledId).checked) {
                        icon.classList.remove('led-off');
                        icon.classList.add('led-on'); // Ubah kelas ke led-on saat tombol diaktifkan
                    } else {
                        icon.classList.remove('led-on');
                        icon.classList.add('led-off'); // Ubah kelas ke led-off saat tombol dinonaktifkan
                    }
                }
            }
        </script>
    </body>
    </html> --}}





        {{-- <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="/your-backend-endpoint" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add LED</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">LED Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Nama LED">
                            </div>

                            <div class="mb-3">
                                <label for="pin" class="form-label">LED Pin</label>
                                <input type="number" class="form-control" name="pin" id="pin"
                                    placeholder="Pin LED">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    <!-- Include the MQTT.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mqtt/4.3.7/mqtt.min.js"></script>


    <script>
        const brokerUrl = 'ws://YOUR_MQTT_BROKER_IP:port'; // Ganti dengan alamat broker MQTT Anda
        const topicPrefix = 'esp32/led';

        const client = mqtt.connect(brokerUrl);

        client.on('connect', function() {
            console.log('Connected to MQTT broker');
        });

        function toggleLed(ledId) {
            // Ganti warna ikon saat tombol diubah
            var icon = document.querySelector('.led-' + ledId + '-icon');
            var ledSwitch = document.getElementById('customSwitch' + ledId);
            if (icon && ledSwitch) {
                if (ledSwitch.checked) {
                    icon.classList.remove('led-off');
                    icon.classList.add('led-on'); // Ubah kelas ke led-on saat tombol diaktifkan
                } else {
                    icon.classList.remove('led-on');
                    icon.classList.add('led-off'); // Ubah kelas ke led-off saat tombol dinonaktifkan
                }

                // Mengirimkan status ke broker MQTT
                const state = ledSwitch.checked ? 'on' : 'off';
                client.publish(`${topicPrefix}/${ledId}`, state);
                console.log(`LED ${ledId} is ${state}`);
            }
        }
    </script>
@endsection
