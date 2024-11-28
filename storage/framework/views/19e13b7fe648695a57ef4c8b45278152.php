<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - SMK Negeri 4 Bogor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-blue-500 text-white py-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center px-4">
            <div class="text-2xl font-bold">
                <a href="/" class="hover:opacity-80">Galeri SMK Negeri 4 Bogor</a>
            </div>
            <nav class="flex space-x-6">
                <a href="/" class="<?php echo e(request()->is('/') ? 'underline' : 'hover:underline'); ?>">Beranda</a>
                <a href="/galeri" class="<?php echo e(request()->is('galeri') ? 'underline' : 'hover:underline'); ?>">Galeri</a>
                <a href="/tentang" class="<?php echo e(request()->is('tentang') ? 'underline' : 'hover:underline'); ?>">Tentang</a>
                <a href="/kontak" class="<?php echo e(request()->is('kontak') ? 'underline' : 'hover:underline'); ?>">Kontak</a>
            </nav>
        </div>
    </header>

    <!-- Konten -->
    <div class="container mx-auto px-4 py-12 flex-grow">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl md:text-4xl font-bold text-center mb-4">Tentang Kami</h1>

            <?php $__currentLoopData = $profiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <h2 class="text-2xl md:text-3xl font-bold text-center text-blue-600 mb-8"><?php echo e($profile->judul); ?></h2>

            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <div class="text-gray-700">
                    <?php echo nl2br(e($profile->isi)); ?>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 SMK Negeri 4 Bogor. Semua Hak Dilindungi.</p>
        </div>
    </footer>
</body>

</html><?php /**PATH C:\MyProject\schoolensa\resources\views/tentang.blade.php ENDPATH**/ ?>