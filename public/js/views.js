Library.MessagesView = Backbone.View.extend({
    el: '#view_container', // Set the element where the view will be rendered
    bootstrapOptions: {
        bg: 'bg-primary',
        text:  'text-white',
        border: 'border-primary',
        title: 'Notice',
        alert: 'alert alert-primary'
    },
    events: {
        // 'change #shelf_number_dropdown': 'render',

    },
    initialize: function (options) {
        this.type = options.type;
        this.level = options.level;
        this.message = options.message;

        // Initialize any variables or setup logic here
        this.render();
    },
    render: function () {
        var options = this.options,
            self = this;
        switch (this.level) {
            case 'error':
            case 'danger': self.bootstrapName = 'danger'; self.bootstrapText ="light"; self.bootstrapOptions.title = "There was an Error"; break;
            case 'warning': self.bootstrapName = 'warning'; self.bootstrapText ="dark"; self.bootstrapOptions.title = "Warning Notice"; break;
            case 'success':
            case 'status': self.bootstrapName = 'success'; self.bootstrapText ="light"; self.bootstrapOptions.title = "Action was successful"; break;
            case 'info': self.bootstrapName = 'info'; self.bootstrapText ="dark"; self.bootstrapOptions.title = "For Your Information"; break;
            case 'primary':
            default: self.bootstrapName = 'primary'; self.bootstrapText ="light"; self.bootstrapOptions.title = "Notice"; break;
        }
        self.bootstrapOptions.alert = 'alert alert-' + self.bootstrapName;
        self.bootstrapOptions.bg = 'bg-' + self.bootstrapName;
        self.bootstrapOptions.textcolor = 'text-' + self.bootstrapText;
        self.bootstrapOptions.border = 'border-' + self.bootstrapName;

        switch (this.type) {
            case 'toast': self.renderToast(); break;
            case 'alert': self.renderAlert(); break;
            case 'modal': self.renderModal(); break;
            default: self.renderToast(); break;
        }
    },
    renderToast: function () {
        var self = this;
        var toast =
            '<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 11">' +
                ' <div id="liveToast" class="toast '+ self.bootstrapOptions.bg + ' ' + self.bootstrapOptions.border +' border-2" role="alert" aria-live="assertive" aria-atomic="true">' +
                    '<div class="toast-header ' + self.bootstrapOptions.border +' ">' +
                        '<span class="fw-bold">'+self.bootstrapOptions.title+'</span>' +
                    '</div>' +
                    '<div class="toast-body fw-bold '+self.bootstrapOptions.textcolor+'">' +
                      self.message +
                    '</div>' +
                '</div>' +
            '</div>';
        if ($('.toast-container').length > 0) {
            $('.toast-container').remove();
        }
        this.$el.append(toast)
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function(toastEl) {
            // Customize autohide and other options if needed
            return new bootstrap.Toast(toastEl, { autohide: true }).show();
        });
    },
    renderAlert: function () {
        var self = this;
        var alert =
            '<div id="alertMessage">' +
            '<div class="alert alert-'+ self.bootstrapName +' alert-dismissible fade show ' + self.bootstrapOptions.border + ' " role="alert">' +
            '<span class="fw-bold">'+self.bootstrapOptions.title+'</span>&nbsp;&nbsp;' +
            '<span>' + self.message + '</span>' +
            '</div>'+
        '</div>';
        if ($('#alertMessage').length > 0) {
            $('#alertMessage').remove();
        }
        $('#alert-container').append(alert);
        setTimeout(function() {
            $('#alertMessage').alert('close'); // Using Bootstrap's alert method to close the alert smoothly
        }, 3500); // 4000 milliseconds = 4 seconds
    },

    renderModal: function () {
        var self = this;
        var modal =
            '<div class="modal fade" id="viewMessage" tabindex="-1" aria-labelledby="viewMessage" aria-hidden="true">' +
                ' <div class="modal-dialog  ' + self.bootstrapOptions.border + '  ' + self.bootstrapOptions.bg + ' ">' +
                   '<div class="modal-content border-0 bg-' + self.bootstrapOptions.bg + ' ">' +
                        '<div class="modal-header border-0 ' + self.bootstrapOptions.alert +' ">' +
                            '<h1 class="modal-title fs-5">'+self.bootstrapOptions.title+'</h1>' +
                        '</div>' +
                        '<div class="modal-body border-0' + self.bootstrapOptions.bg + ' ">' +
                            self.message +
                        '</div>' +
                        '<div class="modal-footer border-0">' +
                            '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>';
        if ($('#viewMessage').length > 0) {
            $('#viewMessage').remove();
        }
        this.$el.append(modal);
        options = {}
    var messageModal = new bootstrap.Modal('#viewMessage', options);
    messageModal.show();
    }
});

