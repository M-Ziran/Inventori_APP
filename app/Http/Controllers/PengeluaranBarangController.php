<?php

namespace App\Http\Controllers;

use App\Models\ItemPengeluaranBarang;
use App\Models\PengeluaranBarang;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengeluaranBarangController extends Controller
{
    public function index()
    {
        return view('pengeluaran-barang.index');
    }

    public function store(Request $request)
    {
        if (empty($request->produk)) {
            toast()->error('Tidak ada produk yang dipilih.', 'Error');
            return redirect()->back();
        }

        $request->validate([
            'produk' => 'required|array|min:1',
            'bayar'  => 'required|numeric|min:1',
        ], [
            'produk.required' => 'Harap pilih setidaknya satu produk.',
            'produk.min'      => 'Harap pilih setidaknya satu produk.',
            'bayar.required'  => 'Jumlah bayar wajib diisi.',
            'bayar.numeric'   => 'Jumlah bayar harus berupa angka.',
        ]);

        $produk     = collect($request->produk);
        $bayar      = $request->bayar;
        $total      = $produk->sum('sub_total');
        $kembalian  = $bayar - $total;

        if ($bayar < $total) {
            toast()->error('Jumlah bayar tidak mencukupi.', 'Error');
            return redirect()->back()->withInput();
        }

        DB::transaction(function () use ($produk, $bayar, $total, $kembalian) {

            // SIMPAN DATA PENGELUARAN
            $pengeluaran = PengeluaranBarang::create([
                'nomor_pengeluaran' => PengeluaranBarang::nomorPengeluaran(),
                'nama_petugas'      => Auth::user()->name,
                'total_harga'       => $total,
                'bayar'             => $bayar,
                'kembalian'         => $kembalian,
            ]);

            // SIMPAN ITEM + UPDATE STOK
            foreach ($produk as $item) {
                ItemPengeluaranBarang::create([
                    'nomor_pengeluaran' => $pengeluaran->nomor_pengeluaran,
                    'nama_produk'       => $item['nama_produk'],
                    'qty'               => $item['qty'],
                    'harga'             => $item['harga_jual'],
                    'sub_total'         => $item['sub_total'],
                ]);

                Product::where('id', $item['produk_id'])
                    ->decrement('stok', $item['qty']);
            }
        });

        toast()->success('Transaksi Tersimpan.', 'Success');
        return redirect()->route('pengeluaran-barang.index');
    }

    public function laporan()
    {
        $data = PengeluaranBarang::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                $item->tanggal_transaksi = Carbon::parse($item->created_at)
                    ->locale('id')
                    ->translatedFormat('l, d F Y');
                return $item;
            });

        return view('pengeluaran-barang.laporan', compact('data'));
    }

    public function detailLaporan(string $nomor_pengeluaran)
    {
        $data = PengeluaranBarang::with('items')
            ->where('nomor_pengeluaran', $nomor_pengeluaran)
            ->firstOrFail();
        $data->total_harga = $data->items->sum('sub_total');
        $data->tanggal_transaksi = Carbon::parse($data->created_at)->locale('id')->translatedFormat('l,d F Y');
        return view('pengeluaran-barang.detail', compact('data'));
    }
}
