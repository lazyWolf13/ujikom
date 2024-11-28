<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-200 to-blue-300 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-xl w-96">
        <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Tambah Post</h2>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <!-- Judul -->
            <div class="mb-6">
                <label for="judul" class="block text-gray-700 text-sm font-medium mb-2">Judul</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- Kategori -->
            <div class="mb-6">
                <label for="kategori_id" class="block text-gray-700 text-sm font-medium mb-2">Kategori</label>
                <select name="kategori_id" id="kategori_id" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($kategori as $category)
                    <option value="{{ $category->id }}">{{ $category->judul }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Isi -->
            <div class="mb-6">
                <label for="isi" class="block text-gray-700 text-sm font-medium mb-2">Isi</label>
                <textarea name="isi" id="isi" required rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('isi') }}</textarea>
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label for="status" class="block text-gray-700 text-sm font-medium mb-2">Status</label>
                <select name="status" id="status" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="archived">Archived</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-between items-center">
                <a href="{{ route('posts.index') }}"
                    class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    Simpan Post
                </button>
            </div>
        </form>
    </div>
</body>

</html>