<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubBagian;
use Illuminate\Http\Request;

class SubBagianController extends Controller
{
    public function index()
    {
        $subBagian = SubBagian::latest()->get();

        return view('admin.sub_bagian.index', compact('subBagian'));
    }

    public function create()
    {
        return view('admin.sub_bagian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sub_bagian' => 'required'
        ]);

        SubBagian::create([
            'nama_sub_bagian' => $request->nama_sub_bagian,
            'deskripsi' => $request->deskripsi,
            'is_active' => 1
        ]);

        return redirect('/admin/sub-bagian')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $subBagian = SubBagian::findOrFail($id);

        return view('admin.sub_bagian.edit', compact('subBagian'));
    }

    public function update(Request $request, $id)
    {
        $subBagian = SubBagian::findOrFail($id);

        $subBagian->update([
            'nama_sub_bagian' => $request->nama_sub_bagian,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect('/admin/sub-bagian')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $subBagian = SubBagian::findOrFail($id);

        $subBagian->delete();

        return redirect('/admin/sub-bagian')
            ->with('success', 'Data berhasil dihapus');
    }

    public function changeStatus($id)
    {
        $data = SubBagian::findOrFail($id);

        $data->is_active =
            !$data->is_active;

        $data->save();

        return back()
            ->with(
                'success',
                'Status berhasil diubah'
            );
    }
}