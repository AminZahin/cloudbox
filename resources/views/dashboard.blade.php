<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold mb-6">CloudBox Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white p-6 rounded shadow">
                <p class="text-gray-500">Total Files</p>
                <h2 class="text-3xl font-bold">{{ $totalFiles }}</h2>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <p class="text-gray-500">Storage Used</p>
                <h2 class="text-3xl font-bold">
                    {{ number_format($storageUsed / 1024 / 1024, 2) }} MB
                </h2>
            </div>
        </div>

        <div class="bg-white rounded shadow">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="font-bold">Recent Uploads</h2>
                <a href="{{ route('files.index') }}" class="text-blue-600">
                    View Files
                </a>
            </div>

            <div class="p-4">
                @forelse($recentFiles as $file)
                    <div class="flex justify-between py-2 border-b">
                        <span>{{ $file->original_name }}</span>
                        <span class="text-gray-500">
                            {{ number_format($file->size / 1024, 2) }} KB
                        </span>
                    </div>
                @empty
                    <p class="text-gray-500">No uploads yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>