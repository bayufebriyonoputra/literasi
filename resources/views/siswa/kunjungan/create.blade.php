@extends('siswa.main')

@section('head')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.all.min.js"></script>
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



        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Modul</span> Kunjungan
        </h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <!-- <h5 class="mb-0">Basic Layout</h5> -->
                        <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                        <form action="/kunjungan" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="basic-default-name" name="tanggal"
                                        required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Kegiatan</label>
                                <div class="col-sm-10">
                                    <select name="tempat_id" id="" class="form-select" required>
                                        @foreach ($tempat as $t)
                                            <option value="{{ $t->id }}">{{ $t->tempat }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="NamaTempat">Nama Tempat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nama_tempat') is-invalid @enderror"
                                        id="NamaTempat" name="nama_tempat" value="{{ old('nama_tempat') }}" required />
                                    @error('nama_tempat')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Profil Pelajar
                                    Pancasila</label>
                                <div class="col-sm-10">
                                    <select name="profil_pelajar_pancasila" id="" class="form-select" required>
                                        <option value="Berkebinekaan GLobal">Berkebinekaan Global</option>
                                        <option value="Bergotong Royong">Bergotong Royong</option>
                                        <option value="Kreatif">Kreatif</option>
                                        <option value="Bernalar Kritis">Bernalar Kritis</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="Beriman, Bertakwa kepada Tuhan YME, dan Berakhlak Mulia">Beriman,
                                            Bertakwa kepada Tuhan YME, dan Berakhlak Mulia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea name="keterangan" id="" rows="3" class="form-control @error('keterangan')is-invalid @enderror"
                                        required>{{ old('keterangan') }}</textarea>
                                        <p class="text-muted">Keterangan harus diisi minimal 50 kata</p>
                                    @error('keterangan')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Hasil Kunjungan</label>
                                <div class="col-sm-10">
                                    <textarea name="hasil_kunjungan" id="" rows="3"
                                        class="form-control @error('hasil_kunjungan')is-invalid @enderror" required>{{ old('hasil_kunjungan') }}</textarea>
                                        <p class="text-muted">Hasil Kunjungan harus diisi minimal 200 kata</p>
                                    @error('hasil_kunjungan')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Upload Foto</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control @error('file_foto')is-invalid @enderror" name="file_foto" required>
                                    <p class="text-muted">file yang diupload adalah foto(*jpg,*jpeg,*png)</p>
                                    @error('file_foto')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
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
