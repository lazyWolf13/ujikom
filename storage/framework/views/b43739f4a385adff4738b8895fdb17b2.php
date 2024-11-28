<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Profile</title>
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
            <h1 class="text-2xl font-bold mb-4">Daftar Profile</h1>

            <!-- Button to Add New Profile -->
            <div class="mb-4">
                <a href="<?php echo e(route('profile.create')); ?>"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Tambah Profile
                </a>
            </div>

            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-center">ID</th>
                        <th class="py-2 px-4 border-b text-center">Judul</th>
                        <th class="py-2 px-4 border-b text-center">Isi</th>
                        <th class="py-2 px-4 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $profiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $profile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="py-2 px-4 border-b text-center"><?php echo e($index + 1); ?></td>
                        <td class="py-2 px-4 border-b text-center"><?php echo e($profile->judul); ?></td>
                        <td class="py-2 px-4 border-b text-center"><?php echo e(\Str::limit($profile->isi, 50)); ?></td>
                        <td class="py-2 px-4 border-b text-center">
                            <a href="<?php echo e(route('profile.edit', $profile->id)); ?>"
                                class="text-blue-600 hover:underline mr-4">Edit</a>
                            <form action="<?php echo e(route('profile.destroy', $profile->id)); ?>" method="POST"
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

</html><?php /**PATH C:\MyProject\schoolensa\resources\views/profile/index.blade.php ENDPATH**/ ?>