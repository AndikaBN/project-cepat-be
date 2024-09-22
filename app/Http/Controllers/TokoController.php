<?php

namespace App\Http\Controllers;

use App\Exports\TokosExport;
use Illuminate\Http\Request;
use App\Models\Toko;
use App\Imports\TokosImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
            'daerah' => 'required|string|max:255'
        ]);

        Toko::create([
            'nama_toko' => $request->nama_toko,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'area' => $request->area,
            'daerah' => $request->daerah,
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
            'nama_toko' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'area' => 'required|string|max:255',
            'daerah' => 'required|string|max:255',
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
