$(document).ready(function () {
    $.material.init();
    $.material.options = {
        "withRipples": ".btn:not(.btn-link), .card-image, .navbar a:not(.withoutripple), .nav-tabs a:not(.withoutripple), .withripple",
        "inputElements": "input.form-control, textarea.form-control, select.form-control",
        "checkboxElements": ".checkbox > label > input[type=checkbox]",
        "radioElements": ".radio > label > input[type=radio]"
    }

    function replaceAll(str, find, replace) {
        return str.replace(new RegExp(find, 'g'), replace);
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
                $(time).addClass('time').append(result.statuses[i].created_at);
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

    $(".owl-employee").owlCarousel({
        loop:true,
        margin:30,
        autoplay: true,
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
                items: 7,
                nav: true,
                loop: false
            }
        }
    });
    if (/Mobi/.test(navigator.userAgent)) {
        $('#place-image').attr('src',$('#place-image').data('thumb') )
    }

});
$( window ).resize(function() {
   landScapeImage();
});
function landScapeImage() {
    var placeImage = $('#place-image');
    if (/Mobi/.test(navigator.userAgent)) {
        placeImage.attr('src',placeImage.data('thumb'));
    } else {
        if(placeImage.attr('src')!== placeImage.data('web')) {
            placeImage.attr('src', placeImage.data('web'));
        }
    };
}
