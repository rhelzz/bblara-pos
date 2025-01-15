<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\ProductOut;
use App\Models\ProductIn;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::all();

        $stocks->each(function ($stock) {
            // Ambil status dari ProductIn
            $productIn = ProductIn::where('product', $stock->product)
                ->where('expired_date', $stock->expired_date)
                ->first();

            // Ambil status dari ProductOut (jika ada)
            $productOut = ProductOut::where('product', $stock->product)
                ->where('expired_date', $stock->expired_date)
                ->first();

            // Prioritaskan status dari ProductIn, jika tidak ada ambil dari ProductOut
            if ($productIn) {
                $stock->status = $productIn->status;
            } elseif ($productOut) {
                $stock->status = $productOut->status;
            } else {
                $stock->status = 'unknown'; // Status default jika tidak ditemukan
            }
        });

        // Kelompokkan berdasarkan kombinasi produk dan status
        $stocks = $stocks->groupBy(function ($stock) {
            return $stock->product . '-' . $stock->status;
        })->flatten(1);

        return view('stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        
        $stock->delete();

        return redirect()->route('stock.index')->with('success','Data has been deleted successfuly');

    }

}
