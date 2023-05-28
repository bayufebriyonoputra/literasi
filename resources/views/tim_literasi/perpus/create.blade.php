@extends('perpustakaan.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Modul</span> Input Resensi Buku
        </h4>

        <div class="bs-toast toast toast-placement-ex m-2 fade bg-primary position-fixed bottom-0 end-0 p-3 {{ session('success') ? 'show' : 'hide' }}"
            role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Suksess</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">Data berhasil ditambahkan</div>
        </div>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <!-- <h5 class="mb-0">Basic Layout</h5> -->
                        <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                        <form action="/perpustakaan" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">ISBN</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-name" name="isbn" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-name" name="judul" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Pengarang</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-name" name="pengarang" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Penerbit</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-name" name="penerbit" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Tahun Terbit</label>
                                <div class="col-sm-10">
                                    <input type="number" min="1900" max="2099" step="1" class="form-control"
                                        id="basic-default-name" name="tahun_terbit" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Referensi/Sinopsis</label>
                                <div class="col-sm-10">
                                    <textarea rows="3" class="form-control" name="sinopsis"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Cover Buku</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control @error('cover_buku') is-invalid @enderror"
                                        name="cover_buku">
                                    @error('cover_buku')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Upload Buku</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control @error('file_buku') is-invalid @enderror"
                                        name="file_buku">
                                    <p class="text-muted">Jenis file yang bisa diupload adalah foto (*jpg, *jpeg, *png)</p>
                                    @error('file_buku')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">
                                        Kirim
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
