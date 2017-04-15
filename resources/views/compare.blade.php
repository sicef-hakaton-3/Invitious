@extends('layout.app')
@section('content')
<div class="container">
    <div class="city-info-page">

        <div class="col-xs-6 city-cover no-pad">

            <img src="{{ $cityOnePhoto->photos[0]->image->mobile}}">
            <div class="col-xs-12 city-basic-info">
                <div class="col-md-7">
                    <h1>{{ $cityOneName }}</h1>
                </div>
                <div class="col-md-5 text-center">
                    <div class="col-sm-6 col-xs-12 no-pad" data-toggle="tooltip" data-placement="top" title="Population" data-original-title="Population" data-container="body">
                        <i class="material-icons">group</i>
                        <br>
                        {{round($cityOne->categories[1]->data[0]->float_value, 2)}} mil
                    </div>
                    <div class="col-sm-6 col-xs-12 no-pad climate" data-toggle="tooltip" data-placement="top" title="" data-original-title="Climate">
                        <i class="material-icons">wb_sunny</i>
                        <br>
                        {{ $cityOne->categories[2]->data[count($cityOne->categories[2]->data) - 1]->string_value }}
                    </div>
                    <div class="col-sm-6 col-xs-12 no-pad" data-toggle="tooltip" data-placement="top" title="" data-original-title="Language">
                        <i class="material-icons">language</i>
                        <br>
                        {{ $cityOne->categories[10]->data[2]->string_value }}
                    </div>
                    <div class="col-sm-6 col-xs-12 no-pad" data-toggle="tooltip" data-placement="top" title="" data-original-title="Currency">
                        <img src="{{ asset('img/city-currency.png') }}">
                        <br>
                        {{ $cityOne->categories[5]->data[0]->string_value }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-6 city-cover no-pad">
            <img src="{{ $cityTwoPhoto->photos[0]->image->mobile}}">
            <div class="col-xs-12 city-basic-info">
                <div class="col-md-6">
                    <h1>{{ $cityTwoName }}</h1>
                </div>
                <div class="col-md-6 text-center">
                    <div class="col-sm-6 col-xs-12 no-pad" data-toggle="tooltip" data-placement="top" title="Population" data-original-title="Population" data-container="body">
                        <i class="material-icons">group</i>
                        <br>
                        {{round($cityTwo->categories[1]->data[0]->float_value, 2)}} mil.
                    </div>
                    <div class="col-sm-6 col-xs-12 no-pad climate" data-toggle="tooltip" data-placement="top" title="" data-original-title="Climate">
                        <i class="material-icons">wb_sunny</i>
                        <br>
                        {{ $cityTwo->categories[2]->data[count($cityTwo->categories[2]->data) - 1]->string_value }}
                    </div>
                    <div class="col-sm-6 col-xs-12 no-pad" data-toggle="tooltip" data-placement="top" title="" data-original-title="Language">
                        <i class="material-icons">language</i>
                        <br>
                        {{ $cityTwo->categories[10]->data[2]->string_value }}
                    </div>
                    <div class="col-sm-6 col-xs-12 no-pad" data-toggle="tooltip" data-placement="top" title="" data-original-title="Currency">
                        <img src="{{ asset('img/city-currency.png') }}">
                        <br>
                        {{ $cityTwo->categories[5]->data[0]->string_value }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 city-description">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="{{ route('get-city-info',['city' => app('request')->input('city_one')]) }}">Show</a></li>
                <li class="active">Compare</li>
            </ol>
        </div>
        <div class="col-xs-6 city-stats-section no-pad">
            <div class="city-stats-title">
                <h2 class="pull-left"><i class="material-icons">attach_money</i> Cost of living</h2>
                <div class="rate-stars pull-left">
                    @for($i=5; $i>=1; $i--)
                        <i class="material-icons">@if($i > $livingCostsScoreCityOne) star @else star_border @endif</i>
                    @endfor
                </div>
            </div>
            <div class="col-xs-12 city-stats-labels">
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[3]->data[1]->label }}</label> {{ $cityOne->categories[3]->data[1]->currency_dollar_value }}$
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[3]->data[2]->label }}</label> {{ $cityOne->categories[3]->data[2]->currency_dollar_value }}$
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[3]->data[3]->label }}</label> {{ $cityOne->categories[3]->data[3]->currency_dollar_value }}$
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[3]->data[4]->label }}</label> {{ $cityOne->categories[3]->data[4]->currency_dollar_value }}$
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[3]->data[7]->label }}</label> {{ $cityOne->categories[3]->data[7]->currency_dollar_value }}$
                </div>
            </div>
            <div class="col-xs-12 city-stats-labels">
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[3]->data[6]->label }}</label> {{ $cityOne->categories[3]->data[6]->currency_dollar_value }}$
                </div>
                <div class="col-xs-12">
                    <label>Monthly Fitness</label> {{ $cityOne->categories[3]->data[5]->currency_dollar_value }}$
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[3]->data[8]->label }}</label> {{ $cityOne->categories[3]->data[8]->currency_dollar_value }}$
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[3]->data[9]->label }}</label> {{ $cityOne->categories[3]->data[9]->currency_dollar_value }}$
                </div>
                <div class="col-xs-12">
                    <label>Meal at restaurant</label> {{ $cityOne->categories[3]->data[10]->currency_dollar_value }}$
                </div>
            </div>

        </div>

        <div class="col-xs-6 city-stats-section no-pad">
            <div class="city-stats-title">
                <h2 class="pull-left"><i class="material-icons">attach_money</i> Cost of living</h2>
                <div class="rate-stars pull-left">
                    @for($i=5; $i>=1; $i--)
                        <i class="material-icons">@if($i > $livingCostsScoreCityTwo) star @else star_border @endif</i>
                    @endfor
                </div>
            </div>
            <div class="col-xs-12 city-stats-labels">
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[3]->data[1]->label }}</label> {{ $cityTwo->categories[3]->data[1]->currency_dollar_value }}$
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[3]->data[2]->label }}</label> {{ $cityTwo->categories[3]->data[2]->currency_dollar_value }}$
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[3]->data[3]->label }}</label> {{ $cityTwo->categories[3]->data[3]->currency_dollar_value }}$
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[3]->data[4]->label }}</label> {{ $cityTwo->categories[3]->data[4]->currency_dollar_value }}$
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[3]->data[7]->label }}</label> {{ $cityTwo->categories[3]->data[7]->currency_dollar_value }}$

                </div>
            </div>
            <div class="col-xs-12 city-stats-labels">
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[3]->data[6]->label }}</label> {{ $cityTwo->categories[3]->data[6]->currency_dollar_value }}$
                </div>
                <div class="col-xs-12">
                    <label>Monthly Fitness</label> {{ $cityTwo->categories[3]->data[5]->currency_dollar_value }}$
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[3]->data[8]->label }}</label> {{ $cityTwo->categories[3]->data[8]->currency_dollar_value }}$
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[3]->data[9]->label }}</label> {{ $cityTwo->categories[3]->data[9]->currency_dollar_value }}$
                </div>
                <div class="col-xs-12">
                    <label>Meal at restaurant</label> {{ $cityTwo->categories[3]->data[10]->currency_dollar_value }}$
                </div>
            </div>
        </div>

        <div class="col-xs-6 city-stats-section no-pad">
            <div class="city-stats-title">
                <h2 class="pull-left"><i class="material-icons">pin_drop</i> Culture</h2>
                <div class="rate-stars pull-left">
                    @for($i=1; $i<=5; $i++)
                        <i class="material-icons">@if($i <= $cultureScoreCityOne) star @else star_border @endif</i>
                    @endfor
                </div>
            </div>
            <div class="col-xs-12 city-stats-labels">
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[4]->data[1]->label }}</label> {{ $cityOne->categories[4]->data[1]->int_value }}
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[4]->data[3]->label }}</label> {{ $cityOne->categories[4]->data[3]->int_value }}
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[4]->data[5]->label }}</label> {{ $cityOne->categories[4]->data[5]->int_value }}
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[4]->data[7]->label }}</label> {{ $cityOne->categories[4]->data[7]->int_value }}
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[4]->data[9]->label }}</label> {{ $cityOne->categories[4]->data[9]->int_value }}
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[4]->data[11]->label }}</label> {{ $cityOne->categories[4]->data[11]->int_value }}
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[4]->data[13]->label }}</label> {{ $cityOne->categories[4]->data[13]->int_value }}
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[4]->data[15]->label }}</label> {{ $cityOne->categories[4]->data[15]->int_value }}
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[4]->data[17]->label }}</label> {{ $cityOne->categories[4]->data[17]->int_value }}
                </div>
            </div>
        </div>

        <div class="col-xs-6 city-stats-section no-pad">
            <div class="city-stats-title">
                <h2 class="pull-left"><i class="material-icons">pin_drop</i> Culture</h2>
                <div class="rate-stars pull-left">
                    @for($i=1; $i<=5; $i++)
                        <i class="material-icons">@if($i <= $cultureScoreCityOne) star @else star_border @endif</i>
                    @endfor
                </div>
            </div>
            <div class="col-xs-12 city-stats-labels">
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[4]->data[1]->label }}</label> {{ $cityTwo->categories[4]->data[1]->int_value }}
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[4]->data[3]->label }}</label> {{ $cityTwo->categories[4]->data[3]->int_value }}
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[4]->data[5]->label }}</label> {{ $cityTwo->categories[4]->data[5]->int_value }}
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[4]->data[7]->label }}</label> {{ $cityTwo->categories[4]->data[7]->int_value }}
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[4]->data[9]->label }}</label> {{ $cityTwo->categories[4]->data[9]->int_value }}
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[4]->data[11]->label }}</label> {{ $cityTwo->categories[4]->data[11]->int_value }}
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[4]->data[13]->label }}</label> {{ $cityTwo->categories[4]->data[13]->int_value }}
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[4]->data[15]->label }}</label> {{ $cityTwo->categories[4]->data[15]->int_value }}
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[4]->data[17]->label }}</label> {{ $cityTwo->categories[4]->data[17]->int_value }}
                </div>
            </div>
        </div>

        <div class="col-xs-6 city-stats-section no-pad">
            <div class="city-stats-title">
                <h2 class="pull-left"><i class="material-icons">info</i> More Info</h2>
            </div>
            <div class="col-xs-12 city-stats-labels">
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[5]->data[1]->label }}</label> {{ $cityOne->categories[5]->data[1]->percent_value*100 }}
                </div>
                <div class="col-xs-12">
                    <label>Life expectancy</label> {{ round($cityOne->categories[7]->data[1]->float_value, 2) }}
                </div>
                <div class="col-xs-12">
                    <label>Healt Care Quality</label> {{ $cityOne->categories[7]->data[3]->float_value*100 }}/100
                </div>
            </div>
            <div class="col-xs-12 city-stats-labels">
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[8]->data[0]->label }}</label> {{ round($cityOne->categories[8]->data[0]->currency_dollar_value) }}$
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[8]->data[1]->label }}</label> {{ round($cityOne->categories[8]->data[1]->currency_dollar_value) }}$
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityOne->categories[8]->data[2]->label }}</label> {{ round($cityOne->categories[8]->data[2]->currency_dollar_value) }}$
                </div>
            </div>
        </div>

        <div class="col-xs-6 city-stats-section no-pad">
            <div class="city-stats-title">
                <h2 class="pull-left"><i class="material-icons">info</i> More Info</h2>
            </div>
            <div class="col-xs-12 city-stats-labels">
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[5]->data[1]->label }}</label> {{ $cityTwo->categories[5]->data[1]->percent_value*100 }}
                </div>
                <div class="col-xs-12">
                    <label>Life expectancy</label> {{ round($cityTwo->categories[7]->data[1]->float_value, 2) }}
                </div>
                <div class="col-xs-12">
                    <label>Healt Care Quality</label> {{ $cityTwo->categories[7]->data[3]->float_value*100 }}/100
                </div>
            </div>
            <div class="col-xs-12 city-stats-labels">
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[8]->data[0]->label }}</label> {{ round($cityTwo->categories[8]->data[0]->currency_dollar_value) }}$
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[8]->data[1]->label }}</label> {{ round($cityTwo->categories[8]->data[1]->currency_dollar_value) }}$
                </div>
                <div class="col-xs-12">
                    <label>{{ $cityTwo->categories[8]->data[2]->label }}</label> {{ round($cityTwo->categories[8]->data[2]->currency_dollar_value) }}$
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

