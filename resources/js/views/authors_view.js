Library.AuthorView = Backbone.View.extend({
    el: '#view_container', // Set the element where the view will be rendered
    events: {
        'click #saveAuthorBtn': 'saveAuthor',
    },

    initialize: function (options) {
        this.authorId = options.authorId;
        AuthorsCollection = new Library.Collections.Authors();

        // If editing an existing author, fetch the author data
        if (this.authorId) {
            var self = this;
            var author = AuthorsCollection.get(this.authorId);
            if (author) {
                this.authorData = author.toJSON();
            } else {
                // Handle author not found or fetch from server
                AuthorsCollection.fetch({
                    success: function () {
                        self.authorData = AuthorsCollection.get(self.authorId).toJSON();
                        self.render();
                    }
                });
            }
        }
        this.render();
        },
    template: function (authorData = null) {
        var selectedAuthor, selectedEdit, selectedTrans;
        switch (authorData.authorType) {
            case 'author':
                selectedAuthor = ' selected ';
                selectedEdit = '';
                selectedTrans = '';
                break;
            case 'editor':
                selectedAuthor = '';
                selectedEdit = ' selected ';
                selectedTrans = '';
                break;
            case 'translator':
                selectedAuthor = '';
                selectedEdit = '';
                selectedTrans = ' selected ';
                break;
            default:
                selectedAuthor = ' selected ';
                selectedEdit = '';
                selectedTrans = '';
                break;
        }

        var html = `
            <!-- AuthorModalTemplate.html -->
            <div class="modal fade" id="AuthorModal" tabindex="-1" aria-labelledby="AuthorModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addAuthorModalLabel">Add New Author</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="addAuthorForm">
                                <!-- Form fields for author details -->
                                <div class="form-group">
                                    <label for="authorPrefix">Prefix</label>
                                    <input type="text" class="form-control" id="authorPrefix" placeholder="מרן, רב רבי" ${authorData.prefix ? 'value="' + authorData.prefix + '"' : ''}>
                                </div>
                                <div class="form-group">
                                    <label for="authorFirstName">First Name</label>
                                    <input type="text" class="form-control" id="authorFirstName" required ${authorData.first_name ? 'value="' + authorData.first_name + '"' : ''}>
                                </div>
                                <div class="form-group">
                                    <label for="authorMiddleName">Middle Name</label>
                                    <input type="text" class="form-control" id="authorMiddleName" ${authorData.middle_name ? 'value="' + authorData.middle_name + '"' : ''}>
                                </div>
                                <div class="form-group">
                                    <label for="authorLastName">Last Name</label>
                                    <input type="text" class="form-control" id="authorLastName" required ${authorData.last_name ? 'value="' + authorData.last_name + '"' : ''}>
                                </div>
                                <div class="form-group">
                                    <label for="authorSuffix">Suffix</label>
                                    <input type="text" class="form-control" id="authorSuffix" placeholder="I, II, זצ״ל etc." ${authorData.suffix ? 'value="' + authorData.suffix + '"' : ''}>
                                </div>
                                <div class="form-group">
                                    <label for="authorAcronym">Acronym</label>
                                    <input type="text" class="form-control" id="authorAcronym" placeholder="רמב״ם or רשב״א" ${authorData.acronym ? 'value="' + authorData.acronym + '"' : ''}>
                                </div>
                                <div class="form-group">
                                    <label for="authorNickname">Nickname</label>
                                    <input type="text" class="form-control" id="authorNickname" placeholder="חתם סופר or חפץ חיים" ${authorData.nickname ? 'value="' + authorData.nickname + '"' : ''}>
                                </div>
                                <div class="form-group">
                                    <label for="authorType">Type</label>
                                    <select class="form-control" id="authorType">
                                        <option value="author" ${selectedAuthor}>Author</option>
                                        <option value="editor" ${selectedEdit}>Editor</option>
                                        <option value="translator" ${selectedTrans}>Translator</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="saveAuthorBtn">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>`;
        <!-- End AuthorModalTemplate.html -->
        return html;
    },
    render: function () {
        if ($('#AuthorModal').length > 0) {
            $('#AuthorModal').remove();
        }
        // Append the modal HTML to the body to ensure it's outside the #view_container
        $('body').append(this.template(this.authorData));
        $('#AuthorModal').modal('show'); // Use Bootstrap's modal method to show the modal
        return this;
    },

    saveAuthor: function() {
        var authorData = {
            prefix: this.$('#authorPrefix').val(),
            first_name: this.$('#authorFirstName').val(),
            middle_name: this.$('#authorMiddleName').val(),
            last_name: this.$('#authorLastName').val(),
            suffix: this.$('#authorSuffix').val(),
            acronym: this.$('#authorAcronym').val(),
            nickname: this.$('#authorNickname').val(),
            type: this.$('#authorType').val(),
        };

        AuthorsCollection.addAuthor(authorData, {
            wait: true, // Wait for the server to respond before adding to the collection

            success: function(model, response) {

                // Optionally, listen to the 'authorAdded' event on your collection to respond to successful adds
                this.listenTo(AuthorsCollection, 'authorAdded', function() {
                    // Close the modal and/or refresh the view to show the new author
                    $('#AuthorModal').modal('hide');
                });
            },

            error: function(model, response) {
                if (response.status === 422) {
                    var errors = JSON.parse(response.responseText).errors;
                    // Display these errors to the user
                    // Example: Update the DOM to show error messages
                    _.each(errors, function(error, field) {
                        // Append error messages to the form
                        $('#author' + field.charAt(0).toUpperCase() + field.slice(1)).after('<span class="error">' + error + '</span>');
                    });
                }
            }
        });

    },
});
