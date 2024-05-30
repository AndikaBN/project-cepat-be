@extends('marketings.layouts.app')

@section('title', 'Add Data Outlet')

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
                <h1>Form Data Otlet</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Data Otlet</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Add Data Otlet</h2>

                <div class="card">
                    <form action="{{ route('dataOtlet.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>Input Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control @error('stat') is-invalid @enderror"
                                    name="stat" value="{{ old('stat') }}">
                                @error('stat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Bebas Blok</label>
                                <input type="text" class="form-control @error('bebas_blok') is-invalid @enderror"
                                    name="bebas_blok" value="{{ old('bebas_blok') }}">
                                @error('bebas_blok')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kode</label>
                                <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                    name="kode" value="{{ old('kode') }}">
                                @error('kode')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Customer</label>
                                <input type="text" class="form-control @error('nama_customer') is-invalid @enderror"
                                    name="nama_customer" value="{{ old('nama_customer') }}">
                                @error('nama_customer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kontak</label>
                                <input type="text" class="form-control @error('kontak') is-invalid @enderror"
                                    name="kontak" value="{{ old('kontak') }}">
                                @error('kontak')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    name="alamat" value="{{ old('alamat') }}">
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Daerah</label>
                                <input type="text" class="form-control @error('daerah') is-invalid @enderror"
                                    name="daerah" value="{{ old('daerah') }}">
                                @error('daerah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Area</label>
                                <input type="text" class="form-control @error('area') is-invalid @enderror"
                                    name="area" value="{{ old('area') }}">
                                @error('area')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Telepon</label>
                                <input type="text" class="form-control @error('telp') is-invalid @enderror"
                                    name="telp" value="{{ old('telp') }}">
                                @error('telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                    name="keterangan" value="{{ old('keterangan') }}">
                                @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>NPWP</label>
                                <input type="text" class="form-control @error('npwp') is-invalid @enderror"
                                    name="npwp" value="{{ old('npwp') }}">
                                @error('npwp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Gol</label>
                                <input type="text" class="form-control @error('gol') is-invalid @enderror"
                                    name="gol" value="{{ old('gol') }}">
                                @error('gol')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tanggal Input</label>
                                <input type="text" class="form-control @error('tgl_input') is-invalid @enderror"
                                    name="tgl_input" value="{{ old('tgl_input') }}">
                                @error('tgl_input')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Set Harga</label>
                                <input type="text" class="form-control @error('set_harga') is-invalid @enderror"
                                    name="set_harga" value="{{ old('set_harga') }}">
                                @error('set_harga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Area Antaran</label>
                                <input type="text" class="form-control @error('area_antaran') is-invalid @enderror"
                                    name="area_antaran" value="{{ old('area_antaran') }}">
                                @error('area_antaran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Area Tagihan</label>
                                <input type="text" class="form-control @error('area_tagihan') is-invalid @enderror"
                                    name="area_tagihan" value="{{ old('area_tagihan') }}">
                                @error('area_tagihan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Type Customer</label>
                                <input type="text" class="form-control @error('type_customer') is-invalid @enderror"
                                    name="type_customer" value="{{ old('type_customer') }}">
                                @error('type_customer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Limit Kredit</label>
                                <input type="text" class="form-control @error('limit_kredit') is-invalid @enderror"
                                    name="limit_kredit" value="{{ old('limit_kredit') }}">
                                @error('limit_kredit')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Limit Divisi</label>
                                <input type="text" class="form-control @error('limit_divisi') is-invalid @enderror"
                                    name="limit_divisi" value="{{ old('limit_divisi') }}">
                                @error('limit_divisi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama NPWP</label>
                                <input type="text" class="form-control @error('nama_npwp') is-invalid @enderror"
                                    name="nama_npwp" value="{{ old('nama_npwp') }}">
                                @error('nama_npwp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Alamat NPWP</label>
                                <input type="text" class="form-control @error('alamat_npwp') is-invalid @enderror"
                                    name="alamat_npwp" value="{{ old('alamat_npwp') }}">
                                @error('alamat_npwp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="ktp">KTP</label>
                                <input type="file" class="form-control-file @error('ktp') is-invalid @enderror"
                                    name="ktp" id="ktp">
                                @error('ktp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
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
