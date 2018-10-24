@extends('layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Data Kelas
                <small>BP2IP Barombong</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Kelas</h3>
                    <!-- <a href="#" type="button" class="btn btn-sm btn-primary pull-right" name="button"><i class="fa fa-plus"></i> AKUN BARU</a> -->
                    <div class="btn-group pull-right">
                        <a href="#" data-toggle="modal" data-target="#addKelas" type="button" title="Tambah akun"
                           class="btn btn-sm btn-primary" name="button"><i class="fa fa-plus"></i> Tambah</a>
                        <a href="#" type="button" title="Import data" class="btn btn-sm btn-info" name="button"><i
                                class="fa fa-download"></i> Import</a>
                    </div>
                </div>
                <style media="screen">
                    .img-news {
                        border-radius: 10px;
                        cursor: pointer;
                        transition: 0.3s;
                        object-fit: cover;
                        width: 100px;
                        height: 100px;
                    }

                    .img-news:hover {
                        opacity: 0.7;
                    }
                </style>
                <div class="box-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="6%">No</th>
                                <th>Nama Kelas</th>
                                <th>Foto</th>
                                <th width="10%" title="Action button">
                                    <center><span class="fa fa-bars"></span></center>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($kelas as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $item->nama_kelas }}</td>
                                    <td>
                                        {{--<center>--}}
                                            {{--<img id="myImg-{{ $item->id }}" src="{{ asset('storage/' . $item->foto) }}"--}}
                                                 {{--alt="{{ $item->nama_kelas }}" class="img-fluid img-news"--}}
                                                 {{--onclick="showImg(this, {{ $item->id }})">--}}
                                        {{--</center>--}}
                                    </td>
                                    <td>
                                        <center>
                                            <a href="#" data-toggle="modal" data-target="#detailInstruktur" title="user"
                                               class="btn btn-xs btn-sc-o btn-round"><i class="fa fa-user"></i> </a>
                                            <a href="#" data-toggle="modal" data-target="#editKelas" title="edit"
                                               class="btn btn-xs btn-in-o btn-round"><i class="fa fa-edit"></i> </a>
                                            <a href="#" title="hapus" class="btn btn-xs btn-dg-o btn-round"><i
                                                    class="fa fa-close" style="margin:1px !important;"></i></a>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- The Modal -->
                <div id="myModal" class="modal">
                    <span class="close">&times;</span>
                    <img class="modal-content" id="img">
                    <div id="caption"></div>
                </div>
                <!-- /.box-footer-->

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

    <div class="modal fade" id="detailInstruktur">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Detail Data Instruktur</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form>
                                <!-- <div class="form-group">
                                  <label>Nama Kelas</label>
                                  <input type="text" class="form-control" placeholder="Masukkan Nama Diklat Diklat" required>
                                </div> -->
                                <div class="form-group">
                                    <label>Pilih Instruktur</label>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <select class="form-control input-sm select2" style="width: 100%;" required>
                                                <option value="0">[NIP] - Nama Instruktur</option>
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" name="pelajaran" placeholder="Masukkan Pelajaran Diampu"
                                                   class="form-control" required>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-sm btn-primary" name="button"><i
                                                    class="fa fa-plus"></i> Tambah
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Pelajaran</th>
                                        <th>Hapus</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td width="5%">1</td>
                                        <td>1234567890</td>
                                        <td>ABCDE EFGHIJK</td>
                                        <td>Matematika Dasar</td>
                                        <td>
                                            <center>
                                                <a href="#" class="btn btn-xs btn-danger"><i
                                                        class="fa fa-close"></i></a>
                                            </center>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="addKelas">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Kelas Baru</h4>
                </div>
                <form action="{{ route('kelas.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Kode Kelas</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Kode Angkatan" name="kode" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Kelas</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Nama Angkatan" name="nama"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="editKelas">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Data Kelas</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Kode Kelas</label>
                                    <input type="text" class="form-control" value="KLSDKP01"
                                           placeholder="Masukkan Kode Kelas" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Kelas</label>
                                    <input type="text" class="form-control" value="Kelas DKP III 01"
                                           placeholder="Masukkan Nama Kelas" required>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Diklat</label>
                                    <select class="form-control input-sm select2" style="width: 100%;" required>
                                        <option value="0" selected>[Kode Diklat] - Nama Subdiklat - Angkatan</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection
@push('js')

    <script>
        $(function () {
            $('#example1').DataTable({
                "columnDefs": [{
                    "targets": 4,
                    "orderable": false
                }]
            })
        });
    </script>

    <script type="text/javascript">
        //Initialize Select2 Elements
        $('.select2').select2({
            placeholder: 'Cari Diklat...',
            allowClear: true
        })

        function showImg(element, i) {
            // Get the modal
            let modal = document.getElementById('myModal');

            // Get the image and insert it inside the modal - use its "alt" text as a caption
            let img = document.getElementById('myImg-' + i);
            let modalImg = document.getElementById("img");
            let captionText = document.getElementById("caption");
            modal.style.display = "block";
            modalImg.src = element.src;
            captionText.innerHTML = element.alt;

            // Get the <span> element that closes the modal
            let span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal
            span.onclick = function () {
                modal.style.display = "none";
            }

        }
    </script>

    @if(Session::has('success'))
        <script>
            swal("Berhasil", '{{ Session::get('success') }}', "success")
        </script>
    @endif
@endpush
