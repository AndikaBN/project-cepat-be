<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    //get tagihan
    public function getTagihan()
    {
        return response()->json([
            'status' => 'success',
            'data' => Tagihan::all()
        ]);
    }

    //store data tagihan to server
    public function store(Request $request)
    {
        //validate the request...
        $request->validate([
            'nama_outlet' => 'required',
            'nomor_nota' => 'required',
            'jumlah_tagihan' => 'required|numeric',
        ]);

        //store the request...
        $tagihan = new Tagihan;
        $tagihan->user_id = auth()->user()->id;
        $tagihan->nama_outlet = $request->nama_outlet;
        $tagihan->nomor_nota = $request->nomor_nota;
        $tagihan->jumlah_tagihan = $request->jumlah_tagihan;
        $tagihan->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Tagihan berhasil dikirim'
        ]);
    }

    //update api tagihan
    public function update(Request $request, $id)
    {
        //validate the request...
        $request->validate([
            'nama_outlet' => 'required',
            'nomor_nota' => 'required',
            'jumlah_tagihan' => 'required|numeric',
        ]);

        //store the request...
        $tagihan = Tagihan::find($id);
        $tagihan->user_id = auth()->user()->id;
        $tagihan->nama_outlet = $request->nama_outlet;
        $tagihan->nomor_nota = $request->nomor_nota;
        $tagihan->jumlah_tagihan = $request->jumlah_tagihan;
        $tagihan->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Tagihan berhasil diupdate'
        ]);
    }

}
