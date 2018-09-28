@extends('layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Kategori Layanan
                <small>BP2IP Barombong</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Kategori Layanan BP2IP</h3>
                    <!-- <a href="#" type="button" class="btn btn-sm btn-primary pull-right" name="button"><i class="fa fa-plus"></i> AKUN BARU</a> -->
                    <div class="btn-group pull-right">
                        <a href="#" type="button" title="Tambah akun" onclick="tambahKategori()"
                           class="btn btn-sm btn-primary" name="button"><i
                                class="fa fa-plus"></i> Tambah</a>
                        <!-- <a href="#" type="button" title="Import data" class="btn btn-sm btn-info" name="button"><i class="fa fa-download"></i> Import</a> -->
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="6%">No</th>
                                <th>Kategori Layanan</th>
                                <th width="15%" title="Action button">
                                    <center><span class="fa fa-bars"></span></center>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($layanan as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>  {{ $item->jenis }}
                                    </td>
                                    <td>
                                        <center>
                                            <a href="#" data-kategori="{{ $item }}" data-toggle="modal"
                                               data-target="#editKategori" title="edit"
                                               class="btn btn-xs btn-in-o btn-round"><i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="deleteKategori('{{ $item->id }}','{{ $item->jenis }}')"
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
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Modal Tambah Kategori-->
    <div class="modal fade" id="tambahKategori">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Kategori Layanan</h4>
                </div>
                <div class="modal-body" id="body-insert">
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
                        <label>Kategori Layanan</label>
                        <input type="text" name="jenis" id="jenis" class="form-control" required>
                    </div>

                </div>
                <div class="modal-footer" id="mFooter">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal Edit Kategori-->
    <div class="modal fade" id="editKategori">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Kategori Layanan</h4>
                </div>
                <div class="modal-body" id="body-update">
                    <div class="form-group">
                        <label>Kategori Layanan</label>
                        <input type="text" id="editJenis" class="form-control" required value="">
                    </div>

                </div>
                <div class="modal-footer" id="mFooter2">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>

                </div>
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
                    "targets": 2,
                    "orderable": false
                }],
            })
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        @if($errors->any())

        $(document).ready(function () {
            $('#tambahKategori').modal('show');
        });

        @endif

        function tambahKategori() {
            $('#save').remove();
            $('#mFooter').append(
                '<button type="button" id="save" onclick="insertKategori()" class="btn btn-primary">Submit</button>'
            );

            $('#tambahKategori').modal('show');

        };

        function insertKategori() {
            let jenis = $('#jenis');
            let redirectUrl = "{{ route('kategori.index') }}"
            $.ajax({
                type: 'POST',
                url: '{{ route('kategori.store') }}',
                data: {
                    jenis: jenis.val()
                },
                success: function () {
                    swal("Berhasil !", 'Kategori berhasil ditambahkan', "success").then((data => {
                        window.location.href = redirectUrl;
                    }));
                },
                error: function (data) {
                    $('#body-insert').prepend(
                        '<div class="alert alert-danger">' +
                        '<ul id="error-insert">' +
                        '</ul>' +
                        '</div>'
                    );


                    $.each(data['responseJSON']['errors'], function (index, value) {
                        $.each(value, function (i, v) {
                            $('#error-insert').append(
                                '<li>' + v + '</li>'
                            );
                        });
                    });
                }
            })
        };

        $('#editKategori').on('show.bs.modal', function (e) {
            let button = $(e.relatedTarget);
            let dataKategori = button.data('kategori');

            $('#editJenis').val(dataKategori['jenis']);

            $('#update').remove();
            $('#mFooter2').append(
                '<button type="button" id="update" onclick="updateKategori(\'' + dataKategori['id'] + '\')" class="btn btn-primary">Submit</button>'
            );
        });

        function updateKategori(idKategori) {
            let theUrl = "{{ route('kategori.update', ':kategoriId') }}";
            theUrl = theUrl.replace(":kategoriId", idKategori);
            let redirectUrl = "{{ route('kategori.index') }}";
            let jenis = $('#editJenis').val();

            $.ajax({
                type: 'POST',
                url: theUrl,
                data: {
                    _method: 'PUT',
                    jenis: jenis,
                },
                success: function () {
                    swal("Berhasil !", 'Kategori berhasil diupdate', "success").then((data => {
                        window.location.href = redirectUrl;
                    }));
                },
                error: function (data) {
                    $('#body-update').prepend(
                        '<div class="alert alert-danger">' +
                        '<ul id="errors-update">' +
                        '</ul>' +
                        '</div>'
                    );


                    $.each(data['responseJSON']['errors'], function (index, value) {
                        $.each(value, function (i, v) {
                            $('#errors-update').append(
                                '<li>' + v + '</li>'
                            );
                        });
                    });

                }
            })

        }

        function deleteKategori(kategoriId, jenisKategori) {
            swal({
                title: "Apa anda yakin?",
                text: "Anda Menghapus Kategori " + jenisKategori,
                icon: "warning",
                buttons: true,
                dangerMode: true,

            }).then((willDelete => {
                if (willDelete) {
                    let theUrl = "{{ route('kategori.destroy', ':kategoriId') }}";
                    theUrl = theUrl.replace(":kategoriId", kategoriId);

                    let redirectUrl = "{{ route('kategori.index') }}";

                    $.ajax({
                        type: 'POST',
                        url: theUrl,
                        data: {_method: "delete"},

                        success: function (data) {
                            swal("Deleted!", "Kategori Layanan berhasil di delete!", "success").then((data => {
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

