@extends('layouts.main')

@section('content')
    <!-- images style -->
    <link rel="stylesheet" href="{{ asset('css/image-style.css') }}">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Postingan Berita Baru
                <small>BP2IP Barombong</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Post Berita BP2IP</h3>
                    <!-- <a href="#" type="button" class="btn btn-sm btn-primary pull-right" name="button"><i class="fa fa-plus"></i> AKUN BARU</a> -->
                    <div class="btn-group pull-right">
                        <!-- <a href="#" type="button" title="Tambah akun" class="btn btn-sm btn-primary" name="button"><i class="fa fa-plus"></i> Tambah</a> -->
                        <!-- <a href="#" type="button" title="Import data" class="btn btn-sm btn-info" name="button"><i class="fa fa-download"></i> Import</a> -->
                    </div>
                </div>
                <div class="box-body">
                    <form id="form" enctype="multipart/form-data" method="post" action="{{ route('news.store') }}">
                        @csrf
                        <input type="hidden" name="id_admin" value="{{ Auth::user()->admin->id }}">
                        <div class="form-group">
                            <input type="text" class="form-control" name="judul" placeholder="MASUKKAN JUDUL DISINI"
                                   required>
                        </div>
                        <div class="form-group">
                            <input type="file" accept="image/*" class="form-control" id="foto" name="foto"
                                   placeholder="Masukkan Foto" required>
                        </div>
                        <div class="box-body pad">
                            <form>
                    <textarea id="isi" name="isi" rows="10" cols="80">
                    </textarea>
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
                                                class="btn btn-block btn-success custom-btn"><i class="fa fa-send"></i>
                                            Publish
                                        </button>
                                        <button type="button" onclick="window.history.back()" name="draft"
                                                class="btn btn-block btn-danger custom-btn"><i class="fa fa-reply"></i>
                                            Kembali
                                        </button>
                                    </div>
                                </center>
                            </form>
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
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('isi');
            //bootstrap WYSIHTML5 - text editor
            $(".textarea").wysihtml5();
        });
    </script>
@endpush

