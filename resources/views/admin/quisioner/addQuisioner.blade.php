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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Periode</h3>

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Kuisioner Untuk</label>
                                <select name="for" class="form-control @error('for') is-invalid @enderror"
                                    value="{{ old('for') }}" required="required">
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Alumni">Alumni</option>
                                    <option value="Calon Mahasiswa">Calon Mahasiswa</option>

                                </select>
                                @error('for')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Pertanyaan</label>
                                <input type="text" id="inputEmail" name="question"
                                    class="form-control @error('question') is-invalid @enderror"
                                    placeholder="Masukkan Pertanyaan" value="{{ old('question') }}" required="required"
                                    autocomplete="question">
                                @error('question')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <a href="{{ url('dashboard/admin/user') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-success float-right">Tambah Quisioner </button>
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
