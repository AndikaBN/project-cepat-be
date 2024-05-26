<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalePiutang;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalePiutangExport;
use App\Imports\SalePiutangImport;


class SalePiutangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $piutangSales = DB::table('sale_piutangs')->when($request->input('kode_customer'), function ($query, $kode_customer) {
            $query->where('kode_customer', 'like', '%' . $kode_customer . '%')
                ->orWhere('nama_customer', 'like', '%' . $kode_customer . '%')
                ->orWhere('daerah', 'like', '%' . $kode_customer . '%');
        })->when($request->input('tagihan'), function ($query, $tagihan) {
            $query->where('tagihan', 'like', '%' . $tagihan . '%');
        })->when($request->input('antaran'), function ($query, $antaran) {
            $query->where('antaran', 'like', '%' . $antaran . '%');
        })->when($request->input('umur'), function ($query, $umur) {
            $query->where('umur', 'like', '%' . $umur . '%');
        })->when($request->input('kode_salesman'), function ($query, $kode_salesman) {
            $query->where('kode_salesman', 'like', '%' . $kode_salesman . '%')
                ->orWhere('nama_salesman', 'like', '%' . $kode_salesman . '%');
        })->paginate(10);

        return view('owner.pages.sales.index', compact('piutangSales'));
    }

    //show
    public function show($id)
    {
        $piutangSales = SalePiutang::findOrFail($id);
        return view('owner.pages.sales.index', compact('piutangSales'));
    }
       public function destroy($id)
    {
        $piutangSales = SalePiutang::findOrFail($id);
        $piutangSales->delete();

        return redirect()->route('salesPiutang.index')->with('success', 'Data deleted successfully');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $file_name = $file->getClientOriginalName();
        $file->move('files', $file_name);

        Excel::import(new SalePiutangImport, public_path('/files/' . $file_name));

        return redirect()->route('salesPiutang.index')->with('success', 'Data imported successfully');
    }

    public function export()
    {
        return Excel::download(new SalePiutangExport, 'sales.xlsx');
    }
}

