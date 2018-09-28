@extends('layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tipe Admin
                <small>BP2IP Barombong</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Tipe Admin BP2IP</h3>
                    <!-- <a href="#" type="button" class="btn btn-sm btn-primary pull-right" name="button"><i class="fa fa-plus"></i> AKUN BARU</a> -->
                    <div class="btn-group pull-right">
                        <a href="#" type="button" title="Tambah Tipe Admin" onclick="tambahTipeAdmin()"
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
                                <th>Tipe Admin</th>
                                <th width="15%" title="Action button">
                                    <center><span class="fa fa-bars"></span></center>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tipeadmin as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>  {{ $item->tipe }}
                                    </td>
                                    <td>
                                        <center>
                                            <a href="#" data-tipe="{{ $item }}" data-toggle="modal"
                                               data-target="#editTipeAdmin" title="edit"
                                               class="btn btn-xs btn-in-o btn-round"><i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="deleteTipeAdmin('{{ $item->id }}','{{ $item->tipe }}')"
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

    <!-- Modal Tambah TipeAdmin-->
    <div class="modal fade" id="tambahTipeAdmin">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Tipe Admin</h4>
                </div>
                <div class="modal-body" id="body-insert">
                    <div class="form-group">
                        <label>Tipe Admin</label>
                        <input type="text" name="tipe" id="tipe" class="form-control" required>
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

    <!-- Modal Edit TipeAdmin-->
    <div class="modal fade" id="editTipeAdmin">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Tipe Admin</h4>
                </div>
                <div class="modal-body" id="body-update">
                    <div class="form-group">
                        <label>Tipe Admin</label>
                        <input type="text" id="editTipe" class="form-control" required value="">
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

        function tambahTipeAdmin() {
            $('#save').remove();
            $('#mFooter').append(
                '<button type="button" id="save" onclick="insertTipeAdmin()" class="btn btn-primary">Submit</button>'
            );

            $('#tambahTipeAdmin').modal('show');

        };

        function insertTipeAdmin() {
            let tipe = $('#tipe');
            let redirectUrl = "{{ route('tipeadmin.index') }}"
            $.ajax({
                type: 'POST',
                url: '{{ route('tipeadmin.store') }}',
                data: {
                    tipe: tipe.val()
                },
                success: function () {
                    swal("Berhasil !", 'TipeAdmin berhasil ditambahkan', "success").then((data => {
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

        $('#editTipeAdmin').on('show.bs.modal', function (e) {
            let button = $(e.relatedTarget);
            let dataTipeAdmin = button.data('tipe');

            $('#editTipe').val(dataTipeAdmin['tipe']);

            $('#update').remove();
            $('#mFooter2').append(
                '<button type="button" id="update" onclick="updateTipeAdmin(\'' + dataTipeAdmin['id'] + '\')" class="btn btn-primary">Submit</button>'
            );
        });

        function updateTipeAdmin(idTipe) {
            let theUrl = "{{ route('tipeadmin.update', ':idTipe') }}";
            theUrl = theUrl.replace(":idTipe", idTipe);
            let redirectUrl = "{{ route('tipeadmin.index') }}";
            let tipe = $('#editTipe').val();

            $.ajax({
                type: 'POST',
                url: theUrl,
                data: {
                    _method: 'PUT',
                    tipe: tipe,
                },
                success: function () {
                    swal("Berhasil !", 'Tipe Admin berhasil diupdate', "success").then((data => {
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

        function deleteTipeAdmin(tipeId, tipe) {
            swal({
                title: "Apa anda yakin?",
                text: "Anda Menghapus Tipe Admin " + tipe,
                icon: "warning",
                buttons: true,
                dangerMode: true,

            }).then((willDelete => {
                if (willDelete) {
                    let theUrl = "{{ route('tipeadmin.destroy', ':tipeId') }}";
                    theUrl = theUrl.replace(":tipeId", tipeId);

                    let redirectUrl = "{{ route('tipeadmin.index') }}";

                    $.ajax({
                        type: 'POST',
                        url: theUrl,
                        data: {_method: "delete"},

                        success: function (data) {
                            swal("Deleted!", "Tipe Admin berhasil di delete!", "success").then((data => {
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

