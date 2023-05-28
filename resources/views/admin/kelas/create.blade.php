@extends('admin.main')
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
                <div class="toast-body">Data berhasil ditambahkan</div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Tambah Data Kelas</h5>
                </div>
                <div class="card-body">
                    <form action="/admin-kelas" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="Tingkat">Tingkat</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control @error('tingkat') is-invalid @enderror"
                                    id="Tingkat" placeholder="Ex : 1" name="tingkat" value="{{ old('tingkat') }}">
                                @error('tingkat')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="NamaKelas">Nama Kelas</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror"
                                    id="NamaKelas" placeholder="Ex : A" name="nama_kelas" value="{{ old('nama_kelas') }}">
                                @error('nama_kelas')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>



                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
