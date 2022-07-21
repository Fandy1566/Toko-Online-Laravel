<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use DB;

class ProductController extends Controller
{
    public function index()
    {
        $product = product::all();
        return view('admin.produk.index', compact('product'));
    }

    public function create()
    {
        return view('admin.produk.create');
    }

    public function store(Request $request)
    {
        $product = new product;
        if (!$request->gambar_produk == null) {
            $text = $request->gambar_produk->getClientOriginalExtension();
            $nama_file = "foto-" . time() . "." . $text;
            $path = $request->gambar_produk->storeAs("public", $nama_file);
            $product->gambar_produk = $nama_file;
        } else {
        }
        $increment = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA ='" . env('DB_DATABASE') . "' AND TABLE_NAME ='" . $product->getTable() . "'")[0]->AUTO_INCREMENT;
        $product->id_product = "P-".str_pad($increment,6,"0",STR_PAD_LEFT);
        $product->nama_product = $request->nama_produk; 
        $product->harga = $request->harga; 
        $product->stok = $request->stok;
        $product->save();
        $request->session()->flash("info", "Data baru berhasil ditambahkan");
        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $product = product::find($id);
        return view("admin.produk.edit", compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = product::findOrFail($id);
        if (!$request->gambar_produk == null) {
            $text = $request->gambar_produk->getClientOriginalExtension();
            $nama_file = "foto-" . time() . "." . $text;
            $path = $request->gambar_produk->storeAs("public", $nama_file);
            $product->gambar_produk = $nama_file;
        } else {
        }
        $product->nama_product = $request->nama_produk; 
        $product->harga = $request->harga; 
        $product->stok = $request->stok;
        $product->save();

        $request->session()->flash("info", "Data produk berhasil diupdate!");
        return redirect()->route("produk.index");
    }

    public function destroy(Request $request, $id)
    {
        $product = product::find($id);
        $product->delete();

        $request->session()->flash("info", "Data produk berhasil dihapus!");
        return redirect()->back();
    }
}
