@extends('admin.layouts.adminlayout')
@section('script_head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('content')
    <!-- Default box -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header">
                        <div class="row">

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close btn  btn-close bg-danger" data-dismiss="alert"
                                        aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card-tools col-12 ">
                                <label>Filter:</label>
                                <form method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-3">
                                            <label for="inputFirstDate">Tanggal Awal</label>
                                            <input type="date" value="{{ $fdate }}" id="inputFirstDate"
                                                name="fdate" class="form-control @error('fdate') is-invalid @enderror"
                                                placeholder="Masukkan Tangga;" value="{{ old('fdate') }}" required
                                                autocomplete="fdate">
                                            @error('fdate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="inputUntilDate">Tanggal Akhir</label>
                                            <input type="date" value="{{ $udate }}" id="inputUntilDate"
                                                name="udate" class="form-control @error('udate') is-invalid @enderror"
                                                placeholder="Masukkan Tangga;" value="{{ old('udate') }}" required
                                                autocomplete="udate">
                                            @error('udate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class=" col-3 d-flex align-content-center p-3">

                                            <input type="submit" value="Cari"
                                                class="m-1 col-12 btn btn-sm btn-success float-right">
                                        </div>
                                        <div class=" col-3 d-flex align-content-center p-3">

                                            <a type="button"
                                                class="m-1 col-12 btn btn-sm btn-warning d-flex align-items-center justify-content-center"
                                                href="{{ url('dashboard/admin/report/exportschedule?fyear=' . $fyear . '&uyear=' . $uyear) }}"
                                                target="_BLANK">Ekspor
                                                Data</a>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-tools col-12 text-end">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body p-0  table-responsive" style="margin: 20px">
                    <table id="previewSchedule" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>PIC 1</th>
                                <th>PIC 2</th>
                                <th>Tujuan</th>
                                <th>Tanggal</th>
                                <th>status</th>
                                <th>Surat Dinas</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    </div>
    <!-- /.card -->
    @endsection @section('script_footer')
    <script src="{{ asset('vendor/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('vendor/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('vendor/adminlte3/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="../../dist/js/demo.js"></script> --}}

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            var fyear = {{ $fyear }};
            var uyear = {{ $uyear }};
            $('#previewSchedule').DataTable({
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": "{{ route('report.reportschedule') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}",
                        "fyear": fyear,
                        "uyear": uyear,
                    }
                },
                "columns": [{
                    "data": "no"
                }, {
                    "data": "pic_1"
                }, {
                    "data": "pic_2"
                }, {
                    "data": "school"
                }, {
                    "data": "date"
                }, {
                    "data": "status"
                }, {
                    "data": "surat_dinas"
                }],
                "language": {
                    "decimal": "",
                    "emptyTable": "Tak ada data yang tersedia pada tabel ini",
                    "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                    "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                    "infoFiltered": "(difilter dari _MAX_ total entri)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "loadingRecords": "Loading...",
                    "processing": "Sedang Mengambil Data...",
                    "search": "Pencarian:",
                    "zeroRecords": "Tidak ada data yang cocok ditemukan",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                    "aria": {
                        "sortAscending": ": aktifkan untuk mengurutkan kolom ascending",
                        "sortDescending": ": aktifkan untuk mengurutkan kolom descending"
                    }
                }

            });

            // hapus data
            $('#previewSchedule').on('click', '.hapusData', function() {
                var id = $(this).data("id");
                var url = $(this).data("url");
                Swal
                    .fire({
                        title: 'Apa kamu yakin?',
                        text: "Kamu tidak akan dapat mengembalikan ini!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            // console.log();
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                data: {
                                    "id": id,
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    // console.log();
                                    Swal.fire('Terhapus!', response.msg, 'success');
                                    $('#previewSchedule').DataTable().ajax.reload();
                                }
                            });
                        }
                    })
            });

            $('#previewSchedule').on('change', '.confirm-status', function() {
                var id = $(this).attr("data-id");
                var idc = $(this).val();
                var url = document.getElementById('confirm-status').getAttribute("data-url");
                console.log(id);
                console.log(idc);
                console.log(url);
                Swal
                    .fire({
                        title: 'Apa kamu yakin?',
                        text: "Kamu akan Mengganti Status Kehadiran Kunjungan Kamu!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Batal'
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            // console.log();
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {
                                    "id": id,
                                    "idc": idc,
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    // console.log();
                                    Swal.fire('Status Diganti!', response.msg, 'success');
                                    $('#previewSchedule').DataTable().ajax.reload();
                                }
                            });
                        }
                    })
            });
        });
    </script>
@endsection
