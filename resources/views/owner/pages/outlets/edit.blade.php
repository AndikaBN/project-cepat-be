@extends('owner.layouts.app')

@section('title', 'Outlet')

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
            <h1>Edit Outlet</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Forms</a></div>
                <div class="breadcrumb-item">Outlets</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <form action="{{ route('outlets.update', $outlet->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        <h4>Edit Outlet</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $outlet->name }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <input type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ $outlet->type }}">
                            @error('type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Limit</label>
                            <input type="number" class="form-control @error('limit') is-invalid @enderror" name="limit" value="{{ $outlet->limit }}">
                            @error('limit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Image KTP</label>
                            <input type="file" class="form-control-file" name="image_ktp">
                            @if ($outlet->image_ktp)
                                <img src="{{ asset($outlet->image_ktp) }}" alt="Image KTP" style="max-width: 200px; margin-top: 10px;">
                            @endif
                            @error('image_ktp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Image Outlet</label>
                            <input type="file" class="form-control-file" name="image_outlet">
                            @if ($outlet->image_outlet)
                                <img src="{{ asset($outlet->image_outlet) }}" alt="Image Outlet" style="max-width: 200px; margin-top: 10px;">
                            @endif
                            @error('image_outlet')
                                <div class="text-danger">{{ $message }}</div>
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
