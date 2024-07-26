<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-4xl font-bold mb-6">الزيارات و التواصل</h1>
        <a href="{{ route('visits.create') }}"
            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-150 mb-6 inline-block">
            Create New Form
        </a>

        @if ($visits->isEmpty())
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow-md">
                No forms available. Click the "Create New Form" button to add a form.
            </div>
        @else
            <div class="overflow-x-auto relative">
                <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                الجهة
                            </th>

                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                التفصيل
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                أجراءات
                            </th>
                        </tr>

                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($visits as $visit)
                            <tr>

                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">{{ $visit->side }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @forelse ($visit->descriptions as $description)
                                            <li>{{ $description->description }}</li>
                                        @empty
                                            <li>No descriptions</li>
                                        @endforelse
                                    </ul>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-1">
                                        <a href="{{ route('visits.show', $visit) }}"
                                            class="bg-teal-500 text-white px-3 py-1 rounded-lg hover:bg-teal-600 transition duration-150">
                                            <svg class="h-5 w-5 inline-block" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12H9m0 0l-3 3m3-3l3-3m6 3v3a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3M9 12h6" />
                                            </svg>
                                        </a>
                                        @if (!$visit->finished == 1 || ($visit->finished == 1 && Auth::user()->isAdmin == 1))
                                            <a href="{{ route('visits.edit', $visit) }}"
                                                class="bg-yellow-600 text-white px-3 py-1 rounded-lg hover:bg-yellow-700 transition duration-150">
                                                <svg class="h-5 w-5 inline-block" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 20h9m0 0h-9m9 0V4m0 16v-8m0 8H3m3 0v-8m0 8v8" />
                                                </svg>
                                            </a>
                                        @endif
                                        <form action="{{ route('visits.destroy', $visit) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition duration-150">
                                                <svg class="h-5 w-5 inline-block" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        <!-- New Form Row -->
                        <tr id="create-row" class="bg-gray-50 hidden">
                            <td colspan="4" class="px-6 py-4">
                                <form id="create-form" action="{{ route('visits.storeFromVisitIndex') }}" method="POST">
                                    @csrf


                                    <!-- Side input -->
                                    <div class="mb-4">
                                        <label for="side"
                                            class="block text-sm font-medium text-gray-700">الجهة</label>
                                        <input type="text" id="side" name="side" required
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <!-- Descriptions -->
                                    <div id="descriptions-container" class="mb-6">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">التفصيل</label>

                                        <div class="flex items-center mb-4" id="description-0">
                                            <input type="text" name="descriptions[]"
                                                class="flex-1 block border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <button type="button" onclick="removeDescriptionField(0)"
                                                class="ml-3 bg-red-500 text-white p-2 rounded hover:bg-red-600">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Add button -->
                                        <button type="button" onclick="addDescriptionField()"
                                            class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Save button -->
                                    <button type="submit"
                                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                        Save
                                    </button>

                                    <!-- Hide button -->
                                    <button type="button" onclick="toggleCreateRow()"
                                        class="bg-gray-500 text-white p-2 rounded hover:bg-gray-600 absolute bottom-2 right-2 hidden"
                                        id="hided">
                                        <svg class="h-4 w-4 text-white-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-10">
                    <!-- Show button -->
                <button type="button" onclick="toggleCreateRow()"
                class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 absolute bottom-2 right-2 "
                id="showed">
                <svg class="h-4 w-4 text-white-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                </svg>
                </button>
                </div>

            </div>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $visits->links('pagination::tailwind') }}
            </div>
        @endif
    </div>

    <script src="{{ asset('js/forms/index.js') }}"></script>
</x-app-layout>
