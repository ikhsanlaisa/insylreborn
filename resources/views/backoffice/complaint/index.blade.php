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
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="6%">No</th>
                                <th width="8%">NIT</th>
                                <th>Nama Pasis</th>
                                <th width="15%">Waktu</th>
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
                                    <td>{{ $item->isi }}</td>
                                    <td>{{ ucwords($item->timeline->last()->status['status']) }}</td>
                                    <td>
                                        <center>
                                            <a href="#" class="btn btn-xs btn-in-o btn-round"><i class="fa fa-eye"></i>
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#editPengaduan"
                                               data-pengaduan="{{ $item }}" title="edit"
                                               class="btn btn-xs btn-in-o btn-round"><i class="fa fa-edit"></i> </a>
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
                    Footer
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
            $('#example1').DataTable({
                "columnDefs": [{
                    "targets": 5,
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

            console.log(dataPengaduan);

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

            let status = dataPengaduan['timeline'][dataPengaduan['timeline'].length - 1]['status']['status'];


            if (status == 'tersubmit') {

                $('#save').remove();
                $('#mFooter').append(
                    '<button type="button" id="save" onclick="onProcess(\'' + dataPengaduan['id'] + '\')" class="btn btn-primary">Proses Sekarang</button>'
                )
            } else if (status == 'onprogress') {
                $('#save').remove();
                $('#mFooter').append(
                    '<button type="button" id="save" onclick="result()" class="btn btn-primary">Selesai</button>'
                )
            }


        });

        function onProcess(id) {

            console.log(id);
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

        function result() {

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

