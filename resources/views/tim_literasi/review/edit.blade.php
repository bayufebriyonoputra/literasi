@extends('tim_literasi.main')

@section('head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="{{ asset('dselect/css/dselect.min.css') }}">
@endsection


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
                    <h5 class="mb-0">Edit Review</h5>
                </div>
                <div class="card-body">
                    <form action="/review-literasi/{{ $review->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="tanggal">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    id="tanggal" placeholder="Ex : 324874827" name="tanggal"
                                    value="{{ \Carbon\Carbon::parse($review->tanggal)->format('Y-m-d') }}" required>
                                @error('tanggal')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">

                            <label for="WaliKelas" class="col-sm-2 col-form-label">Wali Kelas</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="WaliKelas" name="wali_kelas_id" required>
                                    <option value="none">Pilih Salah Satu</option>
                                    @foreach ($walas as $w)
                                        <option value="{{ $w->id }}"
                                            {{ $w->id == $review->wali_kelas_id ? 'selected' : '' }}>{{ $w->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-muted">Jangan Pilih Wali Kelas Jika Review Untuk All</p>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="review">Review</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('review') is-invalid @enderror"
                                    id="review" placeholder="Ex : Membaca Bab I " name="review"
                                    value="{{ $review->review }}" required>
                                @error('review')
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

@section('body-bottom')
    <script src="{{ asset('dselect/js/dselect.min.js') }}"></script>
    <script>
        dselect(document.querySelector('#WaliKelas'), {
            search: true
        })
    </script>
@endsection
