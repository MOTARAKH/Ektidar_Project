
<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-2">انشاء فورم</h1>

        <form action="{{ route('media.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf

            <input type="hidden" id="user_id" name="user_id" value="{{ auth()->id() }}">



            <div class="mb-4">
                <label for="type"
                    class="block text-sm font-medium text-gray-700">النوع</label>
                <input type="text" id="type" name="type" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="MediaOutlet"
                    class="block text-sm font-medium text-gray-700"> الوسيلة الاعلامية</label>
                <input type="text" id="MediaOutlet" name="MediaOutlet" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="topic"
                    class="block text-sm font-medium text-gray-700">الموضوع</label>
                <input type="text" id="topic" name="topic" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="ParticipatingParties"
                    class="block text-sm font-medium text-gray-700"> الجهات المشاركة</label>
                <input type="text" id="ParticipatingParties" name="ParticipatingParties" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div id="descriptions-container">
                <label for="description-1" class="block text-sm font-medium text-gray-700 mb-1 text-right">وصف</label>
                <div class="mb-4 flex items-center">
                    <button type="button" onclick="addDescriptionField()"
                        class="mr-4 text-indigo-600 hover:text-indigo-800 focus:outline-none">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            aria-hidden="true">
                            <path
                                d="M12 4.75a.75.75 0 0 1 .75.75v6.5h6.5a.75.75 0 0 1 0 1.5h-6.5v6.5a.75.75 0 0 1-1.5 0v-6.5H4.75a.75.75 0 0 1 0-1.5h6.5v-6.5A.75.75 0 0 1 12 4.75z" />
                        </svg>
                    </button>
                    <input type="text" id="description-1" name="descriptions[]" placeholder="اكتب الوصف هنا" dir="rtl"
                        class="form-input block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-right">
                </div>
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                Submit
            </button>
        </form>
    </div>

    <style>
        /* Container Styles */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.5rem;
        }

        /* Heading Styles */
        .container h1 {
            font-size: 1.875rem;
            /* Equivalent to text-3xl */
            font-weight: 600;
            /* Equivalent to font-semibold */
            color: #1f2937;
            /* Dark text color */
            margin-bottom: 1.5rem;
            /* Equivalent to mb-6 */
            border-bottom: 1px solid #e5e7eb;
            /* Light gray border at the bottom */
            padding-bottom: 0.5rem;
            /* Padding at the bottom */
            text-align: right;
            /* Right-aligned text */
        }

        /* Form Styles */
        form {
            background-color: #ffffff;
            /* White background */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Shadow */
            border-radius: 0.5rem;
            /* Rounded corners */
            padding: 1.5rem;
            /* Padding inside the form */
        }

        /* Input Styles */
        form input[type="text"],
        form input[type="hidden"] {
            width: 100%;
            border: 1px solid #d1d5db;
            /* Light gray border */
            border-radius: 0.375rem;
            /* Rounded corners */
            padding: 0.5rem;
            /* Padding inside the input */
            font-size: 0.875rem;
            /* Small font size */
            text-align: right;
            /* Right-aligned text */
        }

        /* Label Styles */
        form label {
            display: block;
            font-size: 0.875rem;
            /* Small font size */
            font-weight: 500;
            /* Medium font weight */
            color: #4b5563;
            /* Dark gray text color */
            margin-bottom: 0.25rem;
            /* Small margin at the bottom */
            text-align: right;
            /* Right-aligned text */
        }

        /* Descriptions Container */
        #descriptions-container {
            margin-bottom: 1.5rem;
        }

        #descriptions-container .flex {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        /* Button to Add Description Field */
        #descriptions-container button {
            margin-right: 1rem;
            color: #3b82f6;
            /* Blue text color */
            background-color: transparent;
            border: none;
            cursor: pointer;
            transition: color 0.15s ease-in-out;
        }

        #descriptions-container button:hover {
            color: #2563eb;
            /* Darker blue on hover */
        }

        /* Submit Button */
        form button[type="submit"] {
            width: 100%;
            background-color: #4f46e5;
            /* Indigo background */
            color: #ffffff;
            /* White text */
            padding: 0.5rem 1rem;
            /* Padding inside the button */
            border-radius: 0.375rem;
            /* Rounded corners */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Small shadow */
            cursor: pointer;
            transition: background-color 0.15s ease-in-out;
        }

        form button[type="submit"]:hover {
            background-color: #4338ca;
            /* Darker indigo on hover */
        }
    </style>

    <script>
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
    </script>
</x-app-layout>
