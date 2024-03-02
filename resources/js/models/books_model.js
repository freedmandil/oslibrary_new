

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

        BooksbyShelf: function () {
            var self = this,
                baseUrl = this.url(), // Use the function to ensure we always get the base URL
                shelfName = this.options.shelf_name ? this.options.shelf_name : ''; // Ensure shelf_name exists

            var urlWithShelf = baseUrl + 'ByShelfName/' + encodeURIComponent(shelfName); // Correctly build the URL

            // Now, perform a fetch operation
            return this.fetch({
                url: urlWithShelf, // Use the constructed URL
                success: function(collection, response, options) {
                    return response;
                },
                error: function(collection, response, options) {
                    Utils.sendMessage('', 'error', 'Error fetching books by shelf. Shelf: ' + shelfName);
                }
            });
        }
});
