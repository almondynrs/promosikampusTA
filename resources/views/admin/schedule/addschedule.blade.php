@extends('admin.layouts.adminlayout')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- jika menggunakan bootstrap4 gunakan css ini  -->
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<!-- cdn bootstrap4 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
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
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-11">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Penjadwalan</h3>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="inputDate">Tanggal</label>
                                    <input type="date" id="inputDate" name="date"
                                        class="form-control @error('date') is-invalid @enderror"
                                        placeholder="Masukkan Tangga;" value="{{ old('date') }}" required
                                        autocomplete="date">
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-3">
                                    <label for="inputschool">Sekolah Tujuan</label>

                                    <select id="inputschool" required name="school" aria-label=".form-select-sm example"
                                        class="form-select form-select-sm ">
                                        <option value="" selected>Pilih Sekolah Tujuan</option>
                                        @foreach ($school as $s)
                                            <option value="{{ $s['id'] }}">{{ $s['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('school')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-3">
                                    <label for="inputpic1">PIC 1</label>

                                    <select id="inputpic1" required name="pic1" aria-label=".form-select-sm example"
                                        class="form-select form-select-sm ">
                                        <option value="" selected>Pilih PIC Ke-1</option>
                                        @foreach ($pegawaiAll as $p)
                                            <option value="{{ $p['id'] }}">{{ $p['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('pic1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-3">
                                    <label for="inputpic2">PIC 2</label>

                                    <select id="inputpic2" required name="pic2" aria-label=".form-select-sm example"
                                        class="form-select form-select-sm ">
                                        <option value="" selected>Pilih PIC Ke-2</option>
                                        @foreach ($pegawaiAll as $p)
                                            <option value="{{ $p['id'] }}">{{ $p['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('pic2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="inputdescription">Deskripsi</label>

                                    <textarea id="inputdescription" required name="description" class="form-control" value="{{ old('description') }}"></textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="inputsurat">Unggah Surat Dinas</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="file" id="inputsurat" name="surat_dinas"
                                                accept="application/pdf"
                                                class="form-control @error('surat_dinas') is-invalid @enderror"
                                                placeholder="Upload foto profil">
                                        </div>
                                    </div>

                                    @error('surat_dinas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer ">
                                    <div class="col-12 row justify-content-between">
                                        <a href="{{ url('dashboard/admin/schedule') }}"
                                            class=" col-3 m-1 btn btn-secondary">Batal</a>
                                        <input type="submit" value="Tambah Penjadwalan"
                                            class=" col-3 m-1 btn btn-success float-right">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>

                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <!-- js untuk bootstrap4  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endsection @section('script_footer')
    <script>
        $(document).ready(function() {
            $("#inputschool").select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Sekolah"
            });

            $("#inputpic1").select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Pegawai"
            }).on("change", function() {
                var selectedValue = $(this).val();

                // Disable the options in inputpic2 with the same value as selectedValue
                $("#inputpic2 option").each(function() {
                    if ($(this).val() === selectedValue) {
                        $(this).prop("disabled", true);
                    } else {
                        $(this).prop("disabled", false);
                    }
                });

                // Refresh the Select2 instance for inputpic2
                $("#inputpic2").select2("destroy").select2();
            });

            $("#inputpic2").select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Pegawai"
            }).on("change", function() {
                var selectedValue = $(this).val();

                // Disable the options in inputpic1 with the same value as selectedValue
                $("#inputpic1 option").each(function() {
                    if ($(this).val() === selectedValue) {
                        $(this).prop("disabled", true);
                    } else {
                        $(this).prop("disabled", false);
                    }
                });

                // Refresh the Select2 instance for inputpic1
                $("#inputpic1").select2("destroy").select2();
            });
        });
    </script>
@endsection
