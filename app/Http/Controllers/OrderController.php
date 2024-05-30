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
        $orders = DB::table('orders')
            ->when($request->input('kode_order'), function ($query, $kode_order) {
                $query->where('kode_order', 'like', '%' . $kode_order . '%')
                    ->orWhere('data_otlets_id', 'like', '%' . $kode_order . '%');
            })
            ->paginate(10);
        return view('inputers.pages.orders.index', compact('orders'));
    }

    //create
    public function create()
    {
        return view('inputers.pages.orders.create');
    }

    //store
    public function store(Request $request)
    {
        //validate the request...
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

        //store the request...
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

    //edit
    public function edit(Order $order)
    {
        return view('inputers.pages.orders.edit', compact('orders'));
    }

    //update
    public function update(Request $request, Order $order)
    {
        //validate the request...
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

        //update the request...
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

    //destroy
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index');
    }
}
