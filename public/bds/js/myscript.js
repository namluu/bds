$(document).ready(function(){
    // slideshow
    $('.news-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 10,
        slidesToScroll: 1,
        asNavFor: '.news-slider',
        centerMode: false,
        focusOnSelect: true,
        vertical: true,
        autoplay: true,
        autoplaySpeed: 5000
    });
    $('.media-slick').css('display', 'block');

    // ajax load district
    var $district_select = $('#district_select');
    $('#city_select').on('change', function() {
        var city_id = $(this).val();

        $district_select.html('<option>Đang lấy dữ liệu...</option>');

        $.ajax({
            url: base_url + 'location/district/load',
            type: 'post',
            data: {
                city_id: city_id,
            },
            dataType: 'json'
        }).done(function(response) {
            //console.log('success');
            $district_select.html('');
            $.each(response, function(index, value) {
                $district_select.append('<option value="'+index+'">'+value+'</option>');
            });
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
        }).always(function() {
            //console.log('complete');
        });

    });
});