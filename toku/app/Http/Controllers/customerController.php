<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\pemesanan_detail;
use App\Models\pemesanan;
use App\Models\transaksi;
use App\Models\transaksi_detail;
use DB;
use Auth;
class customerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('home');
    }

    public function home()
    {
        $pilihan = product::inRandomOrder()->where('stok','>=',1)->get();
        $populer = transaksi_detail::query()->select(['id_produk',DB::raw('sum(jumlah) as total')])->groupBy('id_produk')->orderBy('total', 'desc')->limit(10)->get();
        return view('cust.home.home', compact('pilihan','populer'));
    }

    public function product()
    {
        
        $cart = session('cart');
        // $product = product::where('stok','>', 0)->get();
        $product = product::orderBy('stok', 'DESC')->get();
        return view('cust.produk.index',compact('cart','product'));
    }

    public function cari(Request $request)
	{
        
		$product = DB::table('product')
		->where('nama_product','like',"%".$request->cari."%")->paginate();

		return view('cust.produk.index',['product' => $product]);
	}

    public function history()
    {
        
        $transaksi = transaksi::where('id_customer',Auth::user()->id)->get();
        return view('cust.history.history',compact('transaksi'));
    }

    public function show_history($id)
    {
        $transaksi = transaksi::where('id',$id)->where('id_customer', Auth::user()->id)->first();
        $transaksi_detail = transaksi_detail::where('id_transaksi',$transaksi->id)->get();
        return view('cust.history.show',compact('transaksi','transaksi_detail'));
    }

    public function show_pemesanan($id)
    {
        $pemesanan = pemesanan::where('id',$id)->where('id_customer', Auth::user()->id)->first();
        $pemesanan_detail = pemesanan_detail::where('id_pemesanan',$pemesanan->id)->get();
        return view('cust.pesanan.show',compact('pemesanan','pemesanan_detail'));
    }

    public function cart()
    {
        
        $cart = session('cart');
        $product = product::all();
        return view('cust.cart.index',compact('cart','product'));
    }

    public function pesanan()
    {
        $pemesanan = pemesanan::where('id_customer',Auth::user()->id)->orderBy('id_pemesanan','desc')->get();
        return view('cust.pesanan.index',compact('pemesanan'));
    }

    public function add_item($id)
    {
        $cart = session('cart');
        
        $product = product::where("id", $id)->first();
        if ($product->stok != 0) {
            $cart[$id] = [
                'nama_product' => $product->nama_product,
                'gambar_product' => $product->gambar_produk,
                'harga' => $product->harga,
                'jumlah' => 1
            ];
            session(['cart' => $cart]);
        }
        return redirect()->route('produk');
    }
    
    public function delete_item($id)
    {    
        $cart = session('cart');
        unset($cart[$id]);
        session(['cart' => $cart]);
        return redirect()->back();
    }

    public function pesan(Request $request)
    {
        
        $cart = session('cart');
        $i = 0;
        foreach ($cart as $key => $value){
            $product = product::find($key);
            $stok_sisa[] = $product->stok - $request->jmlh[$i];
            $i++;
        }
        if (!(min($stok_sisa) < 0)) {
            $pemesanan = new pemesanan;
            $increment = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA ='" . env('DB_DATABASE') . "' AND TABLE_NAME ='" . $pemesanan->getTable() . "'")[0]->AUTO_INCREMENT;
            $pemesanan->id_pemesanan = date("Ym").str_pad($increment,6,"0",STR_PAD_LEFT);        
            $pemesanan->id_customer = Auth::user()->id;
            $pemesanan->alamat = ($request->alamat == null)? Auth::user()->alamat : $request->alamat;
            $pemesanan->total = 0;
            $pemesanan->status = '0'; //pending
            // $pemesanan->total = $grand_total;
            $pemesanan->save();

            $total=0;
            $i=0;
            foreach ($cart as $key => $value) {
                $pemesanan_detail = new pemesanan_detail;
                $pemesanan_detail->id_pemesanan = $increment;
                $pemesanan_detail->id_produk = $key;
                $pemesanan_detail->jumlah = $request->jmlh[$i];
                $pemesanan_detail->save();
                $product = product::find($key);
                $total += $value['harga'] * $request->jmlh[$i];
                $product->stok = $stok_sisa[$i];
                $product->save();
                $i++;
            }
            $pemesanan2 = pemesanan::find($increment);
            $pemesanan2->total = $total;
            $pemesanan2->save();

            session()->forget('cart');
            $request->session()->flash("info", "Pesanan berhasil dibuat");
    
            return redirect()->route('pesanan');
        } else {
            $request->session()->flash("info", "Pesanan gagal pastikan jumlah yang dipesan tidak lebih dari stok");
            return redirect()->back();
        }
    }

    public function info()
    {
        
        return view('cust.info.index');
    }
}
