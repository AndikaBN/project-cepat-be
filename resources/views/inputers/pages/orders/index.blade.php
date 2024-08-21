@extends('inputers.layouts.app')

@section('title', 'Orders')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <style>
        .card {
            background-color: #F5E1FF;
            border-radius: 10px;
            border: none;
            margin-bottom: 15px;
        }

        .card-body {
            padding: 15px;
        }

        .btn-primary {
            background-color: #8A2BE2;
            border-color: #8A2BE2;
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
                <div class="row">
                    <div class="col-12">
                        @include('inputers.layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Orders</h2>
                <p class="section-lead">
                    You can manage all Orders, such as editing, deleting and more.
                </p>

                <div class="row">
                    <div class="col-12">
                        <form method="GET" action="{{ route('orders.index') }}">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search by Kode Order" name="kode_order" value="{{ request('kode_order') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row mt-4">
                    @foreach ($orders as $order)
                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Salesman: {{ $order->nama_salesman }}</h5>
                                    <p class="card-text">Kode Order: {{ $order->kode_order }}</p>
                                    <p class="card-text">Kode Salesman: {{ $order->kode_salesman }}</p>
                                    @if ($order->stock)
                                        <p class="card-text">Nama Barang: {{ $order->stock->nama_barang }}</p>
                                        <p class="card-text">Harga Dalam Kota: {{ $order->stock->harga_dalam_kota }}</p>
                                    @else
                                        <p class="card-text">Nama Barang: Data tidak tersedia</p>
                                        <p class="card-text">Harga Dalam Kota: Data tidak tersedia</p>
                                    @endif
                                    <p class="card-text">Jumlah Barang: {{ $order->quantity }}</p>
                                    <p class="card-text">Tanggal Order: {{ $order->created_at->format('d M, Y') }}</p>
                                    <p class="card-text">Status: {{ $order->status }}</p>
                                    <button class="btn btn-primary btn-sm" onclick="markAsDone({{ $order->id }})">Selesai</button>
                                    {{-- buton delete --}}
                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus order ini?')">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="float-right">
                    {{ $orders->withQueryString()->links() }}
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
    <script>
        function markAsDone(orderId) {
            alert('Order ' + orderId + ' ditandai sebagai selesai.');
        }
    </script>
@endpush
