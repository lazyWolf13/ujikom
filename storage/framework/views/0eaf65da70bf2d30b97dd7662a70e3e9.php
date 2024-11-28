<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-200 to-blue-300 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-xl w-96">
        <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Edit Profile</h2>

        <!-- Error Messages -->
        <?php if($errors->any()): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
            <ul class="list-disc list-inside">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        <form action="<?php echo e(route('profile.update', $profile->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Title Input -->
            <div class="mb-6">
                <label for="judul" class="block text-gray-700 text-sm font-medium mb-2">Title</label>
                <input type="text" id="judul" name="judul" value="<?php echo e(old('judul', $profile->judul)); ?>" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- Content Input -->
            <div class="mb-6">
                <label for="isi" class="block text-gray-700 text-sm font-medium mb-2">Content</label>
                <textarea id="isi" name="isi" required rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo e(old('isi', $profile->isi)); ?></textarea>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-between items-center">
                <a href="<?php echo e(route('profile.index')); ?>"
                    class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
</body>

</html><?php /**PATH C:\schoolensa\resources\views/profile/edit.blade.php ENDPATH**/ ?>