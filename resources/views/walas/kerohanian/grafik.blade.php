@extends('walas.main')
@section('head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
@endsection



@section('content')
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h4>Grafik Kegiatan Kerohanian</h4>
                    <canvas id="inicanvas"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
@endsection

@section('body-bottom')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    {{-- <script>
        var ctx = document.getElementById("inicanvas").getContext("2d");
        // tampilan chart
        var piechart = new Chart(ctx, {
            type: 'pie',
            data: {
                // label nama setiap Value
                labels: [
                    'Memenuhi',
                    'Tidak Memenuhi',
                ],
                datasets: [{
                    // Jumlah Value yang ditampilkan
                    data: [{{ $memenuhi }}, {{ $tidak_memenuhi }}, ],

                    backgroundColor: [
                        'rgba(81, 0, 255, 0.7)',
                        'rgba(255, 13, 0, 0.7)',
                    ]
                }],
            }
        });
    </script> --}}

    <script>
        var data = [{
            data: [{{ $memenuhi }}, {{ $tidak_memenuhi }}],
            labels: ["Memenuhi", "Tidak Memenuhi"],
            backgroundColor: [
                "#4b77a9",
                "#5f255f",
            ],
            borderColor: "#fff"
        }];

        var options = {
            tooltips: {
                enabled: false
            },
            plugins: {
                datalabels: {
                    formatter: (value, categories) => {

                        let sum = 0;
                        let dataArr = categories.chart.data.datasets[0].data;
                        dataArr.map(data => {
                            sum += data;
                        });
                        let percentage = (value * 100 / sum).toFixed(2) + "%";
                        return percentage;


                    },
                    color: '#fff',
                }
            }
        };


        var categories = document.getElementById('inicanvas').getContext('2d');
        var myChart = new Chart(categories, {
            type: 'pie',
            data: {
                datasets: data
            },
            options: options
        });
    </script>
@endsection
