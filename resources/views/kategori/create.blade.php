<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-200 to-blue-300">

    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-xl w-96">
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Tambah Kategori Baru</h2>

            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="judul" class="block text-gray-700 text-sm font-medium mb-2">Judul Kategori</label>
                    <input type="text" name="judul" id="judul"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan judul kategori" required>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('kategori.index') }}"
                        class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-200">Batal</a>
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">Tambah</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>