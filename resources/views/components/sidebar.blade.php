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
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ set_active('home') }}"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
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
            @if(Auth::user()->roles == 1)
                <li class="{{ set_active(['news.index', 'news.create', 'news.edit']) }}"><a
                        href="{{ route('news.index') }}"><i class="fa fa-newspaper-o"></i> <span>Berita</span></a></li>
                <li class="treeview {{ set_active(['survey.index','survey.submission','survey.result','survey.create'])}}">
                    <a href="#">
                        <i class="fa fa-search"></i> <span>Survey</span>
                        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ set_active('survey.index') }}"><a href="{{ route('survey.index') }}"><i class="fa fa-circle-o"></i>Data Survey</a></li>
                        <li class="{{ set_active('survey.submission') }}"><a href="{{ route('survey.submission') }}"><i class="fa fa-circle-o"></i>Survey Submission</a></li>
                        <li class="{{ set_active('survey.result') }}"><a href="{{ route('survey.result') }}"><i class="fa fa-circle-o"></i>Hasil Survey</a></li>
                    </ul>
                </li>
                <li class="{{ set_active('kategori.index') }}"><a href="{{ route('kategori.index') }}"><i class="fa fa-building-o"></i> Kategori Layanan</a></li>
        @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->
