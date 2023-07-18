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
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 pb-3">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h3 class="card-title col-6">
                                <p>Data Matriks</p>
                            </h3>
                            <div class="card-tools col-6 text-end">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="m1" class="table table-striped tabel-responsive table-bordered display"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>Kriteria</th>
                                    @foreach ($kriteria as $k)
                                        <th>{{ $k->nama_kriteria }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($kriteria as $r => $kr)
                                    <tr>
                                        <td>{{ $kr->nama_kriteria }}</td>
                                        @foreach ($kriteria as $r2 => $kr2)
                                            @php
                                                
                                                $g = avgPerbandinganKriteria::where('kriteria_id1', '=', $kr->id)
                                                    ->where('kriteria_id2', '=', $kr2->id)
                                                    ->first();
                                                $g2 = avgPerbandinganKriteria::where('kriteria_id1', '=', $kr2->id)
                                                    ->where('kriteria_id2', '=', $kr->id)
                                                    ->first();
                                                $A = 'A';
                                                $B = [];
                                            @endphp

                                            @if ($g2)
                                                <td>
                                                    {{ $j[$r2] = doubleval($g2->avg) }}
                                                </td>
                                            @elseif($g)
                                                <td>
                                                    {{ $j[$r2] = doubleval($g->avg) }}
                                                </td>
                                            @elseif($r === $r2)
                                                <td>
                                                    {{ $j[$r2] = 1 }}
                                                </td>
                                            @endif

                                            @php
                                                $B[$A] = $j[$r2];
                                                $A++;
                                            @endphp
                                        @endforeach
                                    </tr>
                                    @php
                                        $jumlah[$r] = array_sum($j);
                                    @endphp
                                @endforeach
                                <tr>
                                    <td>Jumlah</td>
                                    @foreach ($kriteria as $r => $kr)
                                        <td>{{ $jumlah[$r] }}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 pb-3">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h3 class="card-title col-6">
                                <p>Normalisasi / Nilai Eigen Value</p>
                            </h3>
                            <div class="card-tools col-6 text-end">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body ">
                        <div class="table-responsive">
                            <table id="m1" class="table table-striped  table-bordered display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Kriteria</th>
                                        @foreach ($kriteria as $k)
                                            <th>{{ $k->nama_kriteria }}</th>
                                        @endforeach
                                        <th>Jumlah</th>
                                        <th>Priority Vector</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kriteria as $r => $kr)
                                        <tr>
                                            <td>{{ $kr->nama_kriteria }}</td>
                                            @foreach ($kriteria as $r2 => $kr2)
                                                @php
                                                    
                                                    $g = avgPerbandinganKriteria::where('kriteria_id1', '=', $kr->id)
                                                        ->where('kriteria_id2', '=', $kr2->id)
                                                        ->first();
                                                    $g2 = avgPerbandinganKriteria::where('kriteria_id1', '=', $kr2->id)
                                                        ->where('kriteria_id2', '=', $kr->id)
                                                        ->first();
                                                    $A = 'A';
                                                    $B = [];
                                                @endphp

                                                @if ($g2)
                                                    <td>
                                                        {{ $j[$r2] = doubleval($g2->avg) / $jumlah[$r] }}
                                                    </td>
                                                @elseif($g)
                                                    <td>
                                                        {{ $j[$r2] = doubleval($g->avg) / $jumlah[$r] }}
                                                    </td>
                                                @elseif($r === $r2)
                                                    <td>
                                                        {{ $j[$r2] = 1 / $jumlah[$r] }}
                                                    </td>
                                                @endif


                                                @php
                                                    $B[$A] = $j[$r2];
                                                    $A++;
                                                    
                                                @endphp
                                            @endforeach

                                            <td>
                                                {{ $j2[$r] = array_sum($B) }}
                                            </td>
                                            <td>
                                                {{ $j3[$r + 1] = array_sum($B) / count($kriteria) }}
                                            </td>

                                            @php
                                                $jumlah[$r] = array_sum($j);
                                                $jumlah2[$r] = array_sum($j2);
                                                $jumlah3[$r] = array_sum($j3);
                                            @endphp
                                    @endforeach
                                    <tr>
                                        <td>Jumlah</td>
                                        @foreach ($kriteria as $r => $kr)
                                            <td>{{ $jumlah[$r] }}</td>
                                        @endforeach
                                        <td>{{ $jumlah2[$r] }}</td>
                                        <td>{{ $jumlah3[$r] }}</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
@endsection
