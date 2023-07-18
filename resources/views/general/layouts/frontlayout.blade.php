<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('admin/img/favicon.png') }}">
    <title>Sistem Promosi Kampus | @yield('title')</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('admin/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    {{-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" href="{{ asset('vendor/adminlte3/plugins/fontawesome-free/css/all.min.css') }}">

    <link href="{{ asset('admin/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('admin/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    @yield('script_head')

    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

    <style>
        .min-vh-15 {
            min-height: 15vh !important;
        }

        .ringing-bell {
            position: absolute;
            /* left: 50%;
            top: 50%; */
            transition: translate(-50%, -50%);
        }


        .faa-ring {
            color: red;
        }


        @-webkit-keyframes ring {
            0% {
                -webkit-transform: rotate(-15deg);
                transform: rotate(-15deg);
            }

            2% {
                -webkit-transform: rotate(15deg);
                transform: rotate(15deg);
            }

            4% {
                -webkit-transform: rotate(-18deg);
                transform: rotate(-18deg);
            }

            6% {
                -webkit-transform: rotate(18deg);
                transform: rotate(18deg);
            }

            8% {
                -webkit-transform: rotate(-22deg);
                transform: rotate(-22deg);
            }

            10% {
                -webkit-transform: rotate(22deg);
                transform: rotate(22deg);
            }

            12% {
                -webkit-transform: rotate(-18deg);
                transform: rotate(-18deg);
            }

            14% {
                -webkit-transform: rotate(18deg);
                transform: rotate(18deg);
            }

            16% {
                -webkit-transform: rotate(-12deg);
                transform: rotate(-12deg);
            }

            18% {
                -webkit-transform: rotate(12deg);
                transform: rotate(12deg);
            }

            20% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
        }

        @keyframes ring {
            0% {
                -webkit-transform: rotate(-15deg);
                -ms-transform: rotate(-15deg);
                transform: rotate(-15deg);
            }

            2% {
                -webkit-transform: rotate(15deg);
                -ms-transform: rotate(15deg);
                transform: rotate(15deg);
            }

            4% {
                -webkit-transform: rotate(-18deg);
                -ms-transform: rotate(-18deg);
                transform: rotate(-18deg);
            }

            6% {
                -webkit-transform: rotate(18deg);
                -ms-transform: rotate(18deg);
                transform: rotate(18deg);
            }

            8% {
                -webkit-transform: rotate(-22deg);
                -ms-transform: rotate(-22deg);
                transform: rotate(-22deg);
            }

            10% {
                -webkit-transform: rotate(22deg);
                -ms-transform: rotate(22deg);
                transform: rotate(22deg);
            }

            12% {
                -webkit-transform: rotate(-18deg);
                -ms-transform: rotate(-18deg);
                transform: rotate(-18deg);
            }

            14% {
                -webkit-transform: rotate(18deg);
                -ms-transform: rotate(18deg);
                transform: rotate(18deg);
            }

            16% {
                -webkit-transform: rotate(-12deg);
                -ms-transform: rotate(-12deg);
                transform: rotate(-12deg);
            }

            18% {
                -webkit-transform: rotate(12deg);
                -ms-transform: rotate(12deg);
                transform: rotate(12deg);
            }

            20% {
                -webkit-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                transform: rotate(0deg);
            }
        }

        .faa-ring.animated,
        .faa-ring.animated-hover:hover,
        .faa-parent.animated-hover:hover>.faa-ring {
            -webkit-animation: ring 3s ease infinite;
            animation: ring 3s ease infinite;
            transform-origin-x: 50%;
            transform-origin-y: 0px;
            transform-origin-z: initial;
        }

        .bg-gradient-primary {
            background-image: linear-gradient(310deg, #60B7B7 0%, #60B7B7 100%) !important;
            background-image: #60B7B7 !important;
        }

        .text-gradient.text-primary {
            background-image: linear-gradient(310deg, #60B7B7 0%, #60B7B7 100%) !important;

        }

        .btn-primary {
            background-image: linear-gradient(310deg, #60B7B7 0%, #60B7B7 100%) !important;

        }

        tr td:last-child {
            width: 100%;
            white-space: nowrap;
        }
    </style>
    <script>
        if (window.history.replaceState) {
            window.addEventListener("pageshow", function(event) {
                if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
                    window.location.reload();
                }
            });
        }
    </script>
</head>

<body class="g-sidenav-show  bg-gray-100">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                @if (empty(Request::segment(2)) || Request::segment(2) == 4)
                    <nav
                        class="navbar navbar-expand-lg blur blur-rounded navbar-light bg-gradient-primary top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                        <div class="container-fluid pe-0">
                            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="../pages/dashboard.html">
                                Sistem Informasi <br> Promosi Kampus
                            </a>
                            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon mt-2">
                                    <span class="navbar-toggler-bar bar1"></span>
                                    <span class="navbar-toggler-bar bar2"></span>
                                    <span class="navbar-toggler-bar bar3"></span>
                                </span>
                            </button>
                            <div class="collapse navbar-collapse" id="navigation">
                                <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">

                                </ul>
                                @if (Request::segment(1) == 'quisioner')
                                    <li class="nav-item d-flex align-items-center">
                                        <a class="nav-link me-2 bg-gradient-light text-dark btn btn-md btn-round mb-0"
                                            href="{{ url('/') }}">
                                            <i class="fas fa-key opacity-6  me-1"></i>
                                            Masuk
                                        </a>
                                    </li>
                                @else
                                    <li class="nav-item d-flex align-items-center">
                                        <a class="nav-link me-2 bg-gradient-light text-dark  btn btn-md btn-round mb-0"
                                            href="{{ url('/quisioner') }}">
                                            <i class="fas fa-edit opacity-6  me-1"></i>

                                            Kuisioner
                                        </a>
                                    </li>
                                @endif
                            </div>
                        </div>
                    </nav>
                @endif

                <!-- End Navbar -->
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        @yield('content')
    </main>

    <!-- Modal -->
    <div class="modal fade" id="tatacara" tabindex="-1" role="dialog" aria-labelledby="tatacaraLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tatacaraLabel">Tata Cara Mengisi Kuisioner Metode AHP</h5>
                    <button type="button" class="text-white btn  btn-xs btn-danger" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> jika anda pernah mengisi kuesioner, silahkan masukan email yang sama dengan email yang
                        sebelumnya </p>
                    <ol>
                        <li> responden membaca pertanyaan pada kuisioner dengan cermat</li>
                        <li> responden diminta untuk memberikan penilaian relatif terhadap kriteria sub kriteria dan
                            alternatif. Dengan skala pengukuran skala 1-9 untuk menggambarkan tingkat kepentingan faktor
                            tersebut keterangan skala:
                            <p> 1 = kedua elemen sangat penting<br />
                                3 = elemen yang satu sedikit lebih penting<br />
                                5 = elemen satu lebih penting dari yang lain<br />
                                7 = elemen yang satu sangat lebih penting dari yang lain<br />
                                9 = elemen yang satu mutlak lebih penting dari yang lain<br />
                                2,4,6,8 = nilai tengah antara dua pertimbangan yang berdekatan<br />
                            </p>
                        </li>
                        <li> selama mengisi kuisioner, responden diminta untuk memberikan penilaian yang konsisten dan
                            memperhatikan hubungan relatif antara faktor (kriteria, subkriteria dan alternatif) yang ada
                        </li>
                        <li> berikan jawaban secara jujur dan objektif</li>
                        <li> menyerahkan kuisioner</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @if (Request::segment(1) == 'quisioner')
        <div class="fixed-plugin">
            <a type="button"class="fixed-plugin-button text-light position-fixed px-2 py-1 bg-primary ringing-bell faa-ring animated "
                data-bs-toggle="modal" data-bs-target="#tatacara">
                <i class="fa fa-question-circle fa-2x py-1"> </i>
            </a>


        </div>
    @endif
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-4 mx-auto text-center">
                    {{-- <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Company
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        About Us
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Team
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Products
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Blog
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Pricing
                    </a> --}}
                </div>
                <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
                    {{-- <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-dribbble"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-twitter"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-instagram"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-pinterest"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-github"></span>
                    </a> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">
                        Copyright ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> Politeknik Negeri Subang
                    </p>
                </div>
            </div>
        </div>
    </footer>


    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <!--   Core JS Files   -->
    <script src="{{ asset('admin/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('admin/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     --}}
    <script src="{{ asset('vendor/adminlte3/plugins/jquery/jquery.min.js') }}"></script>


    @yield('script_footer')



</body>

</html>
