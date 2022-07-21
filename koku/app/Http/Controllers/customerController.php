<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\transaksi_detail;
use DB;
class customerController extends Controller
{
    public function home()
    {
        $pilihan = product::inRandomOrder()->get();
        $populer = transaksi_detail::query()->select(['id_produk',DB::raw('sum(jumlah) as total')])->groupBy('id_produk')->orderBy('total', 'desc')->limit(10)->get();
        return view('cust.home.home', compact('pilihan','populer'));
    }

    public function product()
    {
        $product = product::all();
        return view('cust.produk.index',compact('product'));
    }
    public function history()
    {
        $product = product::all();
        return view('cust.produk.index',compact('product'));
    }
    public function cart()
    {
        $product = product::all();
        return view('cust.produk.index',compact('product'));
    }
    public function info()
    {
        $product = product::all();
        return view('cust.produk.index',compact('product'));
    }
}
