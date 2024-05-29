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


    /*
            $table->string('kode_order');
            $table->foreignId('outlets_id')->constrained('outlets');
            $table->foreignId('stocks_id')->constrained('stocks');
            $table->string('kode_salesman');
            $table->string('nama_salesman');
            $table->string('nama_barang');
            $table->string('harga_dalam_kota');
            $table->string('quantity');
        */
    //send order to server
    public function store(Request $request)
    {
        $request->validate([
            'sale_piutang_id' => 'required',
            'stocks_id' => 'required',
            'kode_salesman' => 'required',
            'nama_salesman' => 'required',
            'nama_barang' => 'required',
            'harga_dalam_kota' => 'required',
        ]);

        $order = new Order;
        $order->sale_piutang_id = $request->sale_piutang_id;
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

    //api update order
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'sale_piutang_id' => 'required',
            'stocks_id' => 'required',
            'kode_salesman' => 'required',
            'nama_salesman' => 'required',
            'nama_barang' => 'required',
            'harga_dalam_kota' => 'required',
        ]);

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
