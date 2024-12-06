<?php

namespace App\Http\Controllers;

use App\Exports\TokosExport;
use Illuminate\Http\Request;
use App\Models\Toko;
use App\Imports\TokosImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

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
            'latitude' => 'required',
            'longitude' => 'required',
            'nama_toko' => 'required',
            'area' => 'required',
            'daerah' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        $toko = new Toko;
        $toko->nama_toko = $request->nama_toko;
        $toko->latitude = $request->latitude;
        $toko->longitude = $request->longitude;
        $toko->area = $request->area;
        $toko->daerah = $request->daerah;
        $toko->save();

        /* 
        if ($request->hasFile('image_ktp')) {
            $filename = $outlet->id . '_ktp.' . $request->file('image_ktp')->extension();
            $request->file('image_ktp')->move(public_path('img'), $filename);
            $outlet->image_ktp = 'img/' . $filename;
            $outlet->save();
        }
        */
        if ($request->hasFile('image')) {
            $fileme = $toko->id . '_toko.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images'), $fileme);
            $toko->image = 'images/' . $fileme;
            $toko->save();
        }

        return redirect()->route('toko.index')->with('success', 'Toko berhasil ditambahkan.');
    }

    


    public function edit($id)
    {
        $toko = Toko::findOrFail($id);
        return view('marketings.pages.tokos.edit', compact('toko'));
    }

    public function update(Request $request, Toko $toko)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'nama_toko' => 'required',
            'area' => 'required',
            'daerah' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        $toko->nama_toko = $request->nama_toko;
        $toko->latitude = $request->latitude;
        $toko->longitude = $request->longitude;
        $toko->area = $request->area;
        $toko->daerah = $request->daerah;
        $toko->save();

        if ($request->hasFile('image')) {
            if ($toko->image) {
                File::delete(public_path($toko->image));
            }
            $fileme = $toko->id . '_toko.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images'), $fileme);
            $toko->image = 'images/' . $fileme;
            $toko->save();
        }

        return redirect()->route('toko.index')->with('success', 'Toko berhasil diupdate');
    }

    //create method delete
    public function destroy($id)
    {
        $toko = Toko::find($id);
        if ($toko->image) {
            Storage::disk('public')->delete($toko->image);
        }
        $toko->delete();

        return redirect()->route('toko.index')->with('success', 'Toko berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new TokosImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data imported successfully!');
    }

    public function export()
    {
        $export = Excel::download(new TokosExport, 'toko_customer.xlsx');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('tokos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return $export;
    }
}
