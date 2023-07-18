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
        <form method="post" action="{{ route('list-pertanyaan.update', $list->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12 col-xl-12 col-xxl-12 col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Detail List Pertanyaan</h3>

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Jenis Quisioner</label>
                                <input type="text" value="{{ $list->jenisQuisioner->nama_jenis }}" class="form-control"
                                    readonly>
                                @error('for')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Pertanyaan</label>
                                <input type="text" id="inputEmail" name="judul_pertanyaan"
                                    class="form-control @error('question') is-invalid @enderror"
                                    placeholder="Masukkan Pertanyaan" required="required" autocomplete="question"
                                    value="{{ $list->judul_pertanyaan }}">
                                @error('question')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <a href="{{ url('dashboard/admin/list-pertanyaan') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-success float-right">Update Pertanyaan </button>
                        </div>
                        <!-- /.card-body -->

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
