<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard</title>
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
        <main class="w-5/6 p-6">
            <!-- Header -->
            <header class="flex justify-between items-center mb-6">
                <div class="text-gray-600">Dashboard / Overview</div>
                <div class="flex items-center">
                    <i class="fas fa-bell text-gray-600 mr-4"></i>
                    <div class="flex items-center">
                        <!-- Ganti dengan foto petugas yang login -->
                        <img alt="User Avatar" class="rounded-full mr-2" height="30"
                            src="https://storage.googleapis.com/a1aa/image/buNUenUKHJzVdKDeWkzjknNGSnZJHTnlwoz0T2u4dzbgE2rTA.jpg"
                            width="30" />
                        <!-- Menampilkan username petugas yang login -->
                        <span class="text-gray-600"><?php echo e(Auth::user()->username); ?></span>
                    </div>
                </div>
            </header>

            <!-- Cards -->
            <section class="grid grid-cols-4 gap-4 mb-6">
                <div class="bg-blue-500 text-white p-4 rounded-lg">
                    <div class="text-lg">Total Posts</div>
                    <div class="text-2xl font-bold"><?php echo e(App\Models\Post::count()); ?></div>
                    <div class="text-sm">Total Artikel</div>
                </div>
                <div class="bg-indigo-500 text-white p-4 rounded-lg">
                    <div class="text-lg">Total Kategori</div>
                    <div class="text-2xl font-bold"><?php echo e(App\Models\Kategori::count()); ?></div>
                    <div class="text-sm">Jumlah Kategori</div>
                </div>
                <div class="bg-pink-500 text-white p-4 rounded-lg">
                    <div class="text-lg">Total Galeri</div>
                    <div class="text-2xl font-bold"><?php echo e(App\Models\Galery::count()); ?></div>
                    <div class="text-sm">Jumlah Galeri</div>
                </div>
                <div class="bg-green-500 text-white p-4 rounded-lg">
                    <div class="text-lg">Total Foto</div>
                    <div class="text-2xl font-bold"><?php echo e(App\Models\Foto::count()); ?></div>
                    <div class="text-sm">Jumlah Foto</div>
                </div>
            </section>

            <!-- Tambahkan section baru untuk detail kategori -->
            <section class="bg-white p-6 rounded-lg shadow mb-6">
                <h2 class="text-xl font-bold mb-4">Statistik Kategori</h2>
                <div class="grid grid-cols-3 gap-4">
                    <?php $__currentLoopData = App\Models\Kategori::withCount('posts')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <div class="text-lg font-semibold"><?php echo e($kategori->judul); ?></div>
                        <div class="text-2xl font-bold text-blue-600"><?php echo e($kategori->posts_count); ?></div>
                        <div class="text-sm text-gray-600">Artikel</div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>

            <!-- Tambahkan section untuk status post -->
            <section class="bg-white p-6 rounded-lg shadow mb-6">
                <h2 class="text-xl font-bold mb-4">Status Artikel</h2>
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-yellow-100 p-4 rounded-lg">
                        <div class="text-lg font-semibold">Draft</div>
                        <div class="text-2xl font-bold text-yellow-600">
                            <?php echo e(App\Models\Post::where('status', 'draft')->count()); ?>

                        </div>
                        <div class="text-sm text-gray-600">Artikel</div>
                    </div>
                    <div class="bg-green-100 p-4 rounded-lg">
                        <div class="text-lg font-semibold">Published</div>
                        <div class="text-2xl font-bold text-green-600">
                            <?php echo e(App\Models\Post::where('status', 'published')->count()); ?>

                        </div>
                        <div class="text-sm text-gray-600">Artikel</div>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <div class="text-lg font-semibold">Archived</div>
                        <div class="text-2xl font-bold text-gray-600">
                            <?php echo e(App\Models\Post::where('status', 'archived')->count()); ?>

                        </div>
                        <div class="text-sm text-gray-600">Artikel</div>
                    </div>
                </div>
            </section>


        </main>
    </div>
</body>

</html><?php /**PATH C:\MyProject\schoolensa\resources\views/dashboard.blade.php ENDPATH**/ ?>