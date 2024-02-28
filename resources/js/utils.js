Utils = {}
// Show spinner overlay
Utils.showSpinner = function (message) {
    $('.spinner-overlay').removeClass('hide');

    if (message) {
        $('.spinner').html(message);
    }
    $('.spinner-overlay').fadeIn();

}

// Hide spinner overlay
Utils.hideSpinner = function () {
    $('.spinner-overlay').fadeOut();
    $('.spinner-overlay').addClass('hide');

}
