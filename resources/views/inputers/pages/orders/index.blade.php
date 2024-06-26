@extends('inputers.layouts.app')

@section('title', 'Orders')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Orders</h1>
                {{-- <div class="section-header-button">
                    <a href="{{ route('orders.create') }}" class="btn btn-primary">Add New</a>
                </div> --}}
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


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Posts</h4>
                            </div>
                            <div class="card-body">

                                <div class="float-right">
                                    <form method="GET" action="{{ route('orders.index') }}">
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

                                        <tr>
                                            <th>Kode Order</th>
                                            <th>Kode Salesman</th>
                                            <th>Nama Salesman</th>
                                            <th>Nama Barang</th>
                                            <th>Harga Dalam Kota</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->kode_order }}</td>
                                                <td>{{ $order->kode_salesman }}</td>
                                                <td>{{ $order->nama_salesman }}</td>
                                                @if ($order->stock)
                                                    <td>{{ $order->stock->nama_barang }}</td>
                                                    <td>{{ $order->stock->harga_dalam_kota }}</td>
                                                @else
                                                    <td>Data tidak tersedia</td>
                                                    <td>Data tidak tersedia</td>
                                                @endif
                                                <td>{{ $order->quantity }}</td>
                                                <td>{{ $order->status }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('orders.edit', $order->id) }}'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form action="{{ route('orders.destroy', $order->id) }}"
                                                            method="POST" class="ml-2">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach



                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $orders->withQueryString()->links() }}
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
