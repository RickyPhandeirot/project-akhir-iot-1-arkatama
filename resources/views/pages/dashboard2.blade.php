@extends('layouts.dashboard')

@section('content')
    <div id="temperatureChart" style="width: 100%; height: 400px;"></div>
    <div id="humidityChart" style="width: 100%; height: 400px;"></div>
    <div id="gasChart" style="width: 100%; height: 400px;"></div>
    <div id="rainChart" style="width: 100%; height: 400px;"></div>
@endsection

@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        let temperatureChart, humidityChart, gasChart, rainChart;
        const baseUrl = '{{ url('') }}';
        let lastTimestamp = new Date(0).getTime();

        async function requestData() {
            let endpoint = `${baseUrl}/api/data`;
            let params = { limit: 4 }; // Membatasi jumlah data untuk testing

            try {
                const result = await fetch(`${endpoint}`);
                if (result.ok) {
                    const data = await result.json();
                    console.log('Fetched data:', data);  // Debugging: log fetched data

                    if (Array.isArray(data) && data.length > 0) {
                        let newData = false;
                        let temperatureData = [],
                            humidityData = [],
                            gasData = [],
                            rainData = [];

                        data.forEach((sensorData) => {
                            let x = new Date(sensorData.created_at).getTime();
                            let y = Number(sensorData.data);
                            console.log(`Device ID: ${sensorData.device_id}, X: ${x}, Y: ${y}`); // Debugging: log each point

                            if (x > lastTimestamp) {
                                newData = true; // There is new data
                                lastTimestamp = x; // Update the last timestamp
                            }

                            switch (sensorData.device_id) {
                                case "1":
                                    temperatureData.push([x, y]);
                                    break;
                                case "2":
                                    humidityData.push([x, y]);
                                    break;
                                case "3":
                                    gasData.push([x, y]);
                                    break;
                                case "4":
                                    rainData.push([x, y]);
                                    break;
                            }
                        });

                        console.log('New data found. Updating charts.');
                        // Add data to charts
                        addDataToChart(temperatureChart, temperatureData);
                        addDataToChart(humidityChart, humidityData);
                        addDataToChart(gasChart, gasData);
                        addDataToChart(rainChart, rainData);

                        // Uncomment to periodically fetch new data
                        setTimeout(requestData, 5000);
                    } else {
                        console.log('No new data found. Keeping last 4 data.');
                        // Uncomment to periodically fetch new data even if no new data found
                        setTimeout(requestData, 5000);
                    }
                } else {
                    console.error('Failed to fetch data from API');
                    // Uncomment to retry fetching data after some time if failed to fetch
                    setTimeout(requestData, 5000);
                }
            } catch (error) {
                console.error('Error fetching data:', error);
                // Uncomment to retry fetching data after some time if error occurs
                setTimeout(requestData, 5000);
            }
        }

        function addDataToChart(chart, data) {
            // Use update instead of addPoint for batch updates
            if (data.length > 0) {
                const existingData = chart.series[0].data.map(point => [point.x, point.y]);
                const combinedData = [...existingData, ...data];
                const slicedData = combinedData.slice(-4); // Keep only the latest 4 points
                chart.series[0].setData(slicedData, true);
            }
        }

        window.addEventListener('load', function() {
            temperatureChart = new Highcharts.Chart({
                chart: {
                    renderTo: 'temperatureChart',
                    type: 'spline',
                    events: {
                        load: requestData
                    }
                },
                title: {
                    text: 'Temperature'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Temperature (°C)',
                        margin: 80
                    }
                },
                series: [{
                    name: 'Temperature',
                    data: []
                }]
            });

            humidityChart = new Highcharts.Chart({
                chart: {
                    renderTo: 'humidityChart',
                    type: 'spline',
                    events: {
                        load: requestData
                    }
                },
                title: {
                    text: 'Humidity'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Humidity (%)',
                        margin: 80
                    }
                },
                series: [{
                    name: 'Humidity',
                    data: []
                }]
            });

            gasChart = new Highcharts.Chart({
                chart: {
                    renderTo: 'gasChart',
                    type: 'spline',
                    events: {
                        load: requestData
                    }
                },
                title: {
                    text: 'Gas'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Gas (ppm)',
                        margin: 80
                    }
                },
                series: [{
                    name: 'Gas',
                    data: []
                }]
            });

            rainChart = new Highcharts.Chart({
                chart: {
                    renderTo: 'rainChart',
                    type: 'spline',
                    events: {
                        load: requestData
                    }
                },
                title: {
                    text: 'Rain'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Rain (mm)',
                        margin: 80
                    }
                },
                series: [{
                    name: 'Rain',
                    data: []
                }]
            });
        });
    </script>
@endpush
