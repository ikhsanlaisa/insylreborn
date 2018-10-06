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
                                                <select class="form-control input-sm" name="subdiklat" id="subdiklat">
                                                    <option value="0" selected disabled>-Pilih Subdiklat-</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control input-sm" name="angkatan" id="angkatan">
                                                    <option value="0" selected disabled>-Pilih Angkatan-</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control input-sm" name="kelas">
                                                    <option value="0" selected disabled>-Pilih Kelas-</option>
                                                    <option value="1">SEMUA</option>
                                                    <option value="2">AKP-01</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control input-sm select2" name="pasis">
                                                    <option>12324124 - ABCDEH EHEDJ</option>
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
                    <div class="box-header with-border ">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="box-title">Responden Survey Instruktur</h3>
                                <!-- <button type="button" class="btn btn-xs btn-default btn-round" data-toggle="popover" data-content="Some content inside the popover"><i class="fa fa-question" style="padding:1.5px !important;"></i></button> -->
                            </div>
                            <div class="col-md-6">
                        <span class="btn-group pull-right">
                        <a href="#" type="button" title="Tambah responden" class="btn btn-sm btn-primary" ><i
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
                                                <select class="form-control input-sm" name="kelas">
                                                    <option value="0" selected disabled>-Pilih Kelas-</option>
                                                    <option value="1">SEMUA</option>
                                                    <option value="2">AKP-01</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select multiple class="form-control input-sm" disabled>
                                                    <option>NIP - Nama 1 (Matematika Dasar)</option>
                                                    <option>NIP - Nama 2 (Fisika Dasar)</option>
                                                    <option>NIP - Nama 3 (Kimia Dasar)</option>
                                                    <option>NIP - Nama 4 (Kalkulus Dasar)</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control input-sm select2" name="pasis">
                                                    <option>12324124 - ABCDEH EHEDJ</option>
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
                                class="btn btn-sm btn-success" ><i
                                class="fa fa-save"></i> Set</button>
                        <button onclick="tambahOpsi()" type="button" title="Tambah responden"
                                class="btn btn-sm btn-primary" ><i
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
                                class="btn btn-sm btn-primary" ><i class="fa fa-plus"></i> Tambah</button>
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
                    <button type="submit" class="btn btn-success btn-md" ><i class="fa fa-send"></i>
                        TERBITKAN
                    </button>
                    <button type="button" class="btn btn-danger btn-md demo3" ><i class="fa fa-reply"></i>
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
                getSubDiklat();
                getAngkatan();

                let jenisSurvey = $('[name="jenis"] :selected').val();

                $('[name="config_survey"]').val(jenisSurvey);

            }
            else if (survey == '2') {
                $('#instruktur').removeClass('hidden');
                $('#individu').addClass('hidden');
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

        function getSubDiklat() {
            $.ajax({
                type: 'GET',
                url: '{{ route('subdiklat.list') }}',
                success: function (data) {
                    $.each(data, function (index, value) {
                        $('#subdiklat').append(
                            '<option value="' + value['id'] + '">' + value['nama'] + '</option>'
                        )
                    })
                }
            })

        }

        function getAngkatan() {
            $.ajax({
                type: 'GET',
                url: '{{ route('angkatan.list') }}',
                success: function (data) {
                    $.each(data, function (index, value) {
                        console.log(data);
                        $('#angkatan').append(
                            '<option value="' + value['id'] + '">' + value['kode'] + '</option>'
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