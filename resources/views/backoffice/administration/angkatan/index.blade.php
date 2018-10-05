@extends('layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Data Angkatan
                <small>BP2IP Barombong</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Angkatan</h3>
                    <!-- <a href="#" type="button" class="btn btn-sm btn-primary pull-right" name="button"><i class="fa fa-plus"></i> AKUN BARU</a> -->
                    <div class="btn-group pull-right">
                        <a href="#" data-toggle="modal" data-target="#addAngkatan" type="button" title="Tambah akun"
                           class="btn btn-sm btn-primary" name="button"><i class="fa fa-plus"></i> Tambah</a>
                        <a href="#" type="button" title="Import data" class="btn btn-sm btn-info" name="button"><i
                                class="fa fa-download"></i> Import</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="6%">No</th>
                                <th width="10%">Kode Angkatan</th>
                                <th>Diklat & Subdiklat</th>
                                <th>Periode Awal</th>
                                <th>Periode Akhir</th>
                                <th width="8%" title="Action button">
                                    <center><span class="fa fa-bars"></span></center>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($angkatan as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->subdiklat->diklat->nama }} / {{ $item->subdiklat->nama }}</td>
                                    <td>{{ $item->periode_awal }}</td>
                                    <td>{{ $item->periode_akhir }}</td>
                                    <td>
                                        <center>
                                            <a href="#" data-toggle="modal" data-target="#editAngkatan"
                                               data-angkatan="{{ $item }}" title="edit"
                                               class="btn btn-xs btn-in-o btn-round"><i class="fa fa-edit"></i> </a>
                                            <button onclick="deleteAngkatan('{{ $item->id }}', '{{ $item->kode }}')"
                                                    title="hapus" class="btn btn-xs btn-dg-o btn-round"><i
                                                    class="fa fa-close" style="margin:1px !important;"></i></button>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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

    <div class="modal fade" id="addAngkatan">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Angkatan Baru</h4>
                </div>
                <div class="modal-body" id="body-insert">
                    <div class="row">
                        <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Kode Angkatan</label>
                                    <input type="text" class="form-control" id="kode"
                                           placeholder="Masukkan Kode Angkatan"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>Subdiklat</label>
                                    <select id="subdiklat" class="form-control">

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Periode Awal</label>
                                    <input type="text" class="form-control datepicker" id="pAwal"
                                           placeholder="Masukkan Periode Awal" required>
                                </div>
                                <div class="form-group">
                                    <label>Periode Awal</label>
                                    <input type="text" class="form-control datepicker" id="pAkhir"
                                           placeholder="Masukkan Periode Akhir" required>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="submit" onclick="insert()" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="editAngkatan">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Data Angkatan</h4>
                </div>
                <div class="modal-body" id="body-update">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Kode Angkatan</label>
                                <input type="text" id="editKode" class="form-control"
                                       placeholder="Masukkan Kode Angkatan"
                                       required>
                            </div>
                            <div class="form-group">
                                <label>Subdiklat</label>
                                <select id="editSubdiklat" class="form-control">

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Periode Awal</label>
                                <input type="text" class="form-control datepicker" id="editPAwal"
                                       placeholder="Masukkan Nama Periode Awal" required>
                            </div>
                            <div class="form-group">
                                <label>Periode Akhir</label>
                                <input type="text" class="form-control datepicker" id="editPAkhir"
                                       placeholder="Masukkan Nama Periode Akhir" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="save" class="btn btn-primary">Simpan</button>
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
                    "targets": 3,
                    "orderable": false
                }]
            })
        });

        $(function () {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
        })


    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'GET',
            url: '{{ route('subdiklat.list') }}',
            success: function (data) {
                $.each(data, function (index, value) {
                    console.log(value);
                    $('#subdiklat, #editSubdiklat').append(
                        '<option value="' + value['id'] + '">' + value['kode'] + ' - ' + value['nama'] + '</option>'
                    )

                });
            }
        });

        function insert() {
            let kode = $('#kode').val();
            let nama = $('#nama').val();
            let subdiklat = $('#subdiklat  option:selected').val();
            let periodeAwal = $('#pAwal').val()
            let periodeAkhir = $('#pAkhir').val()

            let redirectUrl = "{{ route('angkatan.index') }}";

            $.ajax({
                type: 'POST',
                url: '{{ route('angkatan.store') }}',
                data: {
                    kode: kode,
                    nama: nama,
                    id_subdiklat: subdiklat,
                    periode_awal: periodeAwal,
                    periode_akhir: periodeAkhir,
                },
                success: function (data) {
                    swal("Berhasil !", 'Data Angkatan berhasil ditambahkan', "success").then((data => {
                        window.location.href = redirectUrl;
                    }));
                },
                error: function (data) {
                    $('.alert-danger').remove();
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
        }


        $('#editAngkatan').on('show.bs.modal', function (e) {
            let button = $(e.relatedTarget);
            let dataAngkatan = button.data('angkatan');

            console.log(dataAngkatan);

            $('#editKode').val(dataAngkatan['kode']);
            $('#editNama').val(dataAngkatan['nama']);
            $('#editPAwal').datepicker('setDate', dataAngkatan['periode_awal']);
            $('#editPAkhir').datepicker('setDate', dataAngkatan['periode_akhir']);
            $('#editSubdiklat').find('option[value="' + dataAngkatan['subdiklat']['id'] + '"]').attr("selected", true);


            $('#save').attr("data-id", +dataAngkatan['id']);

        });

        $('#save').on('click', function () {
            let kode = $('#editKode').val();
            let nama = $('#editNama').val();
            let subdiklat = $('#editSubdiklat  option:selected').val();
            let periodeAwal = $('#editPAwal').val()
            let periodeAkhir = $('#editPAkhir').val()

            let idAngkatan = $('#save').attr("data-id");

            let theUrl = "{{ route('angkatan.update', ':idAngkatan') }}";
            theUrl = theUrl.replace(":idAngkatan", idAngkatan);


            let redirectUrl = "{{ route('angkatan.index') }}";

            $.ajax({
                type: 'POST',
                url: theUrl,
                data: {
                    _method: 'PUT',
                    kode: kode,
                    nama: nama,
                    id_subdiklat: subdiklat,
                    periode_awal: periodeAwal,
                    periode_akhir: periodeAkhir,
                },
                success: function (data) {
                    swal("Berhasil !", 'Data Angkatan berhasil diperbaharui', "success").then((data => {
                        window.location.href = redirectUrl;
                    }));
                },
                error: function (data) {
                    console.log(data);
                    $('#body-update').prepend(
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
        })

        function deleteAngkatan(id, nama) {
            swal({
                title: "Apa anda yakin?",
                text: "Anda Menghapus Angkatan " + nama,
                icon: "warning",
                buttons: true,
                dangerMode: true,

            }).then((willDelete => {
                if (willDelete) {
                    let theUrl = "{{ route('angkatan.destroy', ':id') }}";
                    theUrl = theUrl.replace(":id", id);

                    let redirectUrl = "{{ route('angkatan.index') }}";

                    $.ajax({
                        type: 'POST',
                        url: theUrl,
                        data: {_method: "delete"},
                        success: function (data) {
                            swal("Deleted!", "Angkatan berhasil di delete!", "success").then((data => {
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
