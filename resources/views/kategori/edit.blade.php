    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Kategori</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-gradient-to-r from-blue-100 to-blue-300">

        <div class="flex justify-center items-center min-h-screen p-6">
            <div class="w-full max-w-lg bg-white p-10 rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold mb-8 text-center text-blue-600">Edit Kategori</h1>

                <form action="{{ route('kategori.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="judul" class="block text-sm font-medium text-gray-700">Judul Kategori</label>
                        <input type="text" name="judul" id="judul" value="{{ $category->judul }}"
                            class="mt-1 block w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan judul kategori" required>
                    </div>

                    <div class="mb-6">
                        <button type="submit"
                            class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 ease-in-out">
                            Perbarui Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </body>

    </html>