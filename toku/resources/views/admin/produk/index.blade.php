@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="title-content">
        <div>
            Product
        </div>
    </div>
    <div class="card"style="margin-top:40px;">
        <div class="table-product" style="padding:20px;">
        <h2>
            Daftar Produk
        </h2>
        @can('Admin')
        <a class="btn-input" href="/dashboard/produk/create">Tambah Produk</a>
        @endcan
        <table id="tbl">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    @can('Admin')
                    <th>&nbsp;</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach($product as $key => $value)
                <tr>
                    <td>{{++$key}}</td>
                    <td>
                        <div class="flex">
                            <div class="flex-img">
                                <img src="{{asset('storage/'. $value->gambar_produk)}}" alt="Tidak ada gambar" srcset="" width="200" height="100">
                            </div>
                            <div class="flex-text">
                                <div class="flex-nama">
                                    Nama Produk:{{$value->nama_product}}
                                </div>
                                <div class="flex-id">
                                    ID Produk:{{$value->id_product}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>Rp {{ number_format($value->harga, 0, ',', '.') }}</td>
                    <td>{{ number_format($value->stok, 0, ',', '.') }}</td>
                    @can('Admin')
                    <td>
                        <a class="btn edit" href="/dashboard/produk/edit/{{ $value->id}}" style="margin-bottom:5%">Edit</a>
                        <form action="{{ route('produk.delete', ['id' => $value->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="_method" value="delete">
                            <button id="btn_hapus" type="submit" class="btn delete">Hapus</button>
                        </form>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection