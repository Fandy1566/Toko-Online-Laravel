@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="title-content">
        <div>
            Product
        </div>
</div>
<a href="/dashboard/produk" class="btn kembali">Kembali</a>

<div class="card">
    <h2 style="margin-left: 20px">Buat Produk Baru</h2>
    <div class="card-form">
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" style="padding-top: 0px">
            @csrf
            <div style="
                display: flex;
                flex-direction: column;
                justify-content: center;
                flex: 1;
                max-height: 300px;
                max-width: 300px;
            ">
                <div class="image-preview" style="padding:0px; flex: 5;border-radius:5px;">
                    <img id="output" width="auto" height="100%" style=" background-size:contain;"/>
                </div>
                <div class="input" style="
                flex: 1;
                ">
                    <input type="file" name="gambar_produk" accept="image/*" onchange="loadFile(event)">
                </div>
            </div>
            <div class="input-more" style="flex:3;">
                <label>Nama Produk</label><br>
                <input type="text" name="nama_produk">
                <br>
                <label>Harga</label><br>
                <input type="text" name="harga">
                <br>
                <label>Stok</label><br>
                <input type="text" name="stok">
            </div>
            <div class="break">
                <input type="submit" value="Buat Produk" style="
                    width: 100%;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    box-sizing: border-box;
                    padding: 10px 20px;
                    margin: 8px 0;
                    background-color: #33ff52;
                    color: white;
                ">
            </div>
        </form>
    </div>
</div>
<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>
@endsection