@extends('admin.layouts.adminlayout')

@section('content')
    <!-- Main content -->
    <section class="content">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                {{ session('status') }}
            </div>
        @endif
        <form method="post" action="{{ route('kuisioner.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12 col-xl-12 col-xxl-12 col-lg-12">
                    <div class="card card-primary py-4">
                        <div class="card-header">
                            <h3 class="card-title">Detail Kuisioner</h3>

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Kuisioner Untuk</label>
                                <input type="text" value="{{ $quisioner->for }}" class="form-control" disabled>

                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Pertanyaan</label>
                                <input type="text" id="inputEmail" name="question"
                                    class="form-control @error('question') is-invalid @enderror"
                                    placeholder="Masukkan Pertanyaan" value="{{ $quisioner->question }}" disabled>

                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-header">
                            <h3 class="card-title">Jenis Kuisioner</h3>

                        </div>

                        <div class="card-body">


                            <a href="{{ route('jenis-kuis.create', $quisioner->id) }}" class="btn btn-primary">Tambahkan
                                data Jenis
                                Kuisioner</a>
                            @if (count($quisioner->jenisQuisioner) >= 1)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Jenis</th>
                                                <th scope="col">Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($quisioner->jenisQuisioner as $data)
                                            <tr class="">
                                                <td scope="row">{{$loop->iteration}} </td>
                                                <td>{{$data->nama_jenis}}</td>
                                                <td>

                                                    <a href="{{ route('jenis-kuis.edit', $data->id) }}">
                                                        <i class='fas fa-edit fa-lg'></i></a>
                                                    <a href="{{ route('jenis-kuis.delete', $data->id) }}"
                                                        style='border: none; background-color:transparent;' class='hapusData'>
                                                        <i class='fas fa-trash fa-lg text-danger'></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <h3>Belum ada Jenis Kuisioner</h3>
                            @endif




                        </div>
                    </div>


                    <!-- /.card -->
                </div>



            </div>

        </form>
    </section>
    <!-- /.content -->
    @endsection @section('script_footer')
    <script>
        inputFoto.onchange = evt => {
            const [file] = inputFoto.files
            if (file) {
                prevImg.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
