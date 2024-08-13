<x-app-layout>
    <div class="container mx-auto p-6 rtl">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-3xl font-bold mb-4 text-right">تفاصيل الزيارة</h1>

            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2 text-right">معلومات الزيارة</h2>
                <div class="space-y-2 rtl">
                    <p><strong class="text-gray-600">الرقم التعريفي:</strong> <span class="text-gray-800">{{ $visit->id }}</span></p>
                    <p><strong class="text-gray-600">الجهة:</strong> <span class="text-gray-800">{{ $visit->side }}</span></p>
                    <p><strong class="text-gray-600">المستخدم:</strong></p>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2 text-right">التفاصيل</h2>
                @if ($visit->descriptions->isEmpty())
                    <p class="text-gray-600 text-right">لا توجد تفاصيل متاحة.</p>
                @else
                    <ul class="space-y-2 rtl">
                        @foreach ($visit->descriptions as $description)
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
            <a href="{{ route('visits.index') }}"
               class="inline-block bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-150 rtl">
                العودة إلى الزيارات
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
                            rateable_id: '{{ $visit->id }}',
                            rateable_type: 'App\\Models\\Visit',
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
