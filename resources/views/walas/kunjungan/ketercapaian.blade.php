@extends('walas.main')
@section('head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h2>Laporan Ketercapaian Kunjungan</h2>
        <p class="text-primary fs-5">Catatan : kriteria ketercapaian kunjungan kerohanian adalah jika murid melakukan 3 kali
            kegiatan kunjungan</p>
        <p>Filter Berdasarkan Tanggal</p>
        <form action="/ketercapaian-kunjungan-filter" method="POST">
            @csrf
            <div class="row mb-4">
                <div class="col-md-4 mt-2">
                    <label for="">Dari</label>
                    <input type="date" class="form-control" name="from" value="{{ isset($from) ? $from : null }}"
                        required>
                </div>

                <div class="col-md-4 mt-2">
                    <label for="">Sampai</label>
                    <input type="date" class="form-control" name="to" value="{{ isset($to) ? $to : null }}"
                        required>
                </div>
                <div class="col-md-2 mt-4">
                    <button type="submit" class="btn btn-primary">Terapkan</button>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td> <strong>Jumlah Murid</strong></td>
                            <td>{{ $jumlah_siswa }}</td>

                        </tr>
                        <tr>
                            <td> <strong>Jumlah Murid Yang Sudah Input Data</strong></td>
                            <td>{{ $jml_input }}</td>

                        </tr>
                        <tr>
                            <td> <strong>Jumlah Murid Yang Memenuhi Kriteria</strong></td>
                            <td>{{ $memenuhi }}</td>
                        </tr>
                        <tr>
                            <td> <strong>Jumlah Murid Yang Tidak Memenuhi Kriteria</strong></td>
                            <td>{{ $tidak_memenuhi }}</td>
                        </tr>
                        <tr>
                            <td> <strong>Prosentase Ketercapaian</strong></td>
                            <td>{{ round(($memenuhi / $jumlah_siswa) * 100, 2) }}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="text-center">
                            <h4>Grafik Ketercapaian </h4>
                            <h4>Kunjungan</h4>
                        </div>
                        <canvas id="inicanvas"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
@endsection

@section('body-bottom')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>


    <script>
        // var data = [{
        //     data: [{{ $memenuhi }}, {{ $tidak_memenuhi }}],
        //     labels: ["Memenuhi", "Tidak Memenuhi"],
        //     backgroundColor: [
        //         "#4b77a9",
        //         "#5f255f",
        //     ],
        //     borderColor: "#fff"
        // }];



        // var categories = document.getElementById('inicanvas').getContext('2d');
        // var myChart = new Chart(categories, {
        //     type: 'pie',
        //     data: {
        //         datasets: data
        //     },

        // });

        var ctx = document.getElementById("inicanvas").getContext("2d");
        // tampilan chart
        var piechart = new Chart(ctx, {
            type: 'pie',
            data: {
                // label nama setiap Value
                labels: [
                    'Memenuhi',
                    'Belum Memenuhi',
                ],
                datasets: [{
                    // Jumlah Value yang ditampilkan
                    data: [{{ $memenuhi }}, {{ $tidak_memenuhi }}],

                    backgroundColor: [
                        'rgba(0, 255, 77, 0.8)',
                        'rgba(255, 0, 67, 0.8)'

                    ]
                }],
            }
        });
    </script>
@endsection
