@extends('layouts.main')

@section('content')
    <!-- images style -->
    <link rel="stylesheet" href="{{ asset('css/image-style.css') }}">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Edit User Admin
                <small>BP2IP Barombong</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Admin BP2IP</h3>
                    <!-- <a href="#" type="button" class="btn btn-sm btn-primary pull-right" name="button"><i class="fa fa-plus"></i> AKUN BARU</a> -->
                    <div class="btn-group pull-right">
                        <!-- <a href="#" type="button" title="Tambah akun" class="btn btn-sm btn-primary" name="button"><i class="fa fa-plus"></i> Tambah</a> -->
                        <!-- <a href="#" type="button" title="Import data" class="btn btn-sm btn-info" name="button"><i class="fa fa-download"></i> Import</a> -->
                    </div>
                </div>
                <div class="box-body">
                    <form id="form" enctype="multipart/form-data" method="post"
                          action="{{ route('admin.update', $admin->id) }}">
                        @csrf
                        @method('PUT')
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="status" value="aktif">
                                <label>-- Identitas User --</label>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control"
                                           value="{{ $admin->username }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" class="form-control"
                                           value="{{ $admin->email }}" disabled>
                                </div>
                                <div class="form-group">
                                    <a href="#"><i class="fa fa-link"></i> Send Reset Password</a>
                                    @if(Auth::user()->id === $admin->id)
                                        <a href="#" class="btn btn-danger pull-right"><i class="fa fa-link"></i> Ganti Password</a>
                                    @endif
                                </div>
                                <label>-- Identitas Admin --</label>
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" name="nip" id="nip" class="form-control" required
                                           value="{{ $admin->admin->nip }}">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control" required
                                           value="{{ $admin->admin->nama }}">
                                </div>
                                <div class="form-group">
                                    <label for="tipeadminlist">Tipe Admin</label>
                                    <select name="id_tipe" id="tipeadminlist" class="form-control select2">

                                    </select>
                                </div>
                                <span id="inLayanan"></span>

                                <style>
                                    .custom-btn {
                                        width: 100px;
                                        display: inline-block;
                                        margin-right: 15px;

                                        margin-top: 25px !important;
                                    }
                                </style>

                                <center>
                                    <div>
                                        <button style="margin-top:5px;" id="submit" type="submit" name="publish"
                                                class="btn btn-block btn-success custom-btn"><i
                                                class="fa fa-send"></i>
                                            Publish
                                        </button>
                                        <a href="{{ route('admin.index') }}" type="button"
                                                class="btn btn-block btn-danger custom-btn"><i
                                                class="fa fa-reply"></i>
                                            Kembali
                                        </a>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </form>
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
        $.ajax({
            type: 'GET',
            url: '{{ route('tipeadmin.list') }}',
            success: function (data) {
                $.each(data.data, function (index, value) {
                    $('#tipeadminlist').append(
                        '<option value="' + value['id'] + '">' + value['tipe'] + '</option>'
                    )

                });

                let isSuperAdmin = '{{ $admin->admin->id_tipe}}' == '1' ? true : false;

                if (isSuperAdmin) {
                    $('#tipeadminlist > [value="1"]').attr("selected", "true");
                } else {
                    $('#tipeadminlist > [value="2"]').attr("selected", "true");

                    $('#inLayanan').append(
                        "<div class=\"form-group\" id=\"pengLayanan\">\n" +
                        "<label for=\"layananlist\">Pengaduan Layanan</label>\n" +
                        "<select name=\"id_layanan\" id=\"layananlist\" class=\"form-control select2\">\n" +
                        "<option value=\"\">Pilih Layanan</option>\n" +
                        "@if($admin->admin->id_layanan != null)" +
                        "<option value=\"{{ $admin->admin->id_layanan }}\" selected>" +
                        "{{ $admin->admin->layanan->jenis }} </option>" +
                        "@endif" +
                        "@foreach($layanan as $item)\n" +
                        "@if($item['id'] != $admin->admin->id_layanan)" +
                        "<option value=\"{{ $item['id'] }}\">{{ $item['jenis'] }}</option>\n" +
                        "@endif" +
                        "@endforeach\n" +
                        "</select>\n" +
                        "</div>"
                    );

                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

        $('#tipeadminlist').change(function () {

            $('#pengLayanan').remove();

            if (this.value != 1) {
                $('#inLayanan').append(
                    "<div class=\"form-group\" id=\"pengLayanan\">\n" +
                    "<label for=\"layananlist\">Pengaduan Layanan</label>\n" +
                    "<select name=\"id_layanan\" id=\"layananlist\" class=\"form-control select2\">\n" +
                    "<option value=\"\">Pilih Layanan</option>\n" +
                    "@foreach($layanan as $item)\n" +
                    "<option value=\"{{ $item['id'] }}\">{{ $item['jenis'] }}</option>\n" +
                    "@endforeach\n" +
                    "</select>\n" +
                    "</div>"
                )
            }
            $(function () {
                $('.select2').select2();
            });


        });

        $(document).ready(function () {
            $(function () {
                $('.select2').select2();
            });


        });

    </script>
@endpush
