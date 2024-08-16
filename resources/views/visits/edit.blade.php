<x-app-layout>

    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg mt-2 rtl">
        <h1 class="text-2xl font-bold mb-4 text-right">تعديل</h1>

        <form action="{{ route('visits.update', $visit->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Hidden user_id input -->
            <input type="hidden" name="user_id" value="{{ $visit->user_id }}">

            <!-- Side input -->
            <div class="mb-4">
                <label for="side" class="block text-sm font-medium text-gray-700 text-right">الجهة</label>
                <input type="text" id="side" name="side" value="{{ $visit->side }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Descriptions -->
            <div id="descriptions-container" class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2 text-right">التفصيل</label>

                @foreach ($visit->descriptions as $index => $description)
                    <div class="flex items-center mb-4" id="description-{{ $index }}">
                        <input type="text" name="descriptions[]" value="{{ $description->description }}"
                            class="flex-1 block border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">

                        <!-- Remove button for each description -->
                        <button type="button" onclick="removeDescriptionField({{ $index }})"
                            class="ml-3 bg-red-500 text-white p-2 rounded hover:bg-red-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endforeach

                <!-- Add button -->
                <button type="button" onclick="addDescriptionField()"
                    class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 m-1">
                    <svg class="h-5 w-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    إضافة تفاصيل
                </button>
            </div>

            <!-- Finished checkbox -->
            <div class="mb-4">
                <label for="finished" class="block text-sm font-medium text-gray-700 text-right">علامة على النموذج بأنه مكتمل</label>
                <input type="checkbox" id="finished" name="finished" value="1"
                    class="mt-1 h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
            </div>

            <!-- Submit button -->
            <button type="submit" class="bg-green-500 text-white p-2 rounded hover:bg-green-600">
                تحديث النموذج
            </button>

            <!-- Back button -->
            <a href="{{ route('visits.index') }}" class="ml-4 bg-gray-500 text-white p-2 rounded hover:bg-gray-600">
                العودة إلى النماذج
            </a>
        </form>
    </div>

    <script>
        let descriptionCount = {{ $visit->descriptions->count() }};
    </script>
       <script>
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
    </script>
</x-app-layout>
<style>
    /* General container styling */
    .container {
        max-width: 800px;
        /* Adjust the width as needed */
        margin: auto;
        padding: 1.5rem;
        /* Adjust padding as needed */
        background-color: #ffffff;
        /* Background color */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Subtle shadow */
        border-radius: 0.5rem;
        /* Rounded corners */
    }

    /* Heading styling */
    h1 {
        font-size: 1.5rem;
        /* Adjust font size as needed */
        font-weight: 700;
        /* Bold font weight */
        color: #1f2937;
        /* Text color */
        margin-bottom: 1rem;
        /* Space below heading */
        text-align: right;
        /* Right-align text */
    }

    /* Form elements styling */
    form {
        display: flex;
        flex-direction: column;
    }

    label {
        font-size: 0.875rem;
        /* Font size for labels */
        font-weight: 500;
        /* Medium font weight */
        color: #4b5563;
        /* Label text color */
        text-align: right;
        /* Right-align labels */
        margin-bottom: 0.25rem;
        /* Space below label */
    }

    input[type="text"] {
        width: 100%;
        padding: 0.5rem;
        /* Padding inside input */
        border: 1px solid #d1d5db;
        /* Border color */
        border-radius: 0.375rem;
        /* Rounded corners */
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        /* Subtle shadow */
        transition: border-color 0.2s, box-shadow 0.2s;
        /* Smooth transition */
    }

    input[type="text"]:focus {
        border-color: #4f46e5;
        /* Focus border color */
        box-shadow: 0 0 0 1px #4f46e5;
        /* Focus shadow */
    }

    button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1rem;
        /* Padding inside button */
        border: none;
        border-radius: 0.375rem;
        /* Rounded corners */
        font-size: 0.875rem;
        /* Font size */
        font-weight: 500;
        /* Medium font weight */
        color: #ffffff;
        /* Text color */
        cursor: pointer;
        /* Pointer cursor */
        transition: background-color 0.2s;
        /* Smooth transition */
    }

    /* Specific button styling */
    button.bg-red-500 {
        background-color: #ef4444;
        /* Background color for remove button */
    }

    button.bg-red-500:hover {
        background-color: #dc2626;
        /* Background color on hover */
    }

    button.bg-blue-500 {
        background-color: #3b82f6;
        /* Background color for add button */
    }

    button.bg-blue-500:hover {
        background-color: #2563eb;
        /* Background color on hover */
    }

    button.bg-green-500 {
        background-color: #10b981;
        /* Background color for submit button */
    }

    button.bg-green-500:hover {
        background-color: #059669;
        /* Background color on hover */
    }

    button.bg-gray-500 {
        background-color: #6b7280;
        /* Background color for back button */
    }

    button.bg-gray-500:hover {
        background-color: #4b5563;
        /* Background color on hover */
    }

    /* Add margin-top to buttons */
    button.mt-1 {
        margin-top: 0.25rem;
        /* Adjust as needed */
    }

    /* Flex container styling for descriptions */
    #descriptions-container {
        margin-bottom: 1.5rem;
        /* Space below container */
    }

    .flex {
        display: flex;
    }

    .flex.items-center {
        align-items: center;
    }

    .mb-4 {
        margin-bottom: 1rem;
        /* Space below element */
    }

    /* Hide/show button styling */
    button#showed {
        position: absolute;
        bottom: 0.5rem;
        /* Space from bottom */
        right: 0.5rem;
        /* Space from right */
    }

    button#showed svg {
        height: 1rem;
        /* Icon size */
        width: 1rem;
        /* Icon size */
        color: #ffffff;
        /* Icon color */
    }
</style>

