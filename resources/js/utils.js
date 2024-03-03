Utils = {}
// Show spinner overlay
Utils.showSpinner = function (message) {
    message = message || 'Loading...';
    $('.spinner-overlay').removeClass('hide');

    if (message) {
        $('.spinner_msg').html(message);
    }
    $('.spinner-overlay').fadeIn();

}

// Hide spinner overlay
Utils.hideSpinner = function () {
    $('.spinner-overlay').fadeOut();
    $('.spinner-overlay').addClass('hide');
}

Utils.sendMessage = function (type, level, message){
    if (type && level && message)
    {
        var MessageView = new Library.MessagesView({ type: type, level: level, message: message });

    } else {
        var SessionMessage = new Library.Models.Messages();
        SessionMessage.getMessage().done(function(response) {
            var MessageView = new Library.MessagesView({ options: { type: response.type, level: response.level, message: response.message } });
        }).fail(function(error) {
            console.error('Error fetching message:', error);
        });

    }
}

Utils.formatValue = function (value) {
    return value ? value : '';
}
