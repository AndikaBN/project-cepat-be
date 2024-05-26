<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Stock;
use App\Imports\StockImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StockExport;

class StockController extends Controller
{
    /*
 $table->id();
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('jenis_barang');
            $table->string('divisi');
            $table->string('stock');
            $table->string('satuan');
            $table->string('keterangan_isi_1');
            $table->string('keterangan_isi_2');
            $table->string('harga_dalam_kota');
            $table->timestamps();
    */
    public function index(Request $request)
    {
        //get all stocks with pagination
        $stocks = DB::table('stocks')
            ->when($request->input('kode_barang'), function ($query, $kode_barang) {
                $query->where('kode_barang', 'like', '%' . $kode_barang . '%')
                    ->orWhere('nama_barang', 'like', '%' . $kode_barang . '%');
            })
            ->paginate(10);
        return view('marketings.pages.stocks.index', compact('stocks'));
    }

    //show
    public function show($id)
    {
        $stock = Stock::findOrFail($id);
        return view('marketings.pages.stocks.index', compact('stock'));
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

        return redirect()->route('stocks.index')->with('success', 'Data deleted successfully');
    }

    public function export()
    {
        return Excel::download(new StockExport, 'stocks.xlsx');
    }
}
