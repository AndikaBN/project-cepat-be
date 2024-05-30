@extends('owner.layouts.app')

@section('title', 'Add Piutang Sales')

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
                <h1>Form Sales</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Sales</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Add Piutang Sales</h2>

                <div class="card">
                    <form action="{{ route('salesPiutang.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Input Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="text" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal') }}">
                                @error('tanggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nomor Nota</label>
                                <input type="text" class="form-control @error('nomor_nota') is-invalid @enderror" name="nomor_nota" value="{{ old('nomor_nota') }}">
                                @error('nomor_nota')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kode Customer</label>
                                <input type="text" class="form-control @error('kode_customer') is-invalid @enderror" name="kode_customer" value="{{ old('kode_customer') }}">
                                @error('kode_customer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Customer</label>
                                <input type="text" class="form-control @error('nama_customer') is-invalid @enderror" name="nama_customer" value="{{ old('nama_customer') }}">
                                @error('nama_customer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Daerah</label>
                                <input type="text" class="form-control @error('daerah') is-invalid @enderror" name="daerah" value="{{ old('daerah') }}">
                                @error('daerah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tagihan</label>
                                <input type="text" class="form-control @error('tagihan') is-invalid @enderror" name="tagihan" value="{{ old('tagihan') }}">
                                @error('tagihan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Antaran</label>
                                <input type="text" class="form-control @error('antaran') is-invalid @enderror" name="antaran" value="{{ old('antaran') }}">
                                @error('antaran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Umur</label>
                                <input type="number" class="form-control @error('umur') is-invalid @enderror" name="umur" value="{{ old('umur') }}">
                                @error('umur')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kode Salesman</label>
                                <input type="text" class="form-control @error('kode_salesman') is-invalid @enderror" name="kode_salesman" value="{{ old('kode_salesman') }}">
                                @error('kode_salesman')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Salesman</label>
                                <input type="text" class="form-control @error('nama_salesman') is-invalid @enderror" name="nama_salesman" value="{{ old('nama_salesman') }}">
                                @error('nama_salesman')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Total Nota</label>
                                <input type="number" step="0.01" class="form-control @error('total_nota') is-invalid @enderror" name="total_nota" value="{{ old('total_nota') }}">
                                @error('total_nota')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Sisa Hutang</label>
                                <input type="number" step="0.01" class="form-control @error('sisa_hutang') is-invalid @enderror" name="sisa_hutang" value="{{ old('sisa_hutang') }}">
                                @error('sisa_hutang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Sisa Hutang by Sales</label>
                                <input type="number" step="0.01" class="form-control @error('sisa_hutang_by_sales') is-invalid @enderror" name="sisa_hutang_by_sales" value="{{ old('sisa_hutang_by_sales') }}">
                                @error('sisa_hutang_by_sales')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Persentase Pemberian Barang</label>
                                <input type="text" class="form-control @error('persentase_pemberian_barang') is-invalid @enderror" name="persentase_pemberian_barang" value="{{ old('persentase_pemberian_barang') }}">
                                @error('persentase_pemberian_barang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
