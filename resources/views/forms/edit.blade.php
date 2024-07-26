<x-app-layout>

    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg mt-2">
        <h1 class="text-2xl font-bold mb-4">تعديل</h1>

        <form action="{{ route('forms.update', $form->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Hidden user_id input -->
            <input type="hidden" name="user_id" value="{{ $form->user_id }}">

            <!-- Title input -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">الجهة</label>
                <input type="text" id="title" name="title" value="{{ $form->title }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Side input -->
            <div class="mb-4">
                <label for="side" class="block text-sm font-medium text-gray-700">الموضوع</label>
                <input type="text" id="side" name="side" value="{{ $form->side }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Descriptions -->
            <div id="descriptions-container" class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">التفصيل</label>

                @foreach ($form->descriptions as $index => $description)
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
                    Add Description
                </button>
            </div>
            <!-- Finished checkbox -->
            <div class="mb-4">
                <label for="finished" class="block text-sm font-medium text-gray-700">mark as finished form</label>
                <input type="checkbox" id="finished" name="finished" value="1"
                    class="mt-1 h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
            </div>
            <!-- Submit button -->
            <button type="submit" class="bg-green-500 text-white p-2 rounded hover:bg-green-600">
                Update Form
            </button>

            <!-- Back button -->
            <a href="{{ route('forms.index') }}" class="ml-4 bg-gray-500 text-white p-2 rounded hover:bg-gray-600">
                Back to Forms
            </a>
        </form>
    </div>

    <script>
        let descriptionCount = {{ $form->descriptions->count() }};
    </script>
    <script src="{{ asset('js/forms/edit.js') }}"></script>
</x-app-layout>
