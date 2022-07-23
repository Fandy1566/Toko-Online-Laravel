<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;
use App\Models\pemesanan;
use App\Models\product;
use App\Models\transaksi_detail;
use App\Models\pemesanan_detail;
use DB;
use Auth;

class pemesananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('Pegawai');
        $pemesanan = pemesanan::where('status','0')->get();
        return view('admin.pemesanan.index',compact('pemesanan'));
    }
    public function ditolak()
    {
        $this->authorize('Pegawai');
        $pemesanan = pemesanan::where('status','1')->get();
        return view('admin.pemesanan.index',compact('pemesanan'));
    }

    public function diterima()
    {
        $this->authorize('Pegawai');
        $pemesanan = pemesanan::where('status','2')->get();
        return view('admin.pemesanan.index',compact('pemesanan'));
    }
    
    public function all()
    {
        $this->authorize('Pegawai');
        $pemesanan = pemesanan::all();
        return view('admin.pemesanan.index',compact('pemesanan'));
    }

    public function show($id)
    {
        $this->authorize('Pegawai');
        $pemesanan = pemesanan::find($id);
        $pemesanan_detail = pemesanan_detail::where('id_pemesanan',$pemesanan->id)->get();
        return view('admin.pemesanan.show',compact('pemesanan','pemesanan_detail'));
    }

    public function terima(Request $request,$id)
    {   
        $this->authorize('Pegawai');
        $pemesanan = pemesanan::find($id);
        $pemesanan_detail = pemesanan_detail::where('id_pemesanan', $pemesanan->id)->get();
        $transaksi = new transaksi;
        $increment = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA ='" . env('DB_DATABASE') . "' AND TABLE_NAME ='" . $transaksi->getTable() . "'")[0]->AUTO_INCREMENT;
        $transaksi->id_transaksi = date("Ym").str_pad($increment,6,"0",STR_PAD_LEFT);        
        $transaksi->id_pegawai = Auth::user()->id;
        $transaksi->id_customer = $pemesanan->id_customer;
        $transaksi->alamat = $pemesanan->alamat;
        $transaksi->total = $pemesanan->total;
        $pemesanan->status = '2'; //terima
        $pemesanan->save();
        $transaksi->save();

        foreach ($pemesanan_detail as $key => $value) {
            $transaksi_detail = new transaksi_detail;
            $transaksi_detail->id_transaksi = $increment;
            $transaksi_detail->id_produk = $value->id_produk;
            $transaksi_detail->jumlah = $value->jumlah;
            $transaksi_detail->save();
        }

        $request->session()->flash("info", "Data Berhasil dibuat");
        return redirect()->route('pemesanan.index');

    }

    public function tolak(Request $request,$id)
    {   
        $this->authorize('Pegawai');
        $pemesanan = pemesanan::find($id);
        $pemesanan->status = '1'; //tolak
        $pemesanan->save();

        $pemesanan_detail = pemesanan_detail::where('id_pemesanan', $pemesanan->id)->get();
        foreach ($pemesanan_detail as $key => $value) {
            $product = product::find($value->id_produk);
            $product->stok = $product->stok + $value->jumlah;
            $product->save();
        }
        $request->session()->flash("info", "Data Berhasil dibuat");
        return redirect()->route('pemesanan.index');

    }
}