const columnTitleMap = {
    id: { en: "ID", he: "" },
    title: { en: "Title", he: "שם" },
    subtitle: { en: "Subtitle", he: "שם שניה" },
    author: { en: "Author", he: "מחבר" },
    volume: { en: "Vol.", he: "חלק" },
    volume_name: { en: "Vol. Name", he: "מסכתא" },
    shelf_name: { en: "Shelf Number", he: "מספר תא" },
    sefer_number: { en: "Sefer Number", he: "מספר ספר" },
    BookRef: { en: "Book Reference", he: "מספר יסודי" },
    barcode: { en: "Barcode", he: "ברקוד" },
    edition: { en: "Edition", he: "מדורה" },
    topic: { en: "Topic", he: "נושא" },
    language: { en: "Language", he: "שפה" },
    assignment: { en: "Assignment", he: "מקום" },
    dateUpdated: { en: "Date Updated", he: "תאריך שינוי" }
};

Library.BooksGridView = Backbone.View.extend({
    el: '#grid_container', // Set the element where the view will be rendered
    grid: null,
    gridApi: null,
    events: {
       // 'change #shelf_number_dropdown': 'render',
        'change .shelf_number_input': 'render',
         'click .view-book': 'viewBook',
         'click .edit-book': 'editBook',
        'click .delete-book': 'deleteBook'
    },
    initialize: function() {
        let gridApi;
        var columnDefs = Object.keys(columnTitleMap).map(key => {
            let field = (key === 'topic' || key === 'publisher' || key === 'assignment') ? key + '_' + userLanguage : key;
            return {
                field: field,
                headerName: columnTitleMap[key][userLanguage],
                hide: key === 'id', // Assuming you want to hide the ID column
                filter: 'agSetColumnFilter'
            };
        });
        columnDefs.push({
            action: "",
        });

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
        booksCollection.BooksbyShelf(selectedValue).done(function(response) {
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
                            return 'sys_' + params.data.color_name + ' rounded-3';
                        }
                    } : null
                };
            });
            columnDefs = self.addActionsColumn(columnDefs, userAccessLevel);
            // Populate the grid with modified data and column definitions
            self.populateGrid(response, columnDefs);
        }).fail(function(error) {
            Utils.hideSpinner();
            console.log('Aggrid Failed to Populate due to response error');
        });
    },
    onSelectionChanged: function() {

},
    populateGrid: function(data, columnDefs) {
        // Populate the AgGrid with data and column definitions
        var enable_rtl = (userLanguage === 'he');
        var self = this;

        const gridOptions = {
            columnDefs: columnDefs,
            rowData: data,
            enableRtl: enable_rtl,
            rowSelection: 'multiple',
            rowMultiSelectWithClick: true,
            onSelectionChanged: self.onSelectionChanged,
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
        self.removeGrid();
        self.grid = Grid.createGrid(self.el.querySelector('#Books_Grid'), gridOptions);
    },

    removeGrid: function removeGrid() {
        var gridContainer = document.getElementById('Grid_Container');

// Get a reference to the Books_Grid div
        var booksGrid = document.getElementById('Books_Grid');

// Remove the Books_Grid div from the Grid_Container
        gridContainer.removeChild(booksGrid);

// Create a new div element
        var newDiv = document.createElement('div');

// Set the id, class, and style attributes for the new div
        newDiv.id = 'Books_Grid';
        newDiv.className = 'ag-theme-alpine';
        newDiv.style.width = '100%';
        newDiv.style.height = '100%';

// Append the new div to the Grid_Container
        gridContainer.appendChild(newDiv);var gridContainer = document.getElementById('Grid_Container');

// Get a reference to the Books_Grid div
        var booksGrid = document.getElementById('Books_Grid');

// Remove the Books_Grid div from the Grid_Container
        gridContainer.removeChild(booksGrid);

// Create a new div element
        var newDiv = document.createElement('div');

// Set the id, class, and style attributes for the new div
        newDiv.id = 'Books_Grid';
        newDiv.className = 'ag-theme-alpine';
        newDiv.style.width = '100%';
        newDiv.style.height = '100%';

// Append the new div to the Grid_Container
        gridContainer.appendChild(newDiv);
    },
    addActionsColumn: function (columnDefs, userAccessLevel) {
    const actionsColumn = {
        field: "action",
        headerName: "Actions",
        cellRenderer: function(params) {
            let buttons = '';
            let id = params.data.id;
            let viewButton = $('<button>', {
                class: 'btn btn-primary btn-sm view-book',
                text: 'View',
                'data-id': id
            });
            buttons += viewButton.prop('outerHTML');


            if (userAccessLevel >= 5) {
                let editButton = $('<button>', {
                    class: 'btn btn-success btn-sm edit-book',
                    text: 'Edit',
                    'data-id': id
                });
                buttons += '&nbsp;'+editButton.prop('outerHTML');
            }

            if (userAccessLevel >= 7) {
                let deleteButton = $('<button>', {
                    class: 'btn btn-danger btn-sm delete-book',
                    text: 'Delete',
                    'data-id': id
                });
                buttons += '&nbsp;'+deleteButton.prop('outerHTML');
            }

            return buttons;
        },
    };

    columnDefs.push(actionsColumn);
    return columnDefs;
},
    viewBook: function(event) {
        var id = $(event.currentTarget).data('id');
        var bookView = new Library.BookView({ bookId: id });

    },
editBook: function(event) {
    var id = $(event.currentTarget).data('id');
    var bookEdit = new Library.EditBookView({ bookId: id });
},
deleteBook: function(id) {
    // Logic to delete the record
    console.log('Deleting record', id);
}
});

