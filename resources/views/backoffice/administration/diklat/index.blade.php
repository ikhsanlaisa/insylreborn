@extends('layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Diklat
                <small>BP2IP Barombong</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Diklat BP2IP</h3>
                    <!-- <a href="#" type="button" class="btn btn-sm btn-primary pull-right" name="button"><i class="fa fa-plus"></i> AKUN BARU</a> -->
                    <div class="btn-group pull-right">
                        <a href="#" type="button" title="Tambah akun" onclick="tambahDiklat()"
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
                                <th>Kode Diklat</th>
                                <th>Nama Diklat</th>
                                <th width="15%" title="Action button">
                                    <center><span class="fa fa-bars"></span></center>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($diklat as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>  {{ $item->kode }}
                                    </td>
                                    <td>  {{ $item->nama }}
                                    </td>
                                    <td>
                                        <center>
                                            <a href="#" data-diklat="{{ $item }}" data-toggle="modal"
                                               data-target="#editDiklat" title="edit"
                                               class="btn btn-xs btn-in-o btn-round"><i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="deleteDiklat('{{ $item->id }}','{{ $item->nama }}')"
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
    <div class="modal fade" id="tambahDiklat">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Diklat</h4>
                </div>
                <div class="modal-body" id="body-insert">
                    <div class="form-group">
                        <label>Kode Diklat</label>
                        <input type="text" id="kode" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Diklat</label>
                        <input type="text" id="nama" class="form-control" required>
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
    <div class="modal fade" id="editDiklat">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Diklat</h4>
                </div>
                <div class="modal-body" id="body-update">
                    <div class="form-group">
                        <label>Kode Diklat</label>
                        <input type="text" id="editKode" class="form-control" required value="">
                    </div>

                    <div class="form-group">
                        <label>Nama Diklat</label>
                        <input type="text" id="editNama" class="form-control" required value="">
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

        function tambahDiklat() {
            $('#save').remove();
            $('#mFooter').append(
                '<button type="button" id="save" onclick="insertDiklat()" class="btn btn-primary">Submit</button>'
            );

            $('#tambahDiklat').modal('show');

        };

        function insertDiklat() {
            let kode = $('#kode');
            let nama = $('#nama');
            let redirectUrl = "{{ route('diklat.index') }}"
            $.ajax({
                type: 'POST',
                url: '{{ route('diklat.store') }}',
                data: {
                    kode: kode.val(),
                    nama: nama.val(),
                },
                success: function () {
                    swal("Berhasil !", 'Diklat berhasil ditambahkan', "success").then((data => {
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

        $('#editDiklat').on('show.bs.modal', function (e) {
            let button = $(e.relatedTarget);
            let dataDiklat = button.data('diklat');

            $('#editKode').val(dataDiklat['kode']);
            $('#editNama').val(dataDiklat['nama']);

            $('#update').remove();
            $('#mFooter2').append(
                '<button type="button" id="update" onclick="updateDiklat(\'' + dataDiklat['id'] + '\')" class="btn btn-primary">Submit</button>'
            );
        });

        function updateDiklat(idDiklat) {
            let theUrl = "{{ route('diklat.update', ':idDiklat') }}";
            theUrl = theUrl.replace(":idDiklat", idDiklat);
            let redirectUrl = "{{ route('diklat.index') }}";
            let kode = $('#editKode').val();
            let nama = $('#editNama').val();

            $.ajax({
                type: 'POST',
                url: theUrl,
                data: {
                    _method: 'PUT',
                    kode: kode,
                    nama: nama,
                },
                success: function () {
                    swal("Berhasil !", 'Diklat berhasil diupdate', "success").then((data => {
                        window.location.href = redirectUrl;
                    }));
                },
                error: function (data) {
                    console.log(data);
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

        function deleteDiklat(diklatId, namaDiklat) {
            swal({
                title: "Apa anda yakin?",
                text: "Anda Menghapus Diklat " + namaDiklat,
                icon: "warning",
                buttons: true,
                dangerMode: true,

            }).then((willDelete => {
                if (willDelete) {
                    let theUrl = "{{ route('diklat.destroy', ':diklatId') }}";
                    theUrl = theUrl.replace(":diklatId", diklatId);

                    let redirectUrl = "{{ route('diklat.index') }}";

                    $.ajax({
                        type: 'POST',
                        url: theUrl,
                        data: {_method: "delete"},

                        success: function (data) {
                            swal("Deleted!", "Diklat berhasil di delete!", "success").then((data => {
                                window.location.href = redirectUrl;
                            }));
                        },
                        error: function (data) {
                            console.log(data);
                            swal("Oops", "We couldn't connect to the server!", "error");
                        }
                    });
                }
            }));
        }
    </script>
@endpush

