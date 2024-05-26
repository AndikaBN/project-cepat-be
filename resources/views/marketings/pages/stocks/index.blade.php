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
                                    <a href="{{ route('stock.export') }}" class="btn btn-primary">Export Data</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="float-left">
                                    <select class="form-control selectric">
                                        <option>Action For Selected</option>
                                        <option>Move to Draft</option>
                                        <option>Move to Pending</option>
                                        <option>Delete Pemanently</option>
                                    </select>
                                </div>
                                {{-- create button export --}}

                                <div class="float-right">
                                    <form method="GET" action="{{ route('stock.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
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
                                            {{-- <th>Action</th> --}}
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
                                                        {{-- <form
                                                            action="{{ route('salesPiutang.destroy', $piutangSales->id) }}"
                                                            method="POST" class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form> --}}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                        {{-- create pagination --}}
                                        <tr>
                                            <td colspan="9">
                                                {{ $stocks->links() }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                {{-- create form import --}}
                                <div class="float-right">
                                    <form method="POST" action="{{ route('stock.import') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="file">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-upload"></i>
                                                    Import</button>
                                            </div>
                                        </div>
                                    </form>
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
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
