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

    /*
        $table->id();
        $table->string('stat')->nullable();
        $table->string('bebas_blok')->nullable();
        $table->string('kode')->nullable();
        $table->string('nama_customer')->nullable();
        $table->string('kontak')->nullable();
        $table->string('alamat')->nullable();
        $table->string('daerah')->nullable();
        $table->string('area')->nullable();
        $table->string('telp')->nullable();
        $table->string('keterangan')->nullable();
        $table->string('ktp')->nullable();
        $table->string('npwp')->nullable();
        $table->string('gol')->nullable();
        $table->date('tgl_input')->nullable();
        $table->string('set_harga')->nullable();
        $table->string('area_antaran')->nullable();
        $table->string('area_tagihan')->nullable();
        $table->string('type_customer')->nullable();
        $table->string('limit_kredit')->nullable();
        $table->string('limit_divisi')->nullable();
        $table->string('nama_npwp')->nullable();
        $table->string('alamat_npwp')->nullable();
        $table->timestamps();
*/

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
            'ktp' => 'required',
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
        $dataOtlet->ktp = $request->ktp;
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
            'ktp' => 'required',
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
        $dataOtlet->ktp = $request->ktp;
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
