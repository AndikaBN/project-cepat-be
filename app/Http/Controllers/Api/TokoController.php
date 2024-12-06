<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Toko;
use Illuminate\Support\Facades\Storage;

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
            'daerah' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048' // validasi untuk gambar
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $toko = Toko::create([
            'nama_toko' => $request->nama_toko,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'area' => $request->area,
            'daerah' => $request->daerah,
            'image' => $imagePath
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
            'daerah' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048' // validasi untuk gambar
        ]);

        $toko = Toko::findOrFail($id);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($toko->image) {
                Storage::disk('public')->delete($toko->image);
            }
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('images', 'public');
            $toko->image = $imagePath;
        }

        $toko->update([
            'nama_toko' => $request->nama_toko,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'area' => $request->area,
            'daerah' => $request->daerah,
            'image' => $toko->image
        ]);

        return response()->json(['success' => 'Toko berhasil diubah.', 'toko' => $toko]);
    }

    //destroy
    public function destroy($id)
    {
        $toko = Toko::findOrFail($id);
        if ($toko->image) {
            Storage::disk('public')->delete($toko->image);
        }
        $toko->delete();

        return response()->json(['success' => 'Toko berhasil dihapus.']);
    }
}
