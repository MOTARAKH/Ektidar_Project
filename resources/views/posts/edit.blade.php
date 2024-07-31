<x-app-layout>

    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg mt-2" dir="rtl">
        <h1 class="text-2xl font-bold mb-4">تعديل</h1>
        
        <form action="{{ route('media.update', $media->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Hidden user_id input -->
            <input type="hidden" name="user_id" value="{{ $media->user_id }}">


            <!-- Type input -->
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">النوع</label>
                <input type="text" id="type" name="type" value="{{ $media->type }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Media Outlet input -->
            <div class="mb-4">
                <label for="MediaOutlet" class="block text-sm font-medium text-gray-700">الوسيلة الإعلامية</label>
                <input type="text" id="MediaOutlet" name="MediaOutlet" value="{{ $media->MediaOutlet }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Topic input -->
            <div class="mb-4">
                <label for="topic" class="block text-sm font-medium text-gray-700">الموضوع</label>
                <input type="text" id="topic" name="topic" value="{{ $media->topic }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Participating Parties input -->
            <div class="mb-4">
                <label for="ParticipatingParties" class="block text-sm font-medium text-gray-700">الجهات المشاركة</label>
                <input type="text" id="ParticipatingParties" name="ParticipatingParties" value="{{ $media->ParticipatingParties }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Descriptions -->
            <div id="descriptions-container" class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">التفصيل</label>

                @foreach ($media->descriptions as $index => $description)
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
                    إضافة وصف
                </button>
            </div>
            <!-- Finished checkbox -->
            <div class="mb-4">
                <label for="finished" class="block text-sm font-medium text-gray-700">علامة منتهية</label>
                <input type="checkbox" id="finished" name="finished" value="1"
                    class="mt-1 h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
            </div>
            <!-- Submit button -->
            <button type="submit" class="bg-green-500 text-white p-2 rounded hover:bg-green-600">
                تحديث النموذج
            </button>

            <!-- Back button -->
            <a href="{{ route('media.index') }}" class="ml-4 bg-gray-500 text-white p-2 rounded hover:bg-gray-600">
                العودة إلى النماذج
            </a>
        </form>
    </div>

    <script>
        let descriptionCount = {{ $media->descriptions->count() }};
    </script>
    <script src="{{ asset('js/forms/edit.js') }}"></script>
</x-app-layout>
