<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class OrderController extends Controller
{
    //index
    public function index(Request $request)
{
    // Ambil tahun dan bulan dari input atau gunakan tahun dan bulan saat ini
    $year = $request->input('year', now()->year);
    $month = $request->input('month', now()->month);
    $daysInMonth = \Carbon\Carbon::create($year, $month)->daysInMonth;

    // Query dengan filter nama customer dan kode order
    $orders = Order::with('outlet', 'stock')
        ->when($request->input('kode_order'), function ($query, $kode_order) {
            $query->where('kode_order', 'like', '%' . $kode_order . '%')
                  ->orWhere('data_otlets_id', 'like', '%' . $kode_order . '%');
        })
        ->when($request->input('day'), function ($query, $day) use ($month, $year) {
            $query->whereYear('created_at', $year)
                  ->whereMonth('created_at', $month)
                  ->whereDay('created_at', $day);
        }, function ($query) use ($month, $year) {
            $query->whereYear('created_at', $year)
                  ->whereMonth('created_at', $month);
        })
        ->get();

    // Hitung total pembelian per customer
    $customerTotals = $orders->groupBy('data_otlets_id')->map(function ($orders) {
        return $orders->sum(function ($order) {
            // Ensure harga_dalam_kota and quantity are numeric
            $hargaDalamKota = floatval($order->harga_dalam_kota);
            $quantity = floatval($order->quantity);

            return $hargaDalamKota * $quantity; // Total amount per order
        });
    });

    // Hitung total pembelian per salesman
    $totalPurchasePerSalesman = [];
    foreach ($orders->groupBy('nama_salesman') as $salesman => $salesOrders) {
        $totalPurchasePerSalesman[$salesman] = $salesOrders->groupBy('data_otlets_id')->map(function ($customerOrders) use ($customerTotals) {
            return $customerTotals->get($customerOrders->first()->data_otlets_id, 0);
        })->sum();
    }

    // Hitung total purchase amount keseluruhan
    $totalPurchaseAmount = array_sum($totalPurchasePerSalesman);

    return view('inputers.pages.orders.index', compact('orders', 'daysInMonth', 'month', 'year', 'customerTotals', 'totalPurchasePerSalesman', 'totalPurchaseAmount'));
}




    public function create()
    {
        $stock = DB::table('stocks')->get();
        return view('inputers.pages.orders.create', compact('stock'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_order' => 'required',
            'data_otlets_id' => 'required',
            'stocks_id' => 'required',
            'kode_salesman' => 'required',
            'nama_salesman' => 'required',
            'nama_barang' => 'required',
            'harga_dalam_kota' => 'required',
            'quantity' => 'required',
        ]);

        $order = new Order;
        $order->kode_order = $request->kode_order;
        $order->data_otlets_id = $request->data_otlets_id;
        $order->stocks_id = $request->stocks_id;
        $order->kode_salesman = $request->kode_salesman;
        $order->nama_salesman = $request->nama_salesman;
        $order->nama_barang = $request->nama_barang;
        $order->harga_dalam_kota = $request->harga_dalam_kota;
        $order->quantity = $request->quantity;
        $order->save();

        return redirect()->route('orders.index');
    }

    public function show($id)
    {
        $order = Order::with('stock')->find($id);
        return view('order.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('inputers.pages.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'kode_order' => 'required',
            'data_otlets_id' => 'required',
            'stocks_id' => 'required',
            'kode_salesman' => 'required',
            'nama_salesman' => 'required',
            'nama_barang' => 'required',
            'harga_dalam_kota' => 'required',
            'quantity' => 'required',
        ]);

        $order->kode_order = $request->kode_order;
        $order->data_otlets_id = $request->data_otlets_id;
        $order->stocks_id = $request->stocks_id;
        $order->kode_salesman = $request->kode_salesman;
        $order->nama_salesman = $request->nama_salesman;
        $order->nama_barang = $request->nama_barang;
        $order->harga_dalam_kota = $request->harga_dalam_kota;
        $order->quantity = $request->quantity;
        $order->save();

        return redirect()->route('orders.index');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index');
    }
}