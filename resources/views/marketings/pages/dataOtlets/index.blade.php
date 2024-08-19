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
                <div class="section-header-button">
                    <a href="{{ route('dataOtlet.create') }}" class="btn btn-primary">Add New</a>
                </div>
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
                                    <a href="{{ route('dataOtlet.truncate') }}" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete all records?')">Delete All
                                        Data</a>
                                </div>
                            </div>
                            <div class="card-body">

                                {{-- create button export --}}

                                <div class="float-right">
                                    <form method="GET" action="{{ route('dataOtlet.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="search">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="float-right" style="margin-right: 10px">
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
                                            <th>Action</th>
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

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('dataOtlet.edit', $dataOtlet->id) }}'
                                                            class="btn btn-sm btn-info btn-icon ml-2">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        {{-- create button delete --}}
                                                        {{-- <form action="{{ route('dataOtlet.destroy', $dataOtlet->id) }}"
                                                            method="POST" class="ml-2">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form> --}}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>

                                {{-- create form import --}}
                                
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
