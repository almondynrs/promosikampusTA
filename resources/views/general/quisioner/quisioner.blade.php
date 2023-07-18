@extends('general.layouts.frontlayout')

@section('title', 'Quisioner')
@section('content')
    <section>
        <div class="page-header min-vh-75">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                        <div class="card card-plain mt-8">
                            <div class="card-header pb-0 text-left bg-transparent">
                                <h3 class="font-weight-bolder text-primary text-gradient">Selamat Datang di Kuisioner</h3>
                                <p class="mb-0">Silahkan masukan data untuk ke langkah selanjutnya</p>
                                @if (Session::get('status') == 'error')
                                    <div class="alert alert-danger" role="alert">
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <form role="form" method="POST" action="{{ route('general.save-session') }}">
                                    @csrf
                                    <label>Responden Sebagai</label>
                                    <div class="mb-3 form-group">
                                        <select required name="role" id="role" class="form-control"
                                            placeholder="Choose Reponden As" aria-label="role" aria-describedby="role-addon">
                                            <option value="9">Calon Mahasiswa</option>
                                            <option value="7">Mahasiswa</option>
                                            <option value="8">Alumni</option>
                                        </select>
                                        @error('role')
                                            {{ $errors->first('role') }}
                                        @enderror
                                    </div>
                                    <label>Nama</label>
                                    <div class="mb-3 form-group">
                                        <input required name="name" id="name" type="text" class="form-control"
                                            placeholder="Nama Pengisi" aria-label="name" aria-describedby="name-addon">
                                        @error('name')
                                            {{ $errors->first('name') }}
                                        @enderror
                                    </div>
                                  
                                    <label for="school">Asal SMA/Sederajat</label>
                                    <div class="mb-3 form-group">
                                        <input required name="school" id="school" type="text" class="form-control"
                                            placeholder="Asal Sekolah" aria-label="school" aria-describedby="name-addon">
                                        @error('school')
                                            {{ $errors->first('school') }}
                                        @enderror
                                    </div>
                                    <label>Email</label>
                                    <div class="mb-3 form-group">
                                        <input required name="email" id="email" type="email" class="form-control"
                                            placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                        @error('email')
                                            {{ $errors->first('email') }}
                                        @enderror
                                    </div>


                                    {{-- <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div> --}}
                                    <div class="text-center">
                                        <input type="submit" class="btn bg-gradient-primary w-100 mt-4 mb-0"
                                            value="LANJUT">
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                style="background-image:url('	https://pasundan.jabarekspres.com/wp-content/uploads/2021/04/IMG-20210406-WA0058.jpg');background-size:cover;background-repeat: no-repeat">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
