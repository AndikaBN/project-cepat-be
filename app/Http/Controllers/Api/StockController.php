<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;

class StockController extends Controller
{
    //api get all stocks
    public function index()
    {
        return response()->json([
            'message' => 'success',
            'data' => Stock::all()
        ]);
    }

    //api send stock to server
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            'divisi' => 'required',
            'stock' => 'required',
            'satuan' => 'required',
            'keterangan_isi_1' => 'required',
            'keterangan_isi_2' => 'required',
            'harga_dalam_kota' => 'required',
        ]);

        $stock = new Stock;
        $stock->kode_barang = $request->kode_barang;
        $stock->nama_barang = $request->nama_barang;
        $stock->jenis_barang = $request->jenis_barang;
        $stock->divisi = $request->divisi;
        $stock->stock = $request->stock;
        $stock->satuan = $request->satuan;
        $stock->keterangan_isi_1 = $request->keterangan_isi_1;
        $stock->keterangan_isi_2 = $request->keterangan_isi_2;
        $stock->harga_dalam_kota = $request->harga_dalam_kota;
        $stock->save();

        return response()->json([
            'message' => 'success',
            'data' => $stock
        ]);
    }

    //api update stock
    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            'divisi' => 'required',
            'stock' => 'required',
            'satuan' => 'required',
            'keterangan_isi_1' => 'required',
            'keterangan_isi_2' => 'required',
            'harga_dalam_kota' => 'required',
        ]);

        $stock->kode_barang = $request->kode_barang;
        $stock->nama_barang = $request->nama_barang;
        $stock->jenis_barang = $request->jenis_barang;
        $stock->divisi = $request->divisi;
        $stock->stock = $request->stock;
        $stock->satuan = $request->satuan;
        $stock->keterangan_isi_1 = $request->keterangan_isi_1;
        $stock->keterangan_isi_2 = $request->keterangan_isi_2;
        $stock->harga_dalam_kota = $request->harga_dalam_kota;
        $stock->save();

        return response()->json([
            'message' => 'success',
            'data' => $stock
        ], 200);
    }

    //api delete stock
    public function destroy(Stock $stock)
    {
        $stock->delete();

        return response()->json([
            'message' => 'success',
            'data' => null
        ], 200);
    }
}
