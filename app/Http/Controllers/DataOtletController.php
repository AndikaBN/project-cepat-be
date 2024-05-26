<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataOtlet;
use App\Imports\DataOtletImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataOtletExport;

class DataOtletController extends Controller
{
    // index
    public function index(Request $request)
    {
        $dataOtlets = DB::table('data_otlets')->when($request->input('kode'), function ($query, $kode) {
            $query->where('kode', 'like', '%' . $kode . '%')
                ->orWhere('nama_customer', 'like', '%' . $kode . '%')
                ->orWhere('daerah', 'like', '%' . $kode . '%');
        })->paginate(10);

        return view('marketings.pages.dataOtlets.index', compact('dataOtlets'));
    }

    //show
    public function show($id)
    {
        $dataOtlets = DataOtlet::findOrFail($id);
        return view('marketings.pages.dataOtlets.index', compact('dataOtlets'));
    }

    public function destroy($id)
    {
        $dataOtlets = DataOtlet::findOrFail($id);
        $dataOtlets->delete();

        return redirect()->route('dataOtlets.index')->with('success', 'Data deleted successfully');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $file_name = $file->getClientOriginalName();
        $file->move('files', $file_name);

        Excel::import(new DataOtletImport, public_path('/files/' . $file_name));

        return redirect()->route('dataOtlet.index')->with('success', 'Data imported successfully');
    }

    public function export()
    {
        return Excel::download(new DataOtletExport, 'data_otlets.xlsx');
    }
}
