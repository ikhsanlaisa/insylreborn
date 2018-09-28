@extends('layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Data Akun Admin
                <small>BP2IP Barombong</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Akun Admin Aplikasi BP2IP</h3>
                    <!-- <a href="#" type="button" class="btn btn-sm btn-primary pull-right" name="button"><i class="fa fa-plus"></i> AKUN BARU</a> -->
                    <div class="btn-group pull-right">
                        <a href="{{ route('admin.create') }}" type="button" title="Tambah akun"
                           class="btn btn-sm btn-primary" name="button"><i
                                class="fa fa-plus"></i> Tambah</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="6%">No</th>
                                <th width="8%">NIP</th>
                                <th>Nama Admin</th>
                                <th>Username</th>
                                <th>Tipe Admin</th>
                                <th>Tipe Layanan</th>
                                <th width="8%" title="Action button">
                                    <center><span class="fa fa-bars"></span></center>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admin as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $item->admin->nip }}</td>
                                    <td>{{ ucwords($item->admin->nama) }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->admin->tipe['tipe'] }}</td>
                                    <td>{{ $item->admin->layanan['jenis'] }}</td>
                                    <td>
                                        <center>
                                            <a href="#" data-toggle="modal" data-target="#editakun"
                                               data-user="{{ $item }}" title="edit"
                                               class="btn btn-xs btn-in-o btn-round"><i class="fa fa-edit"></i> </a>
                                            <a href="#" title="hapus" class="btn btn-xs btn-dg-o btn-round"><i
                                                    class="fa fa-close" style="margin:1px !important;"></i></a>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    Footer
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="editakun">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Akun <span id="namaSiswa"></span></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="" disabled>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="nit">NIT</label>
                        <input type="text" name="nit" id="nit" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="nit">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="L">Laki - Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kontak">Kontak</label>
                        <input type="number" name="kontak" id="kontak" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir">Kontak</label>
                        <input type="number" name="tgl_lahir" id="tgl_lahir" class="form-control" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="button" id="save" onclick="set(1)" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection
@push('js')
    <script>
        $(function () {
            $('#example1').DataTable({
                "columnDefs": [{
                    "targets": 7,
                    "orderable": false
                }]
            })
        });
    </script>
    <script type="text/javascript">
    </script>
@endpush
