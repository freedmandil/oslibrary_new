
Library.Models.System = Backbone.Model.extend({
    url: '/api/system/',
    getLanguages: function () {
        var self = this,
            baseUrl = self.url;
        var urlWithMethod = baseUrl + 'getLanguages/';

        // Now, perform a fetch operation
        return this.fetch({
            url: urlWithMethod,
            success: function (response) {
                return response;
            },
            error: function (response) {
                Utils.sendMessage('toast', 'error', 'Error fetching languages');
            }
        });
    }
});
