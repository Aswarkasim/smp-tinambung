<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminEkskulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cari = request('cari');
        if ($cari) {
            $ekskul = Ekskul::where('nama', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $ekskul = Ekskul::latest()->paginate(10);
        }
        $data = [
            'title' => 'Ekskul',
            'ekskul' => $ekskul,
            'content' => 'admin/ekskul/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'title' => 'Tambah Ekskul',
            'content' => 'admin/ekskul/add'
        ];
        return view('admin/layouts/wrapper', $data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name'  => 'required',
            'desc'  => 'required',
            'visi'  => 'required',
            'misi'  => 'required',
            'cover'  => 'required',
        ]);

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $file_name = time() . "_" . $cover->getClientOriginalName();

            $storage = 'uploads/images/';
            $cover->move($storage, $file_name);
            $data['cover'] = $storage . $file_name;
        } else {
            $data['cover'] = NULL;
        }

        Ekskul::create($data);
        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect('/admin/ekskul');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = [
            'title' => 'Tambah Ekskul',
            'ekskul' => Ekskul::find($id),
            'content' => 'admin/ekskul/add'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $ekskul = Ekskul::find($id);
        $data = $request->validate([
            'name'  => 'required',
            'desc'  => 'required',
            'visi'  => 'required',
            'misi'  => 'required'
        ]);

        if ($request->hasFile('cover')) {
            if ($ekskul->cover) {
                unlink($ekskul->cover);
            }
            $cover = $request->file('cover');
            $file_name = time() . "_" . $cover->getClientOriginalName();

            $storage = 'uploads/images/';
            $cover->move($storage, $file_name);
            $data['cover'] = $storage . $file_name;
        } else {
            $data['cover'] = $ekskul->cover;
        }
        $ekskul->update($data);
        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect('/admin/ekskul');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $ekskul = Ekskul::find($id);
        if ($ekskul->cover) {
            unlink($ekskul->cover);
        }
        $ekskul->delete();
        Alert::success('Berhasil', 'Data Berhasil Dihapus');
        return redirect('/admin/ekskul');
    }
}
