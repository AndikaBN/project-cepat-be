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

    public function truncate()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('sale_piutangs')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->route('salesPiutang.index')->with('success', 'Semua data telah dihapus');
    }
    public function index(Request $request)
    {
        $search = $request->input('search');

        $piutangSales = DB::table('sale_piutangs')
            ->when($search, function ($query, $search) {
                $query->where('kode_customer', 'like', '%' . $search . '%')
                    ->orWhere('nama_customer', 'like', '%' . $search . '%')
                    ->orWhere('daerah', 'like', '%' . $search . '%')
                    ->orWhere('tagihan', 'like', '%' . $search . '%')
                    ->orWhere('antaran', 'like', '%' . $search . '%')
                    ->orWhere('umur', 'like', '%' . $search . '%')
                    ->orWhere('kode_salesman', 'like', '%' . $search . '%')
                    ->orWhere('nama_salesman', 'like', '%' . $search . '%');
            })
            ->get();

        return view('owner.pages.sales.index', compact('piutangSales'));
    }

    //create
    public function create()
    {
        return view('owner.pages.sales.create');
    }

    /*
    public function up(): void
    {
        Schema::create('sale_piutangs', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->string('nomor_nota');
            $table->string('kode_customer');
            $table->string('nama_customer');
            $table->string('daerah');
            $table->string('tagihan');
            $table->string('antaran');
            $table->integer('umur');
            $table->string('kode_salesman');
            $table->string('nama_salesman');
            $table->decimal('total_nota', 15, 2);
            $table->decimal('sisa_hutang', 15, 2);
            $table->decimal('sisa_hutang_by_sales', 15, 2);
            $table->string('persentase_pemberian_barang');
            $table->timestamps();
        });
    }
    */
    //store
    public function store(Request $request)
    {
        //validate the request...
        $request->validate([
            'tanggal' => 'required',
            'nomor_nota' => 'required',
            'kode_customer' => 'required',
            'nama_customer' => 'required',
            'daerah' => 'required',
            'tagihan' => 'required',
            'antaran' => 'required',
            'umur' => 'required',
            'kode_salesman' => 'required',
            'nama_salesman' => 'required',
            'total_nota' => 'required',
            'sisa_hutang' => 'required',
            'sisa_hutang_by_sales' => 'required',
            'persentase_pemberian_barang' => 'required',
        ]);

        //store the request...
        $piutangSales = new SalePiutang;
        $piutangSales->tanggal = $request->tanggal;
        $piutangSales->nomor_nota = $request->nomor_nota;
        $piutangSales->kode_customer = $request->kode_customer;
        $piutangSales->nama_customer = $request->nama_customer;
        $piutangSales->daerah = $request->daerah;
        $piutangSales->tagihan = $request->tagihan;
        $piutangSales->antaran = $request->antaran;
        $piutangSales->umur = $request->umur;
        $piutangSales->kode_salesman = $request->kode_salesman;
        $piutangSales->nama_salesman = $request->nama_salesman;
        $piutangSales->total_nota = $request->total_nota;
        $piutangSales->sisa_hutang = $request->sisa_hutang;
        $piutangSales->sisa_hutang_by_sales = $request->sisa_hutang_by_sales;
        $piutangSales->persentase_pemberian_barang = $request->persentase_pemberian_barang;
        $piutangSales->save();

        return redirect()->route('salesPiutang.index')->with('success', 'Data added successfully');
    }

    //edit
    public function edit($id)
    {
        $piutangSales = SalePiutang::findOrFail($id);
        return view('owner.pages.sales.edit', compact('piutangSales'));
    }

    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|string',
            'nomor_nota' => 'required|string',
            'kode_customer' => 'required|string',
            'nama_customer' => 'required|string',
            'daerah' => 'required|string',
            'tagihan' => 'required|string',
            'antaran' => 'required|string',
            'umur' => 'required|integer',
            'kode_salesman' => 'required|string',
            'nama_salesman' => 'required|string',
            'total_nota' => 'required|numeric',
            'sisa_hutang' => 'required|numeric',
            'sisa_hutang_by_sales' => 'required|numeric',
            'persentase_pemberian_barang' => 'required|string',
        ]);

        $piutangSale = SalePiutang::findOrFail($id);
        $piutangSale->update($request->all());

        return redirect()->route('salesPiutang.index')->with('success', 'Piutang Sales updated successfully');
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
        $export = Excel::download(new SalePiutangExport, 'piutang_sales.xlsx');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('sale_piutangs')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return $export;
    }
}
