$(document).ready(function(){
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
});