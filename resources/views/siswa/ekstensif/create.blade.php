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
            <span class="text-muted fw-light">Modul</span> Pembiasaan
            Ektensif
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
                        <form action="/ekstensif" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="Tanggal">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                        id="Tanggal" name="tanggal" value="{{ old('tanggal') }}" required />
                                    @error('tanggal')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="Durasi">Durasi (Menit)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('durasi') is-invalid @enderror "
                                        id="Durasi" name="durasi" value="{{ old('durasi') }}" />
                                    @error('durasi')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="ISBN">ISBN</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('isbn') is-invalid @enderror"
                                        id="ISBN" name="isbn" value="{{ old('isbn') }}" />
                                    @error('isbn')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="JudulBuku">Judul Buku</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('judul_buku') is-invalid @enderror"
                                        id="JudulBuku" name="judul_buku" value="{{ old('judul_buku') }}" />
                                    @error('judul_buku')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="JumlahHalaman">Halaman Yang Dibaca</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('jumlah_halaman') is-invalid @enderror"
                                        id="JumlahHalaman" name="jumlah_halaman" value="{{ old('jumlah_halaman') }}"
                                        placeholder="Contoh : 1-12" required />
                                    @error('jumlah_halaman')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="Rangkuman">Rangkuman</label>
                                <div class="col-sm-10">
                                    <textarea name="rangkuman" id="" rows="3" class="form-control @error('rangkuman') is-invalid @enderror">{{ old('rangkuman') }}</textarea>
                                    @error('rangkuman')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <p class="text-muted">Minimal diisi 50 kata</p>
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
