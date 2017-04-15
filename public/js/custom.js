$('#land-search').typeahead({
    ajax: {
        url: '/cities/list',
        triggerLength: 2
    }
});

$(function () {
    $('#land-search').on('change', function () {
        var serchBtn = $('#search-button');
        if($(this).val().length > 0) {
            serchBtn.removeAttr('disabled');
        } else {
            serchBtn.attr('disabled', 'disabled');
        }
    })
});
$('#land-search1').typeahead({
    ajax: {
        url: '/cities/list',
        triggerLength: 2
    }
});

$(function () {
    $('#land-search1').on('change', function () {
        var serchBtn = $('#search-button1');
        if($(this).val().length > 0) {
            serchBtn.removeAttr('disabled');
        } else {
            serchBtn.attr('disabled', 'disabled');
        }
    })
    $('#land-search1').on('focus', function(){
        $('.hidden-msg').addClass('hidden-msg-show');
    })
});
