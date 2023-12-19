
@extends('template/master')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Data Pegawai</h3>
        </div>
        <div class="card-body">
            <!-- Form for adding new data -->
            <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nip">NIP:</label>
                    <input type="text" name="nip" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="foto">Foto:</label>
                    <input type="file" name="foto" class="form-control-file" required>
                </div>
                <div class="form-group">
                    <label for="pekerjaan">Pekerjaan:</label>
                    <input type="text" name="perkerjaan" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <!-- DataTables & Plugins -->
    <!-- (Same as your provided script) -->
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
