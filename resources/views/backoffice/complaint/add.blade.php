@extends('layouts.main')

@section('content')
    <!-- images style -->
    <link rel="stylesheet" href="{{ asset('css/image-style.css') }}">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Buat Pengaduan
                <small>BP2IP Barombong</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Buat Pengaduan BP2IP</h3>
                    <!-- <a href="#" type="button" class="btn btn-sm btn-primary pull-right" name="button"><i class="fa fa-plus"></i> AKUN BARU</a> -->
                    <div class="btn-group pull-right">
                        <!-- <a href="#" type="button" title="Tambah akun" class="btn btn-sm btn-primary" name="button"><i class="fa fa-plus"></i> Tambah</a> -->
                        <!-- <a href="#" type="button" title="Import data" class="btn btn-sm btn-info" name="button"><i class="fa fa-download"></i> Import</a> -->
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form id="form" enctype="multipart/form-data" method="post"
                                  action="{{ route('complaints.store') }}">
                                @csrf
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(!Auth::user()->admin)
                                    <input type="hidden" name="id_siswa" value="{{ Auth::user()->siswa->id }}">

                                    <div class="form-group">
                                        <span>Nama Pelapor : </span>
                                        <label>{{ Auth::user()->siswa->nama }}</label>
                                    </div>
                                    <div class="form-group">
                                        <span>Kelas : </span>
                                        <label>{{ Auth::user()->siswa->kelas->kode }}</label>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="userlist">Siswa Pelapor</label>
                                        <select name="id_siswa" id="userlist" class="form-control select2">

                                        </select>
                                    </div>
                                @endif


                                <div class="form-group">
                                    <label for="layanan">Jenis Layanan</label>
                                    <select name="id_jenis" id="layanan" class="form-control">
                                        @foreach($layanan as $item)
                                            <option value="{{ $item->id }}">{{ $item->jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="isi">Isi Pengaduan :</label>
                                    <textarea name="isi" id="isi" class="form-control" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="foto">Lampiran Foto (Opsional)</label>
                                    <input type="file" accept="image/*" class="form-control" id="foto" name="foto">
                                </div>

                                <style>
                                    .custom-btn {
                                        width: 100px;
                                        display: inline-block;
                                        margin-right: 15px;

                                        margin-top: 25px !important;
                                    }
                                </style>

                                <div>
                                    <button style="margin-top:5px;" id="submit" type="submit"
                                            class="btn btn-block btn-success custom-btn"><i class="fa fa-send"></i>
                                        Submit
                                    </button>
                                    <a type="button" href="{{ route('complaints.index') }}"
                                       class="btn btn-block btn-danger custom-btn"><i class="fa fa-reply"></i>
                                        Kembali
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                BP2IP Barombong
            </div>
            <!-- /.box-footer-->
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('js')

    @if(Auth::user()->admin)
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(function () {
                $('.select2').select2();
            });

            $.ajax({
                type: 'GET',
                url: '/siswas',
                success: function (data) {
                    $.each(data.data, function (index, value) {
                        console.log(value);
                        $('#userlist').append(
                            '<option value="' + value['id'] + '">' + value['nama'] + ' [' + value['nit'] + '] ' + '</option>'
                        )

                    });
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        </script>
    @endif
@endpush

