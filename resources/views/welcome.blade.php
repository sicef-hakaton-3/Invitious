@extends('layout.app')

@section('content')
<div class="landing-page">
    <div class="landing-logo text-center">
        <img src="{{ asset('img/iMove_logo.svg') }}">
    </div>

    <div class="search-bar">
        <form method="get" action="{{ route('get-city-info') }}">
        <div class="input-group">
            <input type="search" id="land-search" class="form-control" required placeholder="Enter city name ..." aria-describedby="basic-addon1" name="city" autocomplete="off">
            <span class="input-group-btn no-pad">
                <button id="search-button" class="btn btn-default" disabled type="submit">SEARCH</button>
            </span>
        </div>
        </form>
    </div>

    <div class="col-xs-6 col-xs-offset-3 recommended-cities text-center">
        <p>Most popular cities:</p>
        @foreach($topCities as $topCity)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <a class="recommended-city" href="{{ route('get-city-info', ['city' => $topCity->city ]) }}">
                    <p>{{ $topCity->city }}</p>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
