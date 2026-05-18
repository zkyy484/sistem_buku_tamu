<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TujuanKonsultasi;
use Illuminate\Http\Request;

class TujuanKonsultasiController extends Controller
{
    public function index()
    {
        $tujuan = TujuanKonsultasi::latest()->get();

        return view('admin.tujuan.index', compact('tujuan'));
    }

    public function create()
    {
        return view('admin.tujuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tujuan_konsultasi' => 'required'
        ]);

        TujuanKonsultasi::create([
            'tujuan_konsultasi' => $request->tujuan_konsultasi,
            'is_active' => 1
        ]);

        return redirect('/admin/tujuan-konsultasi')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $tujuan = TujuanKonsultasi::findOrFail($id);

        return view('admin.tujuan.edit', compact('tujuan'));
    }

    public function update(Request $request, $id)
    {
        $tujuan = TujuanKonsultasi::findOrFail($id);

        $tujuan->update([
            'tujuan_konsultasi' => $request->tujuan_konsultasi
        ]);

        return redirect('/admin/tujuan-konsultasi')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $tujuan = TujuanKonsultasi::findOrFail($id);

        $tujuan->delete();

        return redirect('/admin/tujuan-konsultasi')
            ->with('success', 'Data berhasil dihapus');
    }

    public function changeStatus($id)
    {
        $tujuan =
            TujuanKonsultasi::findOrFail($id);

        $tujuan->is_active =
            !$tujuan->is_active;

        $tujuan->save();

        return back()
            ->with(
                'success',
                'Status berhasil diubah'
            );
    }
}