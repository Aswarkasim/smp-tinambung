<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Galeri;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminGaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $galeri = Galeri::paginate(10);
        $data = [
            'title'     => 'Manajemen galeri',
            'galeri'    => $galeri,
            'content'   => 'admin/galeri/index'
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
            'content'   => 'admin/galeri/add'
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
            'desc'              => 'required|min:3',
            'image'              => 'required:mimes:jpg,png',
        ]);

        //perbaiki upload imagenya
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = time() . "_" . $image->getClientOriginalName();

            $storage = 'uploads/galeries/';
            $image->move($storage, $file_name);
            $data['image'] = $storage . $file_name;
        } else {
            $data['image'] = NULL;
        }

        Galeri::create($data);
        Alert::success('Sukses', 'Galeri telah ditambahkan');
        return redirect('/admin/galeri');
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
        $galeri = Galeri::find($id);
        $data = [
            'title'     => 'Tambah Foto',
            'galeri'    => $galeri,
            'content'   => 'admin/galeri/add'
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
        $galeri = Galeri::find($id);
        $data = $request->validate([
            'desc'              => 'required|min:3',
            // 'image'              => 'required:mimes:jpg,png',
        ]);

        //perbaiki upload imagenya
        if ($request->hasFile('image')) {
            if ($galeri->image != '') {
                unlink($galeri->image);
            }

            $image = $request->file('image');
            $file_name = time() . "_" . $image->getClientOriginalName();

            $storage = 'uploads/galeries/';
            $image->move($storage, $file_name);
            $data['image'] = $storage . $file_name;
        } else {
            $data['image'] = $galeri->image;
        }

        $galeri->update($data);
        Alert::success('Sukses', 'Galeri telah ditambahkan');
        return redirect('/admin/galeri');
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
        $galeri = Galeri::find($id);
        if (($galeri->image != '') || $galeri->galeri != null) {
            unlink($galeri->image);
        }
        $galeri->delete();
        Alert::success('Sukses', 'Galeri telah dihapus');
        return redirect('/admin/galeri');
    }
}
