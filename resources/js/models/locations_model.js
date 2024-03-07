
Library.Models.Locations = Backbone.Model.extend({
    url: '/api/locations/',
    getShelves: function () {
        let self = this,
            baseUrl = self.url;
        let urlWithMethod = baseUrl + 'getShelves/';

        // Now, perform a fetch operation
        return self.fetch({
            url: urlWithMethod,
            success: function (response) {
                return response;
            },
            error: function () {
                Utils.sendMessage('toast', 'error', 'Error fetching shelves');
            }
        });
    }
});
