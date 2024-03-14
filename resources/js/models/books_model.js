
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
                error = response.responseJSON;
                Utils.sendMessage(error.type, error.level, error.message, response.status);
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
                Utils.sendMessage(error.type, error.level, error.message, response.status);
            }
        });
    },

    getAuthors: function() {
        var self = this;
        var url = '/api/authors/getAuthors/';

        return Backbone.sync('read', this, {
            url: url,
            success: function(collection, response, options) {
                return response;
            },
            error: function(collection, response, options) {
                Utils.sendMessage(error.type, error.level, error.message, response.status);
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
                error = response.responseJSON;
                Utils.sendMessage(error.type, error.level, error.message, response.status);
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
                error = response.responseJSON;
                Utils.sendMessage(error.type, error.level, error.message, response.status);
            }
        });
    },
    validateSeferNumber: function(seferNumber, shelfId, bookId = null) {
        var url = '/api/books/validateSeferNumber';
        var data = {
            sefer_number: seferNumber,
            shelf_id: shelfId,
        };

        // Include bookId in the request if it exists
        if (bookId) {
            data.book_id = bookId;
        }

        return Backbone.sync('fetch', this, {
            url: url,
            data: JSON.stringify(data), // Convert data object to JSON string
            method: 'post',
            contentType: 'application/json', // Ensure the server knows to expect JSON
            success: function(model, response, options) {
                return response.success ? true : false;
            },
            error: function(model, response, options) {
                var error = response.responseJSON;
                return error ? error.message ?? null : false;
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
                error = response.responseJSON;
                Utils.sendMessage(error.type, error.level, error.message, response.status);
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
                error = response.responseJSON;
                Utils.sendMessage(error.type, error.level, error.message, response.status);
            }
        });
    },

    AddTitle: function(titleData) {
        var url = '/api/titles/addBookTitle';
        return Backbone.sync('create', this, {
            url: url,
            data: JSON.stringify(titleData),
            contentType: 'application/json',
            success: function(model, response, options) {
                return response;
            },
            error: function(model, response, options) {
                var error = response.responseJSON;
                Utils.sendMessage(error.type, error.level, error.message, response.status);
            }
        });
    },

    UpdateTitle: function(titleId, titleData) {
        var url = '/api/titles/updateBookTitle' + titleId;
        return Backbone.sync('update', this, {
            url: url,
            data: JSON.stringify(titleData),
            contentType: 'application/json',
            success: function(model, response, options) {
                return response;
            },
            error: function(model, response, options) {
                var error = response.responseJSON;
                Utils.sendMessage(error.type, error.level, error.message, response.status);
            }
        });
    },
    AddTopic: function(topicData) {
        var url = '/api/topics/createTopic';
        return Backbone.sync('create', this, {
            url: url,
            data: JSON.stringify(topicData),
            contentType: 'application/json',
            success: function(model, response, options) {
                return response;
            },
            error: function(model, response, options) {
                var error = response.responseJSON;
                Utils.sendMessage(error.type, error.level, error.message, response.status);
            }
        });
    },

    UpdateTopic: function(topicId, topicData) {
        var url = '/api/topics/updateTopic' + topicId;
        return Backbone.sync('update', this, {
            url: url,
            data: JSON.stringify(topicData),
            contentType: 'application/json',
            success: function(model, response, options) {
                return response;
            },
            error: function(model, response, options) {
                var error = response.responseJSON;
                Utils.sendMessage(error.type, error.level, error.message, response.status);
            }
        });
    },

    AddPublisher: function(publisherData) {
        var url = '/api/publishers/createPublisher';
        return Backbone.sync('create', this, {
            url: url,
            data: JSON.stringify(publisherData),
            contentType: 'application/json',
            success: function(model, response, options) {
                return response;
            },
            error: function(model, response, options) {
                var error = response.responseJSON;
                Utils.sendMessage(error.type, error.level, error.message, response.status);
            }
        });
    },

    UpdatePublisher: function(publisherId, publisherData) {
        var url = '/api/publishers/updatePublisher' + publisherId;
        return Backbone.sync('update', this, {
            url: url,
            data: JSON.stringify(publisherData),
            contentType: 'application/json',
            success: function(model, response, options) {
                return response;
            },
            error: function(model, response, options) {
                var error = response.responseJSON;
                Utils.sendMessage(error.type, error.level, error.message, response.status);
            }
        });
    },

    AddShelf: function(shelfData) {
        var url = '/api/shelf/createShelf';
        return Backbone.sync('create', this, {
            url: url,
            data: JSON.stringify(shelfData),
            contentType: 'application/json',
            success: function(model, response, options) {
                return response;
            },
            error: function(model, response, options) {
                var error = response.responseJSON;
                Utils.sendMessage(error.type, error.level, error.message, response.status);
            }
        });
    },

    UpdateShelf: function(shelfId, shelfData) {
        var url = '/api/shelf/updateShelf' + shelfId;
        return Backbone.sync('update', this, {
            url: url,
            data: JSON.stringify(shelfData),
            contentType: 'application/json',
            success: function(model, response, options) {
                return response;
            },
            error: function(model, response, options) {
                var error = response.responseJSON;
                Utils.sendMessage(error.type, error.level, error.message, response.status);
            }
        });
    },
});
