@extends('siswa.main')
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
                    <h5 class="mb-0">Tambah Data Kegitan</h5>
                </div>
                <div class="card-body">
                    <form action="/siswa-kegiatan/{{ $kegiatan->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="Tanggal">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    id="Tanggal" name="tanggal"
                                    value="{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('Y-m-d') }}">
                                @error('nip')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="Nama">Nama Kegiatan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror"
                                    id="Nama" placeholder="Ex : Berkunjung" name="nama_kegiatan"
                                    value="{{ $kegiatan->nama_kegiatan }}">
                                @error('nama_kegiatan')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea id="basic-default-message" class="form-control @error('deskripsi') is-invalid @enderror"
                                    placeholder="Ex : Deskripsi Kegiatan..." name="deskripsi" required>{{ $kegiatan->deskripsi }}</textarea>
                                @error('deskripsi')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="Foto">Foto Kegiatan</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                    id="Foto" name="foto">
                                <p class="text-muted">File yang diupload harus foto(*jpg,*jpeg,*png)</p>
                                @error('foto')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>



                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
