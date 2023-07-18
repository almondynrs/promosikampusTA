@extends('admin.layouts.adminlayout')
@section('script_head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('content')

@php

    use App\Models\avgPerbandinganKriteria;

@endphp
    <!-- Default box -->
    <div class="container-fluid py-4">

        <div class="row">
        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h3 class="card-title col-6">
                                <p>Data Matriks</p>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body tabel-responsive">
                    <table id="m1" class="table table-striped tabel-responsive table-bordered display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                               @foreach($kriteria as $k)
                               <th>{{ $k->nama_kriteria }}</th>
                               @endforeach
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($kriteria as $r => $kr)
                            <tr>
                                <td>{{ $kr->nama_kriteria }}</td>
                                @foreach($kriteria as $r2 => $kr2)
                                
                                    @php
                                    
                                    $g = avgPerbandinganKriteria::where('kriteria_id1', '=', $kr->id)->where('kriteria_id2', '=', $kr2->id)->first();
                                    $g2 = avgPerbandinganKriteria::where('kriteria_id1', '=', $kr2->id)->where('kriteria_id2', '=', $kr->id)->first();
                                    
                                    @endphp

                                    @if($g2)
                                        <td>
                                        {{ $j[$r2] = doubleval($g2->avg) }}
                                        </td>
                                    @elseif($g)
                                        <td>
                                        {{ $j[$r2] = doubleval($g->avg) }}
                                        </td>
                                    @elseif($r === $r2)
                                        <td>
                                         {{ $j[$r2] = 1}}
                                        </td>
                                    @endif

                                @endforeach
                            </tr>
                            @php
                                $jumlah[$r] = array_sum($j);
                            @endphp
                        @endforeach
                            <tr>
                            <td>Jumlah</td>
                                @foreach($kriteria as $r => $kr)
                                    <td>{{ $jumlah[$r] }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h3 class="card-title col-6">
                                <p>Data Geomean</p>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="geomean" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Kriteria 1</th>
                                <th>Kriteria 2</th>
                                <th>Nilai Geomean</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($geomean as $g)
                                <tr>
                                    <td>{{ $g->Kriteria1->nama_kriteria }}</td>
                                    <td>{{ $g->Kriteria2->nama_kriteria }}</td>
                                    <td>{{ $g->avg }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Belum ada data</td>
                                </tr>
                            @endforelse
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
            $('#previewAkun').DataTable({
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": "{{ route('akun.dataTable') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}"
                    }
                },
                "columns": [{
                    "data": "name"
                }, {
                    "data": "email"
                }, {
                    "data": "role"
                }, {
                    "data": "options"
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
            $('#previewAkun').on('click', '.hapusData', function() {
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
                                    $('#previewAkun').DataTable().ajax.reload();
                                }
                            });
                        }
                    })
            });
        });
    </script>
@endsection
