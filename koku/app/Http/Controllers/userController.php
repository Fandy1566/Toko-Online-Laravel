<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use DB;

class userController extends Controller
{
    public function index()
    {
        $userall = user::all();
        return view('admin.user.index', compact('userall'));
    }

    public function store(Request $request)
    {
        $user = new user;
        $increment = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA ='" . env('DB_DATABASE') . "' AND TABLE_NAME ='" . $user->getTable() . "'")[0]->AUTO_INCREMENT;
        $user->id_user = "USER-".str_pad($increment,7,"0",STR_PAD_LEFT);
        $user->name = $request->nama_user;
        $user->telp = $request->no_telp;
        $user->alamat = $request->alamat;
        $user->email = $request->email;
        $user->gender = $request->jk;
        $user->level = $request->level;
        $user->password= bcrypt($request->password);
        $user->save();
        $request->session()->flash("info", "Data baru berhasil ditambahkan");
        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $user = user::find($id);
        $userall = user::all();
        return view("admin.user.index", compact('user','userall'));
    }

    public function update(Request $request, $id)
    {
        $user = user::findOrFail($id);
        $user->name = $request->nama_user;
        $user->telp = $request->no_telp;
        $user->alamat = $request->alamat;
        $user->email = $request->email;
        $user->gender = $request->jk;
        $user->level = $request->level;
        $user->password= bcrypt($request->password);
        $user->save();
        $request->session()->flash("info", "Data user berhasil diupdate!");
        return redirect()->route("user.index");
    }

    public function destroy(Request $request, $id)
    {
        $user = user::find($id);
        $user->delete();

        $request->session()->flash("info", "Data user berhasil dihapus!");
        return redirect()->back();
    }
}
