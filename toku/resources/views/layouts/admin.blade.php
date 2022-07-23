<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/modal.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <script src="{{ asset('js/select2.min.js')}}"></script>
    <title>@yield('title')</title>
</head>
<body>
<div class="sidebar">
    <div class="title">
        Ko<span style="color:red">Ku</span>
    </div>
    <div>
        <ul>
            <h3>Dashboard</h3>
            <li class="item dashboard-item-1 {{(request()->is('dashboard')) ? 'active' : '' }}">
                <a href="/dashboard">
                    <span class="image"></span>
                    <span class="name">Dashboard</span>
                </a>
            </li>
            <h3>Data</h3>
            <li class="item data-item-1 {{(request()->is('dashboard/produk*')) ? 'active' : '' }}">
                <a href="/dashboard/produk">
                    <span class="image"></span>
                    <span class="name">Produk</span>
                </a>
            </li>
            @can('Admin')
            <li class="item data-item-2 {{(request()->is('dashboard/user*')) ? 'active' : '' }}"">
                <a href="/dashboard/user">
                    <span class="image"></span>
                    <span class="name">User</span>
                </a>
            </li>
            @endcan
            <li class="item data-item-3 {{(request()->is('dashboard/customer*')) ? 'active' : '' }}"">
                <a href="/dashboard/customer">
                    <span class="image"></span>
                    <span class="name">Customer</span>
                </a>
            </li>
            <li class="item data-item-4 {{(request()->is('dashboard/pegawai*')) ? 'active' : '' }}"">
                <a href="/dashboard/pegawai">
                    <span class="image"></span>
                    <span class="name">Pegawai</span>
                </a>
            </li>
            <li class="item data-item-5 {{(request()->is('dashboard/transaksi*')) ? 'active' : '' }}">
                <a href="/dashboard/transaksi">
                    <span class="image"></span>
                    <span class="name">Transaksi</span>
                </a>
            </li>
            <li class="item data-item-5 {{(request()->is('dashboard/pemesanan*')) ? 'active' : '' }}">
                <a href="/dashboard/pemesanan">
                    <span class="image"></span>
                    <span class="name">Pemesanan</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar-profile">
        <div class="profile profile-2">
            <div>
                {{Auth::user()->name}}
            </div>
            <div style="font-size:10px">
                Level : {{Auth::user()->level}}
            </div>
        </div>
        <div style="margin-right:5px"class="profile profile-3">
            <a style="display: flex;
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;"href="/dashboard/logout">
            <i style="font-size: 25px"class="bi bi-box-arrow-right"></i></a>
        </div>
    </div>
</div>
<div class="header">

</div>
<div class="content">
    @yield('content')
</div>
    <script>
        $(".item").click(function(){
            window.location=$(this).find("a").attr("href"); 
            return false;
        });

        function resultState(data, container) {
            if(data.element) {
                $(container).addClass($(data.element).attr("class"));
            }
            return data.text;
        }

        // Reload Page on idle
        // var idleTime;
        // $(document).ready(function () {
        //         reloadPage();
        //         $('html').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
        //             clearTimeout(idleTime);
        //             reloadPage();
        //         });
        // });
        // function reloadPage() {
        //     clearTimeout(idleTime);
        //     idleTime = setTimeout(function () {
        //         location.reload();
        //     }, 10000);
        // }
    </script>
</body>
</html>