@extends('layouts.main')

@section('content')
    <!-- images style -->
    <link rel="stylesheet" href="{{ asset('css/image-style.css') }}">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tambah User Siswa Baru
                <small>BP2IP Barombong</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Siswa BP2IP</h3>
                    <!-- <a href="#" type="button" class="btn btn-sm btn-primary pull-right" name="button"><i class="fa fa-plus"></i> AKUN BARU</a> -->
                    <div class="btn-group pull-right">
                        <!-- <a href="#" type="button" title="Tambah akun" class="btn btn-sm btn-primary" name="button"><i class="fa fa-plus"></i> Tambah</a> -->
                        <!-- <a href="#" type="button" title="Import data" class="btn btn-sm btn-info" name="button"><i class="fa fa-download"></i> Import</a> -->
                    </div>
                </div>
                <div class="box-body">
                    <form id="form" enctype="multipart/form-data" method="post" action="{{ route('siswa.update', $siswa->id) }}">
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
                                           value="{{ $siswa->username }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                           value="{{ $siswa->email }}" disabled>
                                </div>

                                <div class="form-group">
                                    <a href="#"><i class="fa fa-link"></i> Send Reset Password</a>
                                </div>
                                <label>-- Identitas Siswa --</label>
                                <div class="form-group">
                                    <label for="nit">NIT</label>
                                    <input type="text" name="nit" id="nit" class="form-control" required
                                           value="{{ $siswa->siswa->nit  }}">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control" required
                                           value="{{ $siswa->siswa->nama }}">
                                </div>
                                <div class="form-group">
                                    <label for="kelas">Kelas </label>
                                    <select name="id_kelas" id="kelas" class="form-control select2">

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="L" {{ $siswa->gender === "L" ? 'selected' : '' }}>Laki - Laki
                                        </option>
                                        <option value="P" {{ $siswa->gender === "P" ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Kontak</label>
                                    <input type="text" name="kontak" id="kontak" class="form-control"
                                           value="{{ $siswa->siswa->kontak }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal lahir</label>
                                    <input type="text" name="tanggal_lahir" id="tanggal_lahir"
                                           class="form-control datepicker">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control"
                                              rows="3">{{ $siswa->siswa->alamat }}</textarea>
                                </div>
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
                                        <a href="{{ route('siswa.index') }}" type="button" name="draft"
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
        $(function () {
            $('.select2').select2();
        });

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        });

        $('#tanggal_lahir').datepicker('setDate', '{{ $siswa->siswa->tanggal_lahir }}');

        $.ajax({
            type: 'GET',
            url: '{{ route('kelas.list') }}',
            success: function (data) {
                $.each(data.data, function (index, value) {
                    $('#kelas').append(
                        '<option value="' + value['id'] + '">' + value['subdiklat']['kode'] + '/' +
                        value['angkatan']['kode'] + ' Kelas ' + value['nama'] + '</option>'
                    )

                });
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });


        $('#kelas').find('option[value="' + '{{ $siswa->siswa->id_kelas }}' + '"]').attr("selected", true);
    </script>
@endpush
