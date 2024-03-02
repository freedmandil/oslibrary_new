
const columnTitleMap = {
    id: { en: "ID", he: "" },
    title: { en: "Title", he: "שם" },
    subtitle: { en: "Subtitle", he: "שם שניה" },
    author: { en: "Author", he: "מחבר" },
    volume: { en: "Vol.", he: "חלק" },
    volume_name: { en: "Vol. Name", he: "מסכתא" },
    shelfNumber: { en: "Shelf Number", he: "מספר תא" },
    seferNumber: { en: "Sefer Number", he: "מספר ספר" },
    BookRef: { en: "Book Reference", he: "מספר יסודי" },
    barcode: { en: "Barcode", he: "ברקוד" },
    edition: { en: "Edition", he: "מדורה" },
    topic: { en: "Topic", he: "נושא" },
    language: { en: "Language", he: "שפה" },
    assignment: { en: "Assignment", he: "מקום" },
    dateUpdated: { en: "Date Updated", he: "תאריך שינוי" }
};

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

function removeGrid() {
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
}
options = {};
function viewBook(id) {
    // Logic to view the record
    var bookModal = new bootstrap.Modal('#viewBook', options)
        bookModal.show();
    $('#bookContent').remove();
    $('#bookContainer').append('<div id="bookContent"></div>');
    $('#bookContent').append('<h3>Book: '+id+'</h3>');


}

function editRecord(id) {
    // Logic to edit the record
    console.log('Editing record', id);
}

function deleteRecord(id) {
    // Logic to delete the record
    console.log('Deleting record', id);
}

function addActionsColumn(columnDefs, userAccessLevel) {
    const actionsColumn = {
        field: "action",
        headerName: "Actions",
        cellRenderer: function(params) {
            let buttons = '<button onclick="viewBook(' + params.data.id + ')" class="btn btn-primary btn-sm">View</button>';


            if (userAccessLevel >= 5) {
                buttons += '&nbsp;&nbsp;<button onclick="editRecord(' + params.data.id + ')" class="btn btn-success btn-sm">Edit</button>';
            }

            if (userAccessLevel >= 7) {
                buttons += '&nbsp;&nbsp;<button onclick="deleteRecord(' + params.data.id + ')" class="btn btn-danger btn-sm">Delete</button>';
            }

            return buttons;
        },
        // adjust this as needed (e.g., set cell style or width)
    };

    columnDefs.push(actionsColumn);
    return columnDefs;
}
function populateGrid(data, columnDefs) {
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
    var gridDiv = document.querySelector('#Books_Grid');
    Grid.createGrid(gridDiv, gridOptions);

}

const apiUrl = '/api/books/shelf_name/'; // URL to Laravel API endpoint
var gridDiv = document.querySelector('#Books_Grid');

var url = '';
// Fetch data from Laravel API
$('.shelf_number').on('change', function() {
    removeGrid();
    // Get the selected value
    var selectedValue = $(this).val();

    // Construct the URL based on the selected value
     url = apiUrl + selectedValue;
    Utils.showSpinner();
    // Update the href attribute of the link to the constructed URL
    fetch(url)
        .then(response => response.json())
        .then(data => {
            // Process fetched data
            data.forEach(item => {
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
            Utils.hideSpinner();
            populateGrid(data, columnDefs);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
});

