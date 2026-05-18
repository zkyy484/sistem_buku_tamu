<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Models\SubBagian;
use App\Models\RoleAkses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataPegawaiController extends Controller
{
    public function index()
    {
        $pegawai = DataPegawai::with('subBagian')
            ->latest()
            ->get();

        return view('admin.pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        // $subBagian = SubBagian::all();
        $subBagian =
            SubBagian::where(
                'is_active',
                1
            )->get();

        $roles = RoleAkses::whereIn('nama_role', [
            'pegawai',
            'pimpinan'
        ])->get();

        return view('admin.pegawai.create', compact(
            'subBagian',
            'roles'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pegawai' => 'required',
            'nip' => 'required|unique:data_pegawai,nip',
            'email' => 'required|email|unique:data_pegawai,email',
            'jabatan' => 'required',
            'id_sub_bagian' => 'required',
            'no_hp' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
            'id_role_akses' => 'required'
        ]);

        $pegawai = DataPegawai::create([
            'nama_pegawai' => $request->nama_pegawai,
            'nip' => $request->nip,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'id_sub_bagian' => $request->id_sub_bagian,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'is_active' => true
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_role_akses' => $request->id_role_akses,
            'id_pegawai' => $pegawai->id_pegawai,
            'is_active' => true
        ]);

        return redirect('/admin/pegawai')
            ->with('success', 'Data pegawai berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pegawai = DataPegawai::findOrFail($id);

        $subBagian = SubBagian::all();

        return view('admin.pegawai.edit', compact(
            'pegawai',
            'subBagian'
        ));
    }

    public function update(Request $request, $id)
    {
        $pegawai = DataPegawai::findOrFail($id);

        $pegawai->update([
            'nama_pegawai' => $request->nama_pegawai,
            'nip' => $request->nip,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'id_sub_bagian' => $request->id_sub_bagian,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect('/admin/pegawai')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $pegawai = DataPegawai::findOrFail($id);

        User::where('id_pegawai', $pegawai->id_pegawai)
            ->delete();

        $pegawai->delete();

        return redirect('/admin/pegawai')
            ->with('success', 'Data berhasil dihapus');
    }

    public function changeStatus($id)
    {
        $pegawai = DataPegawai::findOrFail($id);

        $pegawai->is_active = !$pegawai->is_active;

        $pegawai->save();

        User::where(
            'id_pegawai',
            $pegawai->id_pegawai
        )
            ->update([
                'is_active' => $pegawai->is_active
            ]);

        return back()
            ->with(
                'success',
                'Status pegawai berhasil diubah'
            );
    }
}