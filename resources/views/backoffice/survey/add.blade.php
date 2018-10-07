@extends('layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tambah Survey Baru
                <small>BP2IP Barombong</small>
            </h1>
            <br>
        </section>

        <style media="screen">
            /* .ui-datepicker {
        margin-left: 100px;
        z-index: 1000;
        } */
        </style>

        <!-- Main content -->
        <section class="content">
            <form id="surveyForm" method="POST" action="{{ route('survey.store') }}">
                @csrf
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-6">
                        <input type="text" name="nama" class="form-control" placeholder="MASUKKAN NAMA SURVEY"
                               required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group date">
                            <input type="text" name="tgl_mulai" class="form-control datepicker"
                                   placeholder="MASUKKAN TANGGAL MULAI" required>
                            <div class="input-group-addon">
                                <span><b>s/d</b> </span>
                            </div>
                            <input type="text" name="tgl_selesai" class="form-control datepicker"
                                   placeholder="MASUKKAN TANGGAL SELESAI" required>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-6">
                        <select id="survey" class="form-control" name="jenis">
                            <option value="0" selected disabled>-PILIH JENIS SURVEY-</option>
                            <option value="1">SURVEY INDIVIDU</option>
                            <option value="2">SURVEY INSTRUKTUR</option>
                        </select>
                    </div>
                </div>
                <br>

                <input type="hidden" name="config_survey">
                <!-- Default box -->
                <div class="box box-warning hidden" id="individu">
                    <div class="box-header with-border ">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="box-title">Responden Survey Individu</h3>
                            </div>
                            <div class="col-md-6">
                                <span class="btn-group pull-right">
                        <a href="#" type="button" title="Tambah responden" class="btn btn-sm btn-primary"><i
                                class="fa fa-plus"></i> Tambah</a>
                        <a href="#" type="button" title="Minimize" class="btn btn-sm bg-orange" data-widget="collapse"
                        ><i class="fa fa-minus"></i> Minimize</a>
                      </span>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Diklat</th>
                                            <th>Subdiklat</th>
                                            <th>Angkatan</th>
                                            <th>Kelas</th>
                                            <th>Pasis</th>
                                            <!-- <th width="17%">Anggota</th> -->
                                            <th width="10%">
                                                <center><span class="fa fa-bars" title="action button"></span></center>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <select class="form-control input-sm" name="id_diklat" id="diklat">
                                                    <option value="0" selected>-Pilih Diklat-</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control input-sm" name="id_subdiklat"
                                                        id="subdiklat">
                                                    <option value="0" selected disabled>-Pilih Subdiklat-</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control input-sm" name="id_angkatan" id="angkatan">
                                                    <option value="0" selected disabled>-Pilih Angkatan-</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control input-sm" name="id_kelas">
                                                    <option value="0" selected disabled>-Pilih Kelas-</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control input-sm" name="id_siswa[]" multiple
                                                        data-live-search="true">
                                                    <option value="">-- Pilih Siswa --</option>
                                                </select>
                                            </td>
                                            <td>
                                                <center>
                                                    <a href="#" title="Hapus data" type="button"
                                                       class="btn btn-xs btn-danger btn-round btn-dg-o"><i
                                                            class="fa fa-close"></i></a>
                                                </center>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box box-warning hidden" id="instruktur">
                    <span id="placeInstruktur"></span>
                    <div class="box-header with-border ">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="box-title">Responden Survey Instruktur</h3>
                                <!-- <button type="button" class="btn btn-xs btn-default btn-round" data-toggle="popover" data-content="Some content inside the popover"><i class="fa fa-question" style="padding:1.5px !important;"></i></button> -->
                            </div>
                            <div class="col-md-6">
                        <span class="btn-group pull-right">
                        <a href="#" type="button" title="Tambah responden" class="btn btn-sm btn-primary"><i
                                class="fa fa-plus"></i> Tambah</a>
                        <a href="#" type="button" title="Minimize" class="btn btn-sm bg-orange" data-widget="collapse"
                        ><i class="fa fa-minus"></i> Minimize</a>
                      </span>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Kelas</th>
                                            <th>Instruktur Kelas</th>
                                            <th>Pasis</th>
                                            <!-- <th width="17%">Anggota</th> -->
                                            <th width="10%">
                                                <center><span class="fa fa-bars" title="action button"></span></center>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <select class="form-control input-sm" name="id_kelas"
                                                        id="kelas_instruktur">
                                                    <option value="" selected>-Semua Kelas-</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select multiple class="form-control input-sm" disabled
                                                        id="instrukturKelas">
                                                    <option>Kosong</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control input-sm" name="id_siswa[]" multiple disabled>
                                                </select>
                                            </td>
                                            <td>
                                                <center>
                                                    <a href="#" title="Hapus data" type="button"
                                                       class="btn btn-xs btn-danger btn-round btn-dg-o"><i
                                                            class="fa fa-close"></i></a>
                                                </center>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box box-warning">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="box-title">Pertanyaan Opsional</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="box-tools pull-right">
                                    <!-- <a href="#" type="button" title="Tambah pertanyaan" class="btn btn-sm btn-primary pull-right" ><i class="fa fa-plus"></i> Tambah</a> -->
                                    <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                            title="Collapse">
                                      <i class="fa fa-minus"></i></button> -->
                                    <div class="input-group input-group-sm">
                                        <select type="text" class="form-control" id="tipe_jawaban">
                                            <option selected disabled>-PILIH OPSIONAL-</option>
                                            <option value="1" selected>PERSETUJUAN</option>
                                            <option value="2">KEPUASAN</option>
                                        </select>
                                        <input type="hidden" name="id_tipe_jawaban">
                                        <span class="input-group-btn">
                        <!-- <span class="btn-group pull-right"> -->
                        <button onclick="setTipeJawaban()" type="button" title="Set Opsional"
                                class="btn btn-sm btn-success"><i
                                class="fa fa-save"></i> Set</button>
                        <button onclick="tambahOpsi()" type="button" title="Tambah responden"
                                class="btn btn-sm btn-primary"><i
                                class="fa fa-plus"></i> Tambah</button>
                        <a href="#" type="button" title="Minimize" class="btn btn-sm bg-orange" data-widget="collapse"
                        ><i class="fa fa-minus"></i> Minimize</a>
                      </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive" id="pertanyaanOpsi">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Pertanyaan</th>
                                    <!-- <th width="15%">Tipe</th> -->
                                    <th width="8%">
                                        <center><span class="fa fa-bars" title="action button"></span></center>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <input type="text" name="opsi[]" class="form-control" required>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box box-warning">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="box-title">Pertanyaan Isian</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="box-tools pull-right">
                        <span class="btn-group pull-right">
                        <button onclick="tambahIsian()" type="button" title="Tambah responden"
                                class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                        <a href="#" type="button" title="Minimize" class="btn btn-sm bg-orange" data-widget="collapse"
                        ><i class="fa fa-minus"></i> Minimize</a>
                      </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table" id="pertanyaanIsian">
                                <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Pertanyaan</th>
                                    <!-- <th width="15%">Tipe</th> -->
                                    <th width="8%">
                                        <center><span class="fa fa-bars" title="action button"></span></center>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <input type="text" name="isian[]" class="form-control" required>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <center>
                    <button type="submit" class="btn btn-success btn-md"><i class="fa fa-send"></i>
                        TERBITKAN
                    </button>
                    <button type="button" class="btn btn-danger btn-md demo3"><i class="fa fa-reply"></i>
                        KEMBALI
                    </button>
                </center>
            </form>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
        });
    </script>
    <script type="text/javascript">
        //Initialize Select2 Elements
        $('.select2').select2({
            placeholder: 'Cari Pasis...',
            allowClear: true
        });

        $('.datepicker').datepicker({
            autoclose: true,
        });
    </script>
    <script type="text/javascript">
        $('.demo3').click(function () {
            swal({
                title: "Kembali dan Simpan sebagai Draft?",
                text: "Pilih salah satu!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Simpan",
                closeOnConfirm: false
            }, function () {
                swal("Tersimpan!", "Kuesioner anda tersimpan sebagai draft.", "success");
                window.history.back();
            });
        });
    </script>

    <script type="text/javascript">
        $('#survey').change(function () {
            survey = $('#survey').val();
            if (survey == '1') {
                $('#individu').removeClass('hidden');
                $('#instruktur').addClass('hidden');

                getDiklat();

                let jenisSurvey = $('[name="jenis"] :selected').val();

                $('[name="config_survey"]').val(jenisSurvey);

            }
            else if (survey == '2') {
                getKelas();

                let jenisSurvey = $('[name="jenis"] :selected').val();

                $('[name="config_survey"]').val(jenisSurvey);

                $('#instruktur').removeClass('hidden');
                $('#individu').addClass('hidden');
            }
        });

        //get Subdiklat
        $('select[name="id_diklat"]').change(function () {
            let diklatId = $(this).val();

            if (diklatId) {
                $.ajax({
                    type: 'GET',
                    url: '/dependent/subdiklat/' + diklatId,
                    success: function (data) {
                        $('#subdiklat').empty();
                        $('#subdiklat').append(
                            '<option selected value="">Semua Subdiklat </option>'
                        );
                        $.each(data, function (index, value) {
                            $('#subdiklat').append(
                                '<option value="' + value['id'] + '">' + value['nama'] + '</option>'
                            )
                        })
                    }
                })
            } else {
                $('#subdiklat').empty();
                $('#subdiklat').append(
                    '<option selected>Semua Subdiklat </option>'
                );
            }
        });

        //get Angkatan
        $('select[name="id_subdiklat"]').change(function () {
            let subdiklatId = $(this).val();

            if (subdiklatId) {
                $.ajax({
                    type: 'GET',
                    url: '/dependent/angkatan/' + subdiklatId,
                    success: function (data) {
                        $('#angkatan').empty();
                        $('#angkatan').append(
                            '<option selected value="">Semua Angkatan </option>'
                        );
                        $.each(data, function (index, value) {
                            $('#angkatan').append(
                                '<option value="' + value['id'] + '">' + value['kode'] + '</option>'
                            )
                        })
                    }
                })
            } else {
                $('#angkatan').empty();
                $('#angkatan').append(
                    '<option selected value="">Semua Angkatan </option>'
                );
            }
        });

        //get Kelas
        $('select[name="id_angkatan"]').change(function () {
            let angkatanId = $(this).val();

            if (angkatanId) {
                $.ajax({
                    type: 'GET',
                    url: '/dependent/kelas/' + angkatanId,
                    success: function (data) {
                        $('select[name="id_kelas"]').empty();
                        $('select[name="id_kelas"]').append(
                            '<option selected value="">Semua Kelas </option>'
                        );
                        $.each(data, function (index, value) {
                            $('select[name="id_kelas"]').append(
                                '<option value="' + value['id'] + '">' + value['nama'] + '</option>'
                            )
                        })
                    }
                })
            } else {
                $('select[name="id_kelas"]').empty();
                $('select[name="id_kelas"]').append(
                    '<option selected value="">Semua Kelas </option>'
                );
            }
        });

        $('#kelas_instruktur').change(function () {
            let kelasId = $(this).val();
            $('input[name="id_instruktur\[\]"]').remove();
            if (kelasId) {
                $.ajax({
                    type: 'GET',
                    url: '/dependent/instruktur/' + kelasId,
                    success: function (data) {
                        console.log(data);
                        $('#instrukturKelas').empty();
                        $.each(data, function (index, value) {
                            $('#instrukturKelas').append(
                                '<option value="' + value['id'] + '">' + value['nip'] + ' - '
                                + value['nama'] + ' (' + value['kelas']['0']['pivot']['mapel'] + ')' + '</option>'
                            );
                            $('#placeInstruktur').append(
                                '<input type="hidden" name="id_instruktur[]" value="'+ value['id'] +' ">'
                            );
                        })
                    }
                });

            } else {
                $('#instrukturKelas').empty();
                $('#instrukturKelas').append(
                    '<option selected>Kosong </option>'
                );
            }
        });

        //get Siswa
        $('select[name="id_kelas"]').change(function () {
            let kelasId = $(this).val();

            if (kelasId) {
                $.ajax({
                    type: 'GET',
                    url: '/dependent/siswa/' + kelasId,
                    success: function (data) {
                        $('select[name="id_siswa\[\]"]').empty();
                        $('select[name="id_siswa\[\]"]').append(
                            '<option selected >Semua Siswa </option>'
                        );
                        $.each(data, function (index, value) {
                            $('select[name="id_siswa[]"]').append(
                                '<option value="' + value['id'] + '"> [' + value['nit'] + '] ' + value['nama'] + '</option>'
                            )
                        })
                    }
                })
            } else {
                $('select[name="id_siswa\[\]"]').empty();
                $('select[name="id_siswa\[\]"]').append(
                    '<option selected>Semua Siswa </option>'
                );
            }
        });
    </script>

    <script>

        function getDiklat() {
            $.ajax({
                type: 'GET',
                url: '{{ route('diklat.list') }}',
                success: function (data) {
                    $.each(data.data, function (index, value) {
                        $('#diklat').append(
                            '<option value="' + value['id'] + '">' + value['nama'] + '</option>'
                        )
                    })
                }
            })
        }
        function getKelas() {
            $('#kelas_instruktur').empty();
            $('#kelas_instruktur').append(
                '<option value="" selected>Semua Kelas</option>'
            );
            $.ajax({
                type: 'GET',
                url: '{{ route('kelas.list') }}',
                success: function (data) {
                    $.each(data.data, function (index, value) {
                        $('#kelas_instruktur').append(
                            '<option value="' + value['id'] + '">' + value['subdiklat']['nama'] + '/' + value['angkatan']['kode'] + '/' + value['nama'] + '</option>'
                        )
                    })
                }
            })

        }


    </script>

    <script>
        let noIsian = 1;
        let noOpsi = 1;

        function tambahOpsi() {
            $('#pertanyaanOpsi tr:last').after(
                '<tr>' +
                '<td>' + (++noOpsi) + '</td>' +
                '<td>' +
                '<input type="text" name="opsi[]" class="form-control" required>\n' +
                '</td>' +
                '<td>' +
                '<center>' +
                '<button title="Hapus data" id="removeOpsi" type="button" class="btn btn-xs btn-danger btn-round btn-dg-o"><i class="fa fa-close"></i></button>' +
                '</center>' +
                '</td>' +
                '</tr>'
            )
        }

        function tambahIsian() {
            $('#pertanyaanIsian tr:last').after(
                '<tr>' +
                '<td>' + (++noIsian) + '</td>' +
                '<td>' +
                '<input type="text" name="isian[]" class="form-control" required>\n' +
                '</td>' +
                '<td>' +
                '<center>' +
                '<button title="Hapus data" id="removePertanyaan" type="button" class="btn btn-xs btn-danger btn-round btn-dg-o"><i class="fa fa-close"></i></button>' +
                '</center>' +
                '</td>' +
                '</tr>'
            )
        }

        $("body").on("click", "#removePertanyaan", function () {
            $(this).closest('tr').remove();
            --noIsian;
        });

        $("body").on("click", "#removeOpsi", function () {
            $(this).closest('tr').remove();
            --noOpsi;
        });

        function setTipeJawaban() {
            let tipeJawaban = $('#tipe_jawaban :selected').val();
            let namaTipeJawaban = $('#tipe_jawaban :selected').text();

            $('[name="id_tipe_jawaban"]').val(tipeJawaban);

            swal('Berhasil !', 'Opsi jawaban di set menjadi ' + namaTipeJawaban, 'success');
        }
    </script>

@endpush
