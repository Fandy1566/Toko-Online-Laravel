@extends('layouts.cust')
@section('title','History')
@section('content')
<div class="history">
    <div class="title-history" style="font-size:30px; font-weight:600;">
        Riwayat Belanja
    </div>
    <br>
    <div class="table-history">
        <table id="tbl">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal pembelian</th>
                    <th>Barang pembelian</th>
                    <th>Total</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>10/2/2002</td>
                    <td>Shikanoiun Heizou</td>
                    <td>Rp 20.000</td>
                    <td>Next</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection