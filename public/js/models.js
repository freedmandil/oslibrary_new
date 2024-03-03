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



Library.Models.Books = Backbone.Model.extend({
    url: '/api/books/'
});

/** Books Collection
 *  All the methods for Books in one Collection
 */
Library.Collections.Books = Backbone.Collection.extend({
        model: Library.Models.Books,
        url: function () {
            var url = '/api/books/';
            return url;
        },
        initialize: function (models, options) {
            this.options = options || {};
        },

    BooksbyShelf: function (shelfName) {
        var self = this,
            baseUrl = this.url();
        var urlWithShelf = baseUrl + 'ByShelfName/' + encodeURIComponent(shelfName);

        // Now, perform a fetch operation
        return this.fetch({
            url: urlWithShelf,
            success: function(collection, response, options) {
                return response;
            },
            error: function(collection, response, options) {
                Utils.sendMessage('', 'error', 'Error fetching books by shelf. Shelf: ' + shelfName);
            }
        });
    },

    BookbyId: function (id) {
        var self = this,
            baseUrl = this.url();
        var urlWithShelf = baseUrl + 'byId/' + encodeURIComponent(id);

        // Now, perform a fetch operation
        return this.fetch({
            url: urlWithShelf,
            success: function(collection, response, options) {
                return response;
            },
            error: function(collection, response, options) {
                Utils.sendMessage('', 'error', 'Error fetching books by shelf. id: ' + id);
            }
        });
    }
});
