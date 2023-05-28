@extends('siswa.main')

@section('head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="{{ asset('dselect/css/dselect.min.css') }}">
@endsection

@section('content')
    <div class="bs-toast toast toast-placement-ex m-2 fade bg-primary position-fixed bottom-0 end-0 p-3 {{ session('success') ? 'show' : 'hide' }}"
        role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Suksess</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">{{ session('success') ? session('success') : '' }}</div>
    </div>

    <div class="container">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Tugas</span> Pembiasaan
            Kerohanian
        </h4>


        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Pembuat</th>
                    <th>Tanggal</th>
                    <th>Kelas</th>
                    <th>Tugas</th>
                    <th>Keterangan</th>
                    <th>Jenis Tugas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tugas as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $t->guru->nama }}</td>
                        <td>{{ $t->tanggal }}</td>
                        <td>{{ $t->kelas_id ? $t->kelas->nama_kelas : 'Tingkat ' . $t->tingkat }}</td>
                        <td>{{ $t->tugas }}</td>
                        <td>{{ $t->keterangan }}</td>
                        <td>{{ $t->jenis_tugas }}</td>

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

    <script src="{{ asset('dselect/js/dselect.min.js') }}"></script>
    <script>
        dselect(document.querySelector('#selectWalas'), {
            search: true
        })
        dselect(document.querySelector('#Kelas'), {
            search: true
        })
    </script>
@endsection
