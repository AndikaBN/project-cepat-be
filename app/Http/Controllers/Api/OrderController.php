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
        $orders = Order::with('outlet')->get()->map(function ($order) {
            return [
                'id' => $order->id,
                'kode_order' => $order->kode_order,
                'id_outlet' => $order->data_otlets_id,
                'nama_outlet' => $order->outlet->nama_customer,
                'stocks_id' => $order->stocks_id,
                'kode_salesman' => $order->kode_salesman,
                'nama_salesman' => $order->nama_salesman,
                'nama_barang' => $order->nama_barang,
                'harga_dalam_kota' => $order->harga_dalam_kota,
                'quantity' => $order->quantity,
                'status' => $order->status,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
            ];
        });

        return response()->json([
            'message' => 'Status update success',
            'data' => $orders
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
            'status' => 'required',
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
        $order->status = $request->status;
        $order->save();

        return response()->json([
            'message' => 'success',
            'data' => $order
        ], 201);
    }


    //api update order
    public function update(Request $request, $kode_order)
    {
        $request->validate([
            'kode_order' => 'required',
            'status' => 'required',
        ]);

        $orders = Order::where('kode_order', $request->kode_order)->get();

        foreach ($orders as $order) {
            $order->status = $request->status;
            $order->save();
        }

        return response()->json([
            'message' => 'Status update success',
            'data' => $orders
        ], 200);
    }



    //api delete order
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return response()->json([
            'message' => 'success',
        ], 200);
    }

}
