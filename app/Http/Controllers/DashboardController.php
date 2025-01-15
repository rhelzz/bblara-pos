<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cashier;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data cashier
        $cashiers = Cashier::all();

        // Hitung total pendapatan, total modal, total keuntungan, dan total transaksi
        $totalPemasukan = $cashiers->sum('total_amount');
        $totalModal = $cashiers->sum('cost_price');
        $totalKeuntungan = $cashiers->sum('total_amount') - $cashiers->sum('cost_price');
        $totalTransaksi = $cashiers->count();

        // Kirim data ke view
        return view('public.dashboard', compact('cashiers', 'totalPemasukan', 'totalModal', 'totalKeuntungan', 'totalTransaksi'));
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
    public function destroy(string $id)
    {
        //
    }
}
