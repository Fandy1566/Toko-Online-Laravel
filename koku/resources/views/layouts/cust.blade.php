<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <title>@yield('title')</title>
</head>
<body>
    <div class="header">
        <div class="title-header">
                Ko<span style="color:red">Ku</span>
            </div>
        <div class="header-menu">    
            <input type="text-menu" class="search-box" placeholder="Cari Barang">
            <a class="cart-menu" href="">Keranjang</a>
            <div class="welcome">
                Hi, Admin
            </div>
            <span class="profile"></span>
        </div>
    </div>
    <div class="container">
        <div class="sidebar " style="{{(request()->is('/')) ? 'display:none' : '' }}">
            <div class="title-sidebar">
                Ko<span style="color:red">Ku</span>
            </div>
            <ul class="list">
                <li class="item item-1 {{(request()->is('/')) ? 'active' : '' }}">
                    <a href="/">
                        <span class="img"></span>
                        <span class="title">Home</span>
                    </a>
                </li>
                <li class="item item-2 {{(request()->is('produk*')) ? 'active' : '' }}">
                    <a href="/produk">
                        <span class="img"></span>
                        <span class="title">Produk</span>
                    </a>
                </li>
                <li class="item item-3 {{(request()->is('history*')) ? 'active' : '' }}">
                    <a href="/history">
                        <span class="img"></span>
                        <span class="title">History</span>
                    </a>
                </li>
                <li class="item item-4 {{(request()->is('keranjang*')) ? 'active' : '' }}">
                    <a href="/keranjang">
                        <span class="img"></span>
                        <span class="title">Keranjang</span>
                    </a>
                </li>
                <li class="item item-5 {{(request()->is('info*')) ? 'active' : '' }}">
                    <a href="/info">
                        <span class="img"></span>
                        <span class="title">Info</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="content" style="{{(request()->is('/')) ? 'margin-left:0px' : '' }}">
            
            @yield('content')
        </div>
    </div>
    <script>
        $(".item").click(function(){
        window.location=$(this).find("a").attr("href"); 
        return false;
        });
    </script>
</body>
</html>