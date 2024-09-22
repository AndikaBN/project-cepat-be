@extends('owner.layouts.app')

@section('title', 'Tagihan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <style>
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

        .sales-button {
            text-align: left;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .list-group-item {
            text-align: left;
        }

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
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tagihan</h1>
                <div class="section-header-button">
                    <a href="{{ route('tagihan.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Tagihan</a></div>
                    <div class="breadcrumb-item">All Tagihan</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Tagihan</h2>

                <!-- Month and Outlet Filter -->
                <form action="{{ route('tagihan.index') }}" method="GET" class="month-filter d-flex align-items-center form-inline">
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

                <!-- Total Tagihan for All Salesmen -->
                @php
                    $totalTagihan = $tagihan->sum('jumlah_tagihan');
                @endphp
                <div class="mb-4 font-weight-bold">
                    Total Tagihan All Sales: Rp. {{ number_format($totalTagihan, 0, ',', '.') }}
                </div>

                <div class="row mt-4">
                    @foreach($tagihan->groupBy('user.name') as $salesman => $salesOrders)
                        <div class="col-12 mb-2">
                            <button class="btn btn-secondary btn-block sales-button" type="button" data-toggle="collapse" data-target="#collapse{{ $loop->index }}" aria-expanded="false" aria-controls="collapse{{ $loop->index }}">
                                {{ $salesman }} ( Rp. {{ number_format($salesOrders->sum('jumlah_tagihan'), 0, ',', '.') }})
                            </button>
                            <div class="collapse" id="collapse{{ $loop->index }}">
                                <ul class="list-group mt-2">
                                    @foreach($salesOrders->groupBy('nama_outlet') as $outletName => $outletOrders)
                                        @php
                                            $outletTotal = $outletOrders->sum('jumlah_tagihan');
                                        @endphp
                                        <li class="list-group-item">
                                             {{ $outletName }} Rp. {{ number_format($outletTotal, 0, ',', '.') }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Add Pagination -->
                <div class="day-pagination-container">
                    <div class="day-pagination">
                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            <a href="{{ route('tagihan.index', ['month' => request('month'), 'year' => request('year'), 'day' => $day]) }}"
                               class="{{ request('day') == $day ? 'active' : '' }}">
                               {{ $day }}
                            </a>
                        @endfor
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
