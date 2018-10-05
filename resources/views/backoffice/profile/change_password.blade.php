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
                            <li><a href="{{ route('profile', $user->username) }}">Profile</a></li>
                            <li class="active"><a href="#">Change Password</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane">
                                <form class="form-horizontal" action="{{ route('update.password', $user->id) }}"
                                      method="POST">
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
                                        <label for="current_password" class="col-sm-2 control-label">Current
                                            Password</label>

                                        <div class="col-sm-10">
                                            <input type="password" name="current_password" id="current_password"
                                                   class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password" class="col-sm-2 control-label">New Password</label>

                                        <div class="col-sm-10">
                                            <input type="password" name="new_password" id="new_password"
                                                   class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmation_password" class="col-sm-2 control-label">Confirmation
                                            Password</label>

                                        <div class="col-sm-10">
                                            <input type="password" name="confirmation_password"
                                                   id="confirmation_password"
                                                   class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Save Changes</button>
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
    <script>
        @if(Session::has('success'))
        swal("Berhasil !", '{{ Session::get('success') }}', "success");
        @endif
    </script>
@endpush
