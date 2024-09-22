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
                                <div class="float-left"></div>
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
                                                <th>Tanggal</th>
                                                <th>View Maps</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($checkins as $checkin)
                                                <tr>
                                                    <td>{{ $checkin->user->role === 'sales' ? $checkin->user->name : 'Unknown' }}
                                                    </td>
                                                    <td>{{ $checkin->date }}</td>
                                                    <td>
                                                        <a href="{{ route('checkins.user.locations', ['userId' => $checkin->user_id, 'date' => $checkin->date]) }}"
                                                            class="btn btn-primary">View User Check-Ins</a>
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>
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
