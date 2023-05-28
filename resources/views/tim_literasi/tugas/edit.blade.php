@extends('tim_literasi.main')

@section('head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="{{ asset('dselect/css/dselect.min.css') }}">
@endsection


@section('content')
    <div class="container">
        <div class="col-xxl">

            <div class="bs-toast toast toast-placement-ex m-2 fade bg-primary position-fixed bottom-0 end-0 p-3 {{ session('success') ? 'show' : 'hide' }}"
                role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
                <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Suksess</div>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">Data berhasil diubah</div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit Tugas Literasi</h5>
                </div>
                <div class="card-body">
                    <form action="/tugas-literasi/{{ $tugas->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="tanggal">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    id="tanggal" placeholder="Ex : 324874827" name="tanggal"
                                    value="{{ \Carbon\Carbon::parse($tugas->tanggal)->format('Y-m-d') }}" required>
                                @error('tanggal')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">

                            <label for="Kelas" class="col-sm-2 col-form-label">Kelas</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="Kelas" name="kelas_id" required>
                                    <option value="all" {{ $tugas->tingkat == 'all' ? 'selected' : '' }}>Semua Kelas
                                    </option>
                                    @foreach ($tingkat as $t)
                                        <option value="Tingkat {{ $t }}"
                                            {{ $tugas->tingkat == 'Tingkat ' . $t ? 'selected' : '' }}>Tingkat :
                                            {{ $t }}</option>
                                    @endforeach
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->id }}"
                                            {{ $tugas->kelas_id == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="tugas">Tugas</label>
                            <div class="col-sm-10">
                                <textarea name="tugas" rows="3" class="form-control @error('tugas') is-invalid @enderror" required>{{ $tugas->tugas }}</textarea>

                                @error('tugas')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="Keterangan">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                    id="Keterangan" placeholder="Ex : Senin 07.55 - 08.00 " name="keterangan"
                                    value="{{ $tugas->keterangan }}" required>
                                @error('keterangan')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-company">Jenis Tugas</label>
                            <div class="col-sm-10">
                                <select name="jenis_tugas" id="" class="form-select" required>
                                    <option value="Ekstensif" {{ $tugas->jenis_tugas == 'Ekstensif' ? 'selected' : '' }}>
                                        Ekstensif</option>
                                    <option value="Kerohanian" {{ $tugas->jenis_tugas == 'Kerohanian' ? 'selected' : '' }}>
                                        Kerohanian</option>
                                    <option value="Kunjungan" {{ $tugas->jenis_tugas == 'Kunjungan' ? 'selected' : '' }}>
                                        Kunjungan</option>
                                    <option value="UKBI" {{ $tugas->jenis_tugas == 'UKBI' ? 'selected' : '' }}>UKBI
                                    </option>
                                    <option value="Karya" {{ $tugas->jenis_tugas == 'Karya' ? 'selected' : '' }}>Karya
                                    </option>
                                </select>
                            </div>
                        </div>


                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body-bottom')
    <script src="{{ asset('dselect/js/dselect.min.js') }}"></script>
    <script>
        dselect(document.querySelector('#Kelas'), {
            search: true
        })
    </script>
@endsection
