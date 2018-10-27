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
                                <th width="6%">No</th>
                                <th>Nama</th>
                                <th width="15%">No. Telepon</th>
                                <th width="10%">Kelas</th>
                                <th width="25%">Alamat</th>
                                <th>email</th>
                                {{--<th width="8%" title="Action button">--}}
                                    {{--<center><span class="fa fa-bars"></span></center>--}}
                                {{--</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @if($users->count())
                                @foreach($users as $index => $item)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->np_hp }}</td>
                                        <td>{{ $item->Kelas->nama_kelas }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->email }}</td>
                                        {{--<td>--}}
                                            {{--<center>--}}
                                                {{--<a href="{{ route('siswa.edit', $item->id) }}" title="edit"--}}
                                                   {{--class="btn btn-xs btn-in-o btn-round"><i class="fa fa-edit"></i> </a>--}}
                                                {{--<a href="#"--}}
                                                   {{--onclick="deleteAkun('{{ $item->id }}','{{ $item->siswa->nama }}')"--}}
                                                   {{--title="hapus" class="btn btn-xs btn-dg-o btn-round"><i--}}
                                                        {{--class="fa fa-close" style="margin:1px !important;"></i></a>--}}
                                            {{--</center>--}}
                                        {{--</td>--}}
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
