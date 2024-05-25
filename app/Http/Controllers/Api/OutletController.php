<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    // get all outlets
    public function index()
    {
        return response()->json([
            'message' => 'success',
            'data' => Outlet::all()
        ]);
    }

    // send outlet to server
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'type' => 'required',
            'limit' => 'required|numeric',
        ]);

        $outlet = new Outlet;
        $outlet->name = $request->name;
        $outlet->image = $request->image;
        $outlet->type = $request->type;
        $outlet->limit = $request->limit;
        $outlet->save();

        return response()->json([
            'message' => 'success',
            'data' => $outlet
        ]);
    }
}
