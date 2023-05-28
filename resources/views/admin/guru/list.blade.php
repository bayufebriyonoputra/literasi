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
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guru as $g)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $g->nip }}</td>
                        <td>{{ $g->nama }}</td>
                        <td>{{ $g->alamat }}</td>
                        <td>{{ $g->jenis_kelamin == 'L' ? 'Laki Laki' : 'Perempuan' }}</td>
                        <td>
                            <a href="/admin-guru/{{ $g->id }}/edit" class="btn btn-warning"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <form action="/admin-guru/{{ $g->id }}" class="d-inline" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
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
