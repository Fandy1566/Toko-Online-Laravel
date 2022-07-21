@extends('layouts.cust')
@section('title','Home')
@section('content')

<div class="produk">
    <div class="product-index">
        <h1>Daftar Produk</h1>
        <div style="width:100%;"></div>
        <input type="text" name="" placeholder="Cari Barang Disini">
        <i class="fa-solid fa-magnifying-glass"></i>
        <div style="width:100%;"></div>
        @foreach($product as $key => $value)
        <div class="prod-index">
            <div class="card-img-index"><img class="card-img1"src="{{asset('storage/'. $value->gambar_produk)}}" alt="Tidak ada Gambar"></div>
            <div class="card-text-index">{{$value->nama_product}}
            <br>
            Rp {{ number_format($value->harga, 0, ',', '.') }}
            </div>
        </div>
        @endforeach
    </div>
    <div class="cart">
        <div class="text-cart" style="

        ">
            Keranjang Belanja
        </div>
    </div>
</div>

@endsection