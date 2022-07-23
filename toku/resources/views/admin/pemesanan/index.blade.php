@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="title-content">
        <div>
            Transaksi
        </div>
    </div>
    	
	@if (session()->has('info'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('info') }}
        </div>
    @endif

    <div class="card"style="margin-top:40px;">
        <div class="table-product" style="padding:20px;">
        <h2>
            Daftar Pemesanan
        </h2>
        <div class="nav-pemesanan">
            <a class="pending {{(request()->is('dashboard/pemesanan')) ? 'active' : '' }}" href="{{route('pemesanan.index')}}" required>
                Pending
            </a>
            <a class="diterima {{(request()->is('dashboard/pemesanan/diterima')) ? 'active' : '' }}" href="{{route('pemesanan.diterima')}}" required>
                Diterima
            </a>
            <a class="ditolak {{(request()->is('dashboard/pemesanan/ditolak')) ? 'active' : '' }}" href="{{route('pemesanan.ditolak')}}" required>
                Ditolak
            </a>
            <a class="all {{(request()->is('dashboard/pemesanan/all')) ? 'active' : '' }}" href="{{route('pemesanan.all')}}" required>
                Tampilkan Semua
            </a>
        </div>
        <!-- <button id="modal-btn" class="btn-input">Input Transaksi</button> -->
            <table id="tbl">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Customer</th>
                        <th>Alamat</th>
                        <th>Total</th>
                        <th>Detail</th>
                        @if(Request::path() === 'dashboard/pemesanan')
                        <th>&nbsp;</th>
                        @endif 
                    </tr>
                </thead>
                <tbody>
                    @foreach($pemesanan as $key => $value)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$value->id_pemesanan}}</td>
                        <td>{{$value->user->name}}</td>
                        <td>{{$value->alamat}}</td>
                        <td>Rp {{ number_format($value->total, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('pemesanan.show', ['id' => $value->id])}}">Detail</a>
                        </td>
                        @if(Request::path() === 'dashboard/pemesanan')
                        <td>
                            <form action="{{ route('pemesanan.terima', ['id' => $value->id])}}" method="post">
                                @csrf
                                <button type="submit"><i class="bi bi-check-lg"></i></button>
                            </form>
                            <form action="{{ route('pemesanan.tolak', ['id' => $value->id])}}" method="post">
                                @csrf
                                @method("PATCH")
                                <button type="submit">Tolak</button>
                            </form>
                        </td>
                        @endif 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>

    </script>
@endsection