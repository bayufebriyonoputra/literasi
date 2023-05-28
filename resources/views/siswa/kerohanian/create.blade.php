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
                        <form action="/kerohanian" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="basic-default-name" name="tanggal"
                                        required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Durasi</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="basic-default-name" name="durasi"
                                        required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Agama</label>
                                <div class="col-sm-10">
                                    <select name="agama" id="agama" class="form-select" required>
                                        <option disabled selected>Pilih Salah Satu</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Protestan">Protestan</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Hindhu">Hindhu</option>
                                        <option value="Kong Hu Chu">Kong Hu Chu</option>
                                    </select>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">kegiatan</label>
                                <div class="col-sm-10">
                                    <select name="data_kerohanian_id" id="kegiatan" class="form-select" required>
                                        <option value="" disabled selected>Pilih Salah Satu</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Laporan Kegiatan</label>
                                <div class="col-sm-10">
                                    <textarea name="laporan_kegiatan" id="" rows="3" class="form-control"></textarea>
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

@section('body-bottom')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script>
        function onChangeSelect(url, agama, name) {

            // send ajax request to get the cities of the selected province and append to the select tag
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    agama: agama
                },
                success: function(data) {
                    $('#' + name).empty();
                    $('#' + name).append('<option disabled selected >Pilih Salah Satu</option>');
                    $.each(data, function(key, value) {
                        $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
        $(function() {
            $('#agama').on('change', function() {
                onChangeSelect('{{ route('kegiatan') }}', $(this).val(), 'kegiatan');
            });

        });
    </script>
@endsection
