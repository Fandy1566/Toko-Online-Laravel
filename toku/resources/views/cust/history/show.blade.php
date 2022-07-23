@extends('layouts.cust')
@section('title', 'Dashboard')
@section('content')
    <div class="back-btn">
        <a href="{{route ('history')}}"><i class="bi bi-caret-left"></i></a>
    </div>
    <div class="card">
        <div class="table-product" style="padding:20px;">
        <h2>
            Detail transaksi
        </h2>
        ID transaksi : {{$transaksi->id_transaksi}} <br>
        Nama Customer : {{$transaksi->user->name}} <br>
        Tanggal Transaksi : {{date_format($transaksi->created_at,"d/m/Y")}}
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
                    @foreach($transaksi_detail as $key => $value)
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
                        <td>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>

    </script>
@endsection