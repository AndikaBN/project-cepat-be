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


    /*
        'id',
        'stat',
        'bebas_blok',
        'kode',
        'nama_customer',
        'kontak',
        'alamat',
        'daerah',
        'area',
        'telp',
        'keterangan',
        'ktp',
        'npwp',
        'gol',
        'tgl_input',
        'set_harga',
        'area_antaran',
        'area_tagihan',
        'type_customer',
        'limit_kredit',
        'limit_divisi',
        'nama_npwp',
        'alamat_npwp',
    */
    // store
    public function store(Request $request)
    {
        // validate the request...
        $request->validate([
            'stat' => 'required',
            'bebas_blok' => 'required',
            'kode' => 'required',
            'nama_customer' => 'required',
            'kontak' => 'required',
            'alamat' => 'required',
            'daerah' => 'required',
            'area' => 'required',
            'telp' => 'required',
            'keterangan' => 'required',
            // 'ktp' => 'required',
            'npwp' => 'required',
            'gol' => 'required',
            'tgl_input' => 'required',
            'set_harga' => 'required',
            'area_antaran' => 'required',
            'area_tagihan' => 'required',
            'type_customer' => 'required',
            'limit_kredit' => 'required',
            'limit_divisi' => 'required',
            'nama_npwp' => 'required',
            'alamat_npwp' => 'required',
        ]);

        // store the request...
        $dataOtlets = new DataOtlet;
        $dataOtlets->stat = $request->stat;
        $dataOtlets->bebas_blok = $request->bebas_blok;
        $dataOtlets->kode = $request->kode;
        $dataOtlets->nama_customer = $request->nama_customer;
        $dataOtlets->kontak = $request->kontak;
        $dataOtlets->alamat = $request->alamat;
        $dataOtlets->daerah = $request->daerah;
        $dataOtlets->area = $request->area;
        $dataOtlets->telp = $request->telp;
        $dataOtlets->keterangan = $request->keterangan;
        // $dataOtlets->ktp = $request->ktp;
        $dataOtlets->npwp = $request->npwp;
        $dataOtlets->gol = $request->gol;
        $dataOtlets->tgl_input = $request->tgl_input;
        $dataOtlets->set_harga = $request->set_harga;
        $dataOtlets->area_antaran = $request->area_antaran;
        $dataOtlets->area_tagihan = $request->area_tagihan;
        $dataOtlets->type_customer = $request->type_customer;
        $dataOtlets->limit_kredit = $request->limit_kredit;
        $dataOtlets->limit_divisi = $request->limit_divisi;
        $dataOtlets->nama_npwp = $request->nama_npwp;
        $dataOtlets->alamat_npwp = $request->alamat_npwp;
        $dataOtlets->save();

        // save image ktp
        if ($request->hasFile('ktp')) {

            $ktp = $request->file('ktp');
            $ktp->storeAs('public/ktp', $dataOtlets->id . '.' . $ktp->getClientOriginalExtension());
            $dataOtlets->ktp = 'storage/ktp/' . $dataOtlets->id . '.' . $ktp->getClientOriginalExtension();
            $dataOtlets->save();
        }

        return redirect()->route('dataOtlets.index')->with('success', 'Data added successfully');
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
