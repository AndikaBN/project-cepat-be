<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Toko;


class TokoController extends Controller
{
    //index
    public function index()
    {
        $tokos = Toko::all();
        return response()->json($tokos);
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'area' => 'required|string|max:255',
        ]);

        $toko = Toko::create([
            'nama_toko' => $request->nama_toko,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'area' => $request->area,
        ]);

        return response()->json(['success' => 'Toko berhasil ditambahkan.', 'toko' => $toko], 201);
    }

    //show
    public function show($id)
    {
        $toko = Toko::findOrFail($id);
        return response()->json($toko);
    }

    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'area' => 'required|string|max:255',
        ]);

        $toko = Toko::findOrFail($id);
        $toko->update([
            'nama_toko' => $request->nama_toko,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'area' => $request->area,
        ]);

        return response()->json(['success' => 'Toko berhasil diubah.', 'toko' => $toko]);
    }

    //destroy
    public function destroy($id)
    {
        $toko = Toko::findOrFail($id);
        $toko->delete();

        return response()->json(['success' => 'Toko berhasil dihapus.']);
    }
}
