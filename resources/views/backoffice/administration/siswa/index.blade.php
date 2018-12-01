@extends('layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Data Akun Siswa/i
                <small>Insyl</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Akun Siswa/i Insyl</h3>
                    <!-- <a href="#" type="button" class="btn btn-sm btn-primary pull-right" name="button"><i class="fa fa-plus"></i> AKUN BARU</a> -->
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="6%"><center>No</center></th>
                                <th><center>Nama</center></th>
                                <th width="15%"><center>No. Telepon</center></th>
                                <th width="10%"><center>Kelas</center></th>
                                <th width="25%"><center>Alamat</center></th>
                                <th><center>email</center></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($users->count())
                                @foreach($users as $index => $item)
                                    <tr>
                                        <td><center>{{ ++$index }}</center></td>
                                        <td><center>{{ $item->nama }}</center></td>
                                        <td><center>{{ $item->np_hp }}</center></td>
                                        <td><center>{{ $item->Kelas->nama_kelas }}</center></td>
                                        <td><center>{{ $item->alamat }}</center></td>
                                        <td><center>{{ $item->email }}</center></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">No record data !</td>
                                </tr>
                            @endif

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
