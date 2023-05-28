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
            <span class="text-muted fw-light">Edit</span> Kunjungan
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
                        <form action="/kunjungan/{{ $kunjungan->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="basic-default-name" name="tanggal"
                                        value="{{ \Carbon\Carbon::parse($kunjungan->tanggal)->format('Y-m-d') }}"
                                        required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Kegiatan</label>
                                <div class="col-sm-10">
                                    <select name="tempat_id" id="" class="form-select" required>
                                        @foreach ($tempat as $t)
                                            <option value="{{ $t->id }}"
                                                {{ $t->id == $kunjungan->tempat_id ? 'selected' : '' }}>{{ $t->tempat }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="NamaTempat">Nama Tempat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nama_tempat') is-invalid @enderror"
                                        id="NamaTempat" name="nama_tempat" value="{{ $kunjungan->nama_tempat }}" required />
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
                                        <option value="Berkebinekaan GLobal"
                                            {{ $kunjungan->profil_pelajar_pancasila == 'Berkebinekaan GLobal' ? 'selected' : '' }}>
                                            Berkebinekaan Global</option>
                                        <option value="Bergotong Royong"
                                            {{ $kunjungan->profil_pelajar_pancasila == 'Bergotong Royong' ? 'selected' : '' }}>
                                            Bergotong Royong</option>
                                        <option value="Kreatif"
                                            {{ $kunjungan->profil_pelajar_pancasila == 'Kreatif' ? 'selected' : '' }}>
                                            Kreatif</option>
                                        <option value="Bernalar Kritis"
                                            {{ $kunjungan->profil_pelajar_pancasila == 'Bernalar Kritis' ? 'selected' : '' }}>
                                            Bernalar Kritis</option>
                                        <option value="Mandiri"
                                            {{ $kunjungan->profil_pelajar_pancasila == 'Mandiri' ? 'selected' : '' }}>
                                            Mandiri</option>
                                        <option value="Beriman, Bertakwa kepada Tuhan YME, dan Berakhlak Mulia"
                                            {{ $kunjungan->profil_pelajar_pancasila == 'Beriman, Bertakwa kepada Tuhan YME, dan Berakhlak Mulia' ? 'selected' : '' }}>
                                            Beriman,
                                            Bertakwa kepada Tuhan YME, dan Berakhlak Mulia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea name="keterangan" id="" rows="3" class="form-control @error('keterangan')is-invalid @enderror"
                                        required>{{ $kunjungan->keterangan }}</textarea>
                                    @error('keterangan')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Hasil Kunjungan</label>
                                <div class="col-sm-10">
                                    <textarea name="hasil_kunjungan" id="" rows="3"
                                        class="form-control @error('hasil_kunjungan')is-invalid @enderror" required>{{ $kunjungan->hasil_kunjungan }}</textarea>
                                    @error('hasil_kunjungan')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Upload Foto</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="file_foto">
                                    <p class="text-muted">file yang diupload adalah foto(*jpg,*jpeg,*png)</p>
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
