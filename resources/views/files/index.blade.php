<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">

        <h1 class="text-2xl font-bold mb-6">
            CloudBox Files
        </h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('files.store') }}"
            enctype="multipart/form-data"
            class="mb-6"
        >
            @csrf

            <input
                type="file"
                name="file"
                class="border p-2"
                required
            >

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded"
            >
                Upload
            </button>
        </form>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 text-left">File</th>
                    <th class="p-3 text-left">Size</th>
                    <th class="p-3 text-left">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($files as $file)
                    <tr class="border-t">
                        <td class="p-3">
                            {{ $file->original_name }}
                        </td>

                        <td class="p-3">
                            {{ number_format($file->size / 1024, 2) }} KB
                        </td>

                        <td class="p-3 flex gap-3">
                            <a
                                href="{{ route('files.download', $file) }}"
                                class="text-blue-600"
                            >
                                Download
                            </a>

                            <form
                                method="POST"
                                action="{{ route('files.destroy', $file) }}"
                                onsubmit="return confirm('Delete this file?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="text-red-600"
                                >
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-3">
                            No files found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</x-app-layout>