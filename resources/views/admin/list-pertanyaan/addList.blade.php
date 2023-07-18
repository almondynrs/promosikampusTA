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
        <form method="post" action="{{ route('list-pertanyaan.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12 col-xl-12 col-xxl-12 col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah List Pertanyaan</h3>

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Nama Kuisioner</label>
                                <select name="for" class="form-control @error('for') is-invalid @enderror"
                                    value="{{ old('for') }}" required="required" id="selectQuisioner">
                                    <option value="">Pilih Kuisioner</option>
                                    @foreach ($quisioner as $item)
                                        <option value="{{ $item->id }}">{{ $item->question }} | {{ $item->for }} </option>
                                    @endforeach
                                </select>
                                @error('for')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputName">Jenis Kuisioner Tersedia</label>
                                <select class="form-control @error('for') is-invalid @enderror" value="{{ old('for') }}"
                                    required="required" readonly id="id_jenis_quisioner" name="id_jenis_quisioner">
                                    <option value="">Pilih Jenis</option>
                                </select>
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
                                    placeholder="Masukkan Pertanyaan" value="{{ old('question') }}" required="required"
                                    autocomplete="question">
                                @error('question')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <a href="{{ url('dashboard/admin/user') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-success float-right">Tambah Kuisioner </button>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                </div>

            </div>

        </form>
    </section>
    <!-- /.content -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @endsection @section('script_footer')
    <script>
        $(document).ready(function() {
            $('#selectQuisioner').on('change', function() {
                var id = this.value;


                $.ajax({
                    type: "post",
                    url: "{{ route('list-pertanyaan.getJenisQuisioner') }}",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: "json",
                    success: function(response) {
                        $.each(response.jenis, function(key, value) {
                            $('#id_jenis_quisioner').append('<option value="' + value
                                .id + '">' + value.nama_jenis + '</option>');
                        });
                    }
                });
            })
        });
    </script>
@endsection
