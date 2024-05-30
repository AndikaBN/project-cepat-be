<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Outlet;

class OutletController extends Controller
{
    //index
    public function index(Request $request)
    {
        //get all outlets with pagination
        $outlets = DB::table('outlets')
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
            'type' => 'required',
            'limit' => 'required|numeric',
        ]);

        //store the request...
        $outlet = new Outlet;
        $outlet->name = $request->name;
        $outlet->type = $request->type;
        $outlet->limit = $request->limit;
        $outlet->save();

        //save the image
        if ($request->hasFile('image')) {
            $request->file('image')->storeAs('public/outlets', $outlet->id . '.' . $request->file('image')->extension());
            $outlet->image = 'storage/outlets/' . $outlet->id . '.' . $request->file('image')->extension();
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
            'type' => 'required',
            'limit' => 'required|numeric',
        ]);

        //update the request...
        $outlet = Outlet::findOrFail($id);
        $outlet->name = $request->name;
        $outlet->type = $request->type;
        $outlet->limit = $request->limit;
        $outlet->save();

        //save the image
        if ($request->hasFile('image')) {
            $request->file('image')->storeAs('public/outlets', $outlet->id . '.' . $request->file('image')->extension());
            $outlet->image = 'storage/outlets/' . $outlet->id . '.' . $request->file('image')->extension();
            $outlet->save();
        }

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
