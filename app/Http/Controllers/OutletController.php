<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Outlet;
use Illuminate\Support\Facades\Log;


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

    /*
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->string('no_telp');
            $table->string('image_ktp')->nullable();
            $table->string('image_outlet')->nullable();
            $table->string('type');
            $table->integer('limit');
    */
    //store
    public function store(Request $request)
    {
        //validate the request...
        $request->validate([
            'name' => 'required',
            'no_telp' => 'required',
            'type' => 'required',
            'limit' => 'required|numeric',

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
            $request->file('image_ktp')->storeAs('public/outlets', $outlet->id . '_ktp.' . $request->file('image_ktp')->extension());
            $outlet->image_ktp = 'storage/outlets/' . $outlet->id . '_ktp.' . $request->file('image_ktp')->extension();
            $outlet->save();
        }

        //save the image_outlet
        if ($request->hasFile('image_outlet')) {
            $request->file('image_outlet')->storeAs('public/outlets', $outlet->id . '_outlet.' . $request->file('image_outlet')->extension());
            $outlet->image_outlet = 'storage/outlets/' . $outlet->id . '_outlet.' . $request->file('image_outlet')->extension();
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
    public function update(Request $request, $id)
    {
        //validate the request...
        $request->validate([
            'name' => 'required',
            'no_telp' => 'required',
            'type' => 'required',
            'limit' => 'required|numeric',
        ]);

        try {
            error_log('Update method called');
            $outlet = Outlet::findOrFail($id);
            $outlet->name = $request->name;
            $outlet->no_telp = $request->no_telp;
            $outlet->type = $request->type;
            $outlet->limit = $request->limit;
            $outlet->save();

            error_log('Outlet updated: ' . $outlet->id);

            //save the image_ktp
            if ($request->hasFile('image_ktp')) {
                $request->file('image_ktp')->storeAs('public/outlets', $outlet->id . '_ktp.' . $request->file('image_ktp')->extension());
                $outlet->image_ktp = 'storage/outlets/' . $outlet->id . '_ktp.' . $request->file('image_ktp')->extension();
                $outlet->save();
            }

            //save the image_outlet
            if ($request->hasFile('image_outlet')) {
                $request->file('image_outlet')->storeAs('public/outlets', $outlet->id . '_outlet.' . $request->file('image_outlet')->extension());
                $outlet->image_outlet = 'storage/outlets/' . $outlet->id . '_outlet.' . $request->file('image_outlet')->extension();
                $outlet->save();
            }

            return redirect()->route('outlets.index')->with('success', 'Outlet updated successfully');
        } catch (\Exception $e) {
            error_log('Error updating outlet: ' . $e->getMessage());
            return redirect()->back()->withErrors('An error occurred while updating the outlet: ' . $e->getMessage());
        }
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
