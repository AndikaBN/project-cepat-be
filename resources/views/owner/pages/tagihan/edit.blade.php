@extends('owner.layouts.app')

@section('title', 'Tagihan')

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
            <h1>Edit Tagihan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Forms</a></div>
                <div class="breadcrumb-item">Outlets</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <form action="{{ route('tagihan.update', $tagihan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        <h4>Edit Tagihan</h4>
                    </div>

                    {{--
                    'nama_outlet',
                    'nomor_nota',
                    'jumlah_tagihan',
                    create form edti for tagihan
                    --}}
                    <div class="card-body">
                        <div class="form-group
                            <label for="nama_outlet">Nama Outlet</label>
                            <input type="text" id="nama_outlet" name="nama_outlet" class="form-control" value="{{ $tagihan->nama_outlet }}" required>
                        </div>
                        <div class="form-group
                            <label for="nomor_nota">Nomor Nota</label>
                            <input type="text" id="nomor_nota" name="nomor_nota" class="form-control" value="{{ $tagihan->nomor_nota }}" required>
                        </div>
                        <div class="form-group
                            <label for="jumlah_tagihan">Jumlah Tagihan</label>
                            <input type="text" id="jumlah_tagihan" name="jumlah_tagihan" class="form-control" value="{{ $tagihan->jumlah_tagihan }}" required>
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
