@extends('layouts.app')

@section('content')

<div class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  @if (isset($paket))
  <h3 class="mt-3 px-5 mb-3">Edit Paket</h3>
  <form method="POST" action="{{ route('admin.paket.edit') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $paket->id }}">
    {{-- induk form mau dibagi 2 --}}
    <div class="d-flex w-100 px-5 mb-5">
      {{-- bagian kiri --}}
      <div class="w-100">
        <div class="form-group w-100">
          <label for="inputAddress">Nama Paket</label>
          <input type="text" class="form-control" name="nama" value="{{ $paket->nama }}" id="inputAddress" placeholder="Paket Gold">
        </div>
        <div class="form-group w-100">
          <label for="inputState">Kategori</label>
          <select id="kategori" class="form-control" name="kategori">
            <option disabled selected>--Pilih Kategori--</option>
            @if (isset($kategoris))
                
              @foreach ($kategoris as $kategori)
                  <option value="{{ $kategori->id }}" {{ ($paket->kategorinya->nama == $kategori->nama) ? 'selected' : '' }}>{{ $kategori->nama }}</option>
              @endforeach

            @endif
          </select>
        </div>
        <div class="form-group d-flex w-100">
          <div>
            <label for="inputAddress">Harga</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                <div class="input-group-text">Rp</div>
                </div>
                <input type="text" class="form-control" value="{{ $paket->harga }}" name="harga" id="inlineFormInputGroupUsername2" placeholder="1300000">
            </div>
          </div>
          <div class="ml-4">
            <label for="inputTamu">Jumlah Tamu</label>
            <input type="text" class="form-control" value="{{ $paket->jml_tamu }}" name="jml_tamu" id="inputTamu" placeholder="100">
          </div>
        </div>
        <div class="form-group w-100" id="detail-barang">
          <label for="inputAddress">Detail</label>
          @php
            $i = 0;
            $detail = explode(',', $paket->isi_paket);
            $keterangan = explode(',', $paket->keterangan);
          @endphp
          @foreach ($produks as $produk)
          @if(isset($detail[$i]))
          <div class="input-group d-flex align-items-center mb-2">
              <div>
                <input type="checkbox" name="checkbox[]" {{ ($produk->nama_produk == $detail[$i]) ? 'checked' : '' }} value="{{ $produk->nama_produk }}"> {{ $produk->nama_produk }}
                <input type="hidden" name="detail[]" value="{{ $produk->nama_produk }}">
              </div> 
              <div class="ml-3">
                <input type="text" name="keterangan[]" value="{{ $keterangan[$i] }}" class="form-control" placeholder="100">
              </div>
          </div>
          @endif
          @php
            $i++;
          @endphp
          @endforeach
        </div>
      </div>
      {{-- bagian kanan --}}
      <div class="ml-5 w-100">
        {{-- upload foto --}}
        {{-- <div>
          <label class="d-block">Gambar</label>
          <label for="gambar" class="h-100 w-100 mb-3">
              <div class="border rounded d-flex justify-content-center align-items-center" style="cursor: pointer; height: 300px" id="gambar-preview">
                  <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z"/>
                      <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
                  </svg>
                  <span class="ml-3">Upload</span>
              </div>
          </label>
          <input type="file" name="gambar" id="gambar" accept="image/*" class="d-none">
        </div> --}}

        {{-- Upload slide img --}}
        {{-- upload foto --}}
        <div>
          <label class="d-block" id="simpan">Gambar Slide</label>
          <table>
            <tr>
              <td>
                <label for="gambar-1" id="label-1">
                  @if (isset($gambar[0]) && $gambar[0]->img != null)   
                  <div id="thumb-1" onmouseover="hover(1)" onmouseout="cls(1)" class="img-thumbnail" style="width: 160px;">
                    <img id="preview-1" src="{{ asset('paket/detail/'.$gambar[0]->img.'') }}" alt="" class="img-thumbnail" style="width: 160px; height: 120px">
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
                    <img id="preview-2" src="{{ asset('paket/detail/'.$gambar[1]->img.'') }}" alt="" class="img-thumbnail" style="width: 160px; height: 120px">
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
                      <img id="preview-3" src="{{ asset('paket/detail/'.$gambar[2]->img.'') }}" alt="" class="img-thumbnail" style="width: 160px; height: 120px">
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
                      <img id="preview-4" src="{{ asset('paket/detail/'.$gambar[3]->img.'') }}" alt="" class="img-thumbnail" style="width: 160px; height: 120px">
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
                    <img id="preview-5" src="{{ asset('paket/detail/'.$gambar[4]->img.'') }}" alt="" class="img-thumbnail" style="width: 160px; height: 120px">
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
                    <img id="preview-6" src="{{ asset('paket/detail/'.$gambar[5]->img.'') }}" alt="" class="img-thumbnail" style="width: 160px; height: 120px">
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
        </div>
      </div>
    </div>
    
    <button type="submit" class="btn btn-primary ml-5">Simpan</button>
  </form>

  @else
      
  <h3 class="mt-3 px-5 mb-3">Tambah Paket</h3>
  <form action="{{ route('admin.paket.simpan') }}" method="POST" enctype="multipart/form-data">
      @csrf
      {{-- induk form mau dibagi 2 --}}
      <div class="d-flex w-100 px-5 mb-5">
        {{-- bagian kiri --}}
        <div class="w-100">
          <div class="form-group w-100">
            <label for="inputAddress">Nama Paket</label>
            <input type="text" class="form-control" name="nama" id="inputAddress" placeholder="Paket Gold">
          </div>
          <div class="form-group w-100">
            <label for="inputState">Kategori</label>
            <select id="kategori" class="form-control" name="kategori">
              <option disabled selected>--Pilih Kategori--</option>
              @if (isset($kategoris))
                  
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                @endforeach

              @endif
            </select>
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
            <div class="ml-4" id="jml_tamu">
              <label for="inputTamu">Jumlah Tamu</label>
              <input type="text" class="form-control" name="jml_tamu" id="inputTamu" placeholder="100">
            </div>
          </div>
          <div class="form-group w-100" id="detail-barang">
            <label for="inputAddress">Detail</label>
            @foreach ($produks as $produk)
            <div class="input-group d-flex align-items-center mb-2">
                <div>
                  <input type="checkbox" name="checkbox[]" value="{{ $produk->nama_produk }}"> {{ $produk->nama_produk }}
                  <input type="hidden" name="detail[]" value="{{ $produk->nama_produk }}">
                </div> 
                <div class="ml-3">
                  <input type="text" name="keterangan[]" class="form-control" placeholder="100">
                </div>
            </div>
            @endforeach
          </div>
          <div class="form-group w-100 d-none" id="deskripsi">
            <label for="inputAddress">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" id="inputAddress" rows="3"></textarea>
          </div>
        </div>
        {{-- bagian kanan --}}
        <div class="ml-5 w-100">
          {{-- upload foto --}}
          {{-- <div>
            <label class="d-block">Gambar</label>
            <label for="gambar" class="h-100 w-100 mb-3">
                <div class="border rounded d-flex justify-content-center align-items-center" style="cursor: pointer; height: 300px" id="gambar-preview">
                    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z"/>
                        <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
                    </svg>
                    <span class="ml-3">Upload</span>
                </div>
            </label>
            <input type="file" name="gambar" id="gambar" accept="image/*" class="d-none">
          </div> --}}


          {{-- Upload slide img --}}
          {{-- upload foto --}}
          <div>
            <label class="d-block">Gambar Slide</label>
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
        </div>
      </div>
      
      <button type="submit" id="simpan" class="btn btn-primary ml-5">Simpan</button>
  </form>

  @endif
</div>


<script>
  var kat = document.querySelector('#kategori');
  kat.addEventListener('change', function(){
    if(kat.value == '3'){
      document.querySelector('#detail-barang').style.display = 'none';
      document.querySelector('#jml_tamu').style.display = 'none';
      document.querySelector('#deskripsi').classList.remove('d-none');
    } else if(kat.value == '2'){
      document.querySelector('#detail-barang').style.display = 'block';
      document.querySelector('#jml_tamu').style.display = 'none';
      document.querySelector('#deskripsi').classList.add('d-none');
    } else {
      document.querySelector('#detail-barang').style.display = 'block';
      document.querySelector('#jml_tamu').style.display = 'block';
      document.querySelector('#deskripsi').classList.add('d-none');
    }
  });
</script>

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