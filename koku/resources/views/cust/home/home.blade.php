@extends('layouts.cust')
@section('title','Home')
@section('content')
<div class="picture">
    <div class="pict pict-1">
        <div class="text-home" style="
        display:flex;
        align-items:flex-start;
        justify-content:center;
        flex-direction:column;
        align-content:center;
        font-size:40px;
        margin: 0px 100px;
        ">
            Masih Bingung
            <div style="color:red; display:block; width:100%">Mau Order Apa?</div>
            <div style="color:grey; font-size: 10px; width 50%">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error, nobis iusto tempora ullam sed excepturi optio mollitia delectus id! Odio reiciendis, voluptates laboriosam libero cum et eligendi illo? Magni, totam!
            </div>
            <a href="/produk" class="order">
                Order New
            </a>
        </div>
    </div>
    <div class="pict pict-2">
        <img class="home-pict" src="{{asset('storage/'. $pilihan[0]->gambar_produk)}}" alt="Tidak ada gambar">
    </div>
</div>
<br>
<div class="container-content">
    <div class="text">Pilihan untukmu</div>
    <br>
    <div class="product">
        @foreach ($pilihan as $key => $value)
        <div class="prod-small">
            <div class="card-img-small"><img class="card-img1-small"src="{{asset('storage/'. $value->gambar_produk)}}" alt="Tidak ada gambar"></div>
            <div class="card-text-small">
                <div class="name">
                    {{$value->nama_product}}
                </div>
                <div class="price">
                    Rp {{ number_format($value->harga, 0, ',', '.') }}
                </div>
            </div>
        </div>
        @if($key == 10)
        break;
        @endif
        @endforeach
    </div>
    <br>
    <div class="text">Produk Terpopuler</div>
    <br>
    <div class="product">
        @foreach ($populer as $key => $value2)
        <div class="prod">
            <div class="card-img"><img class="card-img1"src="{{asset('storage/'. $value2->produk->gambar_produk)}}" alt="Tidak ada gambar"></div>
            <div class="card-text">{{$value2->produk->nama_product}}
                <br>
                Rp {{ number_format($value2->produk->harga, 0, ',', '.') }}
            </div>
        </div>
        @if($key == 10)
        break;
        @endif
        @endforeach
    </div>
</div>
        <script>
            
            </script>
@endsection