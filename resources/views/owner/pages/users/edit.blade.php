@extends('owner.layouts.app')

@section('title', 'Edit User')

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
                <h1>Advanced Forms</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Users</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Users</h2>

                <div class="card">
                    <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit User</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $user->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $user->email }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                    </div>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password">
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Roles</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="role" value="owner" class="selectgroup-input"
                                            @if ($user->role == 'owner') checked @endif>
                                        <span class="selectgroup-button">Owner</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="role" value="sales" class="selectgroup-input"
                                            @if ($user->role == 'sales') checked @endif>
                                        <span class="selectgroup-button">Sales</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="role" value="kolektor" class="selectgroup-input"
                                            @if ($user->role == 'kolektor') checked @endif>
                                        <span class="selectgroup-button">Kolektor</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="role" value="inputer" class="selectgroup-input"
                                            @if ($user->role == 'inputer') checked @endif>
                                        <span class="selectgroup-button">Inputer</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="role" value="gudang" class="selectgroup-input"
                                            @if ($user->role == 'gudang') checked @endif>
                                        <span class="selectgroup-button">Gudang</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="role" value="marketing" class="selectgroup-input"
                                            @if ($user->role == 'marketing') checked @endif>
                                        <span class="selectgroup-button">Marketing</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kode Salesman</label>
                                <input type="text" class="form-control @error('kode_salesman') is-invalid @enderror"
                                    name="kode_salesman" value="{{ $user->kode_salesman }}">
                                @error('kode_salesman')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control @error('image_url') is-invalid @enderror"
                                    name="image_url">
                                @error('image_url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @if ($user->image_url)
                                    <img src="{{ asset('storage/' . $user->image_url) }}" alt="User Image"
                                        class="img-thumbnail mt-2" width="150">
                                @endif
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
