<x-app-layout>
    <div style="max-width: 1200px; margin: 0 auto; padding: 1.5rem;">
        <h1 style="font-size: 1.875rem; font-weight: 600; color: #1f2937; margin-bottom: 1.5rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem; text-align: right;">
            انشاء فورم
        </h1>

        <form action="{{ route('forms.store') }}" method="POST" style="background-color: #ffffff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 0.5rem; padding: 1.5rem;">
            @csrf

            <input type="hidden" id="user_id" name="user_id" value="{{ auth()->id() }}">

            <div style="margin-bottom: 1rem;">
                <label for="title" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.25rem; text-align: right;">
                    عنوان
                </label>
                <input type="text" id="title" name="title" required dir="rtl"
                    style="width: 100%; border: 1px solid #d1d5db; border-radius: 0.375rem; padding: 0.5rem; font-size: 0.875rem; text-align: right;">
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="side" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.25rem; text-align: right;">
                    جهة
                </label>
                <input type="text" id="side" name="side" required dir="rtl"
                    style="width: 100%; border: 1px solid #d1d5db; border-radius: 0.375rem; padding: 0.5rem; font-size: 0.875rem; text-align: right;">
            </div>

            <div id="descriptions-container" style="margin-bottom: 1.5rem;">
                <label for="description-1" style="display: block; font-size: 0.875rem; font-weight: 500; color: #4b5563; margin-bottom: 0.25rem; text-align: right;">
                    وصف
                </label>
                <div style="margin-bottom: 1rem; display: flex; align-items: center;">
                    <button type="button" onclick="addDescriptionField()"
                        style="margin-right: 1rem; color: #3b82f6; background-color: transparent; border: none; cursor: pointer; transition: color 0.15s ease-in-out;"
                        onmouseover="this.style.color='#2563eb';"
                        onmouseout="this.style.color='#3b82f6';">
                        <svg style="width: 1.5rem; height: 1.5rem;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 4.75a.75.75 0 0 1 .75.75v6.5h6.5a.75.75 0 0 1 0 1.5h-6.5v6.5a.75.75 0 0 1-1.5 0v-6.5H4.75a.75.75 0 0 1 0-1.5h6.5v-6.5A.75.75 0 0 1 12 4.75z" />
                        </svg>
                    </button>
                    <input type="text" id="description-1" name="descriptions[]" placeholder="اكتب الوصف هنا" dir="rtl"
                        style="flex: 1; border: 1px solid #d1d5db; border-radius: 0.375rem; padding: 0.5rem; font-size: 0.875rem; text-align: right;">
                </div>
            </div>

            <button type="submit"
                style="width: 100%; background-color: #4f46e5; color: #ffffff; padding: 0.5rem 1rem; border-radius: 0.375rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); cursor: pointer; transition: background-color 0.15s ease-in-out;"
                onmouseover="this.style.backgroundColor='#4338ca';"
                onmouseout="this.style.backgroundColor='#4f46e5';">
                Submit
            </button>
        </form>
    </div>

    <script src="{{ asset('js/forms/create.js') }}"></script>
</x-app-layout>
