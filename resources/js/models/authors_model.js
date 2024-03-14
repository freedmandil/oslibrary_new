Library.Models.Authors = Backbone.Model.extend({
    url: '/api/authors/'
});

/** Authors Collection
 *  All the methods for Authors in one Collection
 */
Library.Collections.Authors = Backbone.Collection.extend({
    model: Library.Models.Authors,
    url: function () {
        var url = '/api/authors/';
        return url;
    },
    initialize: function (models, options) {
        this.options = options || {};
    },

    addAuthor: function(authorData, callbacks) {
        var self = this;
        var author = new Library.Models.Authors();

        author.save(null, {
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(authorData),
            success: function(model, response) {
                self.add(model); // Add the new model to the collection
                if(callbacks && typeof callbacks.success === 'function') {
                    callbacks.success(model, response);
                    self.trigger('authorAdded', model);

                }
            },
            error: function(model, response) {
                if(callbacks && typeof callbacks.error === 'function') {
                    callbacks.error(model, response);
                }
            }
        });
    }
});
