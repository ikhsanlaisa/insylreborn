@extends('layouts.main')

@section('content')
    <!-- images style -->
    <link rel="stylesheet" href="{{ asset('css/image-style.css') }}">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Berita
                <small>Insyl Competition</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Insyl Competition</h3>
                    <!-- <a href="#" type="button" class="btn btn-sm btn-primary pull-right" name="button"><i class="fa fa-plus"></i> AKUN BARU</a> -->
                    <div class="btn-group pull-right">
                        <a href="{{ route('news.create') }}" type="button" title="Tambah akun"
                           class="btn btn-sm btn-primary" name="button"><i
                                class="fa fa-plus"></i> Tambah</a>
                        <!-- <a href="#" type="button" title="Import data" class="btn btn-sm btn-info" name="button"><i class="fa fa-download"></i> Import</a> -->
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
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="6%">No</th>
                                <th width="15%">
                                    <center><span class="fa fa-image"></span></center>
                                </th>
                                <th>Judul Berita</th>
                                <th>Tanggal & Waktu</th>
                                <th>Author</th>
                                <!-- <th width="5%">L/P</th> -->
                                <!-- <th>Username</th> -->
                                <th width="8%" title="Action button">
                                    <center><span class="fa fa-bars"></span></center>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($news as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>
                                        <center>
                                            <img id="myImg-{{ $item->id }}" src="{{ asset('storage/' . $item->foto) }}"
                                                 alt="{{ $item->judul }}" class="img-fluid img-news"
                                                 onclick="showImg(this, {{ $item->id }})">
                                        </center>
                                    </td>
                                    <td>  {{ $item->judul }}
                                    </td>
                                    <td>{{ date('G:i - j M Y ', strtotime( $item->created_at )) }}</td>
                                    <td>{{ $item->author->nama }}</td>
                                    <td>
                                        <center>
                                            <a href="{{ route('news.edit', $item->id) }}"
                                               class="btn btn-xs btn-in-o btn-round"><i class="fa fa-edit"></i> </a>
                                            <a href="#" onclick="deleteNews('{{ $item->id }}','{{ $item->judul }}')"
                                               title="hapus" class="btn btn-xs btn-dg-o btn-round"><i
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
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('js')
    <script>
        $(function () {
            $('#example1').DataTable({
                "columnDefs": [{
                    "targets": [1, 3],
                    "orderable": false
                }]
            })
            // $('#example2').DataTable({
            //   'paging'      : true,
            //   'lengthChange': false,
            //   'searching'   : false,
            //   'ordering'    : true,
            //   'info'        : true,
            //   'autoWidth'   : false
            // })
        });
        @if(Session::has('success'))
        swal("Berhasil !", '{{ Session::get('success') }}', "success");
        @endif
    </script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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

        function deleteNews(beritaId, beritaName) {
            swal({
                title: "Apa anda yakin?",
                text: "Anda Menghapus Berita " + beritaName,
                icon: "warning",
                buttons: true,
                dangerMode: true,

            }).then((willDelete => {
                if (willDelete) {
                    let theUrl = "{{ route('news.destroy', ':beritaId') }}";
                    theUrl = theUrl.replace(":beritaId", beritaId);

                    let redirectUrl = "{{ route('news.index') }}";

                    $.ajax({
                        type: 'POST',
                        url: theUrl,
                        data: {_method: "delete"},

                        success: function (data) {
                            swal("Deleted!", "Berita berhasil di delete!", "success").then((data => {
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
@endpush

