document.addEventListener('DOMContentLoaded', function () {
    const monthSelect = document.getElementById('month-select');
    
    monthSelect.addEventListener('change', function () {
        const selectedMonth = this.value;
        
        // Create a form element dynamically
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/storeMonth'; // Adjust the route as needed
        
        // Add CSRF token as a hidden input
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken;
        form.appendChild(csrfInput);

        // Add selected month as a hidden input
        const monthInput = document.createElement('input');
        monthInput.type = 'hidden';
        monthInput.name = 'month';
        monthInput.value = selectedMonth;
        form.appendChild(monthInput);
        
        // Append form to body and submit
        document.body.appendChild(form);
        form.submit();
    });
});
