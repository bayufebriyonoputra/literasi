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
        {{-- Alert area --}}
        @if (session('success'))
            <script>
                Swal.fire(
                    'Sukses',
                    "{{ session('success') }}",
                    'success'
                )
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire(
                    'Gagal',
                    "{{ session('error') }}",
                    'error'
                )
            </script>
        @endif
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Karya &nbsp;</span>{{ $karya[0]->siswa->nama }}</h4>

        {{-- Modal --}}


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/inovasi-karya" method="POST">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="id" id="karyaId">
                            <label for="review">Review</label>
                            <input type="text" class="form-control" name="review" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Tanggal Unggah Karya</th>
                        <th>Jenis Karya</th>
                        <th>Status Kurasi</th>
                        <th>Review</th>
                        <th>Karya</th>
                        <th>Aksi</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($karya as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->tanggal ? Carbon\Carbon::parse($k->tanggal)->locale('id_ID')->isoFormat('DD MMMM YYYY') : Carbon\Carbon::parse($k->created_at)->locale('id_ID')->isoFormat('DD MMMM YYYY') }}</td>
                            <td>{{ $k->karya->karya }} </td>
                            <td>{{ $k->status_kurasi }} </td>
                            <td>{{ $k->review ? $k->review : '-' }}</td>
                            <td><a href="{{ url('uploads/' . $k->file_karya) }}" class="btn btn-info">Lihat Karya</a></td>
                            <td>
                                <a href="/inovasi-karya-kurasi/{{ $k->id }}" class="btn btn-success">Kurasi</a>
                                <a href="/inovasi-karya-unkurasi/{{ $k->id }}" class="btn btn-danger">Batal
                                    Kurasi</a>
                                <button class="btn btn-info" onclick="showModal({{ $k->id }})">Review</button>
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
            function showModal(id) {
                $('#exampleModal').modal('show');
                $('#karyaId').val(id);
            }
        </script>

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
