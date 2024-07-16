jQuery(document).ready(function($) {
    $('.accordion-title').on('click', function() {
        var content = $(this).next('.accordion-content');
        content.slideToggle();
        $(this).toggleClass('active');
    });
});
