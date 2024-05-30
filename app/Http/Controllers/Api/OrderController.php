<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    //get api orders
    public function index(Request $request)
    {
        return response()->json([
            'message' => 'success',
            'data' => Order::all()
        ], 200);
    }

    // api store to server
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

        return response()->json([
            'message' => 'success',
            'data' => $order
        ]);
    }


    //api update order
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'data_otlets_id' => 'required',
            'stocks_id' => 'required',
            'kode_salesman' => 'required',
            'nama_salesman' => 'required',
            'nama_barang' => 'required',
            'harga_dalam_kota' => 'required',
        ]);

        $order->data_otlets_id = $request->data_otlets_id;
        $order->stocks_id = $request->stocks_id;
        $order->kode_salesman = $request->kode_salesman;
        $order->nama_salesman = $request->nama_salesman;
        $order->nama_barang = $request->nama_barang;
        $order->harga_dalam_kota = $request->harga_dalam_kota;
        $order->save();

        return response()->json([
            'message' => 'success',
            'data' => $order
        ]);
    }

    //api delete order
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return response()->json([
            'message' => 'success',
            'data' => null
        ]);
    }

}