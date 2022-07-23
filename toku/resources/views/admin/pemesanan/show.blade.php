@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="title-content">
        <div>
            Transaksi
        </div>
    </div>
    <div class="back-btn">
        <a href="{{route ('pemesanan.index')}}"><i class="bi bi-caret-left"></i></a>
    </div>
    <div class="card">
        <div class="table-product" style="padding:20px;">
        <h2>
            Detail Pemesanan
        </h2>
        ID Pemesanan : {{$pemesanan->id_pemesanan}} <br>
        Nama Customer : {{$pemesanan->user->name}} <br>
        Tanggal Pesan : {{date_format($pemesanan->created_at,"d/m/Y")}}
            <table id="tbl">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pemesanan_detail as $key => $value)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$value->produk->nama_product}}</td>
                        <td style="text-align: right">Rp {{ number_format($value->produk->harga, 0, ',', '.') }}</td>
                        <td style="text-align: right">{{ number_format($value->jumlah, 0, ',', '.') }}</td>
                        <td style="text-align: right">Rp {{ number_format($value->produk->harga * $value->jumlah, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                    <tr style="text-align: right">
                        <td colspan="4">Total Pembelian</td>
                        <td>Rp {{ number_format($pemesanan->total, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>

    </script>
@endsection