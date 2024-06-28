<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;

class TokoController extends Controller
{
    //index
    public function index(Request $request)
    {

        $tokos = Toko::paginate(10);
        return view('marketings.pages.tokos.index', compact('tokos'));
    }

    //create
    public function create()
    {
        return view('marketings.pages.tokos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'area' => 'required|string|max:255',
        ]);

        Toko::create([
            'nama_toko' => $request->nama_toko,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'area' => $request->area,
        ]);

        return redirect()->route('toko.index')->with('success', 'Toko berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $toko = Toko::findOrFail($id);
        return view('marketings.pages.tokos.edit', compact('toko'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_toko' =>'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'area' => 'required|string|max:255',
        ]);

        $toko = Toko::find($id);
        $toko->nama_toko = $request->nama_toko;
        $toko->latitude = $request->latitude;
        $toko->longitude = $request->longitude;
        $toko->area = $request->area;
        $toko->save();

        return redirect()->route('toko.index')->with('success', 'Toko berhasil diubah.');
    }

    //create method delete
    public function destroy($id)
    {
        $toko = Toko::find($id);
        $toko->delete();

        return redirect()->route('toko.index')->with('success', 'Toko berhasil dihapus.');
    }


}
