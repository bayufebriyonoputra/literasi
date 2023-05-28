@extends('admin.main')

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
        {{-- Modal --}}
        <div class="mt-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary my-4" data-bs-toggle="modal" data-bs-target="#modalCenter">
                Tambah Wali Kelas
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Tambahkan Wali Kelas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/admin-walas" method="POST">
                            @csrf
                            <div class="modal-body">

                                {{-- guru --}}
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="selectWalas" class="form-label">Wali Kelas</label>
                                        <select class="form-control" id="selectWalas" name="guru_id">
                                            @foreach ($guru as $g)
                                                <option value="{{ $g->id }}">{{ $g->nip . ' - ' . $g->nama }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                {{-- Kelas --}}
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Kelas" class="form-label">Kelas</label>
                                        <select class="form-control" id="Kelas" name="kelas_id">
                                            @foreach ($kelas as $k)
                                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                {{-- Tahun Pelajaran --}}
                                <div class="row g-2">
                                    <div class="col mb-0">
                                        <label for="TahunPelajaran" class="form-label">Tahun Pelajaran</label>
                                        <input type="text" id="TahunPelajaran" class="form-control"
                                            placeholder="Ex : 2021/2022" name="tahun_pelajaran" required>
                                    </div>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kelas</th>
                    <th>Guru</th>
                    <th>Tahun Pelajaran</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($walas as $w)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $w->kelas->nama_kelas }}</td>
                        <td>{{ $w->guru->nama }}</td>
                        <td>{{ $w->tahun_pelajaran }}</td>
                        <td>
                            <form action="/admin-walas/{{ $w->id }}" class="d-inline" method="POST">
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
