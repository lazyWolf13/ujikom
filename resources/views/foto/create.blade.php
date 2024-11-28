<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Foto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-200 to-blue-300">

    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-xl w-96">
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Tambah Foto</h2>

            <form action="{{ route('foto.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Galeri Dropdown -->
                <div class="mb-6">
                    <label for="galery_id" class="block text-gray-700 text-sm font-medium mb-2">Galeri</label>
                    <select name="galery_id" id="galery_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                        <option value="">Pilih Galeri</option>
                        @foreach($galeries as $galery)
                        <option value="{{ $galery->id }}">{{ $galery->id }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Judul Foto -->
                <div class="mb-6">
                    <label for="judul" class="block text-gray-700 text-sm font-medium mb-2">Judul Foto</label>
                    <input type="text" name="judul" id="judul"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan judul foto" required>
                </div>

                <!-- Upload Foto -->
                <div class="mb-6">
                    <label for="file" class="block text-gray-700 text-sm font-medium mb-2">Upload Foto</label>
                    <input type="file" name="file" id="file"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        accept="image/*" required>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('foto.index') }}"
                        class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-200">Cancel</a>
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>