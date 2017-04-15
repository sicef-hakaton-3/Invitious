@extends('layout.app')
@section('stylesheets')
    <style>
        .twitter-wrapper {
            width: 40%;
            min-width: 400px;
            max-height: 500px;
            overflow: hidden;
        }
        .tweet-wrapper {
            width: 100%;
            padding: 20px;
            border: 1px solid black;
            border-top: 0px;
        }
        .tweet-wrapper:nth-of-type(1) {
            border-top: 1px solid black;
            position: relative;
        }
        .tweet {
            width: calc(100% - 45px);
            display: inline-block;
            clear: left;
        }
        .tweet-image {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: inline-block;
            position: relative;
            margin-left: 4px;
            transform: translateY(-100%);
            top: 35px;
        }
        .hash-tag {
            color: blue;
        }
    </style>
@endsection
@section('content')
    <div class="twitter-wrapper"></div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var city = <?php echo json_encode($_GET['city']); ?> ;
        $(document).ready(function() {
            function replaceAll(str, find, replace) {
                return str.replace(new RegExp(find, 'g'), replace);
            }
            function formatDate(date) {
                var hours = date.getHours();
                var minutes = date.getMinutes();
                hours = hours < 10 ? '0'+hours : hours;
                if (hours == 0) hours = 24;
                minutes = minutes < 10 ? '0'+minutes : minutes;
                var strTime = hours + ':' + minutes;
                return date.getDate() + "/" + (date.getMonth()+1) + "/" + date.getFullYear() + "  " + strTime;
            }
            $.ajax({
                type: "GET",
                url: '/tweets',
                data: {
                    'city': city,
                    '_token': document.getElementsByTagName("meta")["csrf-token"].getAttribute("content")
                },
                success: function( result ) {
                    for(var i=0; i<result.statuses.length; i++) {
                        var tweetWrapper = document.createElement('div');
                        $(tweetWrapper).addClass('tweet-wrapper');
                        var name = document.createElement('span');
                        $(name).addClass('name').append(result.statuses[i].user.name);
                        var time = document.createElement('span');


                        var date = new Date(result.statuses[i].created_at);

                        var dateNow = new Date();

                        var difference = dateNow.getTime() - date.getTime();

                        if (difference == 1000) {
                            var text = 'now';
                        } else if (difference < 3600000) {
                            var text = (Math.ceil(difference/60000) == 1) ? 'minute ago' : Math.ceil(difference/60000)+' minutes ago';
                        } else {
                            var text = formatDate(date);
                        }

                        $(time).addClass('time').append(text);
                        var tweet = document.createElement('p');
                        var tweetText = result.statuses[i].text;
                        var hastags = tweetText.match(/#\S+/g);

                        for (var j=0; j<hastags.length; j++) {
                            tweetText = replaceAll(tweetText, hastags[j], '<span class="hash-tag">'+hastags[j]+"</span>");
                        }

                        $(tweet).addClass('tweet').append(tweetText);
                        var image = document.createElement('img');
                        $(image).addClass('tweet-image').attr('src', result.statuses[i].user.profile_image_url);

                        $(tweetWrapper).append(name).append('&#9675;').append(time).append('<br/>').append(tweet).append(image);

                        $('.twitter-wrapper').append(tweetWrapper);
                    }
                }
            });

        });
    </script>
@endsection
