@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                User Profile
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">User profile</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
            @include('backoffice.profile.side')
            <!-- /.col -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#" data-toggle="tab">Profile</a></li>
                            <li><a href="{{ route('edit-password', $user->username) }}">Change Password</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="settings">
                                <form class="form-horizontal" action="{{ route('update.profile', $user->id) }}"
                                      method="post">
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
                                    <div class="form-group">
                                        <label for="nama" class="col-sm-2 control-label">Name</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama" id="nama"
                                                   placeholder="Name"
                                                   value="{{ $user->admin ? $user->admin->nama : $user->siswa->nama }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="username" class="col-sm-2 control-label">Username</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="username" id="username"
                                                   value="{{ $user->username }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Email</label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" placeholder="Email"
                                                   value="{{ $user->email }}" disabled>
                                        </div>
                                    </div>
                                    @if($user->siswa)
                                        <div class="form-group">
                                            <label for="nit" class="col-sm-2 control-label">NIT</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"
                                                       value="{{ $user->siswa->nit }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kelas" class="col-sm-2 control-label">Kelas</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"
                                                       value="{{ $user->siswa->kelas->angkatan->kode }} / {{ $user->siswa->kelas->nama }}"
                                                       disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_lahir" class="col-sm-2 control-label">Tanggal
                                                Lahir</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control datepicker" id="tanggal_lahir"
                                                       name="tanggal_lahir">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kontak" class="col-sm-2 control-label">Kontak</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="kontak" id="kontak"
                                                       value="{{ $user->siswa->kontak }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat" class="col-sm-2 control-label">Alamat</label>

                                            <div class="col-sm-10">
                                            <textarea name="alamat" id="alamat" class="form-control"
                                                      rows="5">{{ $user->siswa->alamat }}</textarea>
                                            </div>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label for="nip" class="col-sm-2 control-label">NIP</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"
                                                       value="{{ $user->admin->nip }}" disabled>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" id="submit-data" class="btn btn-danger" disabled>Save Changes
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
@endsection
@push('js')
    @if($user->siswa)
        <script>
            $(function () {
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                });

                $('#tanggal_lahir').datepicker('setDate', '{{ $user->siswa->tanggal_lahir }}');
            });

        </script>
    @endif
    <script>

        @if(Session::has('success'))
        swal("Berhasil !", '{{ Session::get('success') }}', "success");
            @endif

        let button = $('#submit-data');
        let orig = [];
        $.fn.getType = function () {
            return this[0].tagName == "INPUT" ? $(this[0]).attr("type").toLowerCase() : this[0].tagName.toLowerCase();
        }
        $("form :input").each(function () {
            let type = $(this).getType();
            let tmp = {
                'type': type,
                'value': $(this).val()
            };
            if (type == 'radio') {
                tmp.checked = $(this).is(':checked');
            }
            orig[$(this).attr('id')] = tmp;
        });
        $('form').bind('change keyup', function () {
            let disable = true;
            $("form :input").each(function () {
                let type = $(this).getType();
                let id = $(this).attr('id');
                if (type == 'text' || type == 'select') {
                    disable = (orig[id].value == $(this).val());
                } else if (type == 'radio') {
                    disable = (orig[id].checked == $(this).is(':checked'));
                }
                if (!disable) {
                    return false; // break out of loop
                }
            });
            button.prop('disabled', disable);
        });
    </script>
@endpush
