@extends('layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Data Instruktur
                <small>BP2IP Barombong</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Instruktur</h3>
                    <!-- <a href="#" type="button" class="btn btn-sm btn-primary pull-right" name="button"><i class="fa fa-plus"></i> AKUN BARU</a> -->
                    <div class="btn-group pull-right">
                        <a href="#" data-toggle="modal" data-target="#addInstruktur" type="button" title="Tambah akun"
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
                                <th width="8%">NIP</th>
                                <th>Nama Instruktur</th>
                                <th width="5%">L/P</th>
                                <th>No Kontak</th>
                                <th width="8%" title="Action button">
                                    <center><span class="fa fa-bars"></span></center>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($instruktur as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $item->nip }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->kontak }}</td>
                                    <td>
                                        <center>
                                            <a href="#" data-toggle="modal" data-target="#editInstruktur" data-instruktur="{{ $item }}" title="edit"
                                               class="btn btn-xs btn-in-o btn-round"><i class="fa fa-edit"></i> </a>
                                            <a href="#" title="hapus"  onclick="deleteInstruktur('{{ $item->id }}','{{ $item->nama }}')" class="btn btn-xs btn-dg-o btn-round"><i
                                                    class="fa fa-close" style="margin:1px !important;"></i></a>
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

    <div class="modal fade" id="addInstruktur">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Instruktur Baru</h4>
                </div>
                <div class="modal-body" id="body-insert">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>NIP</label>
                                <input type="text" id="nip" class="form-control"
                                       placeholder="Masukkan NIP Instruktur"
                                       required>
                            </div>
                            <div class="form-group">
                                <label>Nama Instruktur</label>
                                <input type="text" id="nama" class="form-control"
                                       placeholder="Masukkan Nama Instruktur"
                                       required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" id="gender" required>
                                    <option selected disabled>-PILIH JENIS KELAMIN-</option>
                                    <option value="L">LAKI-LAKI</option>
                                    <option value="P">PEREMPUAN</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label>No Kontak</label>
                                <input type="text" class="form-control"
                                       placeholder="Masukkan Nomor Kontak Instruktur" id="kontak" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="button" onclick="insert()" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="editInstruktur">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Data Instruktur</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>NIP</label>
                                <input type="text" id="editNip" class="form-control"
                                       placeholder="Masukkan NIP Instruktur"
                                       required>
                            </div>
                            <div class="form-group">
                                <label>Nama Instruktur</label>
                                <input type="text" id="editNama" class="form-control"
                                       placeholder="Masukkan Nama Instruktur"
                                       required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" id="editGender" required>
                                    <option selected disabled>-PILIH JENIS KELAMIN-</option>
                                    <option value="L">LAKI-LAKI</option>
                                    <option value="P">PEREMPUAN</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" id="editAlamat" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label>No Kontak</label>
                                <input type="text" class="form-control"
                                       placeholder="Masukkan Nomor Kontak Instruktur" id="editKontak" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="button" id="save" onclick="update()" class="btn btn-primary">Simpan</button>
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
                    "targets": 5,
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

        function insert() {
            let nip = $('#nip').val();
            let nama = $('#nama').val();
            let gender = $('#gender  option:selected').val();
            let alamat = $('#alamat').val()
            let kontak = $('#kontak').val();

            let redirectUrl = "{{ route('instruktur.index') }}";

            $.ajax({
                type: 'POST',
                url: '{{ route('instruktur.store') }}',
                data: {
                    nip: nip,
                    nama: nama,
                    gender: gender,
                    alamat: alamat,
                    kontak: kontak,
                },
                success: function (data) {
                    swal("Berhasil !", 'Instruktur berhasil ditambahkan', "success").then((data => {
                        window.location.href = redirectUrl;
                    }));
                },
                error: function (data) {
                    console.log(data);
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

        $('#editInstruktur').on('show.bs.modal', function (e) {
            let button = $(e.relatedTarget);
            let dataInstruktur = button.data('instruktur');

            $('#editNip').val(dataInstruktur['nip']);
            $('#editNama').val(dataInstruktur['nama']);
            $('#editAlamat').val(dataInstruktur['alamat']);
            $('#editKontak').val(dataInstruktur['kontak']);


            let isMen = dataInstruktur['gender'] == 'L' ? true : false;
            if (isMen) {
                $('#editGender > [value="L"]').attr("selected", "true");
            } else {
                $('#editGender > [value="P"]').attr("selected", "true");
            }

            $('#save').attr("data-id", + dataInstruktur['id']);

        });
        
        function update() {
            let nip = $('#editNip').val();
            let nama = $('#editNama').val();
            let gender = $('#editGender  option:selected').val();
            let alamat = $('#editAlamat').val()
            let kontak = $('#editKontak').val()

            let idInstruktur = $('#save').attr("data-id");

            let theUrl = "{{ route('instruktur.update', ':idInstruktur') }}";
            theUrl = theUrl.replace(":idInstruktur", idInstruktur);


            let redirectUrl = "{{ route('instruktur.index') }}";

            $.ajax({
                type: 'POST',
                url: theUrl,
                data: {
                    _method: 'PUT',
                    nip: nip,
                    nama: nama,
                    gender: gender,
                    alamat: alamat,
                    kontak: kontak,
                },
                success: function (data) {
                    swal("Berhasil !", 'Data Instruktur berhasil diperbaharui', "success").then((data => {
                        window.location.href = redirectUrl;
                    }));
                },
                error: function (data) {
                    console.log(data);
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

        function deleteInstruktur(id, nama) {
            swal({
                title: "Apa anda yakin?",
                text: "Anda Menghapus Instruktur" + nama,
                icon: "warning",
                buttons: true,
                dangerMode: true,

            }).then((willDelete => {
                if (willDelete) {
                    let theUrl = "{{ route('instruktur.destroy', ':id') }}";
                    theUrl = theUrl.replace(":id", id);

                    let redirectUrl = "{{ route('instruktur.index') }}";

                    $.ajax({
                        type: 'POST',
                        url: theUrl,
                        data: {_method: "delete"},
                        success: function (data) {
                            swal("Deleted!", "Instruktur berhasil di delete!", "success").then((data => {
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
