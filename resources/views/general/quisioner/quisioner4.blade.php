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

                                @if (Session::get('status') == 'error')
                                    <div class="alert alert-danger" role="alert">
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <h3 class="font-weight-bolder text-primary text-gradient">Well done!</h3>
                                <p class="mb-0">Thank you for taking the time to fill out the questionnaire</p>
                                <div class="text-center">
                                    <a type="submit" class="btn bg-gradient-primary w-100 mt-4 mb-0"
                                        href="{{ url('/quisioner') }}">Back</a>
                                </div>
                                {{-- </form> --}}
                            </div>
                            {{-- <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-4 text-sm mx-auto">
                                    Don't have an account?
                                    <a href="javascript:;" class="text-primary text-gradient font-weight-bold">Sign
                                        up</a>
                                </p>
                            </div> --}}
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
