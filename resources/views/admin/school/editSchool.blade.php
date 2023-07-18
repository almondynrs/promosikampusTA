@extends('admin.layouts.adminlayout')
@section('script_head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Data Sekolah</h3>
                    </div>
                    <div class="card-body p-0  table-responsive" style="margin: 20px">
                        <form action="{{ route('sekolah.update',$sekolah->id) }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="" class="form-label">Nama Sekolah</label>
                                <input type="text" class="form-control" name="name" id=""
                                    aria-describedby="helpId" value="{{$sekolah->name}}">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Jenis Sekolah</label>
                                <select type="text" class="form-control" name="type" id=""
                                    aria-describedby="helpId" placeholder="">
                                        <option value="SMA">SMA</option>
                                        <option value="SMK">SMK</option>
                                        <option value="MA">MA</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="address" id=""
                                    aria-describedby="helpId" value="{{$sekolah->address}}">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">No Telp</label>
                                <input type="number" class="form-control" name="phone_number" id=""
                                    aria-describedby="helpId" value="{{$sekolah->phone_number}}">
                            </div>
                            <button class="btn btn-primary">Ubah</button>
                        </form>
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