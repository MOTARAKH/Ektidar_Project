let descriptionCount = 1;

function addDescriptionField() {
    for (let i = 0; i < descriptionCount; i++) {
        const descriptionInput = document.getElementById(`description-${i+1}`);
        if (descriptionInput && !descriptionInput.value.trim()) {
            alert("Please fill in all previous descriptions before adding a new one.");
            return;
        }
    }
    const container = document.getElementById('descriptions-container');
    const newField = document.createElement('div');
    newField.classList.add('mb-4', 'flex', 'items-center');
    newField.innerHTML = `
        <input type="text" id="description-${descriptionCount}" name="descriptions[]" 
            placeholder="Description" 
            class="form-input block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
        <button type="button" onclick="removeDescriptionField(this)" 
            class="ml-3 bg-red-500 text-white p-2 rounded hover:bg-red-600 mr-1">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M6 6L18 18M18 6L6 18" />
            </svg>
        </button>
    `;
    container.appendChild(newField);
    descriptionCount++;
}

function removeDescriptionField(button) {
    button.parentElement.remove();
    descriptionCount--;
}
