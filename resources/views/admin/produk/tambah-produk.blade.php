@extends('layouts.app')

@section('content')

<div class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  @if (isset($produk))
  <h3 class="mt-3 mb-3">Edit Produk (Barang)</h3>

  <form action="{{ route('admin.produk.edit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $produk->id}}">
    <div class="form-group w-50">
        <label for="inputAddress">Nama Produk</label>
        <input type="text" class="form-control" value="{{ $produk->nama_produk }}" name="nama" id="inputAddress" placeholder="Kursi">
        {{-- name="nama" artinya nama form inputannya adalah nama --}}
      </div>
      <div class="form-group d-flex w-100">
        <div>
          <label for="inputAddress">Harga</label>
          <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
              <div class="input-group-text">Rp</div>
              </div>
              <input type="text" class="form-control" value="{{$produk->harga }}"  name="harga" id="inlineFormInputGroupUsername2" placeholder="1300000">
          </div>
        </div>
    </div>

    <label>Gambar</label>
    <table>
      <tr>
        <td>
          <label for="gambar-1" id="label-1">
            @if (isset($gambar[0]) && $gambar[0]->img != null)   
            <div id="thumb-1" onmouseover="hover(1)" onmouseout="cls(1)" class="img-thumbnail" style="width: 160px;">
              <img id="preview-1" src="{{ asset('produk/detail/'.$gambar[0]->img.'') }}" alt="" class="img-thumbnail" style="width: 160px; height: 120px">
              <div id="delpre-1" class="w-100 d-none">
                <button type="button" onclick="delpic(1)" class="btn btn-danger">hapus</button>
              </div>
            </div>
            <input type="text" name="picture_1" id="picture-1" value="{{ $gambar[0]->img }}" class="d-none"/>
            @else 
            <div class="img-thumbnail d-flex justify-content-center align-items-center" style="width: 160px; height: 120px">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
              </svg>
            </div>
            @endif
          </label>
          <input type="file" accept="image/*" name="gambar-1" id="gambar-1" class="d-none"/>
        </td>
        <td width="10px"></td>
        <td>
          <label for="gambar-2" id="label-2">
            @if (isset($gambar[1]) && $gambar[1]->img != null)   
            <div id="thumb-2" onmouseover="hover(2)" onmouseout="cls(2)" class="img-thumbnail" style="width: 160px;">
              <img id="preview-2" src="{{ asset('produk/detail/'.$gambar[1]->img.'') }}" alt="" class="img-thumbnail" style="width: 160px; height: 120px">
              <div id="delpre-2" class="w-100 d-none">
                <button type="button" onclick="delpic(2)" class="btn btn-danger">hapus</button>
              </div>
            </div>
            <input type="text" name="picture_2" id="picture-2" value="{{ $gambar[1]->img }}" class="d-none"/>
            @else 
            <div class="img-thumbnail d-flex justify-content-center align-items-center" style="width: 160px; height: 120px">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
              </svg>
            </div>
            @endif
          </label>
          <input type="file" accept="image/*" name="gambar-2" id="gambar-2" class="d-none"/>
        </td>
        <td width="10px"></td>
        <td>
          <label for="gambar-3" id="label-3">
            @if (isset($gambar[2]) && $gambar[2]->img != null)
              <div id="thumb-3" onmouseover="hover(3)" onmouseout="cls(3)" class="img-thumbnail" style="width: 160px;">
                <img id="preview-3" src="{{ asset('produk/detail/'.$gambar[2]->img.'') }}" alt="" class="img-thumbnail" style="width: 160px; height: 120px">
                <div id="delpre-3" class="w-100 d-none">
                  <button type="button" onclick="delpic(3)" class="btn btn-danger">hapus</button>
                </div>
              </div>
              <input type="text" name="picture_3" id="picture-3" value="{{ $gambar[2]->img }}" class="d-none"/>
            @else
              <div class="img-thumbnail d-flex justify-content-center align-items-center" style="width: 160px; height: 120px">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                  <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                  <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                </svg>
              </div>
              @endif
            </label>
            <input type="file" accept="image/*" name="gambar-3" id="gambar-3" class="d-none"/>
        </td>
      </tr>
      <tr height="10px"></tr>
      <tr>
        <td>
          <label for="gambar-4" id="label-4">
            @if (isset($gambar[3]) && $gambar[3]->img != null)
              <div id="thumb-4" onmouseover="hover(4)" onmouseout="cls(4)" class="img-thumbnail" style="width: 160px;">
                <img id="preview-4" src="{{ asset('produk/detail/'.$gambar[3]->img.'') }}" alt="" class="img-thumbnail" style="width: 160px; height: 120px">
                <div id="delpre-4" class="w-100 d-none">
                  <button type="button" onclick="delpic(4)" class="btn btn-danger">hapus</button>
                </div>
              </div>
              <input type="text" name="picture_4" id="picture-4" value="{{ $gambar[3]->img }}" class="d-none"/>
            @else  
              <div class="img-thumbnail d-flex justify-content-center align-items-center" style="width: 160px; height: 120px">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                  <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                  <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                </svg>
              </div>
              @endif
            </label>
            <input type="file" accept="image/*" name="gambar-4" id="gambar-4" class="d-none"/>
        </td>
        <td width="10px"></td>
        <td>
          <label for="gambar-5" id="label-5">
            @if (isset($gambar[4]) && $gambar[4]->img != null)
            <div id="thumb-5" onmouseover="hover(5)" onmouseout="cls(5)" class="img-thumbnail" style="width: 160px;">
              <img id="preview-5" src="{{ asset('produk/detail/'.$gambar[4]->img.'') }}" alt="" class="img-thumbnail" style="width: 160px; height: 120px">
              <div id="delpre-5" class="w-100 d-none">
                <button type="button" onclick="delpic(5)" class="btn btn-danger">hapus</button>
              </div>
            </div>
            <input type="text" name="picture_5" id="picture-5" value="{{ $gambar[4]->img }}" class="d-none"/>
            @else
            <div class="img-thumbnail d-flex justify-content-center align-items-center" style="width: 160px; height: 120px">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
              </svg>
            </div>
            @endif
          </label>
          <input type="file" accept="image/*" name="gambar-5" id="gambar-5" class="d-none"/>
        </td>
        <td width="10px"></td>
        <td>
          <label for="gambar-6" id="label-6">
            @if (isset($gambar[5]) && $gambar[5]->img != null)
            <div id="thumb-6" onmouseover="hover(6)" onmouseout="cls(6)" class="img-thumbnail" style="width: 160px;">
              <img id="preview-6" src="{{ asset('produk/detail/'.$gambar[5]->img.'') }}" alt="" class="img-thumbnail" style="width: 160px; height: 120px">
              <div id="delpre-6" class="w-100 d-none">
                <button type="button" onclick="delpic(6)" class="btn btn-danger">hapus</button>
              </div>
            </div>
            <input type="text" name="picture_6" id="picture-6" value="{{ $gambar[5]->img }}" class="d-none"/>
            @else
            <div class="img-thumbnail d-flex justify-content-center align-items-center" style="width: 160px; height: 120px">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
              </svg>
            </div>
            @endif
          </label>
          <input type="file" accept="image/*" name="gambar-6" id="gambar-6" class="d-none"/>
        </td>
      </tr>
    </table>
    
    <button type="submit" class="btn btn-primary mb-3">Simpan</button>
  </form>
  @else
      
  <h3 class="mt-3 mb-3">Tambah Produk (Barang)</h3>
  
  <form action="{{ route('admin.produk.simpan') }}" method="POST" enctype="multipart/form-data" id="form-tambah">
      @csrf
      
      <div class="form-group w-50">
          <label for="inputAddress">Nama Produk</label>
          <input type="text" class="form-control" name="nama" id="inputAddress" placeholder="Kursi">
          {{-- name="nama" artinya nama form inputannya adalah nama --}}
        </div>
        <div class="form-group d-flex w-100">
          <div>
            <label for="inputAddress">Harga</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                <div class="input-group-text">Rp</div>
                </div>
                <input type="text" class="form-control" name="harga" id="inlineFormInputGroupUsername2" placeholder="1300000">
            </div>
          </div>
      </div>

      <div>
        <label class="d-block">Gambar</label>
        <table>
          <tr>
            <td>
              <label for="gambar-1" id="label-1">
                <div class="img-thumbnail d-flex justify-content-center align-items-center" style="width: 160px; height: 120px">
                  <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                    <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                  </svg>
                </div>
              </label>
              <input type="file" accept="image/*"  name="gambar-1" id="gambar-1" class="d-none"/>
            </td>
            <td width="10px"></td>
            <td>
              <label for="gambar-2" id="label-2">
                <div class="img-thumbnail d-flex justify-content-center align-items-center" style="width: 160px; height: 120px">
                  <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                    <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                  </svg>
                </div>
              </label>
              <input type="file" accept="image/*"  name="gambar-2" id="gambar-2" class="d-none"/>
            </td>
            <td width="10px"></td>
            <td>
              <label for="gambar-3" id="label-3">
                <div class="img-thumbnail d-flex justify-content-center align-items-center" style="width: 160px; height: 120px">
                  <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                    <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                  </svg>
                </div>
              </label>
              <input type="file" accept="image/*"  name="gambar-3" id="gambar-3" class="d-none"/>
            </td>
          </tr>
          <tr height="10px"></tr>
          <tr>
            <td>
              <label for="gambar-4" id="label-4">
                <div class="img-thumbnail d-flex justify-content-center align-items-center" style="width: 160px; height: 120px">
                  <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                    <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                  </svg>
                </div>
              </label>
              <input type="file" accept="image/*"  name="gambar-4" id="gambar-4" class="d-none"/>
            </td>
            <td width="10px"></td>
            <td>
              <label for="gambar-5" id="label-5">
                <div class="img-thumbnail d-flex justify-content-center align-items-center" style="width: 160px; height: 120px">
                  <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                    <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                  </svg>
                </div>
              </label>
              <input type="file" accept="image/*"  name="gambar-5" id="gambar-5" class="d-none"/>
            </td>
            <td width="10px"></td>
            <td>
              <label for="gambar-6" id="label-6">
                <div class="img-thumbnail d-flex justify-content-center align-items-center" style="width: 160px; height: 120px">
                  <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                    <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                  </svg>
                </div>
              </label>
              <input type="file" accept="image/*"  name="gambar-6" id="gambar-6" class="d-none"/>
            </td>
          </tr>
        </table>
      </div>
      
      <button type="submit" class="btn btn-primary mt-3">Simpan</button>
  </form>

  @endif

