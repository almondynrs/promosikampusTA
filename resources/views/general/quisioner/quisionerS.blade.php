@extends('general.layouts.frontlayout')
@section('script_head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('title', 'Quisioner')
@section('content')
    @php
        use App\Models\Subkriteria;
        
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
                                <h3 class="font-weight-bolder text-light ">Kriteria Promosi </h3>
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

                        <form action="{{ route('general.saveSessionQS') }}" method="POST" id="formq">
                            @csrf
                            @php
                                $num = 1;
                            @endphp
                            @foreach ($kriteria as $a1 => $p1)
                                <div class="card m-2">
                                    <div class="card-body">
                                        <div class="table-responsive p-0">
                                            <table class="table align-items-center mb-0">
                                                <thead class="text-center bg-white">

                                                    <div class="row form-group col-12 col-lg-10 mb-0">
                                                        <h6>Kriteria: {{ $p1->nama_kriteria }}</h6>
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
                                                        <th style="padding: 0.75rem 1.5rem 0.75rem 0rem">9</th>
                                                    </div>
                                                </thead>
                                                <tbody class="text-center">
                                                    @php
                                                        
                                                        $perbandingan = SubKriteria::with('kriteria')
                                                            ->where('kriteria_id', '=', $p1->id)
                                                            ->get();
                                                        $perdata = count($perbandingan);
                                                    @endphp
                                                    @foreach ($perbandingan as $a2 => $p2)
                                                        <tr>
                                                            <td>
                                                                <label for="p-1"
                                                                    class="form-label col-12 col-lg-2">{{ $p2->nama_sub }}</label>
                                                            </td>
                                                            <td>
                                                                <output id="s-1" class="col-1 col-lg-1">0</output>
                                                                <input type="hidden" name="perbandingan{{ $p2->id }}"
                                                                    id="perbandingan" value="{{ $p2->id }}">
                                                            </td>
                                                            <td colspan="10">

                                                                <input type="range" value="0"
                                                                    class="form-range w-100" min="0" max="9"
                                                                    id="p-{{ $a1 + 1 }}-{{ $a2 + 1 }}"
                                                                    data-p="{{ $a2 + 1 }}" data-k="2"
                                                                    oninput="updateSliderValue(this)"
                                                                    onchange="resetNextSliders(this)"
                                                                    name="input[{{ $p1->id }}][{{ $p2->id }}]"
                                                                    data-num="{{ $num }}"
                                                                    data-lvl="{{ $p2->id }}" multiple>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    <input type="hidden" name="levelselected_{{ $num }}"
                                                        id="levelselected_{{ $num }}" value="">

                                                </tbody>
                                            </table>
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

            var elementId = '#levelselected_' + parseInt($(dataa).attr('data-num'));
            var element = document.querySelector(elementId);
            element.value = parseInt($(dataa).attr('data-lvl'));
        }

        function resetNextSliders(dataa) {
            var p = parseInt($(dataa).attr('data-p'));
            var nextSlider = $(dataa).parent().parent().next().find('.form-range');
            var nextOutput = nextSlider.parent().prev().find('.col-lg-1');

            nextSlider.val(0);
            nextOutput.text(0);
            console.log(p);
            if (p > 1) {
                p = p - 1;
                var prevSlider = $(dataa).parent().parent().prev().find('.form-range');
                var prevOutput = prevSlider.parent().prev().find('.col-lg-1');

                prevSlider.val(0);
                prevOutput.text(0);
            }


            var elementId = '#levelselected_' + parseInt($(dataa).attr('data-num'));
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
            console.log(validInputs);
            // Lakukan pengiriman data ke server
        }

        function showAlert(event) {
            var shouldSubmit = true;
            var elementToFocus = null;

            for (var i = 1; i < {{ count($kriteria) }} + 1; i++) {
                for (var j = 1; j < {{ $perdata }} + 1; j++) {


                    const elementId = 'p-' + i + '-' + j;
                    const element = document.getElementById(elementId);

                    if (j === 1 && element.value == 0 && document.getElementById('p-' + i + '-2').value == 0) {
                        elementToFocus = element;
                        shouldSubmit = false;
                        break;
                    }

                }

                if (!shouldSubmit) {
                    break;
                }
            }

            if (!shouldSubmit && elementToFocus !== null) {
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

        // const radioButtons = document.querySelectorAll('input[name="p1"]');

        // radioButtons.forEach(function(radioButton) {
        //     radioButton.addEventListener('change', function() {
        //         const selectedValue = this.value;

        //         if (selectedValue === '1') {

        //             document.getElementById('p1_2_1').checked = true;
        //         }
        //     });
        // });

        // const radioButtons2 = document.querySelectorAll('input[name="p2"]');

        // radioButtons2.forEach(function(radioButton) {
        //     radioButton.addEventListener('change', function() {
        //         const selectedValue = this.value;

        //         if (selectedValue === '2') {

        //             document.getElementById('p1_1').checked = true;
        //         } else {

        //         }
        //     });
        // });
    </script>
@endsection
