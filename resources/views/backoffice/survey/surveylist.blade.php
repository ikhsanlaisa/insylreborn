@extends('layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Data Survey
                <small>BP2IP Barombong</small>
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Survey Diklat BP2IP</h3>
                    <a href="{{ route('survey.create') }}" type="button" class="btn btn-sm btn-primary pull-right" name="button"><i
                            class="fa fa-plus"></i> SURVEY</a>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="6%">No</th>
                                <th>Nama Survey</th>
                                <th width="15%">Jmlh Pertanyaan</th>
                                <th>Responden</th>
                                <th width="8%" title="Action button">
                                    <center><span class="fa fa-bars"></span></center>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($survey as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->pertanyaan->count() }}</td>
                                    <td>
                                        @foreach($item->configIndividu as $responden)
                                            {{ $responden->diklat['nama'] }}
                                            {{ $responden->subdiklat['nama'] }}
                                            {{ $responden->angkatan['kode'] }}
                                            {{ $responden->kelas['nama'] }}
                                            {{ $responden->siswa['nama'] }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <center>
                                            <!-- <div class="btn-group">
                                            </div> -->
                                            <a data-toggle="modal" title="edit" data-target="#modal-default"
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

@endpush
