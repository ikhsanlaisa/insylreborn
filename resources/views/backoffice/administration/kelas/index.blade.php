@extends('layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Data Kelas
                <small>BP2IP Barombong</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Kelas</h3>
                    <!-- <a href="#" type="button" class="btn btn-sm btn-primary pull-right" name="button"><i class="fa fa-plus"></i> AKUN BARU</a> -->
                    <div class="btn-group pull-right">
                        <a href="#" data-toggle="modal" data-target="#addKelas" type="button" title="Tambah akun"
                           class="btn btn-sm btn-primary" name="button"><i class="fa fa-plus"></i> Tambah</a>
                        <a href="#" type="button" title="Import data" class="btn btn-sm btn-info" name="button"><i
                                class="fa fa-download"></i> Import</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="6%">No</th>
                                <th width="8%">Kode</th>
                                <th>Nama Kelas</th>
                                <th>Diklat</th>
                                <th width="10%" title="Action button">
                                    <center><span class="fa fa-bars"></span></center>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($kelas as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->angkatan->subdiklat->diklat->kode }}
                                        - {{ $item->angkatan->subdiklat->nama }} {{ $item->angkatan->kode }}</td>
                                    <td>
                                        <center>
                                            <a href="#" data-toggle="modal" data-target="#detailInstruktur" title="user"
                                               class="btn btn-xs btn-sc-o btn-round"><i class="fa fa-user"></i> </a>
                                            <a href="#" data-toggle="modal" data-target="#editKelas" title="edit"
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

    <div class="modal fade" id="detailInstruktur">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Detail Data Instruktur</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form>
                                <!-- <div class="form-group">
                                  <label>Nama Kelas</label>
                                  <input type="text" class="form-control" placeholder="Masukkan Nama Diklat Diklat" required>
                                </div> -->
                                <div class="form-group">
                                    <label>Pilih Instruktur</label>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <select class="form-control input-sm select2" style="width: 100%;" required>
                                                <option value="0">[NIP] - Nama Instruktur</option>
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" name="pelajaran" placeholder="Masukkan Pelajaran Diampu"
                                                   class="form-control" required>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-sm btn-primary" name="button"><i
                                                    class="fa fa-plus"></i> Tambah
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Pelajaran</th>
                                        <th>Hapus</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td width="5%">1</td>
                                        <td>1234567890</td>
                                        <td>ABCDE EFGHIJK</td>
                                        <td>Matematika Dasar</td>
                                        <td>
                                            <center>
                                                <a href="#" class="btn btn-xs btn-danger"><i
                                                        class="fa fa-close"></i></a>
                                            </center>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="addKelas">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Kelas Baru</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form>
                                <div class="form-group">
                                    <label>Kode Kelas</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Kode Diklat" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Kelas</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Nama Diklat Diklat"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Diklat</label>
                                    <select class="form-control input-sm select2" style="width: 100%;" required>
                                        <option value="0">[Kode Diklat] - Nama Subdiklat - Angkatan</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="editKelas">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Data Kelas</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form>
                                <div class="form-group">
                                    <label>Kode Kelas</label>
                                    <input type="text" class="form-control" value="KLSDKP01"
                                           placeholder="Masukkan Kode Kelas" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Kelas</label>
                                    <input type="text" class="form-control" value="Kelas DKP III 01"
                                           placeholder="Masukkan Nama Kelas" required>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Diklat</label>
                                    <select class="form-control input-sm select2" style="width: 100%;" required>
                                        <option value="0" selected>[Kode Diklat] - Nama Subdiklat - Angkatan</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
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
                    "targets": 4,
                    "orderable": false
                }]
            })
        });
    </script>

    <script type="text/javascript">
        //Initialize Select2 Elements
        $('.select2').select2({
            placeholder: 'Cari Diklat...',
            allowClear: true
        })
    </script>
@endpush
