<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Hakaton 2016</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->
    <link rel="stylesheet" href="{{asset('css/base.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor.css')}}">

    <!-- script
    ================================================== -->
    <script src="{{ asset('js/modernizr.js') }}"></script>

    <!-- favicons
     ================================================== -->
    <link rel="icon" type="image/png" href="favicon.png">

</head>

<body>

<!-- main content
================================================== -->
<main id="main-404-content" class="main-content-static">

    <div class="content-wrap">

        {{--<div class="shadow-overlay"></div>--}}

        <div class="main-content">
            <div class="row">

                <img src="{{ asset('img/iMove_error_logo.svg') }}" style="margin: 0 0 15px 7px">

                <div class="col-twelve">

                    <h1 class="kern-this">404 Error.</h1>
                    <p>
                        Oooooops! Looks like nothing was found at this location. Please return to the homepage.
                    </p>


                </div> <!-- /twelve -->
            </div> <!-- /row -->
        </div> <!-- /main-content -->

        <footer>
            <div class="row">

                <div class="col-five tab-full bottom-links">
                    <ul class="links">
                        <li><a href="/">Homepage</a></li>
                    </ul>

                    <div class="credits">
                        <p>Design by <a href="http://www.styleshout.com/" title="styleshout">styleshout</a></p>
                    </div>
                </div>

            </div> <!-- /row -->
        </footer>

    </div> <!-- /content-wrap -->

</main> <!-- /main-404-content -->

<div id="preloader">
    <div id="loader"></div>
</div>

<!-- Java Script
================================================== -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.x-git.js"></script>
<script src="{{ asset('js/plugins.js') }}"></script>
<script src='{{ asset("js/main.js") }}'></script>

</body>

</html>