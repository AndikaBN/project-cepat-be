@extends('marketings.layouts.app')

@section('title', 'Stock MAD')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Stock MAD</h1>
                <div class="section-header-button">
                    <a href="{{ route('stock.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Stock MAD</a></div>
                    <div class="breadcrumb-item">All Stock MAD</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('marketings.layouts.alert')
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Posts</h4>
                                <div class="float-right">
                                    <a href="{{ route('stock.export') }}" class="btn btn-primary mr-2">Export Data</a>
                                    <a href="{{ route('stocks.truncate') }}" class="btn btn-danger"
                                       onclick="return confirm('Are you sure you want to delete all records?')">Delete All Data</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="{{ route('stock.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="search">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="float-right" style="margin-right: 10px">
                                    <form method="POST" action="{{ route('stock.import') }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="file">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-upload"></i> Import
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Divisi</th>
                                            <th>Stok</th>
                                            <th>Satuan</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($stocks as $stock)
                                            <tr>
                                                <td>{{ $stock->kode_barang }}</td>
                                                <td>{{ $stock->nama_barang }}</td>
                                                <td>{{ $stock->jenis_barang }}</td>
                                                <td>{{ $stock->divisi }}</td>
                                                <td>{{ $stock->stock }}</td>
                                                <td>{{ $stock->satuan }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('stock.edit', $stock->id) }}"
                                                           class="btn btn-warning mr-2">Edit</a>
                                                        <form action="{{ route('stock.destroy', $stock->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger"
                                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
