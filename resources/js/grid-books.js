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

// Assuming you can determine the user's language setting similarly in JavaScript
const columnDefs = Object.keys(columnTitleMap).map(key => ({
    field: key,
    headerName: columnTitleMap[key][userLanguage],
    hide: key === 'id' // Assuming you want to hide the ID column
}));
function populateGrid(data, columnDefs) {
    // Assuming you have initialized the grid instance
    const gridOptions = {
        columnDefs: columnDefs,
        rowData: data
    };

    // Assuming you have initialized the grid instance
    const gridDiv = document.querySelector('#Books_Grid');
    const gridApi = createGrid(...)
    new Grid.Grid(gridDiv, gridOptions)
}

const apiUrl = '/api/books/shelf_name/'; // URL to Laravel API endpoint
var url = '';
// Fetch data from Laravel API
$('.shelf_number').on('change', function() {
    // Get the selected value
    var selectedValue = $(this).val();

    // Construct the URL based on the selected value
     url = apiUrl + selectedValue;

    // Update the href attribute of the link to the constructed URL
fetch(url)
    .then(response => response.json())
    .then(data => {
        // Process fetched data
        const columnDefs = Object.keys(columnTitleMap).map(key => ({
            field: key,
            headerName: columnTitleMap[key][userLanguage],
            hide: key === 'id'
        }));

        // Assuming you have a function to populate your grid
        populateGrid(data, columnDefs);
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });
});
