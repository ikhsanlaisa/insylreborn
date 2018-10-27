@extends('layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Data Cabang Olahraga
                <small>Insyl</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Cabang Olahraga</h3>
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
                                <th>Cabang Olahraga</th>
                                <th>Penanggung Jawab</th>
                                <th width="10%" title="Action button">
                                    <center><span class="fa fa-bars"></span></center>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($cabor->count())
                                @foreach($cabor as $index => $item)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $item->cabang_olahraga }}</td>
                                        <td>{{ $item->pj }}</td>
                                        <td>
                                            <center>
                                                <a data-toggle="modal" data-target="#editKelas" title="edit"
                                                   onclick="showModal({{$item->id}})"
                                                   class="btn btn-xs btn-in-o btn-round"><i class="fa fa-edit"></i> </a>
                                                <a href="#"
                                                   onclick="deleteCabor('{{ $item->id }}','{{ $item->cabang_olahraga }}')"
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
                    <h4 class="modal-title">Tambah Cabor</h4>
                </div>
                <form action="{{ route('cabor.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Cabang Olahraga</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Cabang Olahraga"
                                           name="cabang_olahraga" required>
                                </div>
                                <div class="form-group">
                                    <label>Penanggung Jawab</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Penanggung Jawab"
                                           name="pj" required>
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
                    <h4 class="modal-title">Edit Data Cabor</h4>
                </div>
                <form id="formEdit" name="formEdit" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Cabang Olahraga</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Cabang Olahraga"
                                           name="cabang_olahraga" id="cabang_olahraga" required>
                                </div>
                                <div class="form-group">
                                    <label>Penanggung Jawab</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Penanggung Jawab"
                                           name="pj" id="pj" required>
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
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function showModal(id) {
            document.getElementById('formEdit').action = "updatedatacabor/" + id;
            console.log("diklik " + id);
            cabang_olahraga = document.getElementById('cabang_olahraga');
            pj = document.getElementById('pj');
            $.ajax({
                type: 'GET',
                url: 'dependent/cabor/' + id,
                dataType: 'json',
                success: function (data) {
                    if (data !== null) {
                        console.log(data);
                        console.log('datanya 2 = ' + data.id);
                        cabang_olahraga.value = data.cabang_olahraga;
                        pj.value = data.pj;
                    } else {
                        console.log('null')
                        nama_kelas.value = "";
                    }

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log("error bro");
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        }

        function deleteCabor(caborId, cabor) {
            swal({
                title: "Apa anda yakin?",
                text: "Anda Menghapus Cabang Olahraga " + cabor,
                icon: "warning",
                buttons: true,
                dangerMode: true,

            }).then((willDelete => {
                if (willDelete) {
                    let theUrl = "{{ route('cabor.destroy', ':caborId') }}";
                    theUrl = theUrl.replace(":caborId", caborId);

                    let redirectUrl = "{{ route('cabor.index') }}";

                    $.ajax({
                        type: 'POST',
                        url: theUrl,
                        data: {_method: "delete"},

                        success: function (data) {
                            swal("Deleted!", "Kelas berhasil di delete!", "success").then((data => {
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
    </script>



    @if(Session::has('success'))
        <script>
            swal("Berhasil", '{{ Session::get('success') }}', "success")
        </script>
    @endif
@endpush
