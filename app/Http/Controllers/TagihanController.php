<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Tagihan;

use Illuminate\Http\Request;

class TagihanController extends Controller
{
    //index
    public function index( Request $request)
    {

        $tagihan = Tagihan::with('user')
            ->when($request->input('nama_outlet'), function ($query, $nama_outlet) {
                $query->where('nama_outlet', 'like', '%' . $nama_outlet . '%')
                    ->orWhere('nomor_nota', 'like', '%' . $nama_outlet . '%');
            })
            ->paginate(10);
        return view('owner.pages.tagihan.index', compact('tagihan'));
    }

    //create
    public function create()
    {
        return view('owner.pages.tagihan.create');
    }

    //store
    public function store(Request $request)
    {
        //validate the request...
        $request->validate([
            'nama_outlet' => 'required',
            'nomor_nota' => 'required',
            'jumlah_tagihan' => 'required|numeric',
        ]);

        //store the request...
        $tagihan = new Tagihan;
        $tagihan->user_id = auth()->user()->id;
        $tagihan->nama_outlet = $request->nama_outlet;
        $tagihan->nomor_nota = $request->nomor_nota;
        $tagihan->jumlah_tagihan = $request->jumlah_tagihan;
        $tagihan->save();

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil ditambahkan');
    }

    //edit
    public function edit($id)
    {
        $tagihan = Tagihan::find($id);
        return view('owner.pages.tagihan.edit', compact('tagihan'));
    }

    //update
    public function update(Request $request, $id)
    {
        //validate the request...
        $request->validate([
            'nama_outlet' => 'required',
            'nomor_nota' => 'required',
            'jumlah_tagihan' => 'required|numeric',
        ]);

        //update the request...
        $tagihan = Tagihan::find($id);
        $tagihan->nama_outlet = $request->nama_outlet;
        $tagihan->nomor_nota = $request->nomor_nota;
        $tagihan->jumlah_tagihan = $request->jumlah_tagihan;
        $tagihan->user_id = auth()->user()->id;
        $tagihan->save();

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil diupdate');
    }

    //destroy
    public function destroy($id)
    {
        $tagihan = Tagihan::find($id);
        $tagihan->delete();

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil dihapus');
    }
}
