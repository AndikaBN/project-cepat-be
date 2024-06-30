<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OutletController extends Controller
{
    // get all outlets
    public function index()
    {
        return response()->json([
            'message' => 'success',
            'data' => Outlet::all()
        ]);
    }

    // send outlet to server
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'no_telp' => 'required',
            'type' => 'required',
            'limit' => 'required',
        ]);

        $outlet = new Outlet;
        $outlet->user_id = $request->user_id;
        $outlet->name = $request->name;
        $outlet->no_telp = $request->no_telp;
        $outlet->type = $request->type;
        $outlet->limit = $request->limit;
        $outlet->save();

        // Simpan gambar KTP dan gambar outlet
        if ($request->hasFile('image_ktp')) {
            $filename = $outlet->id . '_ktp.' . $request->file('image_ktp')->extension();
            $request->file('image_ktp')->move(public_path('img'), $filename);
            $outlet->image_ktp = 'img/' . $filename;
        }

        if ($request->hasFile('image_outlet')) {
             $filename = $outlet->id . '_outlet.' . $request->file('image_outlet')->extension();
            $request->file('image_outlet')->move(public_path('img'), $filename);
            $outlet->image_outlet = 'img/' . $filename;
        }

        $outlet->save();

        return response()->json([
            'message' => 'success',
            'data' => $outlet
        ]);
    }

}
