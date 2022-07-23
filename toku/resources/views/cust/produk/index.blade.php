@extends('layouts.cust')
@section('title','Home')
@section('content')

<div class="produk">
    <div class="product-index">
        <div style="width:100%;">
            <h1>Daftar Produk</h1>
        </div>
        <form action="{{ route('produk.cari')}}" method="get">
            <input type="text-menu" name="cari" class="search-box" style="padding-left:5px" placeholder="Cari Barang">
            <button class="btn-search-box" type="submit"><i class="bi bi-search"></i></button>
        </form>
        <div style="width:100%;"></div>
        @foreach($product as $key => $value)
        <div class="prod-index">
            <div class="card-img-index"><img class="card-img1 {{$value->stok == 0? 'no-stock': ''}}"src="{{asset('storage/'. $value->gambar_produk)}}" alt="Tidak ada Gambar"></div>
            <a class="card-link" href{{$value->stok == 0? '^': ''}}="{{$value->stok == 0? '': route('cart.add',['id' => $value->id])}}">
            <div class="card-text-index">{{$value->nama_product}}
            <br>
            Rp {{ number_format($value->harga, 0, ',', '.') }}
            </div>
            </a>
        </div>
        @endforeach
    </div>
    @if(empty($cart) || count($cart) == 0)
    @else
    <div class="cart">
        <div class="col2-title">
                Estimasi Harga
            </div>
            <?php $grand_total=0?>
            @foreach($cart as $key => $value)
            <div class="subtotal-item">
                <div class="ket">
                    {{$value['nama_product']}}
                </div>
                <div class="price">
                    Rp {{ number_format($value['harga'], 0, ',', '.') }}
                </div>
            </div>
            <?php $grand_total+= $value['harga']*$value['jumlah']?>
            @endforeach
            <div class="total-pembayaran">Total pembayaran
                <div>Rp {{ number_format($grand_total, 0, ',', '.') }}</div>
            </div>
            <div class="buy">
                <a style="color: #ff3333;" class="card-link" href="{{ route('cart')}}">Cek Detail! <i class="bi bi-arrow-right"></i></a>
            </div>
    </div>
    @endif
</div>

@endsection