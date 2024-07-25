function addDescriptionField() {
    const container = document.getElementById("descriptions-container");
    const newField = document.createElement("div");
    newField.classList.add("flex", "items-center", "mb-4");
    newField.id = `description-${descriptionCount}`;

    newField.innerHTML = `
            <input type="text" name="descriptions[]" 
                class="flex-1 block border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <button type="button" onclick="removeDescriptionField(${descriptionCount})" 
                class="ml-3 bg-red-500 text-white p-2 rounded hover:bg-red-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        `;

    container.appendChild(newField);
    descriptionCount++;
}

function removeDescriptionField(index) {
    const field = document.getElementById(`description-${index}`);
    if (field) {
        field.remove();
    }
}
