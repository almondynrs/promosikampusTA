@extends('admin.layouts.adminlayout')
@section('script_head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('content')
    <!-- Default box -->
    <div class="container-fluid py-4">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible ">
                    <button type="button" class="close btn btn-danger btn-close bg-danger" data-dismiss="alert"
                        aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header">
                        <div class="row">


                            <h5 class="col-6 text-start">
                                <a href="" class="btn btn-success btn-sm p-3" data-toggle="modal"
                                    data-target="#staticModal"> + Impor</a>
                            </h5>


                            <div class="card-tools col-6 text-end">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0  table-responsive" style="margin: 20px">
                            <table id="previewAkun" class="table table-striped table-bordered display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kriteria</th>
                                        <th>Bobot</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kriteria as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->nama_kriteria }}</td>
                                            <td>{{ $data->bobot }}</td>

                                        <tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-6 col-sm-12 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h3 class="card-title col-6">Data Kriteria</h3>
                            <h3 class="card-title col-3 text-center">
                                <a href="{{ route('kriteria.create') }}" class="btn btn sm btn-success"> + Tambah</a>

                            </h3>
                            <div class="card-tools col-2 text-center">
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0  table-responsive" style="margin: 20px">
                            <table id="previewAkun" class="table table-striped table-bordered display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kriteria</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kriteria as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->nama_kriteria }}</td>
                                            <td>
                                                @if ($data->status === '1')
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('kriteria.updatestatus', $data->id) }}">
                                                        Active
                                                    </a>
                                                @else
                                                    <a class="btn btn-sm btn-secondary"
                                                        href="{{ route('kriteria.updatestatus', $data->id) }}">
                                                        Non Active
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('kriteria.edit', $data->id) }}"><i
                                                        class='fas fa-edit fa-lg'></i></a>
                                                <a style='border: none; background-color:transparent;'
                                                    href="{{ route('kriteria.delete', $data->id) }}">
                                                    <i class='fas fa-trash fa-lg text-danger'></i></a>
                                            </td>
                                        <tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div> --}}

            <!-- /.card -->
        </div>
    </div>
    {{-- Modal --}}

    <div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">Impor Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kriteria.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="import">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Impor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
