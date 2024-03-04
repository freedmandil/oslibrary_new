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

function renderMessage(options) {
    var bootstrapOptions = {
        bg: 'bg-primary',
        text: 'text-white',
        border: 'border-primary',
        title: 'Notice',
        alert: 'alert alert-primary'
    };

    // Determine bootstrap options based on message level
    switch (options.level) {
        case 'error':
        case 'danger':
            bootstrapOptions.name = 'danger';
            bootstrapOptions.text = "light";
            bootstrapOptions.title = "There was an Error";
            break;
        case 'warning':
            bootstrapOptions.name = 'warning';
            bootstrapOptions.text = "dark";
            bootstrapOptions.title = "Warning Notice";
            break;
        case 'success':
        case 'status':
            bootstrapOptions.name = 'success';
            bootstrapOptions.text = "light";
            bootstrapOptions.title = "Action was successful";
            break;
        case 'info':
            bootstrapOptions.name = 'info';
            bootstrapOptions.text = "dark";
            bootstrapOptions.title = "For Your Information";
            break;
        case 'primary':
        default:
            bootstrapOptions.name = 'primary';
            bootstrapOptions.text = "light";
            bootstrapOptions.title = "Notice";
            break;
    }

    // Construct the message element based on message type
    var message;
    switch (options.type) {
        case 'toast':
            message = renderToast(options.message, bootstrapOptions);
            break;
        case 'alert':
            message = renderAlert(options.message, bootstrapOptions);
            break;
        case 'modal':
            message = renderModal(options.message, bootstrapOptions);
            break;
        default:
            message = renderToast(options.message, bootstrapOptions);
            break;
    }

    // Append the message to the container element
    var containerElement = document.querySelector('#view_container');
    containerElement.innerHTML = message;
}

function renderToast(message, bootstrapOptions) {
    var toast =
        '<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 11">' +
        '<div id="liveToast" class="toast ' + bootstrapOptions.bg + ' ' + bootstrapOptions.border + ' border-2" role="alert" aria-live="assertive" aria-atomic="true">' +
        '<div class="toast-header ' + bootstrapOptions.border + '">' +
        '<span class="fw-bold">' + bootstrapOptions.title + '</span>' +
        '</div>' +
        '<div class="toast-body fw-bold ' + bootstrapOptions.text + '">' +
        message +
        '</div>' +
        '</div>' +
        '</div>';

    return toast;
}

function renderAlert(message, bootstrapOptions) {
    var alert =
        '<div id="alertMessage">' +
        '<div class="alert alert-' + bootstrapOptions.name + ' alert-dismissible fade show ' + bootstrapOptions.border + '" role="alert">' +
        '<span class="fw-bold">' + bootstrapOptions.title + '</span>&nbsp;&nbsp;' +
        '<span>' + message + '</span>' +
        '</div>' +
        '</div>';

    return alert;
}

function renderModal(message, bootstrapOptions) {
    var modal =
        '<div class="modal fade" id="viewMessage" tabindex="-1" aria-labelledby="viewMessage" aria-hidden="true">' +
        '<div class="modal-dialog ' + bootstrapOptions.border + ' ' + bootstrapOptions.bg + '">' +
        '<div class="modal-content border-0 bg-' + bootstrapOptions.bg + '">' +
        '<div class="modal-header border-0 ' + bootstrapOptions.alert + '">' +
        '<h1 class="modal-title fs-5">' + bootstrapOptions.title + '</h1>' +
        '</div>' +
        '<div class="modal-body border-0 ' + bootstrapOptions.bg + '">' +
        message +
        '</div>' +
        '<div class="modal-footer border-0">' +
        '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>';

    return modal;
}

Utils.sendMessage = function (type, level, message){
    if (type && level && message)
    {
        var messageOptions = {
            type: type, // Specify the type of message (toast, alert, modal)
            level: level, // Specify the level of the message (error, warning, success, info, primary)
            message: message // The actual message content
        };

        // Call the renderMessage function with the message options
        renderMessage(messageOptions);

    } else {

        var messageOptions = {
            type: 'toast', // Specify the type of message (toast, alert, modal)
            level: 'error', // Specify the level of the message (error, warning, success, info, primary)
            message: 'There was an error with this request. Please try again later or contact the Administrator.'
        };

        // Call the renderMessage function with the message options
        renderMessage(messageOptions);

    }

    Utils.sendSysMessage = function (type, level, message){
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
}

Utils.formatValue = function (value) {
    return value ? value : '';
}
