@extends('owner.layouts.app')

@section('title', 'Add Order')

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
                <h1>Form Order</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Order</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Orders</h2>

                <div class="card">
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Input Order Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Kode Order</label>
                                <input type="text" class="form-control @error('kode_order') is-invalid @enderror"
                                       name="kode_order" value="{{ old('kode_order') }}" required>
                                @error('kode_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Data Outlets ID</label>
                                <input type="number" class="form-control @error('data_otlets_id') is-invalid @enderror"
                                       name="data_otlets_id" value="{{ old('data_otlets_id') }}" required>
                                @error('data_otlets_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Stocks ID</label>
                                <input type="number" class="form-control @error('stocks_id') is-invalid @enderror"
                                       name="stocks_id" value="{{ old('stocks_id') }}" required>
                                @error('stocks_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Kode Salesman</label>
                                <input type="text" class="form-control @error('kode_salesman') is-invalid @enderror"
                                       name="kode_salesman" value="{{ old('kode_salesman') }}" required>
                                @error('kode_salesman')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nama Salesman</label>
                                <input type="text" class="form-control @error('nama_salesman') is-invalid @enderror"
                                       name="nama_salesman" value="{{ old('nama_salesman') }}" required>
                                @error('nama_salesman')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                                       name="nama_barang" value="{{ old('nama_barang') }}" required>
                                @error('nama_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Harga dalam Kota</label>
                                <input type="number" class="form-control @error('harga_dalam_kota') is-invalid @enderror"
                                       name="harga_dalam_kota" value="{{ old('harga_dalam_kota') }}" required>
                                @error('harga_dalam_kota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                       name="quantity" value="{{ old('quantity') }}" required>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control @error('status') is-invalid @enderror"
                                        name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
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
    <!-- Script Libraries -->
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
@endpush
