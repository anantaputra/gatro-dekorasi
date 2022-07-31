@extends('layouts.app')

@section('content')

{{-- template bagian kanan halaman --}}
<div class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h3 class="mt-3">Tambahkan Gambar</h3>
    <label for="gambar" class="w-75 mb-3" style="height: 75vh">
        <div class="w-100 h-100 border rounded mt-3 d-flex justify-content-center align-items-center" style="cursor: pointer" id="gambar-preview">
            <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z"/>
                <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
            </svg>
            <span class="ml-3">Upload</span>
        </div>
    </label>
    <form action="{{ route('admin.galeri.simpan') }}" method="post" enctype="multipart/form-data" class="w-75 mt-3 d-flex flex-row-reverse">
        @csrf
        <input type="file" name="gambar" id="gambar" accept="image/*" class="d-none">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    //variable ambil dari id gambar = inputan
    let dropArea = document.querySelector('#gambar'); 
    //variable dari gmbar preview = label 
    let preview  = document.querySelector('#gambar-preview');
    //inputan.
    dropArea.addEventListener('change', function(e){
        e.preventDefault();
        preview.innerHTML = ''; // dibersihkan isi element nya 
        let file = e.target.files[0]; //ambil file
        let url = URL.createObjectURL(file); //membuat url sementara
        let img = document.createElement('img'); //sama dengan tag img baru
        img.src = url; //membuat src img
        img.style.height = '75vh'; //set tinggi gambar
        img.classList.add('w-75') //tambahkan kelas w-75 pada gambar
        preview.appendChild(img); //memasang anak child 
    })
</script>

@endsection