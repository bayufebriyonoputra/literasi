@extends('perpustakaan.main')

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
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Modul &nbsp;</span>Buku Perpustakaan</h4>



        {{-- Alert --}}
        <div class="bs-toast toast toast-placement-ex m-2 fade bg-primary position-fixed bottom-0 end-0 p-3 {{ session('success') ? 'show' : 'hide' }}"
            role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Suksess</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">Data berhasil ditambahkan</div>
        </div>


        <div class="table-responsive ">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Sinopsis</th>
                        <th>Aksi</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($buku as $b)
                        <tr>
                            <td>{{ $b->isbn }}</td>
                            <td>{{ $b->judul }}</td>
                            <td>{{ $b->pengarang }}</td>
                            <td>{{ $b->penerbit }}</td>
                            <td>{{ $b->tahun_terbit }}</td>
                            <td class="text-wrap">{{ $b->sinopsis }}</td>
                            <td>
                                <a href="/perpustakaan/{{ $b->id }}/edit" class="btn btn-warning"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <form action="/perpustakaan/{{ $b->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i
                                            class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
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
