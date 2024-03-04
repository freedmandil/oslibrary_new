
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
                Utils.sendMessage('toast', 'error', 'Error fetching books by shelf. Shelf: ' + shelfName);
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
                Utils.sendMessage('toast', 'error', 'Error fetching books by Id. id: ' + id);
            }
        });
    },

    Authors: function() {
        var self = this;
        var url = '/api/authors/';

        return Backbone.sync('read', this, {
            url: url,
            success: function(collection, response, options) {
                return response;
            },
            error: function(collection, response, options) {
                Utils.sendMessage('toast', 'error', 'Error fetching authors.');
            }
        });
    },

    AddAuthor: function(authorData) {
        var self = this;
        var url = '/api/authors/';

        return Backbone.sync('create', this, {
            url: url,
            data: JSON.stringify(authorData),
            contentType: 'application/json',
            success: function(model, response, options) {
                return response;
            },
            error: function(model, response, options) {
                Utils.sendMessage('toast', 'error', 'Error adding author.');
            }
        });
    },

    UpdateAuthor: function(authorId, authorData) {
        var self = this;
        var url = '/api/authors/' + authorId;

        return Backbone.sync('update', this, {
            url: url,
            data: JSON.stringify(authorData),
            contentType: 'application/json',
            success: function(model, response, options) {
                return response;
            },
            error: function(model, response, options) {
                Utils.sendMessage('toast', 'error', 'Error updating author.');
            }
        });
    },

    UpdateBook: function(bookId, bookData) {
        var self = this;
        var url = '/api/books/update/' + bookId;

        return Backbone.sync('update', this, {
            url: url,
            data: JSON.stringify(bookData),
            contentType: 'application/json',
            success: function(model, response, options) {
                return response;
            },
            error: function(model, response, options) {
                Utils.sendMessage('toast', 'error', 'Error updating book.');
            }
        });
    },

    AddBook: function(bookData) {
        var self = this;
        var url = '/api/books/create';

        return Backbone.sync('create', this, {
            url: url,
            data: JSON.stringify(bookData),
            contentType: 'application/json',
            success: function(model, response, options) {
                return response;
            },
            error: function(model, response, options) {
                Utils.sendMessage('toast', 'error', 'Error adding book.');
            }
        });
    }
});
