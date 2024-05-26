@extends('owner.layouts.app')

@section('title', 'Piutang Sales')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Check in</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Piutang Sales</a></div>
                    <div class="breadcrumb-item">All Piutang Sales</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('owner.layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Piutang Sales</h2>
                <p class="section-lead">
                    You can manage all Piutang Sales, such as editing, deleting and more.
                </p>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Posts</h4>
                                <div class="float-right">
                                    <a href="{{ route('salesPiutang.export') }}" class="btn btn-primary">Export Data</a>
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
                                    <form method="GET" action="{{ route('salesPiutang.index') }}">
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
                                            <th>Tanggal</th>
                                            <th>Kode Customer</th>
                                            <th>Nama Customer</th>
                                            <th>Daerah</th>
                                            <th>Tagihan</th>
                                            <th>Antaran</th>
                                            <th>Umur</th>
                                            <th>Kode Salesman</th>
                                            <th>Nama Salesman</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                        @foreach ($piutangSales as $piutangSale)
                                            <tr>
                                                <td>{{ $piutangSale->tanggal }}</td>
                                                <td>{{ $piutangSale->kode_customer }}</td>

                                                <td>
                                                    {{ $piutangSale->nama_customer }}
                                                </td>
                                                <td>
                                                    {{ $piutangSale->daerah }}
                                                </td>
                                                <td>
                                                    {{ $piutangSale->tagihan }}
                                                </td>
                                                <td>
                                                    {{ $piutangSale->antaran }}
                                                </td>
                                                <td>
                                                    {{ $piutangSale->umur }}
                                                </td>
                                                <td>
                                                    {{ $piutangSale->kode_salesman }}
                                                </td>
                                                <td>
                                                    {{ $piutangSale->nama_salesman }}
                                                </td>

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
                                                {{ $piutangSales->links() }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                {{-- create form import --}}
                                <div class="float-right">
                                    <form method="POST" action="{{ route('salesPiutang.import') }}"
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
