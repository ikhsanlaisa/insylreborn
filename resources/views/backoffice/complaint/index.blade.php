@extends('layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-body">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Data Pengaduan PASIS
                <small>BP2IP Barombong</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Pengaduan BP2IP</h3>
                    <!-- <a href="#" type="button" class="btn btn-sm btn-primary pull-right" name="button"><i class="fa fa-plus"></i> AKUN BARU</a> -->
                    <div class="btn-group pull-right">
                        <a href="{{ route('complaints.create') }}" type="button" title="Buat Pengaduan"
                           class="btn btn-sm btn-primary" name="button"><i class="fa fa-plus"></i> Buat Pengaduan</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12 text-bold">Filter By :</div>
                        @if(Auth::user()->isSuperAdmin())
                            <div class="col-md-3">
                                <select id="filterPengaduan" class="form-control">
                                    <option selected disabled>Pilih Jenis Pengaduan</option>
                                    <option value="">Semua Jenis Pengaduan</option>
                                </select>
                            </div>
                        @endif
                        <div class="col-md-3">

                            <select id="filterStatus" class="form-control">
                                <option selected disabled>Pilih Status</option>
                                <option value="">Semua Status</option>
                                <option value="Tersubmit">Tersubmit</option>
                                <option value="On Progress">On Progress</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>NIT</th>
                                <th>Nama Pasis</th>
                                <th>Waktu</th>
                                <th>Jenis Pengaduan</th>
                                <th>Isi Pengaduan</th>
                                <th>Status</th>
                                <th width="8%" title="Action button">
                                    <center><span class="fa fa-bars"></span></center>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pengaduan as $index => $item)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $item->siswa->nit }}</td>
                                    <td>{{ $item->siswa->nama }}</td>
                                    {{--<td>{{ \Carbon\Carbon::parse($item->created_at)->format('d, M Y H:i') }}</td>--}}
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->layanan->jenis }}</td>
                                    <td>{{ $item->isi }}</td>
                                    <td>
                                        @switch($item->timeline->last()->status['status'])
                                            @case('TERSUBMIT')
                                            <span
                                                class="label label-warning">{{ ucwords($item->timeline->last()->status['status']) }}</span>
                                            @break
                                            @case('ON PROGRESS')
                                            <span
                                                class="label label-info">{{ ucwords($item->timeline->last()->status['status']) }}</span>
                                            @break
                                            @default
                                            <span
                                                class="label label-success">{{ ucwords($item->timeline->last()->status['status']) }}</span>
                                            @break


                                        @endswitch

                                    </td>
                                    <td>
                                        <center>
                                            {{--<a href="#" class="btn btn-xs btn-in-o btn-round"><i class="fa fa-eye"></i>--}}

                                                @if(Auth::user()->admin)
                                                    <a href="#" data-toggle="modal" data-target="#editPengaduan"
                                                       data-pengaduan="{{ $item }}" title="edit"
                                                       class="btn btn-xs btn-in-o btn-round"><i class="fa fa-edit"></i>
                                                    </a>
                                                @endif
                                                <a href="#"
                                                   onclick="deletePengaduan('{{ $item->id }}', '{{ $item->siswa->nama }}', '{{ $item->created_at }}')"
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
                <!-- /.box-body -->
                <div class="box-footer">
                    BP2IP - Barombong
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="editPengaduan">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pengaduan dari <span id="namaSiswa"></span></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal & Waktu : </label>
                        <input type="text" id="tanggal" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Jenis Pengaduan : </label>
                        <input type="text" id="jenis" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Isi Pengaduan : </label>
                        <textarea id="isi" class="form-control" rows="10" readonly></textarea>
                    </div>

                    <div class="form-group">
                        <label>Lampiran Foto : </label>
                        <a id="foto" target="_blank">Klik Disini</a>
                    </div>


                </div>
                <div class="modal-footer" id="mFooter">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    {{--<button type="button" id="save" onclick="set(1)" class="btn btn-primary">Simpan</button>--}}
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
            $('#filterStatus').change(function () {
                let status = $('#filterStatus :selected').val();
                table.column(6).search(status).draw();
            });
            @if(Auth::user()->isSuperAdmin())
            $('#filterPengaduan').change(function () {
                let kategori = $('#filterPengaduan :selected').val();
                table.column(4).search(kategori).draw();
            });

            $.ajax({
                type: 'GET',
                url: '{{ route('kategori.list') }}',
                success: function (data) {
                    $.each(data, function (index, value) {
                        $('#filterPengaduan').append(
                            '<option value="' + value['jenis'] + '">' + value['jenis'] + '</option>'
                        )
                    })
                }
            })
                @endif

            let table = $('#example1').DataTable({
                "columnDefs": [{
                    "targets": 7,
                    "orderable": false
                }],

            });
        });
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#editPengaduan').on('show.bs.modal', function (e) {
            let button = $(e.relatedTarget);
            let dataPengaduan = button.data('pengaduan');

            $('#namaSiswa').text(dataPengaduan['siswa']['nama']);
            $('#tanggal').val(dataPengaduan['created_at']);
            $('#jenis').val(dataPengaduan['layanan']['jenis']);
            $('#isi').text(dataPengaduan['isi']);

            if (dataPengaduan['foto'] != null) {
                $('#foto').attr('href', 'storage/' + dataPengaduan['foto']);
                $('#foto').text('Klik Disini !');
            } else {
                $('#foto').attr('href', '#');
                $('#foto').text('Tidak ada');
            }

            let status = dataPengaduan['timeline'][dataPengaduan['timeline'].length - 1]['status']['id'];


            if (status == 1) {

                $('#save').remove();
                $('#hasilPengaduan').remove();
                $('#mFooter').append(
                    '<button type="button" id="save" onclick="onProcess(\'' + dataPengaduan['id'] + '\')" class="btn btn-primary">Proses Sekarang</button>'
                )
            } else if (status == 2) {
                $('#save').remove();
                $('#hasilPengaduan').remove();
                $('.modal-body').append(
                    '  <div class="form-group" id="hasilPengaduan">\n' +
                    '<label for="hasil">Hasil : </label>\n' +
                    '<textarea name="hasil" id="hasil" class="form-control" rows="5"></textarea>\n' +
                    '</div>'
                );
                $('#mFooter').append(
                    '<button type="button" id="save" onclick="result(\'' + dataPengaduan['id'] + '\')" class="btn btn-primary">Selesai</button>'
                )
            } else {
                $('#save').remove();
                $('#hasilPengaduan').remove();
                $('.modal-body').append(
                    '  <div class="form-group" id="hasilPengaduan">\n' +
                    '<label for="hasil">Hasil : </label>\n' +
                    '<textarea name="hasil" id="hasil" class="form-control" rows="5" readonly>' + dataPengaduan['hasil'] + ' </textarea>\n' +
                    '</div>'
                );
            }


        });

        function onProcess(id) {

            $.ajax({
                type: 'POST',
                url: '{{ route('complaints.proses') }}',
                data: {pengaduan_id: id},
                success: function (data) {
                    window.location.href = "{{ route('complaints.index') }}";
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        function result(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('complaints.done') }}',
                data: {
                    pengaduan_id: id,
                    hasil: $('#hasil').val()
                },
                success: function (data) {
                    window.location.href = "{{ route('complaints.index') }}";
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        function deletePengaduan(pengaduanId, namaPelapor, tanggalLapor) {
            swal({
                title: "Apa anda yakin?",
                text: "Anda Menghapus Pengaduan oleh " + namaPelapor + " pada tanggal : " + tanggalLapor,
                icon: "warning",
                buttons: true,
                dangerMode: true,

            }).then((willDelete => {
                if (willDelete) {
                    let theUrl = "{{ route('complaints.destroy', ':pengaduanId') }}";
                    theUrl = theUrl.replace(":pengaduanId", pengaduanId);

                    let redirectUrl = "{{ route('complaints.index') }}";

                    $.ajax({
                        type: 'POST',
                        url: theUrl,
                        data: {_method: "delete"},
                        success: function (data) {
                            swal("Deleted!", "Pengaduan berhasil di delete!", "success").then((data => {
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

    @if(Session::has('success'))
        <script>
            swal("Berhasil", "Berhasil di perbaharui", "success")
        </script>
    @endif
@endpush

