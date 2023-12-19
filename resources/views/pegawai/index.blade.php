@extends('template/master')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-primary">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DataTable Pegawai</h3>
        </div>
        <div class="card-body">
            <!-- Adjust the route for creating new records -->
            <a href="{{ route('pegawai.create') }}">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
            </a>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Foto</th>
                        <th>NIP</th>
                        <th>Pekerjaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pegawai as $data)
                        <tr>
                            <td>{{ $data->nama }}</td>
                            <td>
                                <img src="{{ Storage::url('pegawai/' . $data->foto) }}" style="width:150px"
                                    class="img-thumbnail">
                            </td>
                            <td>{{ $data->nip }}</td>
                            <td>{{ $data->perkerjaan }}</td>
                            <td>
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                    action="{{ route('pegawai.destroy', $data->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                                <!-- Adjust the route for editing records -->
                                <a href="{{ route('pegawai.edit', $data->id) }}" class="btn btn-outline-warning"><i
                                        class="fa fa-edit"></i> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
