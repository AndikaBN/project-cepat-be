<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Tagihan;
use Carbon\Carbon; // Include Carbon for date handling
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    //index
   public function index(Request $request)
{
    // Get the selected year or default to the current year
    $year = $request->input('year', now()->year);

    // Get the selected month or default to the current month
    $month = $request->input('month', now()->month);

    // Get the number of days in the selected month
    $daysInMonth = Carbon::create($year, $month)->daysInMonth;

    // Query the Tagihan model with the necessary filters
    $tagihan = Tagihan::with('user')
        ->when($request->input('nama_outlet'), function ($query, $nama_outlet) {
            $query->where('nama_outlet', 'like', '%' . $nama_outlet . '%')
                  ->orWhere('nomor_nota', 'like', '%' . $nama_outlet . '%');
        })
        ->when($request->input('day'), function ($query, $day) use ($month, $year) {
            $query->whereYear('created_at', $year)
                  ->whereMonth('created_at', $month)
                  ->whereDay('created_at', $day);
        }, function ($query) use ($month, $year) {
            $query->whereYear('created_at', $year)
                  ->whereMonth('created_at', $month);
        })
        ->get();

    // Pass the tagihan data and daysInMonth to the view
    return view('owner.pages.tagihan.index', compact('tagihan', 'daysInMonth', 'month', 'year'));
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
            'status' => 'required'
        ]);

        //store the request...
        $tagihan = new Tagihan;
        $tagihan->user_id = auth()->user()->id;
        $tagihan->nama_outlet = $request->nama_outlet;
        $tagihan->nomor_nota = $request->nomor_nota;
        $tagihan->jumlah_tagihan = $request->jumlah_tagihan;
        $tagihan->status = $request->status;
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
            'status' => 'required'
        ]);

        //update the request...
        $tagihan = Tagihan::find($id);
        $tagihan->nama_outlet = $request->nama_outlet;
        $tagihan->nomor_nota = $request->nomor_nota;
        $tagihan->jumlah_tagihan = $request->jumlah_tagihan;
        $tagihan->status = $request->status;
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