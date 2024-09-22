@extends('inputers.layouts.app')

@section('title', 'Orders')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <style>
        /* Your existing styles */
        .text-black-custom {
            color: #000 !important;
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
        .dropdown-menu-item {
            border-bottom: 1px solid #ddd;
        }
        .total-purchase {
            font-weight: bold;
            font-size: 1.2rem;
            margin-top: 20px;
        }
        .total-sales-per-salesman {
            font-weight: bold;
            font-size: 1.1rem;
            margin-top: 10px;
        }
    </style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Orders</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Orders</a></div>
                <div class="breadcrumb-item">All Orders</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Orders</h2>

            <form method="GET" action="{{ route('orders.index') }}" class="month-filter d-flex align-items-center form-inline">
                <div class="form-group mb-0 mr-2">
                    <select name="year" class="form-control selectric">
                        @for ($y = date('Y'); $y >= (date('Y') - 10); $y--)
                            <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="form-group mb-0 mr-2">
                    <select name="month" class="form-control selectric">
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                            </option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>

            <!-- Display total purchase amount -->
            <div class="total-purchase">
                Total Purchase Amount: Rp{{ number_format($totalPurchaseAmount, 0, ',', '.') }}
            </div>

            <div class="row mt-4">
                @foreach($totalPurchasePerSalesman as $salesman => $totalSalesman)
                    <div class="col-12 mb-2">
                        @php
                            $kode_salesman = $orders->where('nama_salesman', $salesman)->first()->kode_salesman ?? 'N/A';
                        @endphp
                        <button class="btn btn-secondary btn-block sales-button" type="button" data-toggle="collapse" data-target="#collapse{{ $loop->index }}" aria-expanded="false" aria-controls="collapse{{ $loop->index }}">
                            {{ $salesman }} ({{ $kode_salesman }}) (Rp{{ number_format($totalSalesman, 0, ',', '.') }})
                        </button>
                        <div class="collapse" id="collapse{{ $loop->index }}">
                            <ul class="list-group mt-2">
                                @foreach($orders->where('nama_salesman', $salesman)->groupBy('data_otlets_id') as $customerId => $customerOrders)
                                    @php
                                        $totalPurchase = $customerTotals->get($customerId, 0);
                                    @endphp
                                    @foreach($customerOrders->groupBy('outlet.nama_customer') as $customerName => $customerOrderGroup)
                                        <li class="list-group-item">
                                            <button class="btn btn-link text-dark" type="button" data-toggle="collapse" data-target="#orderCollapse{{ $loop->parent->index }}-{{ $loop->index }}" aria-expanded="false" aria-controls="orderCollapse{{ $loop->parent->index }}-{{ $loop->index }}">
                                                {{ $customerName }} (Rp{{ number_format($totalPurchase, 0, ',', '.') }})
                                            </button>
                                            <div class="collapse" id="orderCollapse{{ $loop->parent->index }}-{{ $loop->index }}">
                                                <ul class="list-group mt-2">
                                                    @foreach($customerOrderGroup as $order)
                                                        <li class="list-group-item dropdown-menu-item">
                                                            {{ $order->stock->nama_barang ?? 'N/A' }} (Qty: {{ $order->quantity }}) - Status: {{ $order->status }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                    @endforeach
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
                        <a href="{{ route('orders.index', ['year' => $year, 'month' => request('month'), 'day' => $day]) }}"
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
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
