@extends('general.layouts.frontlayout')

@section('title', 'Quisioner')
@section('content')
    <section>
        <div class="page-header min-vh-75">
            <div class="container">
                <div class="row" style="min-height: 35rem ; ">
                    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                        <div class="card card-plain mt-8">

                            <div class="card-header pb-0 text-left bg-transparent">
                                <h3 class="font-weight-bolder text-primary text-gradient">Selamat Datang Kembali</h3>
                                <p class="mb-0">Silahkan masuk untuk mengakses sistem ini</p>

                                @if (Session::get('status') == 'error')
                                    <div class="alert alert-danger" role="alert">
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                            </div>
                            <div class="card-body login-card-body">

                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input id="email" type="email" placeholder="Email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required="required" autocomplete="email"
                                            autofocus="autofocus">
                                        {{-- <input type="email" class="form-control" placeholder="Email" autocomplete="off"> --}}
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope fa-2x"></span>
                                            </div>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        {{-- <input type="password" class="form-control" placeholder="Password"> --}}
                                        <input id="password" type="password" placeholder="Kata Sandi"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required="required" autocomplete="current-password">
                                        <div class="input-group-append ">
                                            <a class="input-group-text btn btn-block text-dark bg-white m-0"
                                                onclick="togglePasswordVisibility()">
                                                <span class="fas fa-eye fa-2x" id="eyesee" style="display:block"></span>
                                                <span class="fas fa-eye-slash fa-2x" id="eyesslash"
                                                    style="display:none"></span>
                                            </a>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="icheck-primary">
                                                <input type="checkbox" id="remember">
                                                <label for="remember">
                                                    Ingat sesi saya
                                                </label>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-4">
                                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>

                                {{-- <div class="social-auth-links text-center mb-3">
                                <p>- OR -</p>
                                <a href="#" class="btn btn-block btn-primary">
                                    <i class="fab fa-facebook mr-2"></i>
                                    Sign in using Facebook
                                </a>
                                <a href="#" class="btn btn-block btn-danger">
                                    <i class="fab fa-google-plus mr-2"></i>
                                    Sign in using Google+
                                </a>
                            </div> --}}
                                <!-- /.social-auth-links -->

                                {{-- <p class="mb-1">
                                    <a href="{{ route('password.request') }}">Lupa password?</a>
                                </p>
                                <p class="mb-0">
                                    Belum mempunyai akun?
                                    <a href="{{ route('register') }}" class="text-center">Register</a>
                                </p> --}}
                            </div>
                            <!-- /.login-card-body -->
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

@section('script_footer')
    <script>
        var passwordInput = document.getElementById('password');

        function togglePasswordVisibility() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                document.getElementById('eyesee').style.display = 'none';
                document.getElementById('eyesslash').style.display = 'block';

            } else {
                passwordInput.type = 'password';
                document.getElementById('eyesee').style.display = 'block';
                document.getElementById('eyesslash').style.display = 'none';

            }
        }
    </script>
@endsection
