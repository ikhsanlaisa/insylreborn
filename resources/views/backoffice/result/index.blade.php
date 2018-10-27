@extends('layouts.main')
@section('content')
    {{--<link rel="stylesheet" href="{{ asset('css/image-style.css') }}">--}}
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Data Hasil
                <small>Pertandingan Insyl</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Hasil Pertandingan</h3>
                    <!-- <a href="#" type="button" class="btn btn-sm btn-primary pull-right" name="button"><i class="fa fa-plus"></i> AKUN BARU</a> -->
                    <div class="btn-group pull-right">
                        <a href="#" data-toggle="modal" data-target="#addKelas" type="button" title="Tambah akun"
                           class="btn btn-sm btn-primary" name="button"><i class="fa fa-plus"></i> Tambah</a>
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
                                <th><center>Jadwal</center></th>
                                <th><center>Cabor</center></th>
                                <th><center>Kelas</center></th>
                                <th><center>Score</center></th>
                                <th><center>Keterangan</center></th>
                                <th><center>Lokasi</center></th>
                                <th width="10%" title="Action button">
                                    <center><span class="fa fa-bars"></span></center>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($result->count())
                                @foreach($result as $index => $item)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td><center>{{ date('D, d M Y/h:m A', strtotime($item->jadwal->date_time))}}</center></td>
                                        <td><center>{{$item->cabor_detail->cabang_olahraga}}</center>
                                        <td><center>{{$item->tim1_detail->nama_kelas}} vs {{$item->tim2_detail->nama_kelas}}</center></td>
                                        <td><center>{{$item->score}}</center>
                                        <td><center>{{$item->keterangan}}</center>
                                        <td><center>{{$item->lokasi}}</center></td>
                                        <td>
                                            <center>
                                                <a data-toggle="modal" data-target="#editKelas" title="edit"
                                                   onclick="showModal({{$item->id}})"
                                                   class="btn btn-xs btn-in-o btn-round"><i class="fa fa-edit"></i> </a>
                                                <a href="#"
                                                   onclick="deleteResult('{{ $item->id }}','{{$item->tim1_detail->nama_kelas}} vs {{$item->tim2_detail->nama_kelas}}')"
                                                   title="hapus" class="btn btn-xs btn-dg-o btn-round"><i
                                                        class="fa fa-close" style="margin:1px !important;"></i></a>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">No record data !</td>
                                </tr>
                            @endif
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

    <div class="modal fade" id="addKelas">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Hasil Pertandingan Baru</h4>
                </div>
                <form action="{{ route('result.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="caborlist">Jadwal</label>
                                    <select name="jadwal" id="jadwal" class="form-control">
                                        <option disabled selected>--Pilih Jadwal--</option>
                                        @foreach($jadwal as $j)
                                            <option value="{{ $j->id }}">{{ date('D, d M Y/h:m A', strtotime($j->date_time)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea type="text" class="form-control" placeholder="Masukkan Keterangan"
                                              name="keterangan" id="keterangan" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Cabang Olahrga</label>
                                    <input type="text" class="form-control" name="cabor" id="cabor" disabled>
                                    <input type="hidden" class="form-control" name="caborid" id="caborid">
                                </div>
                                <div class="form-group">
                                    <label>Tim 1</label>
                                    <input type="text" class="form-control" name="tim1" id="tim1" disabled>
                                    <input type="hidden" class="form-control" name="tim1id" id="tim1id">
                                </div>
                                <div class="form-group">
                                    <label>Tim 2</label>
                                    <input type="text" class="form-control" name="tim2" id="tim2" disabled>
                                    <input type="hidden" class="form-control" name="tim2id" id="tim2id">
                                </div>
                                <div class="form-group">
                                    <label for="kelaslist">Tim yang menang</label>
                                    <select name="win" id="win" class="form-control">
                                        <option selected disabled>-Pilih Jadwal-</option>
                                        <option id="opt_win1"></option>
                                        <option id="opt_win2"></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Score</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Lokasi"
                                           name="score" id="score" required>
                                </div>
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <input type="text" class="form-control" name="lokasi" id="lokasi" disabled>
                                    <input type="hidden" class="form-control" name="lokasis" id="lokasis" required>
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
                    <h4 class="modal-title">Edit Data Pertandingan</h4>
                </div>
                <form id="formEdit" name="formEdit" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Jadwal</label>
                                    <input type="text" class="form-control" name="jad" id="jad" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea type="text" class="form-control" placeholder="Masukkan Keterangan"
                                              name="ket" id="ket" ></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Cabang Olahrga</label>
                                    <input type="text" class="form-control" name="cab" id="cab" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <input type="text" class="form-control" name="kelas" id="kelas" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Score</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Lokasi"
                                           name="scores" id="scores" required>
                                </div>
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <input type="text" class="form-control" name="loc" id="loc" disabled>
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

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function showModal(id) {
            document.getElementById('formEdit').action = "/updatedatascore/"+ id;
            console.log("diklik " + id);
            jadwal = document.getElementById('jad');
            cabor = document.getElementById('cab');
            kelas = document.getElementById('kelas');
            score = document.getElementById('scores');
            keterangan = document.getElementById('ket');
            lokasi = document.getElementById('loc');
            $.ajax({
                type: 'GET',
                url: 'dependent/detailscore/' + id,
                dataType: 'json',
                success: function (data) {
                    if (data !== null) {
                        console.log(data);
                        console.log('datanya 2 = ' + data.scr.id);
                        jadwal.value = data.jad.date_time;
                        kelas.value = data.k.nama_kelas + " vs " + data.k1.nama_kelas;
                        cabor.value = data.c.cabang_olahraga;
                        score.value = data.scr.score;
                        keterangan.value = data.scr.keterangan;
                        lokasi.value = data.scr.lokasi;

                    } else {
                        console.log('null')
                        cabang_olahraga.value = "";
                        pj.value = "";
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log("error bro");
                    console.log(textStatus);
                    console.log(errorThrown);

                }
            });
        }

        function deleteResult(resultId, timName) {
            swal({
                title: "Apa anda yakin?",
                text: "Anda Menghapus Hasil Pertandingan " + timName,
                icon: "warning",
                buttons: true,
                dangerMode: true,

            }).then((willDelete => {
                if (willDelete) {
                    let theUrl = "{{ route('result.destroy', ':resultId') }}";
                    theUrl = theUrl.replace(":resultId", resultId);

                    let redirectUrl = "{{ route('result.index') }}";

                    $.ajax({
                        type: 'POST',
                        url: theUrl,
                        data: {_method: "delete"},

                        success: function (data) {
                            swal("Deleted!", "Jadwal berhasil di delete!", "success").then((data => {
                                window.location.href = redirectUrl;
                            }));
                        },
                        error: function (data) {
                            swal("Oops", "We couldn't connect to the server!", "error");
                        }
                    });
                }
            }));
        }

        $('#jadwal').on('change', function (e) {
            console.log(e);
            var a = e.target.value;
            cabor = document.getElementById('cabor');
            caborid = document.getElementById('caborid');
            tim1 = document.getElementById('tim1');
            tim1id = document.getElementById('tim1id');
            tim2 = document.getElementById('tim2');
            tim2id = document.getElementById('tim2id');
            lokasi = document.getElementById('lokasi');
            lokasis = document.getElementById('lokasis');
            win = document.getElementById('win');
            opt_win1 = document.getElementById('opt_win1');
            opt_win2 = document.getElementById('opt_win2');
            $.get('/detaildatajadwal/' + a, function (data) {
//
                $.ajax({
                    type: 'GET',
                    url: '/detaildatajadwal/' + a,
                    dataType: 'json',
                    success: function (returnJSON) {
                        console.log(returnJSON);
                        if (returnJSON !== null) {
                            console.log('data = ' + returnJSON);
                            console.log('datanya 2 = ' + returnJSON.jadwal.id);
                            cabor.value = returnJSON.cabor.cabang_olahraga;
                            caborid.value = returnJSON.cabor.id;
                            tim1.value = returnJSON.tim1.nama_kelas;
                            tim1id.value = returnJSON.tim1.id;
                            tim2.value = returnJSON.tim2.nama_kelas;
                            tim2id.value = returnJSON.tim2.id;
//                            score.value = jad.score;
                            lokasi.value = returnJSON.jadwal.lokasi;
                            lokasis.value = returnJSON.jadwal.lokasi;
                            win.value = returnJSON.all;
                            opt_win1.value = returnJSON.all.tim1.id;
                            opt_win2.value = returnJSON.all.tim2.id;
                            opt_win1.textContent = returnJSON.all.tim1.nama_kelas;
                            opt_win2.textContent = returnJSON.all.tim2.nama_kelas;
                        } else {
                            console.log('null')
                            keterangan.value = "";
                            tim1.value = "";
                            tim2.value = "";
                            score.value = "";
                            lokasi.value = "";
                        }

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        console.log("error bro");
                        console.log(textStatus);
                        console.log(errorThrown);

                    }
                });
            });
        });
    </script>



    @if(Session::has('success'))
        <script>
            swal("Berhasil", '{{ Session::get('success') }}', "success")
        </script>
    @endif
@endpush
