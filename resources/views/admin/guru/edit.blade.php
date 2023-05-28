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
                <div class="toast-body">Data berhasil diubah</div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit Data Guru</h5>
                </div>
                <div class="card-body">
                    <form action="/admin-guru/{{ $guru->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="Nip">nip</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('nip') is-invalid @enderror" id="Nip"
                                    placeholder="Ex : 324874827" name="nip" value="{{ $guru->nip }}">
                                @error('nip')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="Nama">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="Nama" placeholder="Ex : Bagus Subarjo" name="nama"
                                    value="{{ $guru->nama }}">
                                @error('nama')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">Alamat</label>
                            <div class="col-sm-10">
                                <textarea id="basic-default-message" class="form-control @error('alamat') is-invalid @enderror"
                                    placeholder="Ex : Dsn Jasem RT 05 Rw 02 Kec.Ngoro Kab. Mojokerto" name="alamat" required>{{ $guru->alamat }}</textarea>
                                @error('alamat')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <div class="form-check mt-3">
                                    <input name="jenis_kelamin" class="form-check-input" type="radio" value="L"
                                        id="defaultRadio1" {{ $guru->jenis_kelamin == 'L' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="defaultRadio1"> Laki - Laki </label>
                                </div>
                                <div class="form-check">
                                    <input name="jenis_kelamin" class="form-check-input" type="radio" value="P"
                                        id="defaultRadio2" {{ $guru->jenis_kelamin == 'P' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="defaultRadio2"> Perempuan </label>
                                </div>
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
