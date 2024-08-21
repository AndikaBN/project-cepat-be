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
        $orders = Order::with('stock')
            ->when($request->input('kode_order'), function ($query, $kode_order) {
                $query->where('kode_order', 'like', '%' . $kode_order . '%')
                    ->orWhere('data_otlets_id', 'like', '%' . $kode_order . '%')
                    ->orWhere('stocks_id', 'like', '%' . $kode_order . '%')
                    ->orWhere('kode_salesman', 'like', '%' . $kode_order . '%')
                    ->orWhere('nama_salesman', 'like', '%' . $kode_order . '%')
                ;
            })
            ->paginate(10);
        return view('inputers.pages.orders.index', compact('orders'));
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
