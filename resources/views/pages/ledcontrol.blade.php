@extends('layouts.dashboard')

@section('content')
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
                                            <p class="p-0 m-0 text-muted">Pin: 18, 4, 5</p>
                                            <div>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch1"
                                                        onclick="toggleLed(1)">
                                                    <label class="custom-control-label" for="customSwitch1">Toggle
                                                        Switch</label>
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
                                            <p class="p-0 m-0 text-muted">Pin: 18, 4, 5</p>
                                            <div>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch2"
                                                        onclick="toggleLed(2)">
                                                    <label class="custom-control-label" for="customSwitch2">Toggle
                                                        Switch</label>
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

    <!-- Include the MQTT.js library -->
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', (event) => {
        const brokerUrl = 'wss://n69919ff.ala.asia-southeast1.emqxsl.com:8084/mqtt';  // Ubah port sesuai dengan pengaturan broker
        const topicPrefix = 'esp32/led';

        const options = {
          username: 'Mentoring',
          password: 'munyenyo',
          protocol: 'wss',
          rejectUnauthorized: false // Ini penting jika menggunakan sertifikat yang dihasilkan sendiri (self-signed)
        };

        const client = mqtt.connect(brokerUrl, options);

        client.on('connect', function() {
          console.log('Connected to MQTT broker');
        });

        client.on('error', function(err) {
          console.error('Connection error: ', err);
        });

        window.toggleLed = function(ledId) {
          var icon = document.querySelector('.led-' + ledId + '-icon');
          var ledSwitch = document.getElementById('customSwitch' + ledId);
          if (icon && ledSwitch) {
            if (ledSwitch.checked) {
              icon.classList.remove('led-off');
              icon.classList.add('led-on');
            } else {
              icon.classList.remove('led-on');
              icon.classList.add('led-off');
            }

            const state = ledSwitch.checked ? 'on' : 'off';
            client.publish(`${topicPrefix}/${ledId}`, JSON.stringify({ led: ledId, state: state }));
            console.log(`LED ${ledId} is ${state}`);
          }
        }
      });
    </script>
@endsection
