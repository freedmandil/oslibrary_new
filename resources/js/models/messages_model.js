Library.Models.Messages = Backbone.Model.extend({
    urlRoot: '/api/messages/',

    setMessage: function() {
        var self = this;

        // Construct the URL for setMessage endpoint
        var urlsetMessage = this.urlRoot + 'setMessage/';

        // Save the model to trigger a POST request
        return this.save({}, {
            url: urlsetMessage,
            success: function(model, response, options) {
                // Handle success
                console.log('Message set successfully:', response);
            },
            error: function(model, response, options) {
                // Handle error
                console.error('Error setting message:', response);
                // Use Utils to send error message
            }
        });
    },
    getMessage: function() {
        var self = this;

        // Construct the URL for getMessage endpoint
        var urlgetMessage = this.urlRoot + 'getMessage/';

        // Fetch the model to trigger a GET request
        return this.fetch({
            url: urlgetMessage,
            success: function(model, response, options) {
                    return response;
            },
            error: function(model, response, options) {
                console.error('Error fetching message:', response);
            }
        });
    }
});
