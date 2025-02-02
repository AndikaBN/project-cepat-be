@extends('owner.layouts.app')

@section('title', 'Check In')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <style>
        .month-filter {
            margin-bottom: 20px;
        }

        .form-inline .form-group {
            margin-bottom: 0;
        }

        .btn-block {
            width: 100%;
            text-align: left;
        }

        .day-pagination-container {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #fff;
            padding: 10px 0;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000; /* Ensure it stays on top */
        }

        .day-pagination {
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .day-pagination a, .day-pagination span {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #007bff;
            text-decoration: none;
            margin: 2px;
        }

        .day-pagination a:hover {
            background-color: #f0f0f0;
        }

        .day-pagination .active {
            background-color: #007bff;
            color: white;
            pointer-events: none;
        }

    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Check In</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Check In</a></div>
                    <div class="breadcrumb-item">All Check In</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Check In</h2>
                <p class="section-lead">
                    Manage all Check-Ins, view maps, and filter by date or search by sales.
                </p>

                <!-- Month and Sales Search Filter -->
                <form action="{{ route('checkins.index') }}" method="GET" class="month-filter d-flex align-items-center form-inline">
                    <div class="form-group mb-0 mr-2">
                        <label for="month" class="sr-only">Filter by Month:</label>
                        <select id="month" name="month" class="form-control">
                            @foreach(range(1, 12) as $m)
                                @php
                                    $monthName = \DateTime::createFromFormat('!m', $m)->format('F');
                                @endphp
                                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                    {{ $monthName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-0 mr-2">
                        <label for="year" class="sr-only">Filter by Year:</label>
                        <select id="year" name="year" class="form-control">
                            @for ($y = date('Y'); $y >= (date('Y') - 10); $y--)
                                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Check In Records</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-left">
                                    <form method="GET" action="{{ route('checkins.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search Sales" name="name" value="{{ request('name') }}">
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
												<th>No</th>
												<th>Nama Sales</th>
												<th>Tanggal</th>
												<th>View Maps</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($checkins as $checkin)
												<tr>
													<td>{{ $loop->iteration }}</td>
													<td>{{ $checkin->user->role === 'sales' ? $checkin->user->name : 'Unknown' }}</td>
													<td>{{ $checkin->date }}</td>
													<td>
														<a href="{{ route('checkins.user.locations', ['userId' => $checkin->user_id, 'date' => $checkin->date]) }}"
														   class="btn btn-primary">View User Check-Ins</a>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
                                </div>

                                <!-- Add Pagination -->
                                <div class="day-pagination-container">
                                    <div class="day-pagination">
                                        @for ($day = 1; $day <= $daysInMonth; $day++)
                                            <a href="{{ route('checkins.index', ['month' => request('month'), 'year' => request('year'), 'day' => $day]) }}"
                                               class="{{ request('day') == $day ? 'active' : '' }}">
                                                {{ $day }}
                                            </a>
                                        @endfor
                                    </div>
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
@endpush
