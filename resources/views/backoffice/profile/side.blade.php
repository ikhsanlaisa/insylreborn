<div class="col-md-3">

    <!-- Profile Image -->
    <div class="box box-primary">
        <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="{{ $user->avatar }}"
                 alt="User profile picture">

            <h3 class="profile-username text-center">{{ $user->admin ? $user->admin->nama : $user->siswa->nama }}</h3>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
