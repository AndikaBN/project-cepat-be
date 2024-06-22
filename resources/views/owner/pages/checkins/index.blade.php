@extends('owner.layouts.app')

@section('title', 'Check In')

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
                    <div class="breadcrumb-item"><a href="#">Check In</a></div>
                    <div class="breadcrumb-item">All Check In</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('owner.layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Check In</h2>
                <p class="section-lead">
                    You can manage all Check In, such as editing, deleting and more.
                </p>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Posts</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-left">

                                </div>
                                <div class="float-right">
                                    <form method="GET" action="{{ route('checkins.index') }}">
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

                                        <thead>
                                            <tr>
                                                <th>Nama Sales</th>
                                                <th>Location ID</th>
                                                <th>Day</th>
                                                <th>Status</th>
                                                <th>Latitude</th>
                                                <th>Longitude</th>
                                                <th>Outlet ID</th>
                                                <th>Outlet Name</th>
                                                <th>Action</th>
                                                <th>View Maps</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                                $previousUser = null;
                                            @endphp

                                            @foreach ($checkins as $checkin)
                                                @if (!$previousUser || $checkin->user->name !== $previousUser)
                                                    <tr>
                                                        <td>{{ $checkin->user ? $checkin->user->name : 'Unknown' }}</td>
                                                        <td>{{ $checkin->location_id }}</td>
                                                        <td>{{ $checkin->day }}</td>
                                                        <td>{{ $checkin->status }}</td>
                                                        <td>{{ $checkin->latitude }}</td>
                                                        <td>{{ $checkin->longitude }}</td>
                                                        <td>{{ $checkin->data_otlets->id }}</td>
                                                        <td>{{ $checkin->data_otlets->nama_customer }}</td>
                                                        <td>
                                                            <form action="{{ route('checkins.destroy', $checkin->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger"
                                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('checkins.user.locations', $checkin->user_id) }}"
                                                                class="btn btn-primary">View User Check-Ins</a>
                                                        </td>
                                                    </tr>
                                                @endif

                                                @php
                                                    $previousUser = $checkin->user->name;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $checkins->withQueryString()->links() }}
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
