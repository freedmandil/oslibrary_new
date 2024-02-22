/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/forms.js ***!
  \*******************************/
function addRequiredFieldClass() {
  // Get all input and select elements with the required attribute
  var requiredFields = document.querySelectorAll('input[required], select[required]');

  // Iterate over each required field
  requiredFields.forEach(function (field) {
    // Find the corresponding input label
    var label = document.querySelector('label[for="' + field.id + '"]');

    // Add the cm-required-field class to the input label
    if (label) {
      label.classList.add('cm-required-field');
    }
  });
}
document.addEventListener("DOMContentLoaded", function () {
  addRequiredFieldClass();
});
/******/ })()
;