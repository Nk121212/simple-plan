$(document).on('ready', function () {

    $('.star-rating').rating({
        theme: 'krajee-fa',
        filledStar: '<i class="fa fa-star"></i>',
        emptyStar: '<i class="fa fa-star-o"></i>'
    });

    $('.star-rating').on(
    'change', function () {
        console.log('Rating selected: ' + $(this).val());
    });

});