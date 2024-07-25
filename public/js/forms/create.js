let descriptionCount = 1;

function addDescriptionField() {
    // Find the last description input
    const lastDescription = document.getElementById(`description-${descriptionCount}`);
    
    // Check if the last description input is filled
    if (lastDescription.value.trim() === '') {
        alert('Please fill the previous description field before adding a new one.');
        return;
    }

    descriptionCount++;
    const container = document.getElementById('descriptions-container');
    const newField = document.createElement('div');
    newField.classList.add('mb-4', 'flex', 'items-center');
    newField.innerHTML = `
        <input type="text" id="description-${descriptionCount}" name="descriptions[]" 
            placeholder="Description" 
            class="form-input block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
        <button type="button" onclick="removeDescriptionField(this)" 
            class="ml-4 text-red-600 hover:text-red-800 focus:outline-none">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M6 6L18 18M18 6L6 18" />
            </svg>
        </button>
    `;
    container.appendChild(newField);
}

function removeDescriptionField(button) {
    button.parentElement.remove();
}