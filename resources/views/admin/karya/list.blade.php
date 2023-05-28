@extends('admin.main')

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
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data &nbsp;</span>Karya</h4>

        <div class="table-responsive text-nowrap">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>karya</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($karya as $t)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $t->karya }}</td>
                            <td>
                                <a href="/karya/{{ $t->id }}/edit" class="btn btn-warning"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <form action="/karya/{{ $t->id }}" class="d-inline" method="POST">
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
                $('#table').DataTable();
            });
        </script>
    @endsection
