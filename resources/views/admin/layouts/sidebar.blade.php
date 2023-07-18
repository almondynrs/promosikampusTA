<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html "
            target="_blank">
            <img src="{{ asset('/admin/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Sistem Promosi Kampus</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main" style="height: 100% !important;">
        <ul class="navbar-nav">
            @if (Auth::user()->role < 5)
                <li class="nav-item  ">
                    <a class="nav-link  {{ $title == 'Dashboard' ? 'active' : '' }}" href="{{ route('home') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i width="15px" height="15px" class="fa fa-dashboard text-dark"> </i>

                        </div>
                        <span class="nav-link-text ms-1">Beranda</span>
                    </a>
                </li>
                {{-- <li class="nav-item ">
                    <a class="nav-link {{ $title == 'Report' ? 'active' : '' }}" href="{{ route('home') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i width="15px" height="15px" class="fa fa-list-alt text-dark"> </i>
                        </div>
                        <span class="nav-link-text ms-1">Report</span>
                    </a>
                </li> --}}
            @endif


            @if (Auth::user()->role < 3)
                <li class="nav-item">
                    <a class="nav-link
                {{ Request::segment(3) == 'user' || Request::segment(3) == 'kuisioner' ? 'active show' : '' }}
                "
                        id="dropdownData" data-bs-toggle="dropdown" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i width="15px" height="15px" class="fa fa-database text-dark"> </i>
                        </div>
                        <span class="nav-link-text ms-1 font-weight-bold">Data</span>
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end bg-gray-100 p-0 me-sm-n4 m-0 {{ Request::segment(3) == 'user' || Request::segment(3) == 'kuisioner' ? 'show' : '' }}"
                        aria-labelledby="dropdownData" style="margin: 0 1rem !important;">
                        <li class="mb-0">
                            <a class="dropdown-item border-radius-md" href="{{ route('kriteria.index') }}">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <i class="fa fa-table me-sm-1"></i>

                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">Kriteria</span>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mb-0">
                            <a class="dropdown-item border-radius-md" href="{{ route('subKriteria.index') }}">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <i class="fa fa-table me-sm-1"></i>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">SubKriteria</span>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mb-0">
                            <a class="dropdown-item border-radius-md" href="{{ route('alternatif.index') }}">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <i class="fa fa-table me-sm-1"></i>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">Alternatif</span>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mb-0">
                            <a class="dropdown-item border-radius-md" href="{{ url('dashboard/admin/kuisioner') }}">
                                <div class="d-flex py-1">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <i class="fa fa-table me-sm-1"></i>

                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">Kuisioner</span>
                                            </h6>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        {{-- <li class="mb-0">
                            <a class="dropdown-item border-radius-md" href="{{ url('dashboard/admin/jenis-kuis') }}">
                                <div class="d-flex py-1">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <i class="fa fa-table me-sm-1"></i>

                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">Jenis Kuisioner</span>
                                            </h6>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li class="mb-0">
                            <a class="dropdown-item border-radius-md"
                                href="{{ url('dashboard/admin/list-pertanyaan') }}">
                                <div class="d-flex py-1">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <i class="fa fa-table me-sm-1"></i>

                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">List Pertanyaan</span>
                                            </h6>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li> --}}

                        <li class="mb-0">
                            <a class="dropdown-item border-radius-md" href="{{ route('responden.index') }}">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <i class="fa fa-table me-sm-1"></i>

                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">Responden</span>
                                        </h6>

                                    </div>
                                </div>
                            </a>
                        </li>
                        @if (Auth::user()->role < 2)
                            <li class="mb-0">
                                <a class="dropdown-item border-radius-md" href="{{ route('sekolah.index') }}">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <i class="fa fa-table me-sm-1"></i>

                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">Data Sekolah</span>
                                            </h6>

                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="mb-0">
                                <a class="dropdown-item border-radius-md" href="{{ route('user.user') }}">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <i class="fa fa-table me-sm-1"></i>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">Pengguna</span>
                                            </h6>

                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>


            @endif
            @if (Auth::user()->role == 1 || Auth::user()->role == 6)
                <li class="nav-item ">
                    <a class="nav-link {{ $title == 'Data Penjadwalan Kunjungan' ? 'active' : '' }} "
                        href="{{ url('dashboard/admin/schedule') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i width="15px" height="15px" class="fa fa-calendar text-dark"> </i>
                        </div>
                        <span class="nav-link-text ms-1">Penjadwalan</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role < 6)
                <li class="nav-item">
                    <a class="nav-link
        {{ Request::segment(3) == 'report' ? 'active show' : '' }}
        "
                        id="dropdownReport" data-bs-toggle="dropdown" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i width="15px" height="15px" class="fa fa-list-alt text-dark"> </i>
                        </div>
                        <span class="nav-link-text ms-1 font-weight-bold">Laporan</span>
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end bg-gray-100 p-0 me-sm-n4 m-0 {{ Request::segment(3) == 'report' ? 'show' : '' }}"
                        aria-labelledby="dropdownReport" style="margin: 0 1rem !important;">
                        <li class="mb-0">
                            <a class="dropdown-item border-radius-md" href="{{ route('report.schedule') }}">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <i class="fa fa-list-alt me-sm-1"></i>

                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">Penugasan</span>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mb-0">
                            <a class="dropdown-item border-radius-md" href="{{ route('report.ahp') }}">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <i class="fa fa-list-alt me-sm-1"></i>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">Hasil Media Promosi</span>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
    <div class="sidenav-footer mx-3 ">

    </div>
</aside>
