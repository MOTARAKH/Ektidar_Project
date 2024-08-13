<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('مرحبا بكم') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- froms --}}
        <div class="container mx-auto px-4 py-6 rtl">
            <h1 class="text-4xl font-bold mb-6 text-right">المتابعات</h1>
            @if ($forms->isEmpty())
                <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow-md">
                    لا توجد نماذج متاحة. اضغط على زر "إضافة نموذج جديد" لإضافة نموذج.
                </div>
            @else
                <div class="overflow-x-auto relative rtl">
                    <table
                        class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                    ناشر
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                    الجهة
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                    الموضوع
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                    التفصيل
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                    نسبة الاعجاب
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($forms as $form)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                        {{ $form->user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">{{ $form->title }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">{{ $form->side }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @forelse ($form->descriptions as $description)
                                                <li>{{ $description->description }}</li>
                                            @empty
                                                <li>لا يوجد تفاصيل</li>
                                            @endforelse
                                        </ul>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                        @isset($form->average_rating)
                                            <div class="mb-6 rating flex items-center">
                                                <!-- Star rating system -->
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg class="h-5 w-5 cursor-pointer {{ $i <= $form->average_rating ? 'text-yellow-500' : 'text-gray-300' }} mx-1"
                                                        data-rating="{{ $i }}" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 17.27L18.18 21 16.54 13.97 22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                        @endisset
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                <div class="mt-4 rtl">
                    {{ $forms->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
        {{-- end forms --}}

        {{-- receptions --}}
        <div class="container mx-auto px-4 py-6 rtl">
            <h1 class="text-4xl font-bold mb-6 text-right">الاستقبالات</h1>
            @if ($receptions->isEmpty())
                <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow-md">
                    لا توجد نماذج متاحة
                </div>
            @else
                <div class="overflow-x-auto relative rtl">
                    <table
                        class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                    الجهة
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                    التفصيل
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                    نسبة الاعجاب
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($receptions as $reception)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                        {{ $reception->side }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @forelse ($reception->descriptions as $description)
                                                <li>{{ $description->description }}</li>
                                            @empty
                                                <li>لا يوجد تفاصيل</li>
                                            @endforelse
                                        </ul>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                        @isset($reception->average_rating)
                                            <div class="mb-6 rating flex items-center">
                                                <!-- Star rating system -->
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg class="h-5 w-5 cursor-pointer {{ $i <= $reception->average_rating ? 'text-yellow-500' : 'text-gray-300' }} mx-1"
                                                        data-rating="{{ $i }}" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 17.27L18.18 21 16.54 13.97 22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                        @endisset
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                <div class="mt-4 rtl">
                    {{ $receptions->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
        {{-- end receptions --}}

        {{-- medias --}}
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-4xl font-bold mb-6">الحركة الاعلامية</h1>
            @if ($medias->isEmpty())
                <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow-md">
                    لا توجد نماذج متاحة
                </div>
            @else
                <div class="overflow-x-auto relative">
                    <table
                        class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                    النوع
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                    الوسيلة الاعلامية
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                    الموضوع
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    الجهات المشاركة
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    التفصيل
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    النسبة
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($medias as $media)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                        {{ $media->type }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                        {{ $media->MediaOutlet }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                        {{ $media->topic }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                        {{ $media->ParticipatingParties }}</td>
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
                                            <div class="mb-6 rating flex items-center">
                                                <!-- Star rating system -->
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg class="h-5 w-5 cursor-pointer {{ $i <= $media->average_rating ? 'text-yellow-500' : 'text-gray-300' }} mx-1"
                                                        data-rating="{{ $i }}" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 17.27L18.18 21 16.54 13.97 22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                        @endisset
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $medias->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
        {{-- end medias --}}

        {{-- visits --}}
        <div class="container mx-auto px-4 py-6 rtl">
            <h1 class="text-4xl font-bold mb-6 text-right">الزيارات</h1>
            @if ($visits->isEmpty())
                <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow-md">
                    لا توجد نماذج متاحة
                </div>
            @else
                <div class="overflow-x-auto relative rtl">
                    <table
                        class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                    الجهة
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                    التفصيل
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                    نسبة الاعجاب
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($visits as $visit)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                        {{ $visit->side }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @forelse ($visit->descriptions as $description)
                                                <li>{{ $description->description }}</li>
                                            @empty
                                                <li>لا يوجد تفاصيل</li>
                                            @endforelse
                                        </ul>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                        @isset($visit->average_rating)
                                            <div class="mb-6 rating flex items-center">
                                                <!-- Star rating system -->
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg class="h-5 w-5 cursor-pointer {{ $i <= $visit->average_rating ? 'text-yellow-500' : 'text-gray-300' }} mx-1"
                                                        data-rating="{{ $i }}" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 17.27L18.18 21 16.54 13.97 22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                        @endisset
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                <div class="mt-4 rtl">
                    {{ $visits->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
        {{-- end visits --}}


        {{-- posts --}}
        <div class="container mx-auto px-4 py-6 rtl">posts</div>
        {{-- end posts --}}

        {{-- posts --}}
        <div class="container mx-auto px-4 py-6 rtl">activities</div>
        {{-- end posts --}}
    </div>

    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
        }

        /* Header Styles */
        .x-app-layout-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            /* Gray 800 */
            line-height: 1.75rem;
        }

        /* Container Styles */
        .container {
            max-width: 100%;
            padding-left: 1rem;
            padding-right: 1rem;
            margin-left: auto;
            margin-right: auto;
        }

        /* Section Titles */
        h1 {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: right;
        }

        /* Alerts */
        .bg-yellow-100 {
            background-color: #fefcbf;
        }

        .text-yellow-800 {
            color: #854d0e;
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

        /* Tables */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f3f4f6;
            /* Gray 100 */
        }

        thead th {
            padding: 1rem;
            text-align: right;
            font-size: 0.75rem;
            font-weight: 500;
            color: #6b7280;
            /* Gray 500 */
            text-transform: uppercase;
            border-right: 1px solid #d1d5db;
            /* Gray 300 */
        }

        tbody {
            background-color: #ffffff;
        }

        tbody td {
            padding: 1rem;
            border-right: 1px solid #d1d5db;
            /* Gray 300 */
        }

        /* RTL Support */
        .rtl {
            direction: rtl;
        }

        .rtl table {
            direction: rtl;
        }

        /* Rating Stars */
        .rating {
            display: flex;
            align-items: center;
        }

        .rating svg {
            fill: currentColor;
        }

        .text-yellow-500 {
            color: #f59e0b;
            /* Yellow 500 */
        }

        .text-gray-300 {
            color: #d1d5db;
            /* Gray 300 */
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .mb-6 {
            margin-bottom: 1.5rem;
        }
    </style>
</x-app-layout>
