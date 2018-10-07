@extends('layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Hasil Survey
                <small>BP2IP Barombong</small>
            </h1>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <label for="jenis"><small>JENIS SURVEY</small> </label>
                    <select id="survey" class="form-control" name="jenis">
                        <option value="0" selected disabled>-PILIH JENIS SURVEY-</option>
                        <option value="1">SURVEY INDIVIDU</option>
                        <option value="2">SURVEY INSTRUKTUR</option>
                    </select>
                </div>
            </div><br>
            <div id="instruktur" class="row hidden">
                <div class="col-lg-3">
                    <select class="form-control" name="kelas">
                        <option value="0" selected disabled>-PILIH KELAS-</option>
                        <option value="1">KELAS DKP III 01</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <select class="form-control" name="instruktur">
                        <option value="0" selected disabled>-PILIH INSTRUKTUR-</option>
                        <option value="1">NIP - A. WAHIDAH S.Kp (Matematika Dasar)</option>
                    </select>
                </div>
            </div>
            <div id="individu" class="row hidden">
                <div class="col-lg-6">
                    <select class="form-control input-sm select2" style="width: 100%;">
                        <option>Survey Keterampilan Pelaut</option>
                    </select>
                </div>
            </div>
        </section>

        <style media="screen">
            .respon {
                height: 150px;
                display: inline-block;
                width: 100%;
                overflow: auto;
            }
        </style>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="box-title">Daftar Hasil Survey Diklat BP2IP</h3>
                        </div>
                        <!-- <div class="col-md-6">
                            <select class="form-control input-sm select2" style="width: 100%;">
                              <option>Survey Keterampilan Pelaut</option>
                            </select>
                        </div> -->
                    </div>
                </div>
                <div class="box-body">

                    <table class="table">
                        <thead>
                        <tr>
                            <th colspan="2">Pertanyaan</th>
                            <th colspan="5" width="50%"><center>Respon</center></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Cara penyampaian materi oleh tentor BP2IP?</td>
                            <td>TP (10)</td>
                            <td>KP (10)</td>
                            <td>CP (10)</td>
                            <td>P (10)</td>
                            <td>SP (10)</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Fasilitas ruangan diklat BP2IP?</td>
                            <td>TP (10)</td>
                            <td>KP (10)</td>
                            <td>CP (10)</td>
                            <td>P (10)</td>
                            <td>SP (10)</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Berikan saran anda tentang keiatan diklat pengendalian ombat</td>
                            <td colspan="5">
                                <table class="table table-bordered">
                                    <tbody class="respon">
                                    <tr>
                                        <td>1</td>
                                        <td>Saya suka sekali diklat ini, hasilnya saya bisa meratakan ombat</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Sebelum saya ikut diklat saya mengalami pusing hebat, setelah ikut diklat ini pusing saya jadi nambah</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Sarang saya tolong tentornya jangan cowok</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Kesan saya mengikuti diklat ini sebenarnya tidak ada</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Tolong tambah kursinya, masa saya duduknya melantai!!!</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Inilah 5 saran saya mengenai diklat ini, no 4 paling mencengangkan!!</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Saya akan menyanyikan lagu abdullah...</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
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

@endsection

@push('js')

    <script type="text/javascript">
        //Initialize Select2 Elements
        $('.select2').select2({
            placeholder: 'Cari Survey...',
            allowClear: true
        })
    </script>

    <script type="text/javascript">
        $('#survey').change(function(){
            survey = $('#survey').val();
            if(survey=='1'){
                $('#individu').removeClass('hidden');
                $('#instruktur').addClass('hidden');
            }
            else if (survey=='2'){
                $('#instruktur').removeClass('hidden');
                $('#individu').addClass('hidden');
            }
        });
    </script>
@endpush
