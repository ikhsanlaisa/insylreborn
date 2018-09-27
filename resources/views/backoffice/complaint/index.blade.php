@extends('layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Data Pengaduan PASIS
                <small>BP2IP Barombong</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Pengaduan BP2IP</h3>
                    <!-- <a href="#" type="button" class="btn btn-sm btn-primary pull-right" name="button"><i class="fa fa-plus"></i> AKUN BARU</a> -->
                    <div class="btn-group pull-right">
                        <a href="{{ route('complaints.create') }}" type="button" title="Buat Pengaduan"
                           class="btn btn-sm btn-primary" name="button"><i class="fa fa-plus"></i> Buat Pengaduan</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="6%">No</th>
                                <th width="8%">NIT</th>
                                <th>Nama Pasis</th>
                                <th width="15%">Waktu</th>
                                <th>Isi Pengaduan</th>
                                <th>Status</th>
                                <th width="8%" title="Action button">
                                    <center><span class="fa fa-bars"></span></center>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pengaduan as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $item->siswa->nit }}</td>
                                    <td>{{ $item->siswa->nama }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->isi }}</td>
                                    <td>{{ ucwords($item->timeline->last()->status['status']) }}</td>
                                    <td>
                                        <center>
                                            <a href="#" data-toggle="modal" data-target="#editakun" title="edit"
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
                    <h4 class="modal-title">Edit Akun [Nama Akun]</h4>
                </div>
                <div class="modal-body">
                    <p>Test</p>
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
                    "targets": 5,
                    "orderable": false
                }]
            })
            // $('#example2').DataTable({
            //   'paging'      : true,
            //   'lengthChange': false,
            //   'searching'   : false,
            //   'ordering'    : true,
            //   'info'        : true,
            //   'autoWidth'   : false
            // })
        });
    </script>
@endpush

