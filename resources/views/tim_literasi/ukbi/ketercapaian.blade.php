@extends('tim_literasi.main')
@section('head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h2>Laporan Ketercapaian UKBI</h2>
        <p class="text-primary fs-5">Catatan : kriteria ketercapaian UKBI adalah jika murid mampu mencapai skor semenjana</p>
        <p>Pilih Kelas</p>
        <form method="POST" action="/filter-ketercapaian-ukbi" class="mb-4">
            @csrf
            <div class="row">
                <div class="col-md-10">
                    <select name="kelas_id" class="form-select">
                        <option value="">Semua</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id }}" {{ $k->id == $kelas_id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
                            <td>{{ $jumlah_siswa == 0 ? '0' : round(($memenuhi / $jumlah_siswa) * 100, 2) }}%</td>
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
                            <h4>Pembiasaan Ekstensif</h4>
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
