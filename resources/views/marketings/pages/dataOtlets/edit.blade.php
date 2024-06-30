@extends('marketings.layouts.app')

@section('title', 'Edit Data Outlet')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data Otlet</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Data Otlet</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Edit Data Otlet</h2>

                <div class="card">
                    <form action="{{ route('dataOtlet.update', $dataOtlets->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <input type="text" class="form-control @error('stat') is-invalid @enderror"
                                            name="stat" value="{{ $dataOtlets->stat }}">
                                        @error('stat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Bebas Blok</label>
                                        <input type="text" class="form-control @error('bebas_blok') is-invalid @enderror"
                                            name="bebas_blok" value="{{ $dataOtlets->bebas_blok }}">
                                        @error('bebas_blok')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Kode</label>
                                        <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                            name="kode" value="{{ $dataOtlets->kode }}">
                                        @error('kode')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Customer</label>
                                        <input type="text"
                                            class="form-control @error('nama_customer') is-invalid @enderror"
                                            name="nama_customer" value="{{ $dataOtlets->nama_customer }}">
                                        @error('nama_customer')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Kontak</label>
                                        <input type="text" class="form-control @error('kontak') is-invalid @enderror"
                                            name="kontak" value="{{ $dataOtlets->kontak }}">
                                        @error('kontak')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            name="alamat" value="{{ $dataOtlets->alamat }}">
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div
                                        class="form-group
                                        @error('daerah') is-invalid @enderror">
                                        <label>Daerah</label>
                                        <input type="text" class="form-control" name="daerah"
                                            value="{{ $dataOtlets->daerah }}">
                                        @error('daerah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div
                                        class="form-group
                                        @error('area') is-invalid @enderror">
                                        <label>Area</label>
                                        <input type="text" class="form-control" name="area"
                                            value="{{ $dataOtlets->area }}">
                                        @error('area')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div
                                        class="form-group
                                        @error('telp') is-invalid @enderror">
                                        <label>Telepon</label>
                                        <input type="text" class="form-control" name="telp"
                                            value="{{ $dataOtlets->telp }}">
                                        @error('telp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div
                                        class="form-group
                                        @error('keterangan') is-invalid @enderror">
                                        <label>Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan"
                                            value="{{ $dataOtlets->keterangan }}">
                                        @error('keterangan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div
                                        class="form-group
                                        @error('npwp') is-invalid @enderror">
                                        <label>NPWP</label>
                                        <input type="text" class="form-control" name="npwp"
                                            value="{{ $dataOtlets->npwp }}">
                                        @error('npwp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div
                                        class="form-group
                                        @error('gol') is-invalid @enderror">
                                        <label>Gol</label>
                                        <input type="text" class="form-control" name="gol"
                                            value="{{ $dataOtlets->gol }}">
                                        @error('gol')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div
                                        class="form-group
                                        @error('tgl_input') is-invalid @enderror">
                                        <label>Tanggal Input</label>
                                        <input type="date" class="form-control" name="tgl_input"
                                            value="{{ $dataOtlets->tgl_input }}">
                                        @error('tgl_input')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div
                                        class="form-group
                                        @error('set_harga') is-invalid @enderror">
                                        <label>Set Harga</label>
                                        <input type="text" class="form-control" name="set_harga"
                                            value="{{ $dataOtlets->set_harga }}">
                                        @error('set_harga')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div
                                        class="form-group
                                        @error('area_antaran') is-invalid @enderror">
                                        <label>Area Antaran</label>
                                        <input type="text" class="form-control" name="area_antaran"
                                            value="{{ $dataOtlets->area_antaran }}">
                                        @error('area_antaran')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div
                                        class="form-group
                                        @error('area_tagihan') is-invalid @enderror">
                                        <label>Area Tagihan</label>
                                        <input type="text" class="form-control" name="area_tagihan"
                                            value="{{ $dataOtlets->area_tagihan }}">
                                        @error('area_tagihan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div
                                        class="form-group
                                        @error('type_customer') is-invalid @enderror">
                                        <label>Type Customer</label>
                                        <input type="text" class="form-control" name="type_customer"
                                            value="{{ $dataOtlets->type_customer }}">
                                        @error('type_customer')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div
                                        class="form-group
                                        @error('limit_kredit') is-invalid @enderror">
                                        <label>Limit Kredit</label>
                                        <input type="text" class="form-control" name="limit_kredit"
                                            value="{{ $dataOtlets->limit_kredit }}">
                                        @error('limit_kredit')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div
                                        class="form-group
                                        @error('limit_divisi') is-invalid @enderror">
                                        <label>Limit Divisi</label>
                                        <input type="text" class="form-control" name="limit_divisi"
                                            value="{{ $dataOtlets->limit_divisi }}">
                                        @error('limit_divisi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div
                                        class="form-group
                                        @error('nama_npwp') is-invalid @enderror">
                                        <label>Nama NPWP</label>
                                        <input type="text" class="form-control" name="nama_npwp"
                                            value="{{ $dataOtlets->nama_npwp }}">
                                        @error('nama_npwp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div
                                        class="form-group
                                        @error('alamat_npwp') is-invalid @enderror">
                                        <label>Alamat NPWP</label>
                                        <input type="text" class="form-control" name="alamat_npwp"
                                            value="{{ $dataOtlets->alamat_npwp }}">
                                        @error('alamat_npwp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Image KTP</label>
                                        <input type="file" class="form-control @error('ktp') is-invalid @enderror"
                                            name="ktp">
                                        @error('ktp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @if ($dataOtlets->ktp)
                                            <img src="{{ asset($dataOtlets->ktp) }}" alt="KTP Image"
                                                class="img-thumbnail mt-2" width="150">
                                        @endif
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <!-- Continue with other form fields -->
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/jquery-selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
@endpush
