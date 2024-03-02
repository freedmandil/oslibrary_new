// Import local bootstrap file which bootstraps various components and may import jQuery
module.imports = './bootstrap.js';

// Import jQuery globally
window.$ = window.jQuery = require('jquery');

// Import Bootstrap JavaScript (already done in your code, but let's keep it organized)
require('bootstrap/dist/css/bootstrap.min.css');
window.bootstrap = require('bootstrap/dist/js/bootstrap.bundle');

// Import ag-Grid library
Grid = require('ag-grid-community');

Library = {};
Library.Models = {};
Library.Collections = {};
