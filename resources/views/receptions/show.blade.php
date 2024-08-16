<x-app-layout>
    <div class="container mx-auto p-6 rtl">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-3xl font-bold mb-4 text-right">تفاصيل النموذج</h1>

            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2 text-right">معلومات النموذج</h2>
                <div class="space-y-2 rtl">
                    <p><strong class="text-gray-600">المستخدم:</strong> <span class="text-gray-800">{{ Auth::user()->user_name }}</span></p>
                    <p><strong class="text-gray-600">الرقم التعريفي:</strong> <span class="text-gray-800">{{ $reception->id }}</span></p>
                    <p><strong class="text-gray-600">الجهة:</strong> <span class="text-gray-800">{{ $reception->side }}</span></p>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2 text-right">التفاصيل</h2>
                @if ($reception->descriptions->isEmpty())
                    <p class="text-gray-600 text-right">لا توجد تفاصيل متاحة.</p>
                @else
                    <ul class="space-y-2 rtl">
                        @foreach ($reception->descriptions as $description)
                            <li class="bg-gray-100 p-4 rounded-lg shadow-sm">
                                <p class="text-gray-800">{{ $description->description }}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            @if (Auth::user()->isAdmin === 1)
            <div class="mb-6 rating flex items-center">
                <!-- Star rating system -->
                @for ($i = 1; $i <= 5; $i++)
                    <svg class="h-5 w-5 cursor-pointer {{ $i <= $userRating ? 'text-yellow-500' : 'text-gray-300' }} mx-1" data-rating="{{ $i }}" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21 16.54 13.97 22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                @endfor
                <input type="hidden" name="rating" id="rating-input" value="{{ old('rating', $userRating) }}">
            </div>
            @endif
            <a href="{{ route('receptions.index') }}"
               class="inline-block bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-150 rtl">
                العودة إلى الاستقبالات
            </a>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ratingContainer = document.querySelector('.rating');

            if (ratingContainer) {
                const stars = ratingContainer.querySelectorAll('svg');
                const ratingInput = document.querySelector('input[name="rating"]');

                stars.forEach(star => {
                    star.addEventListener('click', function () {
                        const rating = this.getAttribute('data-rating');
                        updateRating(rating);
                    });

                    star.addEventListener('mouseover', function () {
                        const rating = this.getAttribute('data-rating');
                        highlightStars(rating);
                    });

                    star.addEventListener('mouseout', function () {
                        const currentRating = ratingInput.value;
                        highlightStars(currentRating);
                    });
                });

                function highlightStars(rating) {
                    stars.forEach(star => {
                        const starRating = star.getAttribute('data-rating');
                        star.classList.toggle('text-yellow-500', starRating <= rating);
                    });
                }

                function updateRating(rating) {
                    fetch('{{ route('ratings.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            rateable_id: '{{ $reception->id }}',
                            rateable_type: 'App\\Models\\Reception',
                            rating: rating
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            ratingInput.value = rating;
                        } else {
                            console.error('Rating update failed');
                        }
                    });
                }
            } else {
                console.error('Rating container not found');
            }
        });
    </script>
</x-app-layout>
<style>
    /* General container styling */
    .container {
        max-width: 800px;
        /* Adjust as needed */
        margin: auto;
        padding: 1.5rem;
        /* Adjust padding as needed */
    }

    /* Card styling */
    .bg-white {
        background-color: #ffffff;
        /* Card background color */
    }

    .shadow-md {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Card shadow */
    }

    .rounded-lg {
        border-radius: 0.5rem;
        /* Rounded corners */
    }

    .p-6 {
        padding: 1.5rem;
        /* Padding inside the card */
    }

    /* Heading styling */
    h1 {
        font-size: 1.875rem;
        /* Font size for main heading */
        font-weight: 700;
        /* Bold font weight */
        color: #1f2937;
        /* Text color */
        margin-bottom: 1rem;
        /* Space below heading */
        text-align: right;
        /* Right-align text */
    }

    h2 {
        font-size: 1.25rem;
        /* Font size for sub-headings */
        font-weight: 600;
        /* Semi-bold font weight */
        color: #1f2937;
        /* Text color */
        margin-bottom: 0.5rem;
        /* Space below sub-heading */
        text-align: right;
        /* Right-align text */
    }

    .star {
        color: gray;
    }

    .star.yellow {
        color: yellow;
    }


    /* Information section styling */
    .mb-6 {
        margin-bottom: 1.5rem;
        /* Space below each section */
    }

    .space-y-2>*+* {
        margin-top: 0.5rem;
        /* Space between items in the same container */
    }

    /* Text styling */
    .text-gray-600 {
        color: #4b5563;
        /* Gray text color */
    }

    .text-gray-800 {
        color: #1f2937;
        /* Darker gray text color */
    }

    /* List styling */
    ul {
        padding-left: 1.5rem;
        /* Padding for list */
    }

    /* List items styling */
    .bg-gray-100 {
        background-color: #f3f4f6;
        /* Background color for list items */
    }

    .p-4 {
        padding: 1rem;
        /* Padding inside list items */
    }

    .rounded-lg {
        border-radius: 0.5rem;
        /* Rounded corners */
    }

    .shadow-sm {
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        /* Subtle shadow */
    }

    /* Rating system styling */
    .rating {
        display: flex;
        align-items: center;
    }

    .rating svg {
        height: 1.25rem;
        /* Size of stars */
        width: 1.25rem;
        /* Size of stars */
        color: #d1d5db;
        /* Default star color */
        cursor: pointer;
        /* Pointer cursor on hover */
        transition: color 0.2s;
        /* Smooth color transition */
    }

    .text-yellow-500 {
        color: #f59e0b;
        /* Color for highlighted stars */
    }

    .text-gray-300 {
        color: #e5e7eb;
        /* Color for inactive stars */
    }

    /* Button styling */
    a {
        display: inline-block;
        padding: 0.5rem 1rem;
        /* Padding inside button */
        border-radius: 0.5rem;
        /* Rounded corners */
        font-size: 0.875rem;
        /* Font size */
        font-weight: 500;
        /* Medium font weight */
        text-align: center;
        cursor: pointer;
        /* Pointer cursor */
        text-decoration: none;
        /* Remove underline */
        transition: background-color 0.2s;
        /* Smooth transition */
    }

    /* Button specific styles */
    a.bg-gray-800 {
        background-color: #1f2937;
        /* Background color for button */
        color: #ffffff;
        /* Text color */
    }

    a.bg-gray-800:hover {
        background-color: #374151;
        /* Background color on hover */
    }
</style>
