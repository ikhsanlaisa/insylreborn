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
                    {{Auth::user()->roles == 1 ? Auth::user()->nama : Auth::user()->nama  }}
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
            @if(Auth::user()->roles == 1)
                <li class="header">MAIN NAVIGATION</li>
                <li class="{{ set_active('home') }}"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="header">SUPER ADMIN</li>
                <li class="treeview {{ set_active(['kelas.index','admin.index','admin.edit','admin.create','siswa.index']) }}">
                    <a href="#">
                        <i class="fa fa-list"></i> <span>Master Data</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ set_active('siswa.index') }}"><a href="{{ route('siswa.index') }}"><i
                                    class="fa fa-circle-o"></i>Data Akun Siswa</a></li>
                        <li class="{{ set_active(['admin.index','admin.create']) }}"><a
                                href="{{ route('admin.index') }}"><i
                                    class="fa fa-circle-o"></i>Data Akun Admin</a></li>
                        <li class="{{ set_active('kelas.index') }}"><a href="{{ route('kelas.index') }}"><i
                                    class="fa fa-circle-o"></i>Data Kelas</a></li>
                    </ul>
                </li>
                <li class="treeview {{ set_active(['cabor.index', 'kontak.index', 'jadwal.index']) }}">
                    <a href="#">
                        <i class="fa fa-flag"></i>
                        <span>Master Lomba</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ set_active('cabor.index') }}"><a href="{{ route('cabor.index') }}"><i
                                    class="fa fa-circle-o"></i>Data Cabor</a></li>
                        <li class="{{ set_active('kontak.index') }}"><a href="{{ route('kontak.index') }}"><i
                                    class="fa fa-circle-o"></i>Data Kontak</a></li>
                        <li class="{{ set_active('jadwal.index') }}"><a href="{{ route('jadwal.index') }}"><i
                                    class="fa fa-circle-o"></i>Data Jadwal</a></li>
                        <li class="{{ set_active('result.index') }}"><a href="{{ route('result.index') }}"><i
                                    class="fa fa-circle-o"></i>Data Score dan Klasemen</a></li>
                    </ul>
                </li>
                <li class="{{ set_active(['news.index', 'news.create', 'news.edit']) }}"><a
                        href="{{ route('news.index') }}"><i class="fa fa-newspaper-o"></i> <span>Berita</span></a></li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->
