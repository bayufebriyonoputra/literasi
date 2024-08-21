@extends('admin.main')

@section('head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
@endsection

@section('content')
    <div class="container">
        <h4>List Kelas</h4>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kelas</th>
                    <th>Wali Kelas</th>
                    <th>Tahun Pelajaran</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($wali_kelas as $w)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $w->kelas->nama_kelas }}</td>
                        <td>{{ $w->guru->nama ?? '-' }}</td>
                        <td>{{ $w->tahun_pelajaran }}</td>
                        <td>
                            <a class="btn btn-warning" href="/admin-warga/{{ $w->id }}"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                        </td>
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
