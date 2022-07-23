@extends('layouts.cust')
@section('title','History')
@section('content')
<div class="history">
    <div class="title-history" style="font-size:30px; font-weight:600;">
        Riwayat Belanja
    </div>
    <br>
    @if(empty($transaksi) || count($transaksi) == 0)
        Anda Belum Melakukan Transaksi
    @else
    <div class="table-history">
        <table id="tbl">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal pembelian</th>
                    <th>Total</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $key =>$value)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{date_format($value->created_at,"d/m/Y")}}</td>
                    <td>Rp {{ number_format($value->total, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('history.show',['id' => $value->id])}}">Next</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection