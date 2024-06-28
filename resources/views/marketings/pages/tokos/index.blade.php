@extends('marketings.layouts.app')

@section('title', 'Daftar Toko')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Daftar Toko</h1>
                <div class="section-header-button">
                    <a href="{{ route('toko.create') }}" class="btn btn-primary">Tambah Toko Baru</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Toko</a></div>
                    <div class="breadcrumb-item">Semua Toko</div>
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
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="{{ route('toko.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="search">
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
                                            <th>Nama Toko</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>Area</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($tokos as $toko)
                                            <tr>
                                                <td>{{ $toko->nama_toko }}</td>
                                                <td>{{ $toko->latitude }}</td>
                                                <td>{{ $toko->longitude }}</td>
                                                <td>{{ $toko->area }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('toko.edit', $toko->id) }}"
                                                            class="btn btn-warning mr-2">Edit</a>
                                                        <form action="{{ route('toko.destroy', $toko->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger"
                                                                onclick="return confirm('Are you sure?')">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                        {{-- create pagination --}}
                                        <tr>
                                            <td colspan="5">
                                                {{ $tokos->links() }}
                                            </td>
                                        </tr>
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
