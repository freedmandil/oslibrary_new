function addRequiredFieldClass() {
    // Get all input and select elements with the required attribute
    const requiredFields = document.querySelectorAll('input[required], select[required]');

    // Iterate over each required field
    requiredFields.forEach(function (field) {
        // Find the corresponding input label
        const label = document.querySelector('label[for="' + field.id + '"]');

        // Add the cm-required-field class to the input label
        if (label) {
            label.classList.add('cm-required-field');
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    addRequiredFieldClass();

});
