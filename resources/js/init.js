/**
 * Backbone Initialization
 * init the application
 */

// Add AJAX interceptor
Backbone.ajax = function(options) {
    var originalError = options.error;

    options.error = function(jqXHR, textStatus, errorThrown) {
        if (jqXHR.status === 401) {
            // Handle unauthorized access
            Utils.sendMessage('modal', 'error', 'Unauthorized access. Please login to continue.');
            // For example, redirect to the login page
            window.location.href = '/login';
        } else {
            // Handle other errors
            Utils.sendMessage('toast', 'error', 'There was an error with this request. Error Code: ' +
                textStatus + '('+jqXHR+'). ' + errorThrown + '. Please try again.');

            if (originalError) {
                originalError(jqXHR, textStatus, errorThrown);
            } else {
                console.error('Error:', errorThrown);
            }
        }
    };

    return Backbone.$.ajax.apply(Backbone.$, arguments);
};