</div>

<script>
  function prePic(id){
    let label = document.getElementById('label-'+id);
    let pic = document.getElementById('gambar-'+id);
    if (pic){
      pic.addEventListener('change', function(){
        let reader = new FileReader();
        reader.onload = function(e){
          let picture = document.getElementById('picture-'+id);
          if (picture){
            picture.value = '';
            console.log(picture.value);
          }
          label.innerHTML = '';
          label.innerHTML = '<div id="thumb-'+id+'" onmouseover="hover('+id+')" onmouseout="cls('+id+')" class="img-thumbnail" style="width: 160px;">\
                  <img id="preview-'+id+'" src="'+e.target.result+'" alt="" class="img-thumbnail" style="width: 160px; height: 120px">\
                  <div id="delpre-'+id+'" class="w-100 d-none">\
                    <button type="button" onclick="delpic('+id+')" class="btn btn-danger">hapus</button>\
                  </div>\
                </div>';
        }
        reader.readAsDataURL(this.files[0]);
      });
    }
  }

  function hover(id){
    let del = document.getElementById('delpre-'+id);
    del.classList.remove('d-none');
  }

  function cls(id){
    let del = document.getElementById('delpre-'+id);
    del.classList.add('d-none');
  }

  function delpic(id){
    let gambar = document.getElementById('gambar-'+id);
    if (gambar){
      gambar.value = '';
    }
    let picture = document.getElementById('picture-'+id);
    if (picture){
      picture.value = '';
    }
    let label = document.getElementById('label-'+id);
    label.innerHTML = '<div class="img-thumbnail d-flex justify-content-center align-items-center" style="width: 160px; height: 120px">\
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">\
                <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>\
                <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>\
              </svg>\
            </div>';
  }

  for (var i = 1; i <= 6; i++) {
    prePic(i);
  }
</script>
@endsection