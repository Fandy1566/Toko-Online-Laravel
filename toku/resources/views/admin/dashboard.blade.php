@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="title-content">
        <div>
            Dashboard
        </div>
    </div>
    <div class="container">
        <div class="box box-1">
            <div class="num num-box-1">
                {{$product}}
            </div>
            <a href="/dashboard/produk">
                <div class="name name-box-1">
                    Produk
                </div>
            </a>
        </div>
        @can('Admin')
        <div class="box box-2">
            <div class="num num-box-2">
                {{$user}}
            </div>
            <a href="/dashboard/user">
                <div class="name name-box-2">
                    User
                </div>
            </a>
        </div>
        @endcan
        <div class="box box-3">
            <div class="num num-box-3">
                {{$pegawai}}
            </div>
            <a href="/dashboard/pegawai">
                <div class="name name-box-3">
                    Pegawai
                </div>
            </a>
        </div>
        <div class="box box-4">
            <div class="num num-box-4">
                {{$customer}}
            </div>
            <a href="/dashboard/customer">
                <div class="name name-box-4">
                    Customer
                </div>
            </a>
        </div>
        <div class="box box-1">
            <div class="num num-box-1">
                {{$transaksi}}
            </div>
            <a href="/dashboard/transaksi">
                <div class="name name-box-1">
                    Transaksi
                </div>
            </a>
        </div>
    </div>
    <div class="chart">
        <div class="table-transaksi">
            Transaksi Terbaru
            <table id="tbl">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Nama Customer</th>
                        <th>Total</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_baru as $key => $value)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value->id_transaksi}}</td>
                        <td>{{ $value->user->name}}</td>
                        <td>Rp {{ number_format($value->total, 0, ',', '.') }}</td>
                        <td>Next</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="top-customer">
            Top 10 Customer
            @foreach ($top as $key => $value)
            <br>
            {{++$key}}. {{$value->user->name}} ({{$value->total_pembelian}} Transaksi)
            @endforeach
        </div>
    </div>
@endsection