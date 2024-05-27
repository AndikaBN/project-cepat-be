<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalePiutang;

class SalePiutangController extends Controller
{
    //get api sales piutang
    public function index(Request $request)
    {
        return response()->json([
            'message' => 'success',
            'data' => SalePiutang::all()
        ], 200);
    }

     /*
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
       */

    //send sales piutang to server
    public function store(Request $request)
    {
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

        $salePiutang = new SalePiutang;
        $salePiutang->tanggal = $request->tanggal;
        $salePiutang->nomor_nota = $request->nomor_nota;
        $salePiutang->kode_customer = $request->kode_customer;
        $salePiutang->nama_customer = $request->nama_customer;
        $salePiutang->daerah = $request->daerah;
        $salePiutang->tagihan = $request->tagihan;
        $salePiutang->antaran = $request->antaran;
        $salePiutang->umur = $request->umur;
        $salePiutang->kode_salesman = $request->kode_salesman;
        $salePiutang->nama_salesman = $request->nama_salesman;
        $salePiutang->total_nota = $request->total_nota;
        $salePiutang->sisa_hutang = $request->sisa_hutang;
        $salePiutang->sisa_hutang_by_sales = $request->sisa_hutang_by_sales;
        $salePiutang->persentase_pemberian_barang = $request->persentase_pemberian_barang;
        $salePiutang->save();

        return response()->json([
            'message' => 'success',
            'data' => $salePiutang
        ], 200);
    }

    //update sales piutang
    public function update(Request $request, $id)
    {
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

        $salePiutang = SalePiutang::find($id);
        $salePiutang->tanggal = $request->tanggal;
        $salePiutang->nomor_nota = $request->nomor_nota;
        $salePiutang->kode_customer = $request->kode_customer;
        $salePiutang->nama_customer = $request->nama_customer;
        $salePiutang->daerah = $request->daerah;
        $salePiutang->tagihan = $request->tagihan;
        $salePiutang->antaran = $request->antaran;
        $salePiutang->umur = $request->umur;
        $salePiutang->kode_salesman = $request->kode_salesman;
        $salePiutang->nama_salesman = $request->nama_salesman;
        $salePiutang->total_nota = $request->total_nota;
        $salePiutang->sisa_hutang = $request->sisa_hutang;
        $salePiutang->sisa_hutang_by_sales = $request->sisa_hutang_by_sales;
        $salePiutang->persentase_pemberian_barang = $request->persentase_pemberian_barang;
        $salePiutang->save();

        return response()->json([
            'message' => 'success',
            'data' => $salePiutang
        ], 200);
    }

    //delete sales piutang
    public function destroy($id)
    {
        $salePiutang = SalePiutang::find($id);
        $salePiutang->delete();

        return response()->json([
            'message' => 'success',
            'data' => $salePiutang
        ], 200);
    }

    //show sales piutang
    public function show($id)
    {
        $salePiutang = SalePiutang::find($id);

        return response()->json([
            'message' => 'success',
            'data' => $salePiutang
        ], 200);
    }
}
