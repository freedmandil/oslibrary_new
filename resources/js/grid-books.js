
const columnTitleMap = {
    id: { en: "ID", he: "" }, // Assuming you're not displaying the ID, hence empty string for Hebrew
    title: { en: "Title", he: "שם" },
    author: { en: "Author", he: "מחבר" },
    shelfNumber: { en: "Shelf Number", he: "מספר תא" },
    seferNumber: { en: "Sefer Number", he: "מספר ספר" },
    edition: { en: "Edition", he: "מדורה" },
    publisher: { en: "Publisher", he: "מוצי לאור" },
    type: { en: "Type", he: "סוג" },
    topic: { en: "Topic", he: "נושא" },
    classRef: { en: "Class Ref", he: "אות נושא" },
    classNumber: { en: "Class Number", he: "מספר נושא" },
    referenceId: { en: "Reference ID", he: "מספר כללי" },
    language: { en: "Language", he: "שפה" },
    barcode: { en: "Barcode", he: "ברכוד" },
    assignment: { en: "Assignment", he: "מקום" },
    dateUpdated: { en: "Date Updated", he: "תאריך שינוי" }
};

const columnDefs = Object.keys(columnTitleMap).map(key => {
    let field = (key === 'topic' || key === 'publisher' || key === 'assignment') ? key + '_' + userLanguage : key;
    return {
        field: field,
        headerName: columnTitleMap[key][userLanguage],
        hide: key === 'id' // Assuming you want to hide the ID column
    };
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
function populateGrid(data, columnDefs) {
    var enable_rtl = (userLanguage == 'he');
    // Assuming you have initialized the grid instance
    const gridOptions = {
        columnDefs: columnDefs,
        rowData: data,
        enableRtl: enable_rtl,

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

    // Update the href attribute of the link to the constructed URL
    fetch(url)
        .then(response => response.json())
        .then(data => {
            // Process fetched data
            data.forEach(item => {
                // Concatenate 'author_first' and 'author_last' and assign it to 'author' field
                var author_first = (item.author_first) ? item.author_first : '',
                    author_last = (item.author_last) ? item.author_last : '';
                item.author = author_first + ' ' + author_last;
            });

            // Now 'data' contains the 'author' field with concatenated values
            const columnDefs = Object.keys(columnTitleMap).map(key => {
                let field = (key === 'topic' || key === 'publisher' || key === 'assignment') ? key + '_' + userLanguage : key;
                return {
                    field: field,
                    headerName: columnTitleMap[key][userLanguage],
                    hide: key === 'id'
                };
            });

            // Populate the grid with modified data and column definitions
            populateGrid(data, columnDefs);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
});
