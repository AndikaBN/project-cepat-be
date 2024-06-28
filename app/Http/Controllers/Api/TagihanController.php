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
        $tagihan = Tagihan::with('user')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'user_id' => $item->user_id,
                'nama_sales' => $item->user->name,
                'kode_sales' => $item->user->kode_salesman,
                'nama_outlet' => $item->nama_outlet,
                'nomor_nota' => $item->nomor_nota,
                'jumlah_tagihan' => $item->jumlah_tagihan,
                'status'=>$item->status,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return response()->json([
            'message' => 'success',
            'data' => $tagihan
        ], 200);
    }

    //store data tagihan to server
    public function store(Request $request)
    {
        //validate the request...
        $request->validate([
            'nama_outlet' => 'required',
            'nomor_nota' => 'required',
            'jumlah_tagihan' => 'required|numeric',
            'status' => 'required'
        ]);

        //store the request...
        $tagihan = new Tagihan;
        $tagihan->user_id = $request->user_id;
        $tagihan->nama_outlet = $request->nama_outlet;
        $tagihan->nomor_nota = $request->nomor_nota;
        $tagihan->jumlah_tagihan = $request->jumlah_tagihan;
        $tagihan->status = $request->status;
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
            'user_id' => 'required',
            'nama_outlet' => 'required',
            'nomor_nota' => 'required',
            'jumlah_tagihan' => 'required|numeric',
            'status' => 'required'
        ]);

        //store the request...
        $tagihan = Tagihan::find($id);
        $tagihan->user_id = $request->user_id;
        $tagihan->nama_outlet = $request->nama_outlet;
        $tagihan->nomor_nota = $request->nomor_nota;
        $tagihan->jumlah_tagihan = $request->jumlah_tagihan;
        $tagihan->status = $request->status;
        $tagihan->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Tagihan berhasil diupdate'
        ]);
    }

    //delete api tagihan
    public function destroy($id)
    {
        $tagihan = Tagihan::find($id);
        $tagihan->delete();

        return response()->json([
           'message' => 'success',
        ], 200);
    }
}
