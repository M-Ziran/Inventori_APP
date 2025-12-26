<?php

namespace App\Http\Controllers;

use App\Models\ItemPenerimaanBarang;
use App\Models\PengeluaranBarang;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $totalUsers = User::count();
        $totalProduk = Product::count();

        $totalOrder = PengeluaranBarang::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->count();
        $totalPendapatan = PengeluaranBarang::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->sum('total_harga');
        $totalPendapatan = "Rp." . number_format($totalPendapatan);

        $latesOrder = PengeluaranBarang::latest()->take(5)->get()->map(function ($item) {
            $item->tanggal_transaksi = Carbon::parse($item->created_at)->locale('id')->translatedFormat('d F Y');
            return $item;
        });

        $produkTerlaris = ItemPenerimaanBarang::select('nama_produk')
            ->selectRaw('SUM(qty) as total_terjual')
            ->whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->groupBy('nama_produk')
            ->orderByDesc('total_terjual')
            ->take(5)
            ->get();

        return view('dashboard.index', compact('totalUsers', 'totalProduk', 'totalOrder', 'totalPendapatan', 'latesOrder', 'produkTerlaris'));
    }
}
