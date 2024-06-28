<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataOtlet;
use Illuminate\Http\Request;

class DataOtletController extends Controller
{
    //get api data otlet
    public function index()
    {
        return response()->json([
            'message' => 'success',
            'data' => DataOtlet::all()
        ]);
    }

    //send data otlet to server
    public function store(Request $request)
    {
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

        $dataOtlet = new DataOtlet;
        $dataOtlet->stat = $request->stat;
        $dataOtlet->bebas_blok = $request->bebas_blok;
        $dataOtlet->kode = $request->kode;
        $dataOtlet->nama_customer = $request->nama_customer;
        $dataOtlet->kontak = $request->kontak;
        $dataOtlet->alamat = $request->alamat;
        $dataOtlet->daerah = $request->daerah;
        $dataOtlet->area = $request->area;
        $dataOtlet->telp = $request->telp;
        $dataOtlet->keterangan = $request->keterangan;
        $dataOtlet->npwp = $request->npwp;
        $dataOtlet->gol = $request->gol;
        $dataOtlet->tgl_input = $request->tgl_input;
        $dataOtlet->set_harga = $request->set_harga;
        $dataOtlet->area_antaran = $request->area_antaran;
        $dataOtlet->area_tagihan = $request->area_tagihan;
        $dataOtlet->type_customer = $request->type_customer;
        $dataOtlet->limit_kredit = $request->limit_kredit;
        $dataOtlet->limit_divisi = $request->limit_divisi;
        $dataOtlet->nama_npwp = $request->nama_npwp;
        $dataOtlet->alamat_npwp = $request->alamat_npwp;
        $dataOtlet->save();

        // Menyimpan gambar KTP
        if ($request->hasFile('ktp')) {
            $ktp = $request->file('ktp');
            $ktpName = time() . '.' . $ktp->getClientOriginalExtension();
            $ktp->move(public_path('img/ktp'), $ktpName);
            $dataOtlet->ktp = 'img/ktp/' . $ktpName;
            $dataOtlet->save();
        }

        return response()->json([
            'message' => 'success',
            'data' => $dataOtlet
        ]);
    }

    //update data otlet
    public function update(Request $request, $id)
    {
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

        $dataOtlet = DataOtlet::find($id);
        $dataOtlet->stat = $request->stat;
        $dataOtlet->bebas_blok = $request->bebas_blok;
        $dataOtlet->kode = $request->kode;
        $dataOtlet->nama_customer = $request->nama_customer;
        $dataOtlet->kontak = $request->kontak;
        $dataOtlet->alamat = $request->alamat;
        $dataOtlet->daerah = $request->daerah;
        $dataOtlet->area = $request->area;
        $dataOtlet->telp = $request->telp;
        $dataOtlet->keterangan = $request->keterangan;
        // $dataOtlet->ktp = $request->ktp;
        $dataOtlet->npwp = $request->npwp;
        $dataOtlet->gol = $request->gol;
        $dataOtlet->tgl_input = $request->tgl_input;
        $dataOtlet->set_harga = $request->set_harga;
        $dataOtlet->area_antaran = $request->area_antaran;
        $dataOtlet->area_tagihan = $request->area_tagihan;
        $dataOtlet->type_customer = $request->type_customer;
        $dataOtlet->limit_kredit = $request->limit_kredit;
        $dataOtlet->limit_divisi = $request->limit_divisi;
        $dataOtlet->nama_npwp = $request->nama_npwp;
        $dataOtlet->alamat_npwp = $request->alamat_npwp;
        $dataOtlet->save();

        // Menyimpan gambar KTP
        if ($request->hasFile('ktp')) {
            $ktp = $request->file('ktp');
            $ktpName = time() . '.' . $ktp->getClientOriginalExtension();
            $ktp->move(public_path('img/ktp'), $ktpName);
            $dataOtlet->ktp = 'img/ktp/' . $ktpName;
            $dataOtlet->save();
        }

        return response()->json([
            'message' => 'success',
            'data' => $dataOtlet
        ]);
    }

    //delete data otlet
    public function destroy($id)
    {
        $dataOtlet = DataOtlet::find($id);
        $dataOtlet->delete();

        return response()->json([
            'message' => 'success',
            'data' => $dataOtlet
        ]);
    }
}
