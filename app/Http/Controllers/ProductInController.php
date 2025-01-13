<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductIn;
use App\Models\Stock;

class ProductInController extends Controller
{
    public function index()
    {
        $productIns = ProductIn::all();

        foreach ($productIns as $productIn) {
            if (now()->greaterThanOrEqualTo($productIn->expired_date)) {
                $productIn->update(['status' => 'expired']);
            }
        }

        return view('product_in.index', compact('productIns'));
    }


    public function create()
    {
        return view('product_in.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product' => 'required|string',
            'expired_date' => 'required|date',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:good,expired',
        ]);

        // Tentukan status berdasarkan tanggal expired
        $status = now()->greaterThanOrEqualTo($request->expired_date) ? 'expired' : 'good';

        $productIn = ProductIn::create(array_merge($request->all(), ['status' => $status]));

        $stock = Stock::firstOrCreate(
            ['product' => $request->product, 'expired_date' => $request->expired_date],
            ['stock_in' => 0, 'stock_out' => 0, 'stock_now' => 0]
        );

        $stock->increment('stock_in', $request->quantity);
        $stock->increment('stock_now', $request->quantity);

        return redirect()->route('product_in.index')->with('success', 'Barang masuk berhasil ditambahkan.');
    }

    public function edit(ProductIn $productIn)
    {
        return view('product_in.edit', compact('productIn'));
    }

    public function update(Request $request, ProductIn $productIn)
    {
        $request->validate([
            'product' => 'required|string',
            'expired_date' => 'required|date',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:good,expired',
        ]);

        // Tentukan status berdasarkan tanggal expired
        $status = now()->greaterThanOrEqualTo($request->expired_date) ? 'expired' : 'good';

        $difference = $request->quantity - $productIn->quantity;

        $productIn->update(array_merge($request->all(), ['status' => $status]));

        $stock = Stock::where('product', $request->product)
            ->where('expired_date', $request->expired_date)
            ->first();

        if ($stock) {
            $stock->increment('stock_in', $difference);
            $stock->increment('stock_now', $difference);
        }

        return redirect()->route('product_in.index')->with('success', 'Barang masuk berhasil diupdate.');
    }

    public function destroy(ProductIn $productIn)
    {
        $stock = Stock::where('product', $productIn->product)
            ->where('expired_date', $productIn->expired_date)
            ->first();

        if ($stock) {
            $stock->decrement('stock_in', $productIn->quantity);
            $stock->decrement('stock_now', $productIn->quantity);
        }

        $productIn->delete();

        return redirect()->route('product_in.index')->with('success', 'Barang masuk berhasil dihapus.');
    }
}
