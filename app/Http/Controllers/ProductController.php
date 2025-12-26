<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use function Laravel\Prompts\confirm;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); 
        confirmDelete('Hapus Data', 'Apakah anda yakin menghapus data ini?', 'Hapus', );
        return view('product.index', compact('products'));
    }

    public function store(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'nama_product'      => 'required|unique:products,nama_produk,' . $id,
            'harga_jual'        => 'required|numeric|min:0',
            'harga_beli_pokok'  => 'required|numeric|min:0',
            'kategori_id'       => 'required|exists:kategoris,id',
            'stok'              => 'required|numeric|min:0',
            'stok_minimal'      => 'required|numeric|min:0',
        ],[
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'nama_produk.unique' => 'Nama produk sudah digunakan.',
            'harga_jual.required' => 'Harga jual wajib diisi.',
            'harga_jual.numeric' => 'Harga jual harus berupa angka.',
            'harga_jual.min' => 'Harga jual tidak boleh kurang dari 0.',
            'harga_beli_pokok.required' => 'Harga beli pokok wajib diisi.',
            'harga_beli_pokok.numeric' => 'Harga beli pokok harus berupa angka.',
            'harga_beli_pokok.min' => 'Harga beli pokok tidak boleh kurang dari 0.',
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.numeric' => 'Stok harus berupa angka.',
            'stok.min' => 'Stok tidak boleh kurang dari 0.',
            'stok_minimal.required' => 'Stok minimal wajib diisi.',
            'stok_minimal.numeric' => 'Stok minimal harus berupa angka.',
            'stok_minimal.min' => 'Stok minimal tidak boleh kurang dari 0.',
        ]);

        $newRequest = [
                'id' => $id,
                'nama_produk' => $request->nama_product,
                'harga_jual' => $request->harga_jual,
                'harga_beli_pokok' => $request->harga_beli_pokok,
                'kategori_id' => $request->kategori_id,
                'stok' => $request->stok,
                'stok_minimal' => $request->stok_minimal,
                'is_active' => $request->has('is_active'),
        ];

        if (!$id) {
            $newRequest['sku'] = Product::nomorSku();
        }
        Product::updateOrCreate(
            ['id' => $id],
            $newRequest
        );
        toast()->success('Data produk berhasil disimpan.');
        return redirect()->route('master-data.product.index');
    }

    public function destroy(String $id)
    {
        $product = Product::find($id);
        $product->delete();
        toast()->success('Data Berhasil Dihapus');
        return redirect()->route('master-data.product.index');
    }

    public function getData()
    {
        $search = request()->query('search');
        $query = Product::query();
        $product = $query->where('nama_produk', 'like', '%' . $search . '%')->get();
        return response()->json($product);
    }

    public function cekStok()
    {
        $id = request()->query('id');
        $stok = Product::find($id)->stok;
        return response()->json($stok);
    }

    public function cekHarga()
    {
        $id = request()->query('id');
        $harga = Product::find($id)->harga_jual;
        return response()->json($harga);
    }
    
}
