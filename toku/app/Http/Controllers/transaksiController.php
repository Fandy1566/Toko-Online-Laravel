<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\transaksi;
use App\Models\user;
use App\Models\transaksi_detail;
use App\Models\product;
use Illuminate\Support\Facades\Validator;

class transaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('Pegawai');
        $transaksi = transaksi::all();
        $customer = user::where('level','=','3')->get();
        $product = product::where('stok','>',0)->get();
        return view('admin.transaksi.index',compact('transaksi','product','customer'));
    }

    public function show($id)
    {
        $this->authorize('Pegawai');
        $transaksi = transaksi::find($id);
        $transaksi_detail = transaksi_detail::where('id_transaksi',$transaksi->id)->get();
        return view('admin.transaksi.show',compact('transaksi','transaksi_detail'));
    }

    public function store(Request $request)
    {   
        $this->authorize('Pegawai');
        $request->validate([
            'nama_customer' => 'required',
            'id_product' => 'required|array',
            'id_product.*' => 'required',
            'jmlh' => 'required|array',
            'jmlh.*' => 'required'
        ]);

        foreach ($request->id_product as $key => $value){
            $product = product::find($request->id_product[$key]);
            $stok_sisa[] = $product->stok - $request->jmlh[$key];
        }
        if (!(min($stok_sisa) < 0)) {
            $transaksi = new transaksi;
            $increment = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA ='" . env('DB_DATABASE') . "' AND TABLE_NAME ='" . $transaksi->getTable() . "'")[0]->AUTO_INCREMENT;
            $transaksi->id_transaksi = date("Ym").str_pad($increment,6,"0",STR_PAD_LEFT);        
            $transaksi->id_pegawai = Auth::user()->id;
            $transaksi->id_customer = $request->nama_customer;
            $cust = user::find($request->nama_customer);
            $transaksi->alamat = ($request->alamat == null)? $cust->alamat : $request->alamat;
            $transaksi->save();
            
            $total=0;
            foreach ($request->id_product as $key => $value) {
                $product = product::find($request->id_product[$key]);
                $transaksi_detail = new transaksi_detail;
                $transaksi_detail->id_transaksi = $increment;
                $transaksi_detail->id_produk = $request->id_product[$key];
                $transaksi_detail->jumlah = $request->jmlh[$key];
                $transaksi_detail->save();
                $total += $product->harga*$request->jmlh[$key];
                $product->stok -= $request->jmlh[$key];
                $product->save();
            }
            
            $transaksi2 = transaksi::find($increment);
            $transaksi2->total = $total;
            $transaksi2->save();

            $request->session()->flash("info", "Data Berhasil dibuat");
            return redirect()->route('transaksi.index');
        } else {
            $request->session()->flash("info", "Kekurangan Stok");
            return redirect()->back();
        }
        
    }
}

