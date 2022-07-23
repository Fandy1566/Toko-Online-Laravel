@extends('layouts.cust')
@section('title','Home')
@section('content')
<form action="{{route('cart.pesan')}}" method="post">
    @csrf
<div class="card-cart">
    <div class="col1">
        <div class="col1-header">
            <div class="col1-title">
                <div class="col1-title-title">
                    Bills
                </div>
                <div class="col1-title-text">
                    Alamat Pengantaran
                </div>
                <div class="col1-alamat">
                    {{Auth::user()->alamat}}
                </div>
            </div>
            <div class="change-alamat">
                <button type ="button" class="btn-change-alamat">Ubah Lokasi</button>
            </div>
        </div>
        <div class="cart-all">
            <?php $i =0?>
            @if(empty($cart) || count($cart) == 0)
            Tidak ada Barang
            @else
            @foreach($cart as $key => $value)
            <div class="cart-items">
                <div class="cart-items-image">
                    <img class="cart-items-image-class"src="{{asset('storage/'. $value['gambar_product'])}}" alt="Tidak ada gambar">
                </div>
                <div class="cart-product-detail">
                    <div class="cart-name">
                        {{$value['nama_product']}}
                    </div>
                    <div class="cart-price">
                        Rp {{ number_format($value['harga'], 0, ',', '.') }}
                    </div>
                    <div class="cart-stock">
                        Stok : {{ number_format($product[--$key]->stok, 0, ',', '.') }}
                    </div>
                </div>
                <div class="cart-product-jumlah">
                    <div class="increment decrement{{$i}}">
                        <button class="login-btn" type="button">
                            -
                        </button>
                    </div>
                    <div class="cart-product-total">
                        <input type="number" name="jmlh[]" class="quantity{{$i}}" value="{{$value['jumlah']}}" min="1" max="1000">
                    </div>
                    <div class="decrement increment{{$i}}">
                    <button class="login-btn" type="button">
                            +
                        </button>
                    </div>
                </div>
                <div class="batal">
                    <a class="batal-btn"href="{{ route('cart.delete',['id'=> ++$key]) }}"><i style="color:white;"class="bi bi-trash-fill"></i></a>
                </div>
            </div>
            <?php $i++ ?>
            @endforeach
            @endif
        </div>
    </div>
    <div class="col2">
    <?php $i =0?>
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
            <div style="display:none" class="satuan{{$i}}">
                {{$value['harga']}}
            </div>
            <div style="display:none" class="price-hidden{{$i}}">
                {{$value['harga']}}
            </div>
            <div class="price{{$i}}">
                Rp {{ number_format($value['harga'], 0, ',', '.') }}
            </div>
        </div>
        <?php $grand_total+= $value['harga']*$value['jumlah']?>
        <?php $i++?>
        @endforeach
        <div class="total-pembayaran">Total pembayaran
            <div class="total-pembayaran-num">Rp {{ number_format($grand_total, 0, ',', '.') }}</div>
        </div>
        <div class="buy">
            <button class="login-btn" type="submit">
                <p style="color: #ff3333;">Beli Sekarang! <i class="bi bi-arrow-right"></i></p>
            </button>
        </div>
    </div>
        @endif
    </div>
</div>
</form>
<script>
    $(document).ready(function(){
        $( ".cart-items" ).each(function( index ) {
            $(".quantity"+index).on("input", function(){
                var val1 = +$(".satuan"+index).text();
                var val2 = +$(".quantity"+index).val();
                let subtotal = addCommas(val1*val2);
                $(".price"+index).text("Rp "+subtotal);
                $(".price-hidden"+index).text(val1*val2);
                var total = 0;
                $( ".subtotal-item").each(function( j ) {
                    var asdw = +$(".price-hidden"+j).text();
                    total = total + asdw;
                });
                $(".total-pembayaran-num").text("Rp "+addCommas(total));
            });

            $(".increment"+index).click(function(){
                var val2 = +$(".quantity"+index).val();
                if (val2<1000) {
                    $(".quantity"+index).val(val2+1);
                    var val1 = +$(".satuan"+index).text();
                    var val2 = +$(".quantity"+index).val();
                    let subtotal = addCommas(val1*val2);
                    $(".price"+index).text("Rp "+subtotal);
                    $(".price-hidden"+index).text(val1*val2);
                    var total = 0;
                    $( ".subtotal-item").each(function( j ) {
                        var asdw = +$(".price-hidden"+j).text();
                        total = total + asdw;
                    });
                    $(".total-pembayaran-num").text("Rp "+addCommas(total));
                } else {
                    $(".quantity"+index).val(1000);
                }
            });

            $(".decrement"+index).click(function(){
                var val2 = +$(".quantity"+index).val();
                if (val2>1) {
                    $(".quantity"+index).val(val2-1);
                    var val1 = +$(".satuan"+index).text();
                    var val2 = +$(".quantity"+index).val();
                    let subtotal = addCommas(val1*val2);
                    $(".price"+index).text("Rp "+subtotal);
                    $(".price-hidden"+index).text(val1*val2);
                    var total = 0;
                    $( ".subtotal-item").each(function( j ) {
                        var asdw = +$(".price-hidden"+j).text();
                        total = total + asdw;
                    });
                    $(".total-pembayaran-num").text("Rp "+addCommas(total));
                } else {
                    $(".quantity"+index).val(1);
                }
            });
        });
    });

    function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
    }
</script>
@endsection