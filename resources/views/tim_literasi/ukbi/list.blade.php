@extends('tim_literasi.main')

@section('head')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.all.min.js"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jq-3.6.0/dt-1.12.1/b-2.2.3/datatables.min.css" />

    <style>
        .text-wrap {
            white-space: normal;
        }

        /* .width-200 {
                                                                                width: 200px;
                                                                            } */
    </style>
@endsection


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Modul &nbsp;</span>UKBI</h4>
        <p>Pilih Kelas</p>
        <form method="POST" action="/filter-ukbi" class="mb-4">
            @csrf
            <div class="row">
                <div class="col-md-10">
                    <select name="kelas_id" class="form-select" required>
                        <option value="all" selected>Semua</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id }}" {{ $k->id == $kelas_id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mt-2">
                    <label for="">Dari</label>
                    <input type="date" class="form-control" name="from" value="{{ isset($from) ? $from : null }}">
                </div>

                <div class="col-md-4 mt-2">
                    <label for="">Sampai</label>
                    <input type="date" class="form-control" name="to" value="{{ isset($to) ? $to : null }}">
                </div>
                <div class="col-md-2 mt-4">
                    <button type="submit" class="btn btn-primary">Terapkan</button>
                </div>
            </div>
        </form>
        <div class="table-responsive text-nowrap">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal Tes</th>
                        <th>Skor</th>
                        <th>Ketercapaian</th>
                        <th>Sertifikat</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($ukbi as $u)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $u->siswa->nama }}</td>
                            <td>{{ Carbon\Carbon::parse($u->tanggal)->locale('id_ID')->isoFormat('DD MMMM YYYY') }}</td>
                            <td>{{ $u->skor }} </td>
                            <td>
                                @if ($u->skor <= 325)
                                    Terbatas
                                @elseif ($u->skor <= 404)
                                    Marginal
                                @elseif ($u->skor <= 481)
                                    Semenja
                                @elseif ($u->skor <= 577)
                                    Madya
                                @elseif ($u->skor <= 640)
                                    Unggul
                                @elseif ($u->skor <= 724)
                                    Sangat Unggul
                                @elseif ($u->skor <= 800)
                                    Istimewa
                                @endif
                            </td>
                            <td><a href="{{ asset('uploads/' . $u->sertifikat) }}" class="btn btn-info">Lihat Foto</a></td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection

    @section('body-bottom')
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.6.0/dt-1.12.1/b-2.2.3/datatables.min.js">
        </script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.3.0-beta.2/pdfmake.min.js"
            integrity="sha512-k9XKlDENMt9s19gEl+L6F/r+OWAR4pesbUd8/SKQVMt3b1ECqsRXgLA9XnJoq4J9mjlxLQabfTxf3268lzpFUQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.3.0-beta.2/vfs_fonts.min.js"
            integrity="sha512-6RDwGHTexMgLUqN/M2wHQ5KIR9T3WVbXd7hg0bnT+vs5ssavSnCica4Uw0EJnrErHzQa6LRfItjECPqRt4iZmA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.js"></script>

        <script>
            $(document).ready(function() {
                $('#table').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'pdfHtml5',
                        text: 'Print PDF',
                        title: '',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        customize: function(doc) {
                            // Here's where you can control the cell padding
                            doc.styles.tableHeader.margin = [20, 15, 20, 15];
                            doc.styles.tableHeader.margin = [20, 15, 20, 15];
                            doc.styles.tableBodyOdd.margin = [20, 15, 20, 15];
                            doc.styles.tableBodyEven.margin = [20, 15, 20, 15];
                        },

                    }, {
                        extend: 'excel',
                        text: 'Export Excel',
                        title: '',

                    }]
                });
            });
        </script>
    @endsection
