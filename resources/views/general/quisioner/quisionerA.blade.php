@extends('general.layouts.frontlayout')
@section('script_head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('title', 'Quisioner')
@section('content')
    @php
        use App\Models\Subkriteria;
        use App\Models\Alternatif;
        
    @endphp
    <section>

        <div class="page-header min-vh-60">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 d-flex flex-column mx-auto">
                        <div class="card  mt-1">
                            <div class="card-header pb-0 text-left bg-primary">
                                @if (Session::get('status') == 'error')
                                    <div class="alert alert-danger" role="alert">
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                                <h3 class="font-weight-bolder text-light ">Alternatif Promosi </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container position-sticky z-index-sticky top-0 ">
            <div class="row">
                <div class="col-12">
                    <!-- Navbar -->
                    <nav
                        class="navbar navbar-expand-lg blur blur-rounded navbar-primary bg-primary  top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                        <div class="container-fluid pe-0 min-vh-15">
                            @foreach ($quisioner->listPertanyaan as $item)
                                <h6>{{ $item->judul_pertanyaan }}</h6>
                            @endforeach
                        </div>
                    </nav>

                    <!-- End Navbar -->
                </div>
            </div>
        </div>

        <div class="min-vh-25"></div>
        <div class="page-header min-vh-75">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 d-flex flex-column mx-auto">

                        <form action="{{ route('general.saveSessionQA') }}" method="POST" id="formq">
                            @csrf
                            @php
                                $num = 1;
                            @endphp
                            @foreach ($kriteria as $a1 => $p1)
                                <div class="card m-2">
                                    <div class="card-header bg-gradient-faded-light">
                                        <div class="row form-group col-12 col-lg-10 mb-0">
                                            <h6>{{ $num }}. Kriteria: {{ $p1->nama_kriteria }}</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive p-0">
                                            @foreach ($sub as $a2 => $p2)
                                                <table class="table align-items-center mb-0">
                                                    <thead class="text-center bg-white">

                                                        <div
                                                            class="row form-group col-12 col-lg-12 mb-0 bg-gradient-faded-light">
                                                            <h6>{{ $a2 + 1 }}. Subkriteria: {{ $p2->nama_sub }}</h6>

                                                        </div>
                                                        <div class="row form-group col-12 col-lg-10 mb-0">

                                                            <th>Perbandingan</th>
                                                            <th>Nilai</th>
                                                            <th style="padding: 0.75rem 1.5rem 0.75rem 0rem">0</th>
                                                            <th style="padding: 0.75rem 1.5rem 0.75rem 0rem">1</th>
                                                            <th style="padding: 0.75rem 1.5rem 0.75rem 0rem">2</th>
                                                            <th style="padding: 0.75rem 1.5rem 0.75rem 0rem">3</th>
                                                            <th style="padding: 0.75rem 1.5rem 0.75rem 0rem">4</th>
                                                            <th style="padding: 0.75rem 1.5rem 0.75rem 0rem">5</th>
                                                            <th style="padding: 0.75rem 1.5rem 0.75rem 0rem">6</th>
                                                            <th style="padding: 0.75rem 1.5rem 0.75rem 0rem">7</th>
                                                            <th style="padding: 0.75rem 1.5rem 0.75rem 0rem">8</th>
                                                            <th style="padding: 0.75rem 0rem 0.75rem 1.5rem">9</th>
                                                        </div>
                                                    </thead>
                                                    <tbody class="text-center">
                                                        @php
                                                            
                                                            $perbandingan = Alternatif::with(['subkriteria'])
                                                                ->where('sub_kriteria_id', '=', $p2->id)
                                                                ->orderBy('id', 'ASC')
                                                                ->get();
                                                            // dd($perbandingan);
                                                            $perdata = count($perbandingan);
                                                        @endphp
                                                        @php
                                                            $x = 1;
                                                        @endphp
                                                        @foreach ($perbandingan as $a3 => $p3)
                                                            @foreach ($perbandingan as $a4 => $p4)
                                                                @if ($a4 > $a3)
                                                                    <tr>
                                                                        <td>
                                                                            <p class=" col-12 col-lg-2">
                                                                                {{ $p3->nama_alternatif }}</p>
                                                                        </td>
                                                                        <td>
                                                                            <output id="s-1"
                                                                                class="col-1 col-lg-1">0</output>
                                                                        </td>
                                                                        <td colspan="10">

                                                                            <input type="range" value="0"
                                                                                class="form-range w-100" min="0"
                                                                                max="9" {{-- id="p-{{ $a1 + 1 }}-{{ $p3->id }}-{{ $p4->id }}" --}}
                                                                                id="p-{{ $a1 + 1 }}-{{ $a3 + 1 }}-{{ $a4 + 1 }}"
                                                                                data-p="1" data-k="2"
                                                                                oninput="updateSliderValue(this)"
                                                                                onchange="resetNextSliders(this)"
                                                                                name="atas-[{{ $p1->id }}]-[{{ $p2->id }}]-[{{ $p3->id }}][{{ $p4->id }}]"
                                                                                data-num="{{ $a1 + 1 }}_{{ $a2 + 1 }}_{{ $x }}"
                                                                                data-lvl="{{ $p3->id }}" multiple>
                                                                            {{-- <input type="hidden" name="id_kriteria1[]" value="{{ $p3->id }}"/> --}}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <p class=" col-12 col-lg-2">
                                                                                {{ $p4->nama_alternatif }}</p>
                                                                        </td>
                                                                        <td>
                                                                            <output id="s-2"
                                                                                class="col-1 col-lg-1">0</output>
                                                                        </td>
                                                                        <td colspan="10">

                                                                            <input type="range" value="0"
                                                                                class="form-range w-100" min="0"
                                                                                max="9" {{-- id="p-{{ $a1 + 1 }}-{{ $p4->id }}-{{ $p3->id }}" --}}
                                                                                id="p-{{ $a1 + 1 }}-{{ $a4 + 1 }}-{{ $a3 + 1 }}"
                                                                                data-p="2" data-k="1"
                                                                                oninput="updateSliderValue(this)"
                                                                                onchange="resetNextSliders(this)"
                                                                                name="bawah-[{{ $p2->id }}]-[{{ $p3->id }}][{{ $p4->id }}]"
                                                                                data-num="{{ $a1 + 1 }}_{{ $a2 + 1 }}_{{ $x }}"
                                                                                data-lvl="{{ $p4->id }}" multiple>
                                                                            {{-- <input type="hidden" name="id_kriteria2[]" value="{{ $p4->id }}"/> --}}

                                                                        </td>
                                                                    </tr>
                                                                    <input type="hidden"
                                                                        name="levelselected_{{ $a1 + 1 }}_{{ $a2 + 1 }}_{{ $x }}"
                                                                        id="levelselected_{{ $a1 + 1 }}_{{ $a2 + 1 }}_{{ $x }}"
                                                                        value="{{ $p4->id }}">
                                                                    @if ($a4 !== $perdata - 1 || $a4 !== $a3 + 1)
                                                                        <tr>
                                                                            <td>Perbandingan</td>
                                                                            <td class="">Nilai</td>
                                                                            <td colspan="10" class="">
                                                                                <div class="row justify-content-around">
                                                                                    <p class="col-1 m-0"
                                                                                        style="padding: 0.75rem 1.5rem 0.75rem 0.2rem">
                                                                                        0
                                                                                    </p>
                                                                                    <p class="col-1 m-0"
                                                                                        style="padding: 0.75rem 1.5rem 0.75rem 0.2rem">
                                                                                        1
                                                                                    </p>
                                                                                    <p class="col-1 m-0"
                                                                                        style="padding: 0.75rem 1.5rem 0.75rem 0.2rem">
                                                                                        2
                                                                                    </p>
                                                                                    <p class="col-1 m-0"
                                                                                        style="padding: 0.75rem 1.5rem 0.75rem 0.2rem">
                                                                                        3
                                                                                    </p>
                                                                                    <p class="col-1 m-0"
                                                                                        style="padding: 0.75rem 1.5rem 0.75rem 0.2rem">
                                                                                        4
                                                                                    </p>
                                                                                    <p class="col-1 m-0"
                                                                                        style="padding: 0.75rem 1.5rem 0.75rem 0.2rem">
                                                                                        5
                                                                                    </p>
                                                                                    <p class="col-1 m-0"
                                                                                        style="padding: 0.75rem 1.5rem 0.75rem 0.2rem">
                                                                                        6
                                                                                    </p>
                                                                                    <p class="col-1 m-0"
                                                                                        style="padding: 0.75rem 1.5rem 0.75rem 0.2rem">
                                                                                        7
                                                                                    </p>
                                                                                    <p class="col-1 m-0"
                                                                                        style="padding: 0.75rem 1.5rem 0.75rem 0.2rem">
                                                                                        8
                                                                                    </p>
                                                                                    <p class="col-1 m-0"
                                                                                        style="padding: 0.75rem 0rem 0.75rem 1.5rem">
                                                                                        9
                                                                                    </p>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endif

                                                                    @php
                                                                        $x++;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                @php
                                    $num++;
                                @endphp
                            @endforeach

                            <input type="hidden" name="id_list" id="id_list"
                                value="{{ $quisioner->listpertanyaan[0]->id }}">
                            <input type="hidden" name="jenis" id="jenis" value="{{ $quisioner->id }}">

                            <div class="col-xl-12 col-lg-12 col-md-12 d-flex justify-content-end ">
                                <div class="col-lg-1 col-3">
                                    <button type="button" onclick="showAlert(event)"
                                        class="btn bg-gradient-primary w-100 mt-4 mb-0"> NEXT </button>

                                </div>
                            </div>
                        </form>




                    </div>

                </div>
            </div>
        </div>
    </section>


    @endsection @section('script_footer')

    <script type="text/javascript">
        // $(document).ready(function() {



        // });

        function updateSliderValue(dataa) {
            var value = $(dataa).val();
            var output = $(dataa).parent().prev().find('.col-lg-1');
            output.text(value);
            console.log(value);
            var elementId = '#levelselected_' + $(dataa).attr('data-num');


            var element = document.querySelector(elementId);
            element.value = parseInt($(dataa).attr('data-lvl'));
        }

        function resetNextSliders(dataa) {
            var p = parseInt($(dataa).attr('data-p'));
            var nextSlider = $(dataa).parent().parent().next().find('.form-range');
            var nextOutput = nextSlider.parent().prev().find('.col-lg-1');

            nextSlider.val(0);
            nextOutput.text(0);
            // console.log(p);
            if (p > 1) {
                p = p - 1;
                var prevSlider = $(dataa).parent().parent().prev().find('.form-range');
                var prevOutput = prevSlider.parent().prev().find('.col-lg-1');

                prevSlider.val(0);
                prevOutput.text(0);
            }


            var elementId = '#levelselected_' + $(dataa).attr('data-num');
            var element = document.querySelector(elementId);
            element.value = parseInt($(dataa).attr('data-lvl'));


            if ($(dataa).val() == 0) {
                nextSlider.attr('disabled', 'disabled');
                nextOutput.text("");
            } else {
                nextSlider.removeAttr('disabled');
            }

        }



        function submitForm() {
            var inputs = document.querySelectorAll('.form-range');
            var validInputs = [];
            inputs.forEach(function(input) {
                var value = parseInt(input.value);
                if (value > 0) {
                    validInputs.push(value.toString());
                }
            });
            // console.log(validInputs);
            // Lakukan pengiriman data ke server
        }

        function showAlert(event) {
            var shouldSubmit = true;
            var elementToFocus = null;
            outerLoop: for (var p = 1; p < {{ count($kriteria) }} + 1; p++) {
                for (var q = 1; q < {{ count($sub) }} + 1; q++) {
                    for (var i = 1; i < {{ $perdata }} + 1; i++) {
                        for (var j = 1; j < {{ $perdata }} + 1; j++) {
                            if (j > i) {
                                const elementId = 'p-' + p + '-' + i + '-' + j;
                                const elementId2 = 'p-' + p + '-' + j + '-' + i;
                                const element = document.getElementById(elementId);
                                const element2 = document.getElementById(elementId2);
                                console.log(elementId)
                                console.log(element.value)
                                console.log(elementId2)
                                console.log(element2.value)
                                if (element.value == 0 && element2.value ==
                                    0) {
                                    elementToFocus = element;
                                    shouldSubmit = false;
                                    break outerLoop;
                                }
                            }
                        }
                    }
                    if (!shouldSubmit) {
                        break;
                    }
                }
            }
            console.log(shouldSubmit)
            if (!shouldSubmit) {
                elementToFocus.focus();

                Swal.fire({
                    title: 'Oops!',
                    text: "Pengisian tidak boleh 0 dengan 0!",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                });
            }

            if (shouldSubmit) {
                document.getElementById('formq').submit();
            }
        }
    </script>
@endsection
