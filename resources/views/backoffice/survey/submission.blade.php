@extends('layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Survey Submission
                <small>BP2IP Barombong</small>
            </h1>
        </section>

        <!-- <style media="screen">
          @media only screen and (min-width: 1276px) and (max-width: 1480px) {
            .alg-form{
              margin-right: -60px !important;
              margin-left: 140px !important;
            }
          }
        </style> -->

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-md-5">
                            <h3 class="box-title">Daftar Submission Survey Diklat BP2IP</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-11">
                                <select class="form-control input-sm select2" style="width: 100%;">
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-sm btn-success pull-right" name="button"><i class="fa fa-file-excel-o"></i> Export Data</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="6%">No</th>
                                <th>Nama Responden</th>
                                <th>Diklat</th>
                                <th>Waktu Submit</th>
                                <th>Jenis Survey</th>
                                <!-- <th width="8%" title="Action button"><center><span class="fa fa-bars"></span></center></th> -->
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Saya Akan Menyanyikan Lagu Abdullah</td>
                                <td>DIKLAT KEBAJAK LAUTAN</td>
                                <td>11/09/2018, 08:18 AM</td>
                                <td>SURVEY KETERAMPILAN PASIS</td>
                                <!-- <td>
                                  <center>
                                      <a href="#" title="detail" class="btn btn-xs btn-sc-o btn-round"><i class="fa fa-search"></i></a>
                                  </center>
                                </td> -->
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Abdullah Nama Ayahnya</td>
                                <td>DIKLAT PENGENDALIAN OMBAT</td>
                                <td>11/09/2018, 05:20 AM</td>
                                <td>SURVEY PENGEMBANGAN TINGKAT I</td>
                                <!-- <td>
                                  <center>
                                    <a href="#" title="detail" class="btn btn-xs btn-sc-o btn-round"><i class="fa fa-search"></i></a>
                                  </center>
                                </td> -->
                            </tr>
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
            $('#example1').DataTable()
        });

    </script>
    <script type="text/javascript">
        //Initialize Select2 Elements
        $('.select2').select2({
            placeholder: 'Cari Survey...',
            allowClear: true,
            // containerCssClass: ':all:'
        })
    </script>

@endpush
