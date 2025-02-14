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
                    <select id="month-select" name="month" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="" selected>Select a month</option>
                        @foreach (range(1, 12) as $month)
                            <option value="{{ $month }}">{{ \DateTime::createFromFormat('!m', $month)->format('F') }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-3 ">
                <a href="{{ route('forms.index') }}"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-150 mb-6 inline-block">
                    المتابعات
                </a>
                <a href="{{ route('receptions.index') }}"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-150 mb-6 inline-block">
                    الاستقبالات
                </a>
                <a href="{{ route('forms.index') }}"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-150 mb-6 inline-block">
                    الزيارات و التواصل
                </a>
                <a href="{{ route('forms.index') }}"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-150 mb-6 inline-block">
                    الحركة الاعلامية
                </a>
                <a href="{{ route('forms.index') }}"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-150 mb-6 inline-block">
                    الانشطة المختلفة
                </a>
                <a href="{{ route('forms.index') }}"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-150 mb-6 inline-block">
                    المشاركات المختلفة
                </a>
            </div>
        </div>

    </div>
<script src="{{ asset('js/dashboard/dashboard.js') }}" defer></script>
</x-app-layout>

