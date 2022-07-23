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

    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endforeach

    <div class="card"style="margin-top:40px;">
        <div class="table-product" style="padding:20px;">
        <h2>
            Daftar Transaksi
        </h2>
        <button id="modal-btn" class="btn-input">Input Transaksi</button>
            <div id="modal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2>Input Data</h2>
                    </div>
                    <div class="card-form">
                        <form action="{{ route('transaksi.store') }}" method="POST" style="padding-top: 0px">
                            @csrf
                            <div class="input-more break">
                                <label>Nama Customer<span style="color:red">*</span></label>
                                <select class="select2" name="nama_customer">
                                    @foreach ($customer as $ket => $value)
                                    <option value="{{$value->id}}">{{$value->name}} ({{$value->id_user}})</option>
                                    @endforeach
                                </select>
                                <br>
                                <label>Alamat</label><br>
                                <input type="text" name="alamat" placeholder="Alamat Default Users" required>
                                <br>
                                <label>Produk</label>
                                <button type="button" class="btn-add">+</button>
                                <table id="tbl-trs">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>jumlah</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody id="trs-body">
                                        <tr>
                                            <td>
                                                <select class="select2" name="id_product[]" required>
                                                    <option value="">Produk (Stok)</option>
                                                    @foreach($product as $key => $value)
                                                    <option value="{{$value->id}}">{{$value->nama_product}} ({{$value->stok}})</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="jmlh[]" min="1" required>
                                            </td>
                                            <td>
                                                <button type="button" style="display:none" class="btn-remove">Hapus</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                            </div>
                            <input type="submit" value="Input Data">
                        </form>
                    </div>
                </div>
            </div>
            <table id="tbl">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Tanggal Transaksi</th>
                        <th>Customer</th>
                        <th>Alamat</th>
                        <th>Total</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi as $key => $value)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$value->id_transaksi}}</td>
                        <td>{{date_format($value->created_at,"d/m/Y")}}</td>
                        <td>{{$value->user->name}}</td>
                        <td>{{$value->alamat}}</td>
                        <td>Rp {{ number_format($value->total, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('transaksi.show',['id'=> $value->id])}}">detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
    function refresh() {
        $('.select2').select2({
            width: '100%',
            templateResult: resultState,
            selectOnClose: true,
        });
    }
    
    $(document).ready(function(){
        var i = 1;
        refresh();
        $(".btn-add").click(function(){
            ++i;
            var html ='';                
            html += '<tr>';
            html += '<td>';
            html += '<select name="id_product[]" required>';
            html += '<option value="">Pilih Produk</option>';
            html += ' @foreach($product as $key => $value)';
            html += '<option value="{{$value->id}}">{{$value->nama_product}} ({{$value->stok}})</option>';
            html += '@endforeach';
            html += '</select>';
            html += '</td>';
            html += '<td>';
            html += '<input type="number" name="jmlh[]" min="1" required>';
            html += '</td>';
            html += '<td>';
            html += '<button class="btn-remove">Hapus</button>';
            html += '</td>';
            html += '</tr>';
            $("#trs-body").append(html);
            if (i>1) {
                $(".btn-remove").css('display','inline');
            }
        });
        $(document).on('click', '.btn-remove', function () {
            $(this).closest('tr').remove();
            --i;
            if(i<2){
                $(".btn-remove").css('display','none');
            }
        });
    });
    var modal = document.getElementById("modal");
    var btn = document.getElementById("modal-btn");
    var span = document.getElementsByClassName("close")[0];
    var btnShow = document.getElementsByClassName("modal-btn-show");

    btn.onclick = function() {
    modal.style.display = "block";
    }
    
    span.onclick = function() {
        if ({!! (request()->is('dashboard/user/edit*'))? 1:0 !!} == 1) {
            location.replace(location.origin+"/dashboard/user");
        } else {
            modal.style.display = "none";
        }
    }
    </script>
@endsection