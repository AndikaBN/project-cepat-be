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
                                        {{--
                                        public function postCheckin(Request $request)
                                        {
                                            $request->validate([
                                                'location_id' => 'required',
                                                'day' => 'required',
                                                'status' => 'required',
                                                'latitude' => 'required',
                                                'longitude' => 'required',
                                                'data_otlets_id' => 'required',
                                                'outlet_name' => 'required',
                                            ]);

                                            $checkin = CheckIn::create([
                                                'location_id' => $request->location_id,
                                                'day' => $request->day,
                                                'status' => $request->status,
                                                'latitude' => $request->latitude,
                                                'longitude' => $request->longitude,
                                                'data_otlets_id' => $request->data_otlets_id,
                                                'outlet_name' => $request->outlet_name,
                                            ]);

                                            return response()->json([
                                                'message' => 'Checkin created',
                                                'data' => $checkin,
                                            ] , 200);
                                        }
                                        --}}
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

                                        @foreach ($checkins as $checkin)
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
                                                    <a href="{{ route('checkins.edit', $checkin->id) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <form action="{{ route('checkins.destroy', $checkin->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <a href="https://www.google.com/maps?q={{ $checkin->latitude }},
                                                        {{ $checkin->longitude }}"
                                                        target="_blank" class="btn btn-primary">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
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
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
