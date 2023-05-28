@extends('siswa.main')

@section('head')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.all.min.js"></script>
@endsection


@section('content')
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


    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Edit</span> Unggah Karya
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
                        <form action="/unggah_karya/{{ $unggah->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="basic-default-name" name="tanggal"
                                        value="{{ \Carbon\Carbon::parse($unggah->tanggal)->format('Y-m-d') }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Jenis Karya</label>
                                <div class="col-sm-10">
                                    <select name="karya_id" id="" class="form-select">
                                        @foreach ($karya as $k)
                                            <option value="{{ $k->id }}"
                                                {{ $unggah->karya_id == $k->id ? 'selected' : '' }}>{{ $k->karya }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Unggah Karya</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="basic-default-name" name="file_karya" />
                                    <p class="text-muted">File yang diupload harus type .pdf</p>
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
