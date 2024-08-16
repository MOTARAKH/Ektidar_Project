<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-4xl font-bold mb-6"> المشاركات المختلفة</h1>
        <a href="{{ route('posts.create') }}"
            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-150 mb-6 inline-block">
            اضافة
        </a>

        @if ($posts->isEmpty())
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow-md">
                No posts available. Click the "Create New Post" button to add a post.
            </div>
        @else
            <div class="overflow-x-auto relative">
                <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                عنوان
                            </th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                الجهة
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                الجهات المشاركة
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                التفصيل
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                النسبة
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">

                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($posts as $media)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">{{ $media->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                    {{ $media->side }}</td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                    {{ $media->sidesParticipating }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @forelse ($media->descriptions as $description)
                                            <li>{{ $description->description }}</li>
                                        @empty
                                            <li>No descriptions</li>
                                        @endforelse
                                    </ul>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                    @isset($media->average_rating)
                                        {{ number_format($media->average_rating, 2) }}
                                    @else
                                        لا يوجد لحد الان
                                    @endisset
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                    <div class="flex space-x-1">
                                        <a href="{{ route('posts.show', $media) }}"
                                            class="bg-teal-500 text-white px-3 py-1 rounded-lg hover:bg-teal-600 transition duration-150 ml-1">
                                            <svg class="h-5 w-5 inline-block" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12H9m0 0l-3 3m3-3l3-3m6 3v3a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3M9 12h6" />
                                            </svg>
                                        </a>
                                        @if (!$media->finished == 1 || ($media->finished == 1 && Auth::user()->isAdmin == 1))
                                            <a href="{{ route('posts.edit', $media->id) }}"
                                                class="bg-yellow-600 text-white px-3 py-1 rounded-lg hover:bg-yellow-700 transition duration-150">
                                                <svg class="h-5 w-5 inline-block" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 20h9m0 0h-9m9 0V4m0 16v-8m0 8H3m3 0v-8m0 8v8" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('posts.destroy', $media->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition duration-150">
                                                    <svg class="h-5 w-5 inline-block" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        {{-- <!-- New Form Row -->
                        <tr id="create-row" class="bg-gray-50 hidden">
                            <td colspan="4" class="px-6 py-4">
                                <form id="create-form" action="{{ route('media.storeFromMediaIndex') }}"
                                    method="POST">
                                    @csrf

                                    <!-- Form fields -->

                                    <!-- Save button -->
                                    <button type="submit"
                                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                        Save
                                    </button>

                                    <!-- Hide button -->
                                    <button type="button" onclick="toggleCreateRow()"
                                        class="bg-gray-500 text-white p-2 rounded hover:bg-gray-600 absolute bottom-2 right-0 hidden"
                                        id="hided">
                                        <svg class="h-4 w-4 text-white-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
                <div>


                    <div class="mt-10 rtl">
                        <!-- Show button -->
                        <button type="button" onclick="toggleCreateRow()"
                            style="

                                display: inline-flex;
                                align-items: center;
                                justify-content: center;
                                padding: 0.5rem; /* p-2 */
                                border-radius: 0.375rem; /* rounded-lg */
                                background-color: #000000; /* bg-black-500 */
                                color: #ffffff; /* text-white */
                                position: absolute;
                                bottom: 0.5rem; /* bottom-2 */
                                right: 0.5rem; /* right-0 */
                                transition: background-color 0.15s ease-in-out;
                                border: none;
                                cursor: pointer;
                                            "
                            id="showed">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                style="
                            height: 1rem; /* h-4 */
                            width: 1rem; /* w-4 */
                            color: #ffffff; /* text-white */">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        @endif
    </div>

    <script>
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
        document.addEventListener("DOMContentLoaded", function() {
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
    </script>
</x-app-layout>
<style>
    /* General Styles for Container */
    .container {
        max-width: 100%;
        padding-left: 1rem;
        padding-right: 1rem;
        margin-left: auto;
        margin-right: auto;
    }

    /* Heading Styles */
    h1 {
        font-size: 2.25rem;
        /* 4xl */
        font-weight: 700;
        /* font-bold */
        margin-bottom: 1.5rem;
        /* mb-6 */
        text-align: right;
    }

    /* Button Styles */
    a,
    button {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        /* rounded-lg */
        text-align: center;
        font-size: 1rem;
        /* text-base */
        font-weight: 500;
        /* font-medium */
        text-decoration: none;
        transition: background-color 0.15s ease-in-out;
    }

    /* Add Button */
    a.bg-blue-600 {
        background-color: #2563eb;
        /* bg-blue-600 */
        color: white;
    }

    a.bg-blue-600:hover {
        background-color: #1d4ed8;
        /* bg-blue-700 */
    }

    /* Notification Box */
    .bg-yellow-100 {
        background-color: #fefcbf;
        /* bg-yellow-100 */
        color: #d97706;
        /* text-yellow-800 */
        padding: 1rem;
        /* p-4 */
        border-radius: 0.5rem;
        /* rounded-lg */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* shadow-md */
    }

    /* Table Styles */
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        border: 1px solid #e5e7eb;
        /* border-gray-300 */
        border-radius: 0.5rem;
        /* rounded-lg */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* shadow-md */
    }

    thead {
        background-color: #f3f4f6;
        /* bg-gray-100 */
    }

    thead th {
        padding: 0.75rem 1.5rem;
        /* px-6 py-3 */
        text-align: right;
        font-size: 0.75rem;
        /* text-xs */
        font-weight: 500;
        /* font-medium */
        color: #6b7280;
        /* text-gray-500 */
        text-transform: uppercase;
        border-right: 1px solid #d1d5db;
        /* border-r border-gray-300 */
    }

    tbody td {
        padding: 1rem 1.5rem;
        /* px-6 py-4 */
        border-right: 1px solid #d1d5db;
        /* border-r border-gray-300 */
        vertical-align: middle;
    }

    /* Description List */
    ul.list-disc {
        padding-left: 1.25rem;
        /* pl-5 */
        margin-bottom: 0;
    }

    ul.list-disc li {
        margin-bottom: 0.25rem;
        /* space-y-1 */
    }

    /* Action Buttons */
    .flex {
        display: flex;
        align-items: center;
    }

    .bg-teal-500 {
        background-color: #14b8a6;
        /* bg-teal-500 */
        color: white;
    }

    .bg-teal-500:hover {
        background-color: #0d9488;
        /* bg-teal-600 */
    }

    .bg-yellow-600 {
        background-color: #f59e0b;
        /* bg-yellow-600 */
        color: white;
    }

    .bg-yellow-600:hover {
        background-color: #eab308;
        /* bg-yellow-700 */
    }

    .bg-red-600 {
        background-color: #dc2626;
        /* bg-red-600 */
        color: white;
    }

    .bg-red-600:hover {
        background-color: #b91c1c;
        /* bg-red-700 */
    }

    .bg-green-600 {
        background-color: #16a34a;
        /* bg-green-600 */
        color: white;
    }

    .bg-green-600:hover {
        background-color: #15803d;
        /* bg-green-700 */
    }

    .bg-gray-500 {
        background-color: #6b7280;
        /* bg-gray-500 */
        color: white;
    }

    .bg-gray-500:hover {
        background-color: #4b5563;
        /* bg-gray-600 */
    }

    /* Form Styles */
    input[type="text"] {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #d1d5db;
        /* border-gray-300 */
        border-radius: 0.375rem;
        /* rounded-md */
        font-size: 0.875rem;
        /* sm:text-sm */
    }

    input[type="text"]:focus {
        border-color: #6366f1;
        /* focus:border-indigo-500 */
        box-shadow: 0 0 0 1px #6366f1;
        /* focus:ring-indigo-500 */
    }

    /* Flex Container for Descriptions */
    #descriptions-container {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    /* Hide and Show Buttons */
    button#showed,
    button#hided {
        position: absolute;
        bottom: 0.5rem;
        right: 0.5rem;
        padding: 0.5rem;
        border-radius: 0.375rem;
        /* rounded */
        color: white;
        transition: background-color 0.15s ease-in-out;
    }

    button#hided {
        display: none;
        /* hidden by default */
    }

    button#showed {
        display: block;
        /* show by default */
    }

    /* Responsive Utility */
    @media (max-width: 640px) {

        /* Mobile responsive adjustments */
        .rtl {
            direction: rtl;
        }
    }
</style>
