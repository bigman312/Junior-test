document.addEventListener('DOMContentLoaded', function () {
    const productType = document.getElementById('productType');
    const dynamicFields = document.querySelectorAll('.dynamic-field');

    function showRelevantFields() {
        dynamicFields.forEach(field => {
            field.style.display = 'none';
        });
        const selectedType = productType.value;
        if (selectedType) {
            const selectedField = document.getElementById(selectedType);
            if (selectedField) {
                selectedField.style.display = 'block';
            }
        }
    }

    productType.addEventListener('change', showRelevantFields);
    showRelevantFields();
});
