<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Galeri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-gradient-to-r from-blue-100 to-blue-200">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-1/6 bg-blue-600 text-white min-h-screen p-4">
            <div class="text-lg font-bold mb-6">Logo</div>
            <ul>
                <li class="mb-4">
                    <i class="fas fa-home mr-2"></i>
                    <a href="/dashboard" class="hover:underline">Dashboard</a>
                </li>
                <li class="mb-4">
                    <i class="fas fa-user-circle mr-2"></i>
                    <a href="<?php echo e(route('profile.index')); ?>" class="hover:underline">Profile</a> <!-- Profile link -->
                </li>
                <li class="mb-4">
                    <i class="fas fa-chart-line mr-2"></i>
                    <a href="<?php echo e(route('petugas.index')); ?>" class="hover:underline">Manajemen Akun</a>
                </li>
                <li class="mb-4">
                    <i class="fas fa-cogs mr-2"></i>
                    <a href="<?php echo e(route('kategori.index')); ?>" class="hover:underline">Kategori</a>
                </li>
                <li class="mb-4">
                    <i class="fas fa-users mr-2"></i>
                    <a href="<?php echo e(route('galery.index')); ?>" class="hover:underline">Galery</a>
                </li>
                <li class="mb-4">
                    <i class="fas fa-camera mr-2"></i>
                    <a href="<?php echo e(route('foto.index')); ?>" class="hover:underline">Foto</a>
                </li>
                <li class="mb-4">
                    <i class="fas fa-file-alt mr-2"></i>
                    <a href="<?php echo e(route('posts.index')); ?>" class="hover:underline">Post</a>
                </li>
                <!-- Logout Link -->
                <li class="mb-4">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    <a href="<?php echo e(route('logout')); ?>"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="hover:underline">Logout</a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <div class="w-5/6 p-6">
            <h1 class="text-2xl font-bold mb-4">Daftar Galeri</h1>

            <!-- Tambahkan form pencarian di bawah tombol Tambah Galeri -->
            <div class="mb-4 flex items-center justify-between">
                <a href="<?php echo e(route('galery.create')); ?>"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Tambah Galeri
                </a>

                <form action="<?php echo e(route('galery.index')); ?>" method="GET" class="flex gap-2">
                    <select name="status" class="border rounded px-3 py-2">
                        <option value="">Semua Status</option>
                        <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Active</option>
                        <option value="inactive" <?php echo e(request('status') == 'inactive' ? 'selected' : ''); ?>>Inactive
                        </option>
                    </select>
                    <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        <i class="fas fa-search mr-2"></i>Cari
                    </button>
                </form>
            </div>

            <!-- Gallery Table -->
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left">ID</th>
                        <th class="py-2 px-4 border-b text-left">Post</th>
                        <th class="py-2 px-4 border-b text-left">Position</th>
                        <th class="py-2 px-4 border-b text-left">Status</th>
                        <th class="py-2 px-4 border-b text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $galeries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $galery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?php echo e($galery->id); ?></td>
                        <td class="py-2 px-4 border-b"><?php echo e($galery->post->judul); ?></td>
                        <td class="py-2 px-4 border-b"><?php echo e($galery->position); ?></td>
                        <td class="py-2 px-4 border-b"><?php echo e($galery->status); ?></td>
                        <td class="py-2 px-4 border-b">
                            <a href="<?php echo e(route('galery.edit', $galery->id)); ?>"
                                class="text-blue-600 hover:underline mr-2">Edit</a>
                            <form action="<?php echo e(route('galery.destroy', $galery->id)); ?>" method="POST"
                                style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html><?php /**PATH C:\schoolensa\resources\views/galery/index.blade.php ENDPATH**/ ?>