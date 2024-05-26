<?php

namespace App\Http\Controllers\Api;

use App\Models\SalePiutang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function index()
    {
        return SalePiutang::all();
    }

    public function store(Request $request)
    {
        $sale = SalePiutang::create($request->all());
        return response()->json($sale, 201);
    }

    public function show(SalePiutang $sale)
    {
        return $sale;
    }

    public function update(Request $request, SalePiutang $sale)
    {
        $sale->update($request->all());
        return response()->json($sale, 200);
    }

    public function destroy(SalePiutang $sale)
    {
        $sale->delete();
        return response()->json(null, 204);
    }

}
