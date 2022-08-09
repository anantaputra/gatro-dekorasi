@extends('layouts.app')

@section('content')

{{-- template bagian kanan halaman --}}
<div class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="mt-4">
        <h3>Galeri</h3>
        <div class="mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Admin</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Galeri</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <div class="w-full d-flex flex-row-reverse mr-5">
        <div class="mr-2">
            <a class="btn btn-info" href="{{ route('admin.galeri.tambah') }}" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cloud-plus align-middle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
                    <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
                </svg>  
                <span class="ml-2 align-middle">Tambah Foto</span>
            </a>
        </div>
    </div>
    <div class="album py-3">
        <div class="container">
    
          <div class="row">

            @foreach ($photos as $photo)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="{{ asset('public/galeri/'.$photo->gambar.'') }}" class="bd-placeholder-img card-img-top" alt="">
            
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    {{-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button> --}}
                                    <a class="btn btn-sm btn-outline-secondary" onclick="hapus({{ $photo->id }})" data-toggle="modal" data-target="#modal-delete" role="button">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
          </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Hapus Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Apakah Anda yakin untuk menghapus data tersebut ???</p>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Batal</button>
            <a id="delete" class="btn btn-outline-danger">Hapus</a>
        </div>
        </div>
    </div>
</div>

<script>
    function hapus(id){
        var hps = document.querySelector("#delete");
        hps.href = "{{ route('admin.galeri.hapus', '') }}"+"/"+id;
    }
</script>
@endsection