<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\stock;
use App\Imports\StockImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StockExport;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $stocks = DB::table('stocks')
            ->when($search, function ($query) use ($search) {
                $query->where('kode_barang', 'like', '%' . $search . '%')
                    ->orWhere('nama_barang', 'like', '%' . $search . '%')
                    ->orWhere('jenis_barang', 'like', '%' . $search . '%')
                    ->orWhere('divisi', 'like', '%' . $search . '%')
                    ->orWhere('stock', 'like', '%' . $search . '%')
                    ->orWhere('satuan', 'like', '%' . $search . '%')
                    ->orWhere('keterangan_isi_1', 'like', '%' . $search . '%')
                    ->orWhere('keterangan_isi_2', 'like', '%' . $search . '%')
                    ->orWhere('harga_dalam_kota', 'like', '%' . $search . '%');
            })
            ->paginate(10);
        return view('marketings.pages.stocks.index', compact('stocks'));
    }

    //create
    public function create()
    {
        return view('marketings.pages.stocks.create');
    }

    //store
    public function store(Request $request)
    {
        //validate the request...
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

        //store the request...
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
        return redirect()->route('stock.index')->with('success', 'Data added successfully');
    }

    //show
    public function show($id)
    {
        $stock = Stock::findOrFail($id);
        return view('marketings.pages.stocks.index', compact('stock'));
    }

    //edit
    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        return view('marketings.pages.stocks.edit', compact('stock'));
    }

    //update
    public function update(Request $request, $id)
    {
        //validate the request...
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

        //update the request...
        $stock = Stock::find($id);
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

        return redirect()->route('stock.index')->with('success', 'Data updated successfully');
    }

    //import excel
    public function import(Request $request)
    {
        $file = $request->file('file');
        $file_name = $file->getClientOriginalName();
        $file->move('files', $file_name);

        Excel::import(new StockImport, public_path('/files/' . $file_name));

        return redirect()->route('stock.index')->with('success', 'Data imported successfully');
    }

    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('stock.index')->with('success', 'Data deleted successfully');
    }

    public function export()
    {
        $export = Excel::download(new StockExport, 'stocks.xlsx');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('stocks')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return $export;
    }

    public function truncateTable()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('stocks')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->route('stock.index')->with('success', 'All records deleted successfully');
    }
}
