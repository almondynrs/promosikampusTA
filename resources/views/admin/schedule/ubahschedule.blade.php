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
                                    <label for="inputDate">Date</label>
                                    <input type="date" id="inputDate" name="date"
                                        class="form-control @error('date') is-invalid @enderror"
                                        placeholder="Masukkan Tangga;" value="{{ $schedule->date }}" required="required"
                                        autocomplete="date">
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-3">
                                    <label for="inputschool">Sekolah Tujuan</label>

                                    <select id="inputschool" name="school" aria-label=".form-select-sm example" required
                                        class="form-select form-select-sm ">
                                        <option selected value="">Pilih Sekolah Tujuan</option>
                                        @foreach ($school as $s)
                                            <option value="{{ $s['id'] }}"
                                                @if ($schedule->school_id == $s['id']) {{ 'selected' }} @endif>
                                                {{ $s['name'] }}</option>
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

                                    <select id="inputpic1" name="pic1" aria-label=".form-select-sm example" required
                                        class="form-select form-select-sm ">
                                        <option selected value="">Pilih PIC Ke-1</option>
                                        @foreach ($pegawaiAll as $p)
                                            <option value="{{ $p['id'] }}"
                                                @if ($schedule->pic_1 == $p['id']) {{ 'selected' }} @endif>
                                                {{ $p['name'] }}</option>
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

                                    <select id="inputpic2" name="pic2" aria-label=".form-select-sm example" required
                                        class="form-select form-select-sm ">
                                        <option selected value="">Pilih PIC Ke-2</option>
                                        @foreach ($pegawaiAll as $p)
                                            <option value="{{ $p['id'] }}"
                                                @if ($schedule->pic_2 == $p['id']) {{ 'selected' }} @endif>
                                                {{ $p['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('pic2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="inputdescription">Description</label>

                                    <textarea id="inputdescription" name="description" class="form-control">{{ $schedule->description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">

                                    <label for="inputsurat">Upload Surat Dinas</label>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input type="file" id="inputsurat" name="surat_dinas"
                                                accept="application/pdf"
                                                class="form-control @error('surat_dinas') is-invalid @enderror"
                                                placeholder="Upload foto profil">
                                        </div>
                                        @if ($schedule->surat_dinas)
                                            <div class="col-md-4">
                                                <a class="btn btn-info btn-sm" target="_BLANK"
                                                    href="{{ asset($schedule->surat_dinas) }}">File</a>
                                            </div>
                                        @endif
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
                                        <input type="submit" value="Simpan Perubahan Schedule"
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
