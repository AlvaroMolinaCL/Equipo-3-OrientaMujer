@extends('tenants.default.layouts.app')

@section('navbar')
    @section('navbar-class', 'navbar-dark-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-dark')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <h1 class="mb-4" style="font-family: 'Courier Prime', Courier">Tips</h1>
            <!--
                <p class="mb-5">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vel dapibus nunc. Morbi vestibulum massa et turpis congue tincidunt.
                </p>

                {{-- Acordeones --}}
                <div class="accordion" id="tipsAccordion">
                    {{-- @for ($i = 1; $i <= 10; $i++)
                        <div class="accordion-item bg-transparent border-0">
                            <h2 class="accordion-header" id="heading{{ $i }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}" aria-expanded="false" aria-controls="collapse{{ $i }}">
                                    Tip {{ $i }}: Título del tip
                                </button>
                            </h2>
                            <div id="collapse{{ $i }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $i }}" data-bs-parent="#tipsAccordion">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor.
                                </div>
                            </div>
                        </div>
                    @endfor --}}
                </div>
            -->
            <p class="mb-5">
                En construcción.
            </p>
        </div>
    </section>

    @include('tenants.default.layouts.footer')
@endsection
