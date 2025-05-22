document.addEventListener("DOMContentLoaded", function () {
    const typeSelect = document.getElementById('type');
    const descriptionInput = document.getElementById('description');

    if (typeSelect && descriptionInput) {
        typeSelect.addEventListener('change', function () {
            const selectedType = typeSelect.value;

            if (selectedType === '1') { // Phone
                descriptionInput.placeholder = '(11) 99999-9999';
                descriptionInput.pattern = "\\(\\d{2}\\) \\d{4,5}-\\d{4}";
                descriptionInput.title = "Phone must match (11) 99999-9999";
            } else if (selectedType === '0') { // Email
                descriptionInput.placeholder = 'example@mail.com';
                descriptionInput.pattern = "[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,}$";
                descriptionInput.title = "Enter a valid email address";
            } else {
                descriptionInput.placeholder = '';
                descriptionInput.pattern = '';
                descriptionInput.title = '';
            }
        });
    }
});
