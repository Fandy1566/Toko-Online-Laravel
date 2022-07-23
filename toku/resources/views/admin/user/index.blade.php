@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="title-content">
        <div>
            User
        </div>
    </div>
    <div class="card"style="margin-top:40px;">
        <div class="table-product" style="padding:20px;">
        <h2>
            Daftar User
        </h2>
        <button id="modal-btn" class="btn-input">Input User</button>
            <div id="modal" class="modal" style="{{(request()->is('dashboard/user/edit*'))? 'display:block':''}}">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2>{{(request()->is('dashboard/user/edit*'))? 'Edit Data':'Input Data'}}</h2>
                    </div>
                    <div class="card-form">
                        <form action="{{ (request()->is('dashboard/user/edit*'))? route('user.update', ['id' => $user->id]) : route('user.store') }}" method="POST" style="padding-top: 0px">
                            @csrf
                            @if(request()->is('dashboard/user/edit*'))
                                @method('PATCH')
                            @endif
                            <div class="input-more break">
                                <label>Nama User<span style="color:red">*</span></label> <br>
                                <input type="text" name="nama_user" value="{{(request()->is('dashboard/user/edit*'))? $user->name:''}}">
                                <br>
                                <label>Nomor Telepon<span style="color:red">*</span></label> <br>
                                <input type="text" name="no_telp" value="{{(request()->is('dashboard/user/edit*'))? $user->telp:''}}">
                                <br>
                                <label>Alamat<span style="color:red">*</span></label> <br>
                                <input type="text" name="alamat" value="{{(request()->is('dashboard/user/edit*'))? $user->alamat:''}}">
                                <br>
                                <label>Jenis Kelamin<span style="color:red">*</span></label> <br>
                                <select name="jk">
                                    @if(request()->is('dashboard/user/edit*'))
                                    <option class="invisible" value="{{$user->gender}}">
                                        @if ($user->gender ==='L')
                                            Laki-laki
                                        @elseif ($user->gender ==='P')
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
                                <input type="email" name="email" value="{{(request()->is('dashboard/user/edit*'))? $user->email:''}}">
                                <br>
                                <label>Password<span style="color:red">*</span></label> <br>
                                <input type="password" name="password">
                                <br>
                                <label>Level<span style="color:red">*</span></label> <br>
                                <select name="level">
                                    @if(request()->is('dashboard/user/edit*'))
                                    <option class="invisible" value="{{$user->level}}">
                                        @if ($user->level == 1)
                                            Admin
                                        @elseif ($user->level == 2)
                                            Pegawai
                                        @else
                                            Customer
                                        @endif
                                        </option>
                                    @endif
                                    <option value="1">Admin</option>
                                    <option value="2">Pegawai</option>
                                    <option value="3">Customer</option>
                                </select>
                                <br>
                                <br>
                                <input type="submit" value="{{(request()->is('dashboard/user/edit*'))? 'Update Data':'Input Data'}}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table id="tbl">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID User</th>
                        <th>Nama User</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userall as $key => $value)
                    <tr>
                        <td class="number">{{++$key}}</td>
                        <td>{{$value->id_user}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->telp}}</td>
                        <td>{{$value->alamat}}</td>
                        <td>{{$value->gender}}</td>
                        <td>{{$value->email}}</td>
                        <td>                                        
                            @if ($value->level == 1)
                                Admin
                            @elseif ($value->level == 2)
                                Pegawai
                            @else
                                Customer
                            @endif
                        </td>
                        <td>
                            <a class="btn edit" href="/dashboard/user/edit/{{ $value->id}}" style="margin-bottom:5%">Edit</a>
                            <form action="{{ route('user.delete', ['id' => $value->id]) }}" method="post">
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
            if ({!! (request()->is('dashboard/user/edit*'))? 1:0 !!} == 1) {
                location.replace(location.origin+"/dashboard/user");
            } else {
                modal.style.display = "none";
            }
        }
    </script>
@endsection