Library.BookView = Backbone.View.extend({
    el: '#view_container', // Set the element where the view will be rendered
    events: {
        // 'change #shelf_number_dropdown': 'render',

    },
    initialize: function (options) {
        this.bookId = options.bookId;
        // Initialize any variables or setup logic here
        booksCollection = new Library.Collections.Books();

        this.render(this.bookId);
    },
        template: function () {
        var html = `<div class="modal fade" id="viewBookModal" tabindex="-1" aria-labelledby="viewBook" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="viewBookTitle">Book Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="bookContainer">
                            <div id="bookContent"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        `;
        return html;
        },
        render: function(bookId) {
        if ($('#viewBookModal').length > 0) {
            $('#viewBookModal').remove();
        }
            $('#view_container').append(this.template());
            var options = {};
            var bookModal = new bootstrap.Modal('#viewBookModal', options);
            this.$('#bookContent').remove();
            this.$('#bookContainer').append('<div id="bookContent"></div>');
            Utils.showSpinner();

            var bookData = booksCollection.BookbyId(bookId).done(function(response) {
                    // Process fetched data
                        // Concatenate 'author_first' and 'author_last' and assign it to 'author' field
                        var author_first = (response.author_first) ? response.author_first : '',
                            author_middle = (response.author_middle) ? response.author_middle : '';
                        author_last = (response.author_last) ? response.author_last : '';
                        response.author = author_first + ' ' + author_middle + ' ' + author_last;
                        response.author = response.author ? response.author : response.author_acronym;
                var bookData = response;
                if (userLanguage !== 'he') {
                    var modalContent = `
                        <div class="container ${(userLanguage === 'he') ? 'rtl' : ''}">
                             <div class="header alert alert-info">
                                <h3 class="fw-bold ${(bookData.language_code === 'he') ? 'rtl' : 'ltr'}">${Utils.formatValue(bookData.title)}</h3>
                                <h3 class="${(bookData.language_code === 'he') ? 'rtl' : 'ltr'}">${Utils.formatValue(bookData.subtitle)}</h3>
                                <h4 class="${(bookData.language_code === 'he') ? 'rtl' : 'ltr'}">${Utils.formatValue(bookData.author)}</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>General Details</h5>
                                    <p><strong>BookID:</strong> ${Utils.formatValue(bookData.id)}  ${bookData.BookRef ? '<strong>Book Ref.:</strong>' + bookData.BookRef : ''}</p>
                                    <p><strong>Title:</strong> ${Utils.formatValue(bookData.title)} ${bookData.subtitle ? '- ' + bookData.subtitle : ''}</p>
                                    <p><strong>Author:</strong> ${Utils.formatValue(bookData.author)}</p>
                                    <p><strong>Edition:</strong> ${Utils.formatValue(bookData.edition)}</p>
                                    <p><strong>Volume:</strong> ${Utils.formatValue(bookData.volume)} ${bookData.volume_name ? '- ' + bookData.volume_name : ''}</p>
                                    <p><strong>Type:</strong> ${Utils.formatValue(bookData.type)}</p>
                                    <p><strong>Language:</strong> ${Utils.formatValue(bookData.language)}</p>
                                    <p><strong>Notes:</strong> ${Utils.formatValue(bookData.notes)}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Classification & Publication</h5>
                                    <p><strong>Topic:</strong> ${bookData.language_code === 'he' ? Utils.formatValue(bookData.topic_he) : Utils.formatValue(bookData.topic_en)}</p>
                                    <p><strong>Publisher:</strong>   ${bookData.language_code === 'he' ? Utils.formatValue(bookData.publisher_he) : Utils.formatValue(bookData.publisher_en)}</p>
                                    <p><strong>Shelf Number:</strong> ${Utils.formatValue(bookData.shelf_name)}&nbsp;|&nbsp;<strong>Book Number:</strong> ${Utils.formatValue(bookData.sefer_number)}</p>
                                    <p><strong>Location:</strong> <span class="p-2 sys_${bookData.color_name}"> ${userLanguage === 'he' ? Utils.formatValue(bookData.assignment_he) : Utils.formatValue(bookData.assignment_en)}</p></span>
                                    <p><strong>Barcode:</strong> ${Utils.formatValue(bookData.barcode)}</p>
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                    var modalContent = `
                        <div class="container ${(userLanguage === 'he') ? 'rtl' : ''}">
                            <div class="header alert alert-info">
                                <h3 class="fw-bold ${(bookData.language_code === 'he') ? 'rtl' : 'ltr'}">${Utils.formatValue(bookData.title)}</h3>
                                <h3 class="${(bookData.language_code === 'he') ? 'rtl' : 'ltr'}">${Utils.formatValue(bookData.subtitle)}</h3>
                                <h4 class="${(bookData.language_code === 'he') ? 'rtl' : 'ltr'}">${Utils.formatValue(bookData.author)}</h4>
                            </div>
                               <div class="row">
                                <div class="col-md-6">
                                    <h5>פרטים כללים</h5>
                                    <p><strong>מספר יסודי:</strong> ${Utils.formatValue(bookData.id)}  ${bookData.BookRef ? '<strong>מספר ישן.:</strong>' + bookData.BookRef : ''}</p>
                                    <p><strong>שם:</strong> ${Utils.formatValue(bookData.title)} ${bookData.subtitle ? '- ' + bookData.subtitle : ''}</p>
                                    <p><strong>מחבר:</strong> ${Utils.formatValue(bookData.author)}</p>
                                    <p><strong>מדורה:</strong> ${Utils.formatValue(bookData.edition)}</p>
                                    <p><strong>חלק:</strong> ${Utils.formatValue(bookData.volume)} ${bookData.volume_name ? '- ' + bookData.volume_name : ''}</p>
                                    <p><strong>סוג:</strong> ${Utils.formatValue(bookData.type)}</p>
                                    <p><strong>שפה:</strong> ${Utils.formatValue(bookData.language)}</p>
                                    <p><strong>הערות:</strong> ${Utils.formatValue(bookData.notes)}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>סיווג והוצאת ספרים</h5>
                                    <p><strong>עניין:</strong> ${bookData.language_code === 'he' ? Utils.formatValue(bookData.topic_he) : Utils.formatValue(bookData.topic_he)}</p>
                                    <p><strong>מוציא לאור:</strong>   ${bookData.language_code === 'he' ? Utils.formatValue(bookData.publisher_he) : Utils.formatValue(bookData.publisher_he)}</p>
                                    <p><strong>מספר תא:</strong> ${Utils.formatValue(bookData.shelf_name)} &nbsp;|&nbsp;<strong>מספר ספר:</strong> ${Utils.formatValue(bookData.sefer_number)}</p>
                                    <p><strong>אתר:</strong> <span class="p-2 sys_${bookData.color_name}"> ${bookData.language_code === 'he' ? Utils.formatValue(bookData.assignment_he) : Utils.formatValue(bookData.assignment_he)}</p></span>
                                    <p><strong>ברקוד:</strong> ${Utils.formatValue(bookData.barcode)}</p>
                                </div>
                            </div>
                        </div>
                    `;
                }

                $('#bookContent').append(modalContent);
                Utils.hideSpinner();
                bookModal.show();
            });
        }
});

Library.EditBookView = Backbone.View.extend({
    el: '#edit_container',
    events: {
        'click #saveBook': 'saveBook',
        'change #editSeferNumber': 'validateSeferNumber',
        'change #editShelf': 'validateSeferNumber'
    },

    initialize: function(options) {
        this.bookId = options.bookId;
        // Assuming booksCollection is available in the scope or passed in options
        this.booksCollection = new Library.Collections.Books();

        this.render(this.bookId);
    },

    template: function(bookData) {
        // Template now includes form elements pre-filled with bookData values
        // Note: Ensure you handle the possibility of null or undefined values in bookData
        return `
            <div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="editBook" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editBookTitle">Edit Book Details</h1>
                        </div>
                        <div id="bookEditForm" class="modal-body">
                          <div id="bookContainer">
                            <div id="editBookContent"></div>
                          </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="saveBook">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    },

    render: function(bookId) {
        var self = this;
        if ($('#editBookModal').length > 0) {
            $('#editBookModal').remove();
        }

        Utils.showSpinner();

        $('#edit_container').append(self.template(bookData));
            var editModal = new bootstrap.Modal('#editBookModal', {id: bookId});
            var bookData = booksCollection.BookbyId(bookId).done(function(response) {
            var bookData = response;
            var System = new Library.Models.System();
            var Locations = new Library.Models.Locations();



            var editModalContent = `
            <form id="editBookForm">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>General Details</h5>
                            <p><strong>BookID:</strong> ${Utils.formatValue(bookData.id)}  ${bookData.BookRef ? '<strong>Book Ref.:</strong>' + bookData.BookRef : ''}</p>
                            <div class="mb-3">
                                <label for="editSeferNumber" class="form-label">Book Number</label>
                                <input type="number" class="form-control" id="editSeferNumber" value="${Utils.formatValue(bookData.sefer_number)}">
                                <span id="seferNumberValidation" class="text-danger"></span>
                                  <label for="editShelf" class="form-label">Shelf</label>
                                  <select class="dropdown ui" id="editShelf">
                                    ${ShelvesSelect}
                                  </select>
                            </div>
                            <div class="mb-3">
                                <label for="editTitle" class="form-label">Title</label>
                                <input type="text" class="form-control ${(bookData.language_code === 'he') ? 'rtl' : 'ltr'}" id="editTitle" value="${Utils.formatValue(bookData.title)}">
                            </div>
                            <div class="mb-3">
                                <label for="editAuthor" class="form-label">Author</label>
                                <select class="form-select dropdown ui" id="editAuthor">
                                    ${Utils.formatValue(bookData.author_id)}
                                </select>
                            </div>
                             <div class="mb-3">
                                <label for="editEdition" class="form-label">Edition</label>
                                <input type="number" class="form-control ${(bookData.language_code === 'he') ? 'rtl' : 'ltr'}" id="editEdition" value="${Utils.formatValue(bookData.edition)}">
                            </div>
                             <div class="mb-3">
                                <label for="editVolume" class="form-label">Volume</label>
                                <input type="number" class="form-control" id="editVolume" value="${Utils.formatValue(bookData.volume)}">
                            </div>
                            <div class="mb-3">
                                <label for="editVolumeName" class="form-label">Volume Name</label>
                                <input type="text" class="form-control" id="editVolumeName" value="${Utils.formatValue(bookData.volume_name)}">
                            </div>
                            <div class="mb-3">
                                <label for="editType" class="form-label">Type</label>
                                <input type="text" class="form-control" id="editType" value="${Utils.formatValue(bookData.type)}">
                            </div>
                            <div class="mb-3">
                                <label for="editLanguage" class="form-label">Book Language</label>
                                <select class="dropdown ui" id="editLanguage">
                                    ${LanguagesSelect}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editNotes" class="form-label">Notes</label>
                                    <textarea class="form-control" id="editNotes">
                                         ${Utils.formatValue(bookData.notes)}
                                    </textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Classification & Publication</h5>
                            <div class="mb-3">
                              &nbsp;
                            </div>
                            <div class="mb-3">
                                <label for="editPublisher" class="form-label">Publisher</label>
                                <input type="text" class="form-control" id="editPublisher" value="${Utils.formatValue(bookData.publisher)}">
                            </div>
                            <!-- Add more input fields for other classification & publication details here -->
                        </div>
                    </div>
                    <!-- Add dropdowns for fields with _id suffix -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editBookCategory" class="form-label">Book Category</label>
                                <select class="form-select dropdown ui" id="editBookCategory">
                                    <!-- Populate options dynamically -->
                                </select>
                                <button type="button" class="btn btn-sm btn-primary mt-2" id="addBookCategory">Add New Category</button>
                            </div>
                        </div>
                        <!-- Add more dropdowns for other fields with _id suffix here -->
                    </div>
                </div>
            </form>
        `;

                $('#editBookContent').append(editModalContent);
                var Languages = [];
                var LanguagesSelect = '';
                System.getLanguages().done(function(response) {
                    Languages = response.map(function(language) {
                        var selected = (bookData.language_id === language.id) ? ' selected ' : '';
                        return `<option value="${language.id}" ${selected} >${language.name_lan}</option>`;
                    });
                    Languages.forEach(function(language) {
                        LanguagesSelect += language;
                    });
                    $('#editLanguage').append(LanguagesSelect);
                });
                var Shelves = [];
                var ShelvesSelect = '';
                Locations.getShelves().done(function(response) {
                    Shelves = response.map(function(shelf) {
                        var selected = (bookData.shelf_number_id === shelf.id) ? ' selected ' : '';
                        return `<option value="${shelf.id}" ${selected} >${shelf.name}</option>`;
                    });
                    Shelves.forEach(function(shelf) {
                        ShelvesSelect += shelf;
                    });
                    $('#editShelf').append(ShelvesSelect);
                });
                $('.dropdown').dropdown();
                Utils.hideSpinner();
                editModal.show();
            });
    },

    saveBook: function() {
        var formData = {
            // Collect form data
            title: $('#bookTitle').val(),
            // Include other fields here
        };

        // Example of updating the model. You'll need to adjust this to your application's needs
        var book = this.booksCollection.get(this.bookId);
        if (book) {
            book.save(formData, {
                success: function(model, response) {
                    // Handle success, e.g., showing a success message and closing the modal
                    $('#editBookModal').modal('hide');
                },
                error: function() {
                    // Handle errors, e.g., showing an error message
                }
            });
        }
    },
    validateSeferNumber: function(bookId = null) {
        var seferNumberValidation = $('#seferNumberValidation');
        var seferNumber = this.$('#editSeferNumber').val();
        var shelfId = this.$('#editShelf').val();

        this.model.validateSeferNumber(seferNumber, shelfId, bookId).then(
            function(response) {
                $('#editSeferNumber').data('valid', true); // Setting data attribute to true
                seferNumberValidation.removeClass('text-danger').addClass('text-success sm-2').html('<i class="bi bi-check-circle-fill"></i>');
            },
            function(error) {
                $('#editSeferNumber').data('valid', false); // Setting data attribute to false
                seferNumberValidation.removeClass('text-success').addClass('text-danger sm-2').html('<i class="bi bi-exclamation-circle-fill"></i> ' + error);
            }
        );
    }
});
