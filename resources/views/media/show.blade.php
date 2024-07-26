<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-3xl font-bold mb-4">Media Details</h1>

            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Form Information</h2>
                <div class="space-y-2">
                    <p>
                        <strong class="text-gray-600">ID:</strong>
                        <span class="text-gray-800">{{ $media->id }}</span>
                    </p>

                    <p><strong class="text-gray-600">User:</strong>
                        {{-- <a href="{{ route('users.show', $form->user_id) }}" class="text-blue-500 hover:underline">{{ $form->user->name }}</a> --}}
                    </p>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Descriptions</h2>
                @if ($media->descriptions->isEmpty())
                    <p class="text-gray-600">No descriptions available.</p>
                @else
                    <ul class="space-y-2">
                        @foreach ($media->descriptions as $description)
                            <li class="bg-gray-100 p-4 rounded-lg shadow-sm">
                                <p class="text-gray-800">{{ $description->description }}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <a href="{{ route('media.index') }}"
                class="inline-block bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-150">Back
                to Forms</a>
        </div>
    </div>
</x-app-layout>
