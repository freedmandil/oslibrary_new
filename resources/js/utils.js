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

Utils.sendMessage = function (type, level, message){
    // Handle error
    $.ajax({
        url: '/api/messages/setMessage', // Laravel route to set session message
        method: 'POST',
        data: {
            message: message,
            level: level,
            type: type// You can customize this based on the situation
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
        },
        success: function(data) {
            // Optionally handle response
        },
        error: function(xhr, status, error) {
            console.log('Error handling Message');
        }
    });
}
