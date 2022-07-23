@extends('layouts.cust')
@section('title','History')
@section('content')
<div class="history">
    <div class="title-history" style="font-size:30px; font-weight:600;">
        Riwayat Pemesanan
    </div>
    <br>
    @if(empty($pemesanan) || count($pemesanan) == 0)
        Anda Belum Melakukan Pemesanan
    @else
    <div class="table-history">
        <table id="tbl">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemesanan as $key =>$value)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{date_format($value->created_at,"d/m/Y")}}</td>
                    <td>Rp {{ number_format($value->total, 0, ',', '.') }}</td>
                    <td>
                        @if($value->status == '1')
                        Ditolak
                        @elseif($value->status == '2')
                        Diterima
                        @else
                        Pending
                        @endif
                    </td>
                    <td><a href="{{ route('pesanan.show',['id' => $value->id])}}">Next</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection