@extends('layouts.main')

@section('content')
    <!-- images style -->
    <link rel="stylesheet" href="{{ asset('css/image-style.css') }}">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Edit Password
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
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" name="current_password" id="current_password"
                                           class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" name="new_password" id="new_password" class="form-control"
                                           required>
                                </div>


                                <div class="form-group">
                                    <label for="confirmation_password">Current Password</label>
                                    <input type="password" name="confirmation_password" id="confirmation_password"
                                           class="form-control" required>
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
                                        <button type="button" onclick="window.history.back()" name="draft"
                                                class="btn btn-block btn-danger custom-btn"><i
                                                class="fa fa-reply"></i>
                                            Kembali
                                        </button>
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
