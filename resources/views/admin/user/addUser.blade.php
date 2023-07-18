@extends('admin.layouts.adminlayout')

@section('content')
    <!-- Main content -->
    <section class="content">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close  btn-close bg-danger" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                {{ session('status') }}
            </div>
        @endif
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Data Diri</h3>

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Nama</label>
                                <input type="text" id="inputName" name="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama"
                                    value="{{ old('name') }}" required="required" autocomplete="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input type="email" id="inputEmail" name="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email"
                                    value="{{ old('email') }}" required="required" autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label for="role">Role</label>

                                <select id="role" required name="role" aria-label=".form-select-sm example"
                                    class="form-select form-select-sm ">
                                    <option value="" selected>Pilih Role</option>
                                    @foreach ($role as $r)
                                        <option value="{{ $r['id'] }}">{{ $r['role'] }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="inputFoto">Foto Profil</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="elevation-3" id="prevImg"
                                            src="{{ asset('vendor/adminlte3/img/user2-160x160.jpg') }}" width="150px" />
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" id="inputFoto" name="user_image" accept="image/*"
                                            class="form-control @error('user_image') is-invalid @enderror"
                                            placeholder="Upload foto profil">
                                    </div>
                                </div>

                                @error('user_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Password</h3>

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" placeholder="Kata Sandi"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required="required" autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">Konfirmasi Password</label>
                                <input placeholder="Ketik ulang kata sandi" id="password-confirm" type="password"
                                    class="form-control" name="password_confirmation" required="required"
                                    autocomplete="new-password">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ url('dashboard/admin/user') }}" class="btn btn-secondary">Batal</a>
                    <input type="submit" value="Tambah Akun" class="btn btn-success float-right">
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
