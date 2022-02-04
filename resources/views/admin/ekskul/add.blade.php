<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @if (Request::is('admin/ekskul/create'))
          <form action="/admin/ekskul" method="POST" enctype="multipart/form-data">  
        @else
          <form action="/admin/ekskul/{{$ekskul->id}}" method="POST" enctype="multipart/form-data">  
            @method('PUT')
        @endif
          @csrf
   

          <div class="form-group">
            <label for="">Nama</label>
            <textarea class="form-control  @error('name') is-invalid @enderror" id="summernote"  name="name" placeholder="Nama">{{isset($ekskul) ? $ekskul->name : old('name')}}</textarea>
            @error('name')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="">Deskripsi</label>
            <textarea class="form-control  @error('desc') is-invalid @enderror" id="summernote"  name="desc" placeholder="Deskripsi">{{isset($ekskul) ? $ekskul->desc : old('desc')}}</textarea>
            @error('desc')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
            @enderror
          </div>
          

          <div class="form-group">
            <label for="">Visi</label>
            <textarea class="form-control  @error('visi') is-invalid @enderror" id="summernote"  name="visi" placeholder="Visi">{{isset($ekskul) ? $ekskul->visi : old('visi')}}</textarea>
            @error('visi')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="">Misi</label>
            <textarea class="form-control  @error('misi') is-invalid @enderror" id="summernote"  name="misi" placeholder="Misi">{{isset($ekskul) ? $ekskul->misi : old('misi')}}</textarea>
            @error('misi')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
            @enderror
          </div>
       
          <div class="form-group">
            <label for="">Gambar</label>
            <input type="file" class="form-control  @error('cover') is-invalid @enderror"  name="cover"  value="{{isset($ekskul) ? $ekskul->cover : old('cover')}}" placeholder="cover">
            {{-- <input type="file" class="form-control  @error('cover') is-invalid @enderror"  name="cover"  placeholder="cover"> --}}
             @error('cover')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror

            @if (isset($ekskul))
                <img src="/{{$ekskul->cover}}" width="100%" class="py-3" alt="">
            @endif
          </div>

     
          <a href="/admin/ekskul" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

