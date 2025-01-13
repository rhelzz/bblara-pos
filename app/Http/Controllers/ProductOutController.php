<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductOut;
use App\Models\Stock;

class ProductOutController extends Controller
{
    public function index()
    {
        $productOuts = ProductOut::all();

        foreach ($productOuts as $productOut) {
            if (now()->greaterThanOrEqualTo($productOut->expired_date)) {
                $productOut->update(['status' => 'expired']);
            }
        }

        return view('product_out.index', compact('productOuts'));
    }

    public function create()
    {
        return view('product_out.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product' => 'required|string',
            'expired_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:good,expired',
        ]);

        // Tentukan status berdasarkan tanggal expired
        $status = now()->greaterThanOrEqualTo($request->expired_date) ? 'expired' : 'good';

        $stock = Stock::where('product', $request->product)
            ->where('expired_date', $request->expired_date)
            ->first();

        if (!$stock || $stock->stock_now < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        }

        // Create ProductOut record
        ProductOut::create(array_merge($request->all(), ['status' => $status]));

        // Update stock quantities
        $stock->increment('stock_out', $request->quantity);
        $stock->decrement('stock_now', $request->quantity);

        // Redirect to the index page with success message
        return redirect()->route('product_out.index')->with('success', 'Barang keluar berhasil ditambahkan.');
    }

    public function edit(ProductOut $productOut)
    {
        return view('product_out.edit', compact('productOut'));
    }

    public function update(Request $request, ProductOut $productOut)
    {
        $request->validate([
            'product' => 'required|string',
            'expired_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:good,expired',
        ]);

        // Tentukan status berdasarkan tanggal expired
        $status = now()->greaterThanOrEqualTo($request->expired_date) ? 'expired' : 'good';

        $difference = $request->quantity - $productOut->quantity;

        // Update produk keluar dengan status yang benar
        $productOut->update(array_merge($request->all(), ['status' => $status]));

        $stock = Stock::where('product', $request->product)
            ->where('expired_date', $request->expired_date)
            ->first();

        if ($stock) {
            // Update stock sesuai dengan perubahan quantity
            $stock->increment('stock_out', $difference);
            $stock->decrement('stock_now', $difference);
        }

        return redirect()->route('product_out.index')->with('success', 'Barang keluar berhasil diupdate.');
    }

    public function destroy(ProductOut $productOut)
    {
        $stock = Stock::where('product', $productOut->product)
            ->where('expired_date', $productOut->expired_date)
            ->first();

        if ($stock) {
            $stock->decrement('stock_out', $productOut->quantity);
            $stock->increment('stock_now', $productOut->quantity);
        }

        $productOut->delete();

        return redirect()->route('product_out.index')->with('success', 'Barang keluar berhasil dihapus.');
    }
}
