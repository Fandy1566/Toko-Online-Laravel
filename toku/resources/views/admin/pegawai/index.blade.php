@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="title-content">
        <div>
            Pegawai
        </div>
    </div>
    <div class="card"style="margin-top:40px;">
        <div class="table-product" style="padding:20px;">
        <h2>
            Daftar Pegawai
        </h2>
        @can('Admin')
        <button id="modal-btn" class="btn-input">Input Pegawai</button>
            <div id="modal" class="modal" style="{{(request()->is('dashboard/pegawai/edit*'))? 'display:block':''}}">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2>{{(request()->is('dashboard/pegawai/edit*'))? 'Edit Data':'Input Data'}}</h2>
                    </div>
                    <div class="card-form">
                        <form action="{{ (request()->is('dashboard/pegawai/edit*'))? route('pegawai.update', ['id' => $pegawai->id]) : route('pegawai.store') }}" method="POST" style="padding-top: 0px">
                            @csrf
                            @if(request()->is('dashboard/pegawai/edit*'))
                                @method('PATCH')
                            @endif
                            <div class="input-more break">
                                <label>Nama Pegawai<span style="color:red">*</span></label> <br>
                                <input type="text" name="nama_pegawai" value="{{(request()->is('dashboard/pegawai/edit*'))? $pegawai->name:''}}" required>
                                <br>
                                <label>Nomor Telepon<span style="color:red">*</span></label> <br>
                                <input type="text" name="no_telp" value="{{(request()->is('dashboard/pegawai/edit*'))? $pegawai->telp:''}}" required>
                                <br>
                                <label>Alamat<span style="color:red">*</span></label> <br>
                                <input type="text" name="alamat" value="{{(request()->is('dashboard/pegawai/edit*'))? $pegawai->alamat:''}}" required>
                                <br>
                                <label>Jenis Kelamin<span style="color:red">*</span></label> <br>
                                <select name="jk">
                                    @if(request()->is('dashboard/pegawai/edit*'))
                                    <option class="invisible" value="{{$pegawai->gender}}">
                                        @if ($pegawai->gender ==='L')
                                            Laki-laki
                                        @elseif ($pegawai->gender ==='P')
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
                                <input type="email" name="email" value="{{(request()->is('dashboard/pegawai/edit*'))? $pegawai->email:''}}" required>
                                <br>
                                <label>Password<span style="color:red">*</span></label> <br>
                                <input type="password" name="password">
                                <br>
                                <br>
                                <input type="submit" value="{{(request()->is('dashboard/pegawai/edit*'))? 'Update Data':'Input Data'}}" required>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endcan
            <table id="tbl">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Gender</th>
                        <th>Email</th>
                        @can('Admin')
                        <th>&nbsp;</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach($pegawaiall as $key => $value)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->telp}}</td>
                        <td>{{$value->alamat}}</td>
                        <td>{{$value->gender}}</td>
                        <td>{{$value->email}}</td>
                        @can('Admin')
                        <td>
                            <a class="btn edit" href="/dashboard/pegawai/edit/{{ $value->id}}" style="margin-bottom:5%">Edit</a>
                            <form action="{{ route('pegawai.delete', ['id' => $value->id]) }}" method="post">
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
            if ({!! (request()->is('dashboard/pegawai/edit*'))? 1:0 !!} == 1) {
                location.replace(location.origin+"/dashboard/pegawai");
            } else {
                modal.style.display = "none";
            }
        }
    </script>
@endsection