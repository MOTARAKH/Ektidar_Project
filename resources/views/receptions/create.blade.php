
<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-2">انشاء فورم</h1>

        <form action="{{ route('receptions.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf

            <input type="hidden" id="user_id" name="user_id" value="{{ auth()->id() }}">



            <div class="mb-4">
                <label for="side" class="block text-sm font-medium text-gray-700 mb-1 text-right">جهة</label>
                <input type="text" id="side" name="side" required dir="rtl"
                    class="form-input block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-right">
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

    <script src="{{ asset('js/receptions/create.js') }}"></script>
</x-app-layout>
