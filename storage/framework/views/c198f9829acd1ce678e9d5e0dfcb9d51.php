<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gallery</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-200 to-blue-300">

    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-xl w-96">
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Edit Gallery</h2>

            <form action="<?php echo e(route('galery.update', $galery->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-6">
                    <label for="post_id" class="block text-gray-700 text-sm font-medium mb-2">Post</label>
                    <select name="post_id" id="post_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($post->id); ?>" <?php echo e($post->id == $galery->post_id ? 'selected' : ''); ?>>
                            <?php echo e($post->judul); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="position" class="block text-gray-700 text-sm font-medium mb-2">Position</label>
                    <input type="number" name="position" id="position" value="<?php echo e(old('position', $galery->position)); ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <div class="mb-6">
                    <label for="status" class="block text-gray-700 text-sm font-medium mb-2">Status</label>
                    <select name="status" id="status"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                        <option value="active" <?php echo e($galery->status == 'active' ? 'selected' : ''); ?>>Active</option>
                        <option value="inactive" <?php echo e($galery->status == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="<?php echo e(route('galery.index')); ?>"
                        class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-200">Cancel</a>
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">Update
                        Gallery</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html><?php /**PATH C:\MyProject\schoolensa\resources\views/galery/edit.blade.php ENDPATH**/ ?>