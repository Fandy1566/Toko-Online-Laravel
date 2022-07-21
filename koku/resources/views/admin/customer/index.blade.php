@extends('layouts.admin')
@section('title', 'Product')
@section('content')
    <div class="title-content">
        <div>
            Customer
        </div>
    </div>
    <div class="card"style="margin-top:40px;">
        <div class="table-product" style="padding:20px;">
        <h2>
            Daftar Customer
        </h2>
        <button id="modal-btn" class="btn-input">Input Customer</button>
            <div id="modal" class="modal" style="{{(request()->is('dashboard/customer/edit*'))? 'display:block':''}}">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2>{{(request()->is('dashboard/customer/edit*'))? 'Edit Data':'Input Data'}}</h2>
                    </div>
                    <div class="card-form">
                        <form action="{{ (request()->is('dashboard/customer/edit*'))? route('customer.update', ['id' => $customer->id]) : route('customer.store') }}" method="POST" style="padding-top: 0px">
                            @csrf
                            @if(request()->is('dashboard/customer/edit*'))
                                @method('PATCH')
                            @endif
                            <div class="input-more break">
                                <label>Nama Customer<span style="color:red">*</span></label> <br>
                                <input type="text" name="nama_customer" value="{{(request()->is('dashboard/customer/edit*'))? $customer->name:''}}">
                                <br>
                                <label>Nomor Telepon<span style="color:red">*</span></label> <br>
                                <input type="text" name="no_telp" value="{{(request()->is('dashboard/customer/edit*'))? $customer->telp:''}}">
                                <br>
                                <label>Alamat<span style="color:red">*</span></label> <br>
                                <input type="text" name="alamat" value="{{(request()->is('dashboard/customer/edit*'))? $customer->alamat:''}}">
                                <br>
                                <label>Jenis Kelamin<span style="color:red">*</span></label> <br>
                                <select name="jk">
                                    @if(request()->is('dashboard/customer/edit*'))
                                    <option class="invisible" value="{{$customer->gender}}">
                                        @if ($customer->gender ==='L')
                                            Laki-laki
                                        @elseif ($customer->gender ==='P')
                                            Perempuan
                                        @else
                                            Lainnya/Tidak Diketahui
                                        @endif
                                        </option>
                                    @endif
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                    <option value="?">Lainnya/Tidak Diketahui</option>
                                </select>
                                <br>
                                <label>Email<span style="color:red">*</span></label> <br>
                                <input type="email" name="email" value="{{(request()->is('dashboard/customer/edit*'))? $customer->email:''}}">
                                <br>
                                <label>Password<span style="color:red">*</span></label> <br>
                                <input type="password" name="password">
                                <br>
                                <br>
                                <input type="submit" value="{{(request()->is('dashboard/customer/edit*'))? 'Update Data':'Input Data'}}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table id="tbl">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Customer</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customerall as $key => $value)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->telp}}</td>
                        <td>{{$value->alamat}}</td>
                        <td>{{$value->gender}}</td>
                        <td>{{$value->email}}</td>
                        <td>
                            <a class="btn edit" href="/dashboard/customer/edit/{{ $value->id}}" style="margin-bottom:5%">Edit</a>
                            <form action="{{ route('customer.delete', ['id' => $value->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="_method" value="delete">
                                <button id="btn_hapus" type="submit" class="btn delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        var modal = document.getElementById("modal");
        var btn = document.getElementById("modal-btn");
        var span = document.getElementsByClassName("close")[0];
        // var URL = window.location.href;
        // var arr=URL.split('/');

        btn.onclick = function() {
        modal.style.display = "block";
        }
        
        span.onclick = function() {
            if ({!! (request()->is('dashboard/customer/edit*'))? 1:0 !!} == 1) {
                location.replace(location.origin+"/dashboard/customer");
            } else {
                modal.style.display = "none";
            }
        }
    </script>
@endsection