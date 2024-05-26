@extends('marketings.layouts.app')

@section('title', 'Data Otlet')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Otlet</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Data Otlet</a></div>
                    <div class="breadcrumb-item">All Data Otlet</div>
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
                                    <a href="{{ route('dataOtlet.export') }}" class="btn btn-primary">Export Data</a>
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
                                    <form method="GET" action="{{ route('dataOtlet.index') }}">
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
                                            <th>Stat</th>
                                            <th>Bebas Blok</th>
                                            <th>Kode</th>
                                            <th>Nama Customer</th>
                                            <th>Kontak</th>
                                            <th>Alamat</th>
                                            <th>Daerah</th>
                                            <th>Area</th>
                                            <th>Telepon</th>
                                            <th>KTP</th>
                                            <th>NPWP</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                        @foreach ($dataOtlets as $dataOtlet)
                                            <tr>
                                                <td>{{ $dataOtlet->stat }}</td>
                                                <td>{{ $dataOtlet->bebas_blok }}</td>
                                                <td>{{ $dataOtlet->kode }}</td>
                                                <td>{{ $dataOtlet->nama_customer }}</td>
                                                <td>{{ $dataOtlet->kontak }}</td>
                                                <td>{{ $dataOtlet->alamat }}</td>
                                                <td>{{ $dataOtlet->daerah }}</td>
                                                <td>{{ $dataOtlet->area }}</td>
                                                <td>{{ $dataOtlet->telp }}</td>
                                                <td>{{ $dataOtlet->ktp }}</td>
                                                <td>{{ $dataOtlet->npwp }}</td>
                                                {{-- <td>

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
                                                {{ $dataOtlets->links() }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                {{-- create form import --}}
                                <div class="float-right">
                                    <form method="POST" action="{{ route('dataOtlet.import') }}"
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
