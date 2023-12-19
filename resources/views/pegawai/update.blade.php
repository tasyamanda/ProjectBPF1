@extends('template/master')
@section('content')
<br>
<div class="col">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Ubah Data Pegawai</h3>
        </div>
        <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col col-md-12 form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{

$pegawai->nama }}" placeholder="Masukkan">

                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-12 form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP" value="{{ $pegawai->nip}}">
                    </div>
                </div>
                <div class="row">
                    <div class="co col-md-12 form-group">
                        <label for="exampleInputFile">Foto</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto" name="foto">
                                <label class="custom-file-label" for="exampleInputFile">Pilih Foto</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-12 form-group">
                        <label>Pekerjaan</label>
                        <input type="text" class="form-control" id="perkerjaan" name="perkerjaan" placeholder="Masukkan Pekerjaan" value="{{ $pegawai->pekerjaan}}">

                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('css')
<link rel="stylesheet" href="{{ url('plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('js')
<script src="{{ url('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(function() {
        $('#deskripsi_form').summernote()
    })
</script>
@endsection