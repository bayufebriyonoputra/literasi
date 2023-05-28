@extends('admin.main')

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
            <span class="text-muted fw-light">Edit</span> Data
            Kerohanian
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
                        <form action="/data_kerohanian/{{ $rohani->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="Agama">Agama</label>
                                <div class="col-sm-10">
                                    <select name="agama" id="Agama" class="form-select" required>
                                        <option value="Islam" {{ $rohani->agama == 'Islam' ? 'selected' : '' }}>Islam
                                        </option>
                                        <option value="Katolik" {{ $rohani->agama == 'Katolik' ? 'selected' : '' }}>Katolik
                                        </option>
                                        <option value="Protestan" {{ $rohani->agama == 'Protestan' ? 'selected' : '' }}>
                                            Protestan</option>
                                        <option value="Budha" {{ $rohani->agama == 'Budha' ? 'selected' : '' }}>Budha
                                        </option>
                                        <option value="Hindhu" {{ $rohani->agama == 'Hindhu' ? 'selected' : '' }}>Hindhu
                                        </option>
                                        <option value="Kong Hu Chu" {{ $rohani->agama == 'Kong Hu Chu' ? 'selected' : '' }}>
                                            Kong
                                            Hu Chu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="Kegiatan">kegiatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('kegiatan') is-invalid @enderror "
                                        id="Kegiatan" name="kegiatan" value="{{ $rohani->kegiatan }}" />
                                    @error('kegiatan')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="Target">Target</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('target') is-invalid @enderror"
                                        id="Target" name="target" value="{{ $rohani->target }}" />
                                    @error('target')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">
                                        Send
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
