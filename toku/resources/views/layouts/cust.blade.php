<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/custmodal.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <title>@yield('title')</title>
</head>
<body>
    <div class="header">
        <div class="title-header">
            <a class="card-link" href="{{route('home')}}">
                Ko<span style="color:red">Ku</span>
            </a>
            </div>
        <div class="header-menu" style="margin-right: 20px">    
            <div>
                <form action="{{ route('produk.cari')}}" method="get">
                    <input type="text-menu" name="cari" class="search-box" style="padding-left:5px" placeholder="Cari Barang">
                    <button class="btn-search-box" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <a class="cart-menu" href="/keranjang"><i class="bi bi-cart"></i> Cart</a>
            <div class="welcome">
                @if (Auth::check())
                <div class="dropdown">
                    <span>
                        Hi, {{Auth::user()->name}} <i class="bi bi-caret-down-fill"></i>
                    </span>
                    <div class="dropdown-content">
                        <a style="margin-left:15px" href="/logout"><i class="bi bi-box-arrow-right"></i> Logout</a>
                    </div>
                </div>
                @else
                <button type="button" class="login-btn" id="modal-btn"><i class="bi bi-box-arrow-in-right"></i> Login</button>
                    <div id="modal" class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="close">&times;</span>
                                <h2>Login</h2>
                            </div>
                            <div class="card-form">
                                <form action="{{ route('login') }}" method="POST" style="padding-top: 0px">
                                    @csrf
                                    <div class="input-more break">
                                        <label>Email</label> <br>
                                        <input type="email" name="email" required>
                                        <br>
                                        <label>Password</label><br>
                                        <input type="password" name="password" required autocomplete="current-password">
                                        <br>
                                        <br>
                                        <input type="submit" value="Login">
                                        <label style="    font-size: 15px;
                                        display: flex;
                                        text-align: center;
                                        align-items: center;
                                        justify-content: center;
                                        align-content: center;
                                        padding-right: 24px">Belum punya akun?
                                        <button id="modal-btn-register" class="login-btn" type="button"> Daftar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="modal-register" class="modal-Register">
                        <div class="modal-content-Register">
                            <div class="modal-header-Register">
                                <span class="close-Register">&times;</span>
                                <h2>Register</h2>
                            </div>
                            <div class="card-form">
                                <form action="{{ route('register') }}" method="POST" style="padding-top: 0px">
                                    @csrf
                                    <div class="input-more break">
                                        <label>Name</label> <br>
                                        <input type="text" name="name" required>
                                        <br>
                                        <label>Alamat</label><br>
                                        <input type="text" name="alamat" required>
                                        <br>
                                        <label>Telephone</label><br>
                                        <input type="number" name="no_telp" required>
                                        <br>
                                        <label>Gender</label> <br>
                                        <select name="gender">
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                            <option value="?">Lainnya/Tidak Diketahui</option>
                                        </select>
                                        <br>
                                        <label>Email</label>
                                        <input type="email" name="email" required>
                                        <br>
                                        <label>Password</label>
                                        <input type="password" name="password" required autocomplete="new-password" required>
                                        <br>
                                        <label>Confirm Password</label>
                                        <input type="password" name="password_confirmation" required>
                                        <br>
                                        <input type="submit" value="Register">
                                        <label style="    font-size: 15px;
                                        display: flex;
                                        text-align: center;
                                        align-items: center;
                                        justify-content: center;
                                        align-content: center;
                                        padding-right: 24px">Sudah punya akun?
                                        <button id="close-box-register" class="login-btn" type="button"> Login</button></label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="container">
        <div class="sidebar " style="{{(Auth::check()) ? '' : 'display:none' }}">
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
                <li class="item item-5 {{(request()->is('pesanan*')) ? 'active' : '' }}">
                    <a href="/pesanan">
                        <span class="img"></span>
                        <span class="title">Pesanan</span>
                    </a>
                </li>
                <li class="item item-6 {{(request()->is('info*')) ? 'active' : '' }}">
                    <a href="/info">
                        <span class="img"></span>
                        <span class="title">Info</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="content" style="{{(Auth::check()) ? '' : 'margin-left:0px' }}">
            @yield('content')
        </div>
    </div>
    <script>
        var modal = document.getElementById("modal");
        var btn = document.getElementById("modal-btn");
        var span = document.getElementsByClassName("close")[0];
        var modalRegister = document.getElementById("modal-register");
        var btnRegister = document.getElementById("modal-btn-register");
        var spanRegister = document.getElementsByClassName("close-Register")[0];
        var btncloseRegister = document.getElementById("close-box-register");

        $(".item").click(function(){
            window.location=$(this).find("a").attr("href"); 
            return false;
        });

        btnRegister.onclick = function() {
            modalRegister.style.display = "block";
        }

        spanRegister.onclick = function() {
            modalRegister.style.display = "none";
            modal.style.display = "none";
        }

        btncloseRegister.onclick = function() {
            modalRegister.style.display = "none";
        }

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }
    </script>
</body>
</html>