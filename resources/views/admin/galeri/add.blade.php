<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @if (Request::is('admin/galeri/create'))
          <form action="/admin/galeri" method="POST" enctype="multipart/form-data">  
        @else
          <form action="/admin/galeri/{{$galeri->id}}" method="POST" enctype="multipart/form-data">  
            @method('PUT')
        @endif
          @csrf
   

          <div class="form-group">
            <label for="">Deskripsi</label>
            <textarea class="form-control  @error('desc') is-invalid @enderror" id="summernote"  name="desc" placeholder="Deskripsi">{{isset($galeri) ? $galeri->desc : old('desc')}}</textarea>
            @error('desc')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
            @enderror
          </div>

       
          <div class="form-group">
            <label for="">Gambar</label>
            <input type="file" class="form-control  @error('image') is-invalid @enderror"  name="image"  value="{{isset($galeri) ? $galeri->image : old('image')}}" placeholder="image">
            {{-- <input type="file" class="form-control  @error('image') is-invalid @enderror"  name="image"  placeholder="image"> --}}
             @error('image')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror

            @if (isset($galeri))
                <img src="/{{$galeri->image}}" width="100%" class="py-3" alt="">
            @endif
          </div>

     
          <a href="/admin/galeri" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

