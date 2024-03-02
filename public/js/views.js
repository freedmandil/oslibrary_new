

var BooksGridView = Backbone.View.extend({
    el: '#Grid_Container', // Set the element where the view will be rendered

    initialize: function() {
        // Initialize any variables or setup logic here
         booksCollection = new Library.Collections.Books();

// Now, you can call the BooksbyShelf method on this collection instance

        this.render();
    },

    render: function() {
        // Render the grid and populate it with data
        var self = this;
        var columnDefs = []; // Define column definitions here, similar to your existing code
        var selectedValue = $('#shelf_number_dropdown').val() ? $('#shelf_number_dropdown').val() : $('#shelf_number_text').val();
        Utils.showSpinner();
        booksCollection.options.shelf_name = selectedValue;
        booksCollection.BooksbyShelf().done(function(response) {
            Utils.hideSpinner();
            // Process fetched data
            response.forEach(item => {
                // Concatenate 'author_first' and 'author_last' and assign it to 'author' field
                var author_first = (item.author_first) ? item.author_first : '',
                    author_middle = (item.author_middle) ? item.author_middle : '';
                author_last = (item.author_last) ? item.author_last : '';
                item.author = author_first + ' ' + author_middle + ' ' + author_last;
                item.author = item.author ? item.author : item.author_acronym;
            });

            // Now 'data' contains the 'author' field with concatenated values
            var columnDefs = Object.keys(columnTitleMap).map(key => {
                let field = (key === 'topic' || key === 'publisher' || key === 'assignment') ? key + '_' + userLanguage : key;

                return {
                    field: field,
                    headerName: columnTitleMap[key][userLanguage],
                    hide: key === 'id',
                    // Conditionally add the cellClass property for the 'assignment' column
                    cellClass: (key === 'assignment') ? function(params) {
                        if (params.data.color_name) {
                            // Prefix 'sys_' to the color_name and return it as the class name
                            return 'sys_' + params.data.color_name;
                        }
                    } : null
                };
            });
            columnDefs = addActionsColumn(columnDefs, userAccessLevel);
            // Populate the grid with modified data and column definitions
            self.populateGrid(response, columnDefs);
        }).fail(function(error) {
            Utils.hideSpinner();
            Utils.sendMessage('', 'error', 'There was an error: ' + error);
        });
    },

    populateGrid: function(data, columnDefs) {
        // Populate the AgGrid with data and column definitions
        var enable_rtl = (userLanguage == 'he');

        const gridOptions = {
            columnDefs: columnDefs,
            rowData: data,
            enableRtl: enable_rtl,
            autoSizeStrategy: {
                type: 'fitGridWidth',
                defaultMinWidth: 100,
                columnLimits: [
                    {
                        colId: 'action',
                        minWidth: 300,
                    },
                ],
            },
        };

        Grid.createGrid(this.el.querySelector('#Books_Grid'), gridOptions);
    }
});

// Instantiate the BooksGridView
