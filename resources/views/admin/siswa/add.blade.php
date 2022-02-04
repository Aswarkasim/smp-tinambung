<div class="row">
  <div class="col-md-12">
    <div class="p-3  card">
      <div class="card-body">

        @if (Request::is('admin/siswa/create'))
          <form action="/admin/siswa" method="POST" enctype="multipart/form-data">  
        @else
          <form action="/admin/siswa/{{$siswa->id}}" method="POST" enctype="multipart/form-data">  
            @method('PUT')
        @endif
          @csrf
   

          <div class="row">
            <div class="col-md-6">

           
           <div class="form-group">
              <label for="">Nama Lengkap</label>
              <input type="text" class="form-control  @error('namalengkap') is-invalid @enderror"  name="namalengkap"  value="{{isset($siswa) ? $siswa->namalengkap : old('namalengkap')}}" placeholder="Nama Lengkap">
              @error('namalengkap')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
              @enderror
            </div>

             <div class="form-group">
              <label for="">NIS</label>
              <input type="text" class="form-control  @error('nis') is-invalid @enderror"  name="nis"  value="{{isset($siswa) ? $siswa->nis : old('nis')}}" placeholder="NIS">
              @error('nis')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
              @enderror
            </div>


             <div class="form-group">
              <label for="">Tempat Lahir</label>
              <input type="text" class="form-control  @error('nis') is-invalid @enderror"  name="nis"  value="{{isset($siswa) ? $siswa->nis : old('nis')}}" placeholder="Tempat Lahir">
              @error('nis')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
              @enderror
            </div>

            <div class="form-group">
              <label for="">Tanggal Lahir</label>
              <input type="date" class="form-control  @error('tanggal_lahir') is-invalid @enderror"  name="tanggal_lahir"  value="{{isset($siswa) ? $siswa->tanggal_lahir : old('tanggal_lahir')}}" placeholder="Tanggal Lahir">
              @error('tanggal_lahir')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
              @enderror
            </div>

            <div class="form-group">
              <label for="">Alamat</label>
              <input type="text" class="form-control  @error('alamat') is-invalid @enderror"  name="alamat"  value="{{isset($siswa) ? $siswa->alamat : old('alamat')}}" placeholder="Alamat">
              @error('alamat')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
              @enderror
            </div>
 
       
          

           </div>
            <div class="col-md-6">

              <div class="form-group">
                <label for="">Nama Wali</label>
                <input type="text" class="form-control  @error('nama_wali') is-invalid @enderror"  name="nama_wali"  value="{{isset($siswa) ? $siswa->nama_wali : old('nama_wali')}}" placeholder="Nama Wali">
                @error('nama_wali')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Alamat Wali</label>
                <input type="text" class="form-control  @error('alamat_wali') is-invalid @enderror"  name="alamat_wali"  value="{{isset($siswa) ? $siswa->alamat_wali : old('alamat_wali')}}" placeholder="Alamat Wali">
                @error('alamat_wali')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

                 <div class="form-group">
                <label for="">Asal Sekolah</label>
                <input type="text" class="form-control  @error('asal_sekolah') is-invalid @enderror"  name="asal_sekolah"  value="{{isset($siswa) ? $siswa->asal_sekolah : old('asal_sekolah')}}" placeholder="Asal Sekolah">
                @error('asal_sekolah')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

                  <div class="form-group">
                <label for="">Foto</label>
                <input type="file" class="form-control  @error('foto') is-invalid @enderror"  name="foto"  value="{{isset($siswa) ? $siswa->foto : old('foto')}}" placeholder="Foto">
                @error('foto')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror

                @if (isset($siswa))
                    <img src="/{{$siswa->gambar}}" width="100%" class="py-3" alt="">
                @endif
              </div>

            </div>
          </div>

     
          <a href="/admin/siswa" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

