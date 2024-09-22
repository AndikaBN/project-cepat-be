<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Outlet;
use App\Http\Requests\UpdateOutletRequest;


class OutletController extends Controller
{
    //index
    public function index(Request $request)
    {
        $outlets = Outlet::with('user')
            ->when($request->input('name'), function ($query, $name) {
                $query->where('name', 'like', '%' . $name . '%')
                    ->orWhere('type', 'like', '%' . $name . '%');
            })
            ->paginate(10);

        return view('owner.pages.outlets.index', compact('outlets'));
    }

    //create
    public function create()
    {
        return view('owner.pages.outlets.create');
    }

    //store
    public function store(Request $request)
    {
        //validate the request...
        $request->validate([
            'name' => 'required',
            'no_telp' => 'required',
            'type' => 'required',
            'limit' => 'required|numeric',
            'image_ktp' => 'nullable|image',
            'image_outlet' => 'nullable|image',
        ]);

        //store the request...
        $outlet = new Outlet;
        $outlet->name = $request->name;
        $outlet->no_telp = $request->no_telp;
        $outlet->type = $request->type;
        $outlet->limit = $request->limit;
        $outlet->user_id = auth()->user()->id;
        $outlet->save();

        //save the image_ktp
        if ($request->hasFile('image_ktp')) {
            $filename = $outlet->id . '_ktp.' . $request->file('image_ktp')->extension();
            $request->file('image_ktp')->move(public_path('img'), $filename);
            $outlet->image_ktp = 'img/' . $filename;
            $outlet->save();
        }

        //save the image_outlet
        if ($request->hasFile('image_outlet')) {
            $filename = $outlet->id . '_outlet.' . $request->file('image_outlet')->extension();
            $request->file('image_outlet')->move(public_path('img'), $filename);
            $outlet->image_outlet = 'img/' . $filename;
            $outlet->save();
        }

        return redirect()->route('outlets.index')->with('success', 'Outlet created successfully');
    }

    //show
    public function show($id)
    {
        return view('owner.pages.outlets.show');
    }

    //edit
    public function edit($id)
    {
        $outlet = Outlet::findOrFail($id);
        return view('owner.pages.outlets.edit', compact('outlet'));
    }

    //update
    public function update(UpdateOutletRequest $request, $id)
    {
        $outlet = Outlet::findOrFail($id);

        $outlet->name = $request->name;
        $outlet->no_telp = $request->no_telp;
        $outlet->type = $request->type;
        $outlet->limit = $request->limit;

        if ($request->hasFile('image_ktp')) {
            $filename = $outlet->id . '_ktp.' . $request->file('image_ktp')->extension();
            $request->file('image_ktp')->move(public_path('img'), $filename);
            $outlet->image_ktp = 'img/' . $filename;
        }

        if ($request->hasFile('image_outlet')) {
            $filename = $outlet->id . '_outlet.' . $request->file('image_outlet')->extension();
            $request->file('image_outlet')->move(public_path('img'), $filename);
            $outlet->image_outlet = 'img/' . $filename;
        }

        $outlet->save();

        return redirect()->route('outlets.index')->with('success', 'Outlet updated successfully');
    }


    //destroy
    public function destroy($id)
    {
        //delete the request...
        $outlet = Outlet::findOrFail($id);
        $outlet->delete();
        return redirect()->route('outlets.index')->with('success', 'Outlet deleted successfully');
    }
}
