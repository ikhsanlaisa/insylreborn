<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::user()->avatar }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>
                    {{Auth::user()->admin ? Auth::user()->admin->nama : Auth::user()->siswa->nama  }}
                </p>
                <a><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        {{--<form action="#" method="get" class="sidebar-form">--}}
            {{--<div class="input-group">--}}
                {{--<input type="text" name="q" class="form-control" placeholder="Search...">--}}
                {{--<span class="input-group-btn">--}}
              {{--<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>--}}
              {{--</button>--}}
            {{--</span>--}}
            {{--</div>--}}
        {{--</form>--}}
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ set_active('home') }}"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            <li class="treeview ">
                <a href="#">
                    <i class="fa fa-search"></i> <span>Survey</span>
                    <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i>Data Survey</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Survey Submission</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Hasil Survey</a></li>
                </ul>
            </li>
            <li class="{{ set_active(['complaints.index', 'complaints.create', 'complaints.edit']) }}">
                <a href="{{ route('complaints.index') }}"><i class="fa fa-exclamation-circle"></i>
                    <span>Pengaduan</span></a></li>
            @if(Auth::user()->isSuperAdmin())
                <li class="{{ set_active(['news.index', 'news.create', 'news.edit']) }}"><a
                        href="{{ route('news.index') }}"><i class="fa fa-newspaper-o"></i> <span>Berita</span></a></li>
                <li class="header">SUPER ADMIN</li>
                <li class="treeview {{ set_active(['diklat.index','subdiklat.index',
            'angkatan.index','kelas.index','admin.index','admin.edit','admin.create','siswa.index']) }}">
                    <a href="#">
                        <i class="fa fa-list"></i> <span>Master Data</span>
                        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ set_active('siswa.index') }}"><a href="{{ route('siswa.index') }}"><i
                                    class="fa fa-circle-o"></i>Data Akun Siswa</a></li>
                        <li class="{{ set_active(['admin.index','admin.edit','admin.create']) }}"><a
                                href="{{ route('admin.index') }}"><i
                                    class="fa fa-circle-o"></i>Data Akun Admin</a></li>
                        <li class="{{ set_active('diklat.index') }}"><a href="{{ route('diklat.index') }}"><i
                                    class="fa fa-circle-o"></i>Data Diklat</a></li>
                        <li class="{{ set_active('subdiklat.index') }}"><a href="{{ route('subdiklat.index') }}"><i
                                    class="fa fa-circle-o"></i>Data Sub Diklat</a></li>
                        <li class="{{ set_active('angkatan.index') }}"><a href="{{ route('angkatan.index') }}"><i
                                    class="fa fa-circle-o"></i>Data Angkatan</a></li>
                        <li class="{{ set_active('kelas.index') }}"><a href="{{ route('kelas.index') }}"><i
                                    class="fa fa-circle-o"></i>Data Kelas</a></li>

                    </ul>
                </li>
                <li><a href="{{ route('kategori.index') }}"><i class="fa fa-building-o"></i> Kategori Layanan</a></li>
        @endif

        <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
              </ul>
            </li> -->
            <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level One
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li class="treeview">
                      <a href="#"><i class="fa fa-circle-o"></i> Level Two
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
              </ul>
            </li> -->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->
