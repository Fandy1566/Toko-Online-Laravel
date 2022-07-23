<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use DB;

class pegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $this->authorize('Pegawai');
        $pegawaiall = user::where('level',2)->get();
        return view('admin.pegawai.index', compact('pegawaiall'));
    }

    public function store(Request $request)
    {
        $this->authorize('Admin');
        try {
            $pegawai = new user;
            $increment = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA ='" . env('DB_DATABASE') . "' AND TABLE_NAME ='" . $pegawai->getTable() . "'")[0]->AUTO_INCREMENT;
            $pegawai->id_user = "USER-".str_pad($increment,7,"0",STR_PAD_LEFT);
            $pegawai->name = $request->nama_pegawai;
            $pegawai->telp = $request->no_telp;
            $pegawai->alamat = $request->alamat;
            $pegawai->email = $request->email;
            $pegawai->gender = $request->jk;
            $pegawai->level = 2;
            $pegawai->password= bcrypt($request->password);
            $pegawai->email= $request->email;
            $pegawai->save();
            $request->session()->flash("info", "Data baru berhasil ditambahkan");
        } catch (\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                $request->session()->flash("error", "Email tidak boleh sama");
                return redirect()->back();
            }
            $request->session()->flash("error", "Kesalahan Query");
            return redirect()->back();
        }
        
        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $this->authorize('Admin');
        $pegawaiall = user::where('level',2)->get();
        $pegawai = user::find($id);
        return view("admin.pegawai.index", compact('pegawaiall','pegawai'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('Admin');
        $pegawai = user::findOrFail($id);
        $pegawai->name = $request->nama_pegawai;
        $pegawai->telp = $request->no_telp;
        $pegawai->alamat = $request->alamat;
        $pegawai->email = $request->email;
        $pegawai->gender = $request->jk;
        $pegawai->password= bcrypt($request->password);
        $pegawai->save();
        $request->session()->flash("info", "Data user berhasil diupdate!");
        return redirect()->route("pegawai.index");
    }

    public function destroy(Request $request, $id)
    {
        $this->authorize('Admin');
        $pegawai = user::find($id);
        $pegawai->delete();

        $request->session()->flash("info", "Data user berhasil dihapus!");
        return redirect()->back();
    }
}
