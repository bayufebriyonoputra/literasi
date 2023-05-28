@extends('admin.main')

@section('head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
@endsection

@section('content')
    <div class="container">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tahun Masuk</th>
                    <th>Nomor Induk</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>No HP Siswa</th>
                    <th>No HP Wali</th>
                    <th>Tes Diagnostik</th>
                    <th>Kata Kunci</th>
                    <th>Tahun Pelajaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $s->tahun_masuk }}</td>
                        <td>{{ $s->nomor_induk }}</td>
                        <td>{{ $s->nama }}</td>
                        <td>{{ $s->alamat }}</td>
                        <td>{{ $s->jenis_kelamin == 'L' ? 'Laki Laki' : 'Perempuan' }}</td>
                        <td>{{ $s->hp_siswa }}</td>
                        <td>{{ $s->hp_wali }}</td>
                        <td>{{ $s->tes_diagnostik }}</td>
                        <td>{{ $s->kata_kunci }}</td>
                        <td>{{ $s->tahun_pelajaran }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection

@section('body-bottom')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                scrollX: true,
            });
        });
    </script>
@endsection
