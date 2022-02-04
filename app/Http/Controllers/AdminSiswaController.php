<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminSiswaController extends Controller
{  //
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
            $data = Siswa::where('nama', 'LIKE', "%$cari%")->paginate(10);
        } else {
            $data = Siswa::paginate(10);
        }
        $siswa = Siswa::paginate(10);
        $data = [
            'title'     => 'Manajemen siswa',
            'siswa'    => $siswa,
            'content'   => 'admin/siswa/index'
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
            'title'     => 'Tambah Foto',
            'content'   => 'admin/siswa/add'
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
            'namalengkap'   => 'required',
            'nis'   => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'   => 'required',
            'alamat'   => 'required',
            'nama_wali'   => 'required',
            'alamat_wali'   => 'required',
            'asal_sekolah'   => 'required',
            'foto'              => 'required:mimes:jpg,jpeg,png',
        ]);

        //perbaiki upload fotonya
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $file_name = time() . "_" . $foto->getClientOriginalName();

            $storage = 'uploads/siswa/';
            $foto->move($storage, $file_name);
            $data['foto'] = $storage . $file_name;
        } else {
            $data['foto'] = NULL;
        }

        Siswa::create($data);
        Alert::success('Sukses', 'Siswa telah ditambahkan');
        return redirect('/admin/siswa');
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
        $siswa = Siswa::find($id);
        $data = [
            'title'     => 'Tambah Foto',
            'siswa'    => $siswa,
            'content'   => 'admin/siswa/add'
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
        $siswa = Siswa::find($id);
        $data = $request->validate([
            'desc'              => 'required|min:3',
            // 'image'              => 'required:mimes:jpg,png',
        ]);

        //perbaiki upload imagenya
        if ($request->hasFile('image')) {
            if ($siswa->image != '') {
                unlink($siswa->image);
            }

            $image = $request->file('image');
            $file_name = time() . "_" . $image->getClientOriginalName();

            $storage = 'uploads/siswaes/';
            $image->move($storage, $file_name);
            $data['image'] = $storage . $file_name;
        } else {
            $data['image'] = $siswa->image;
        }

        $siswa->update($data);
        Alert::success('Sukses', 'Siswa telah ditambahkan');
        return redirect('/admin/siswa');
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
        $siswa = Siswa::find($id);
        if (($siswa->image != '') || $siswa->siswa != null) {
            unlink($siswa->image);
        }
        $siswa->delete();
        Alert::success('Sukses', 'Siswa telah dihapus');
        return redirect('/admin/siswa');
    }
}
