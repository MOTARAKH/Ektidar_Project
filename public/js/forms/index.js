let descriptionCount = 1;

function addDescriptionField() {
    const container = document.getElementById("descriptions-container");
    for (let i = 0; i < descriptionCount; i++) {
        const descriptionInput = document.querySelector(
            `#description-${i} input`
        );
        if (!descriptionInput.value.trim()) {
            alert(
                "Please fill in all previous descriptions before adding a new one."
            );
            return;
        }
    }

    descriptionCount++;
    const newField = document.createElement("div");
    newField.classList.add("flex", "items-center", "mb-4");
    newField.id = `description-${descriptionCount - 1}`;
    newField.innerHTML = `
            <input type="text" name="descriptions[]" class="flex-1 block border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <button type="button" onclick="removeDescriptionField(${
                descriptionCount - 1
            })" class="ml-3 bg-red-500 text-white p-2 rounded hover:bg-red-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        `;
    container.appendChild(newField);
}

function removeDescriptionField(id) {
    const field = document.getElementById(`description-${id}`);
    if (field) {
        field.remove();
    }
}
document.addEventListener("DOMContentLoaded", function () {
    const createRow = document.getElementById("create-row");
    const showButton = document.getElementById("showed");
    const hideButton = document.getElementById("hided");

    function toggleCreateRow() {
        if (createRow.classList.contains("hidden")) {
            createRow.classList.remove("hidden");
            showButton.classList.add("hidden");
            hideButton.classList.remove("hidden");
        } else {
            createRow.classList.add("hidden");
            showButton.classList.remove("hidden");
            hideButton.classList.add("hidden");
        }
    }

    showButton.addEventListener("click", toggleCreateRow);
    hideButton.addEventListener("click", toggleCreateRow);
});
