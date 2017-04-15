@extends('layout.app')
@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/owl.carousel.css') }}">
@endsection
@section('content')
    <div class="owl-employee">
        <div>
            <img src="{{ asset('img/logo-demo.png') }}" alt="">
            <a href="http://www.nordeus.com" target="_blank"><p class="text-center">Nordeus</p></a>
            <p class="text-center employee-info">Information Technology - 4.3</p>
        </div>
        <div>
            <img src="{{ asset('img/logo-demo.png') }}" alt="">
        </div>
        <div>
            <img src="{{ asset('img/logo-demo.png') }}" alt="">
        </div>
        <div>
            <img src="{{ asset('img/logo-demo.png') }}" alt="">
        </div>
        <div>
            <img src="{{ asset('img/logo-demo.png') }}" alt="">
        </div>
        <div>
            <img src="{{ asset('img/logo-demo.png') }}" alt="">
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/owl.carousel.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(".owl-employee").owlCarousel({
                loop:true,
                margin:10,
                responsiveClass:true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 3,
                        nav: false
                    },
                    1000: {
                        items: 5,
                        nav: true,
                        loop: false
                    }
                }
            });
        });
    </script>
@endsection
