<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Foto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-200 to-blue-300 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-xl w-96">
        <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Edit Foto</h2>

        <form action="<?php echo e(route('foto.update', $foto)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Pilih Galeri -->
            <div class="mb-6">
                <label for="galery_id" class="block text-gray-700 text-sm font-medium mb-2">Galeri</label>
                <select name="galery_id" id="galery_id"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                    <option value="">Pilih Galeri</option>
                    <?php $__currentLoopData = $galeries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $galery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($galery->id); ?>" <?php if($foto->galery_id == $galery->id): ?> selected <?php endif; ?>>
                        <?php echo e($galery->id); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Upload Foto -->
            <div class="mb-6">
                <label for="file" class="block text-gray-700 text-sm font-medium mb-2">Upload Foto Baru</label>
                <input type="file" name="file" id="file"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-sm text-gray-500 mt-2">Kosongkan jika tidak ingin mengganti foto.</p>
            </div>

            <!-- Judul Foto -->
            <div class="mb-6">
                <label for="judul" class="block text-gray-700 text-sm font-medium mb-2">Judul Foto</label>
                <input type="text" name="judul" id="judul" value="<?php echo e($foto->judul); ?>"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <!-- Tombol Action -->
            <div class="flex justify-end space-x-4">
                <a href="<?php echo e(route('foto.index')); ?>"
                    class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    Update
                </button>
            </div>
        </form>
    </div>
</body>

</html><?php /**PATH C:\schoolensa\resources\views/foto/edit.blade.php ENDPATH**/ ?>