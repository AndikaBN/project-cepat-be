@extends('marketings.layouts.app')

@section('title', 'Edit Data Stock')

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
                <h1>Edit Data Stock</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Data Stock</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Edit Data Stock</h2>

                <div class="card">
                    <form action="{{ route('stock.update', $stock->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Kode Barang</label>
                                <input type="text" class="form-control @error('kode_barang') is-invalid @enderror"
                                    name="kode_barang" value="{{ $stock->kode_barang }}">
                                @error('kode_barang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                                    name="nama_barang" value="{{ $stock->nama_barang }}">
                                @error('nama_barang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jenis Barang</label>
                                <input type="text" class="form-control @error('jenis_barang') is-invalid @enderror"
                                    name="jenis_barang" value="{{ $stock->jenis_barang }}">
                                @error('jenis_barang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Divisi</label>
                                <input type="text" class="form-control @error('divisi') is-invalid @enderror"
                                    name="divisi" value="{{ $stock->divisi }}">
                                @error('divisi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="text" class="form-control @error('stock') is-invalid @enderror"
                                    name="stock" value="{{ $stock->stock }}">
                                @error('stock')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Satuan</label>
                                <input type="text" class="form-control @error('satuan') is-invalid @enderror"
                                    name="satuan" value="{{ $stock->satuan }}">
                                @error('satuan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Keterangan Isi 1</label>
                                <input type="text" class="form-control @error('keterangan_isi_1') is-invalid @enderror"
                                    name="keterangan_isi_1" value="{{ $stock->keterangan_isi_1 }}">
                                @error('keterangan_isi_1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Keterangan Isi 2</label>
                                <input type="text" class="form-control @error('keterangan_isi_2') is-invalid @enderror"
                                    name="keterangan_isi_2" value="{{ $stock->keterangan_isi_2 }}">
                                @error('keterangan_isi_2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Harga Dalam Kota</label>
                                <input type="text" class="form-control @error('harga_dalam_kota') is-invalid @enderror"
                                    name="harga_dalam_kota" value="{{ $stock->harga_dalam_kota }}">
                                @error('harga_dalam_kota')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
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

