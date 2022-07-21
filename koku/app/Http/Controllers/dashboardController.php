<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;
use DB;

class dashboardController extends Controller
{
    public function dashboard()
    {
        $product = DB::table('product')->count();
        $pegawai = DB::table('users')->where('level',2)->count();
        $customer = DB::table('users')->where('level',3)->count();
        $user = DB::table('users')->count();
        $transaksi = DB::table('transaksi')->count();
        $data_baru = transaksi::orderBy('id','desc')->limit(10)->get();
        $top = transaksi::query()->select(['id_customer',DB::raw('count(*) as total_pembelian')])->groupBy('id_customer')->orderBy('total_pembelian', 'desc')->get();
        return view('admin.dashboard', compact('product','pegawai','customer','transaksi','user','data_baru','top'));
    }
}
