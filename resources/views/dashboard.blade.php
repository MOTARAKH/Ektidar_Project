<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in") }}
                    @if (Auth::user()->isAdmin == 1)
                        as an admin
                    @else
                        as a doctor
                    @endif
                </div>

            </div>

        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
            <!-- Display success message -->
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-lg shadow-md mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <label for="month-select" class="block text-sm font-medium text-gray-700">Choose the month:</label>
                    <select id="month-select" name="month"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="" selected>Select a month</option>
                        @foreach (range(1, 12) as $month)
                            <option value="{{ $month }}">
                                {{ \DateTime::createFromFormat('!m', $month)->format('F') }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- -->
            <div class="mt-3">
                <a href="{{ route('forms.index') }}"
                    style="background-color: #2563eb; color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; display: inline-block; margin-bottom: 1.5rem; transition: background-color 0.15s ease-in-out;"
                    onmouseover="this.style.backgroundColor='#1d4ed8';"
                    onmouseout="this.style.backgroundColor='#2563eb';">
                    المتابعات
                </a>
                <a href="{{ route('receptions.index') }}"
                    style="background-color: #2563eb; color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; display: inline-block; margin-bottom: 1.5rem; transition: background-color 0.15s ease-in-out;"
                    onmouseover="this.style.backgroundColor='#1d4ed8';"
                    onmouseout="this.style.backgroundColor='#2563eb';">
                    الاستقبالات
                </a>
                <a href="{{ route('visits.index') }}"
                    style="background-color: #2563eb; color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; display: inline-block; margin-bottom: 1.5rem; transition: background-color 0.15s ease-in-out;"
                    onmouseover="this.style.backgroundColor='#1d4ed8';"
                    onmouseout="this.style.backgroundColor='#2563eb';">
                    الزيارات و التواصل
                </a>
                <a href="{{ route('media.index') }}"
                    style="background-color: #2563eb; color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; display: inline-block; margin-bottom: 1.5rem; transition: background-color 0.15s ease-in-out;"
                    onmouseover="this.style.backgroundColor='#1d4ed8';"
                    onmouseout="this.style.backgroundColor='#2563eb';">
                    الحركة الاعلامية
                </a>
                <a href="{{ route('activities.index') }}"
                    style="background-color: #2563eb; color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; display: inline-block; margin-bottom: 1.5rem; transition: background-color 0.15s ease-in-out;"
                    onmouseover="this.style.backgroundColor='#1d4ed8';"
                    onmouseout="this.style.backgroundColor='#2563eb';">
                    الانشطة المختلفة
                </a>
                <a href="{{ route('posts.index') }}"
                    style="background-color: #2563eb; color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; display: inline-block; margin-bottom: 1.5rem; transition: background-color 0.15s ease-in-out;"
                    onmouseover="this.style.backgroundColor='#1d4ed8';"
                    onmouseout="this.style.backgroundColor='#2563eb';">
                    المشاركات المختلفة
                </a>
            </div>

        </div>

    </div>
    <script src="{{ asset('js/dashboard/dashboard.js') }}" defer></script>
</x-app-layout>
<style>
    /* General Styles */
body {
    font-family: 'Figtree', sans-serif;
    color: #1a202c;
}

/* Container Styles */
.py-12 {
    padding-top: 3rem;
    padding-bottom: 3rem;
}

.max-w-7xl {
    max-width: 80rem;
}

.mx-auto {
    margin-left: auto;
    margin-right: auto;
}

.sm\:px-6 {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
}

.lg\:px-8 {
    padding-left: 2rem;
    padding-right: 2rem;
}

/* Card Styles */
.bg-white {
    background-color: #ffffff;
}

.overflow-hidden {
    overflow: hidden;
}

.shadow-sm {
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}

.sm\:rounded-lg {
    border-radius: 0.5rem;
}

.p-6 {
    padding: 1.5rem;
}

.text-gray-900 {
    color: #1a202c;
}

/* Success Message Styles */
.bg-green-100 {
    background-color: #d1fae5;
}

.text-green-800 {
    color: #065f46;
}

.p-4 {
    padding: 1rem;
}

.rounded-lg {
    border-radius: 0.5rem;
}

.shadow-md {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.mb-4 {
    margin-bottom: 1rem;
}

/* Form and Input Styles */
.block {
    display: block;
}

.text-sm {
    font-size: 0.875rem;
}

.font-medium {
    font-weight: 500;
}

.text-gray-700 {
    color: #4a5568;
}

.mt-1 {
    margin-top: 0.25rem;
}

.w-full {
    width: 100%;
}

.border-gray-300 {
    border-color: #d2d6dc;
}

.rounded-md {
    border-radius: 0.375rem;
}

.shadow-sm {
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.focus\:border-indigo-500:focus {
    border-color: #5a67d8;
}

.focus\:ring-indigo-500:focus {
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.5);
}

.sm\:text-sm {
    font-size: 0.875rem;
}

/* Button Styles */
.mt-3 {
    margin-top: 0.75rem;
}

a.button-link {
    background-color: #2563eb;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    display: inline-block;
    margin-bottom: 1.5rem;
    transition: background-color 0.15s ease-in-out;
}

a.button-link:hover {
    background-color: #1d4ed8;
}

/* Additional Spacing */
.mt-2 {
    margin-top: 0.5rem;
}

</style>
