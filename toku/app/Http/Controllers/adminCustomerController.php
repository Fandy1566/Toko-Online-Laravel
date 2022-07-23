<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;


class adminCustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $this->authorize('Pegawai');
        $customerall = user::where('level',3)->get();
        return view('admin.customer.index', compact('customerall'));
    }

    public function store(Request $request)
    {
        $this->authorize('Pegawai');
        $customer = new user;
        $increment = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA ='" . env('DB_DATABASE') . "' AND TABLE_NAME ='" . $customer->getTable() . "'")[0]->AUTO_INCREMENT;
        $customer->id_user = "USER-".str_pad($increment,7,"0",STR_PAD_LEFT);
        $customer->name = $request->nama_customer;
        $customer->telp = $request->no_telp;
        $customer->alamat = $request->alamat;
        $customer->email = $request->email;
        $customer->gender = $request->jk;
        $customer->level = 3;
        $customer->password= bcrypt($request->password);
        $customer->save();
        $request->session()->flash("info", "Data baru berhasil ditambahkan");
        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $this->authorize('Pegawai');
        $customer = user::find($id);
        $customerall = user::where('level',3)->get();
        return view("admin.customer.index", compact('customer','customerall'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('Pegawai');
        $customer = user::findOrFail($id);
        $customer->name = $request->nama_customer; 
        $customer->no_telp = $request->no_telp; 
        $customer->alamat = $request->alamat;
        $customer->jk = $request->jk;
        $customer->save();
        $request->session()->flash("info", "Data user berhasil diupdate!");
        return redirect()->route("customer.index");
    }

    public function destroy(Request $request, $id)
    {
        $this->authorize('Pegawai');
        $customer = user::find($id);
        $customer->delete();

        $request->session()->flash("info", "Data user berhasil dihapus!");
        return redirect()->back();
    }
}
