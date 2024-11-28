<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Sekolah - SMK Negeri 4 Bogor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100 text-gray-800">
    <!-- Header -->
    <header class="bg-blue-500 text-white py-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center px-4">
            <div class="text-2xl font-bold">
                <a href="/" class="hover:opacity-80">Galeri SMK Negeri 4 Bogor</a>
            </div>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="/" class="hover:opacity-80">Beranda</a></li>
                    <li><a href="#profil-sekolah" class="hover:opacity-80">Profil Sekolah</a></li>
                    <li><a href="#informasi-terkini" class="hover:opacity-80">Informasi Terkini</a></li>
                    <li><a href="#agenda-sekolah" class="hover:opacity-80">Agenda Sekolah</a></li>
                    <li><a href="#galeri-foto" class="hover:opacity-80">Galeri Foto</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <!-- Hero Section dengan Background Image -->
        <div class="relative min-h-screen">
            <!-- Background Image -->
            <div class="absolute inset-0 -z-10">
                <img src="https://smkn4bogor.sch.id/assets/images/background/smkn4bogor_2.jpg" alt="Galeri Sekolah"
                    class="w-full h-screen object-cover sticky top-0">
                <!-- Overlay gradient untuk membuat teks lebih terbaca -->
                <div class="absolute inset-0 bg-black/50"></div>
            </div>

            <!-- Content di atas background -->
            <div class="relative z-10 flex flex-col items-center justify-center min-h-screen text-white p-8">
                <h1 class="text-4xl md:text-5xl font-bold text-center mb-4">
                    SMK Negeri 4 Bogor
                </h1>
                <h2 class="text-2xl md:text-3xl font-semibold text-center mb-4">
                    KR4BAT (Kejuruan Empat Hebat)
                </h2>
                <p class="text-xl md:text-2xl text-center max-w-2xl mb-4">
                    AKHLAK terpuji ILMU terkaji TERAMPIL dan Teruji
                </p>
            </div>
        </div>

        <!-- Profil Sekolah Section -->
        <div class="bg-gray-50 py-20" id="profil-sekolah">
            <div class="container mx-auto px-4">
                <h2 class="text-4xl font-bold text-center mb-16 text-gray-800">Profil Sekolah</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Bagian Teks (Kiri) -->
                    <div class="space-y-8">
                        <?php $__currentLoopData = $profiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-800 mb-4"><?php echo e($profile->judul); ?></h3>
                                <p class="text-gray-600 leading-relaxed"><?php echo e($profile->isi); ?></p>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Bagian Video (Kanan) -->
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Video Profil</h3>
                            <div class="aspect-video rounded-lg overflow-hidden">
                                <video class="w-full h-full object-cover" controls>
                                    <source src="https://smkn4bogor.sch.id/assets/videos/smkn4bogor.mp4"
                                        type="video/mp4">
                                    Browser Anda tidak mendukung tag video.
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Terkini Section -->
        <div id="informasi-terkini" class="bg-white py-20">
            <h2 class="text-4xl font-bold text-center mb-16 text-gray-800">Informasi Terkini</h2>
            <?php if($informasiPosts->isEmpty()): ?>
            <p class="text-center text-gray-600">Tidak ada informasi yang tersedia.</p>
            <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php $__currentLoopData = $informasiPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4"><?php echo e($post->judul); ?></h3>
                        <!-- Text yang disingkat -->
                        <p class="text-gray-600 mb-4" id="short-text-<?php echo e($post->id); ?>">
                            <?php echo e(Str::limit($post->isi, 150)); ?>

                            <button onclick="toggleText(<?php echo e($post->id); ?>)"
                                class="text-blue-600 hover:text-blue-700 font-medium">
                                Baca selengkapnya →
                            </button>
                        </p>
                        <!-- Text lengkap (hidden by default) -->
                        <p class="text-gray-600 mb-4 hidden" id="full-text-<?php echo e($post->id); ?>">
                            <?php echo e($post->isi); ?>

                            <button onclick="toggleText(<?php echo e($post->id); ?>)"
                                class="text-blue-600 hover:text-blue-700 font-medium">
                                Tutup ←
                            </button>
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500"><?php echo e($post->created_at->format('d M Y')); ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- Agenda Sekolah Section -->
        <div id="agenda-sekolah" class="bg-gray-50 py-20">
            <div class="container mx-auto px-4">
                <h2 class="text-4xl font-bold text-center mb-16 text-gray-800">Agenda Sekolah</h2>
                <?php if($agendaPosts->isEmpty()): ?>
                <p class="text-center text-gray-600">Tidak ada agenda yang tersedia.</p>
                <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php $__currentLoopData = $agendaPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4"><?php echo e($post->judul); ?></h3>
                            <!-- Text yang disingkat -->
                            <p class="text-gray-600 mb-4" id="short-agenda-<?php echo e($post->id); ?>">
                                <?php echo e(Str::limit($post->isi, 150)); ?>

                                <button onclick="toggleAgenda(<?php echo e($post->id); ?>)"
                                    class="text-blue-600 hover:text-blue-700 font-medium">
                                    Baca selengkapnya →
                                </button>
                            </p>
                            <!-- Text lengkap (hidden by default) -->
                            <p class="text-gray-600 mb-4 hidden" id="full-agenda-<?php echo e($post->id); ?>">
                                <?php echo e($post->isi); ?>

                                <button onclick="toggleAgenda(<?php echo e($post->id); ?>)"
                                    class="text-blue-600 hover:text-blue-700 font-medium">
                                    Tutup ←
                                </button>
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500"><?php echo e($post->created_at->format('d M Y')); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Galeri Foto Section -->
        <div id="galeri-foto" class="bg-gray-50 py-20">
            <h2 class="text-3xl font-bold text-center mb-8 text-black">Galeri Foto</h2>

            <!-- Album List -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php $__currentLoopData = $galeries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postTitle => $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="album-card" onclick="openAlbum('album-<?php echo e(Str::slug($postTitle)); ?>')">
                    <!-- Album Cover -->
                    <div class="relative group cursor-pointer bg-white rounded-xl shadow-md overflow-hidden">
                        <!-- Cover Image -->
                        <div class="aspect-[4/3] overflow-hidden">
                            <?php if($gallery->first()): ?>
                            <img src="<?php echo e(asset('storage/' . $gallery->first()->file)); ?>" alt="<?php echo e($postTitle); ?>"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <?php endif; ?>
                            <!-- Overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <p class="text-white text-sm"><?php echo e($gallery->count()); ?> Foto</p>
                                </div>
                            </div>
                        </div>

                        <!-- Album Info -->
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">
                                <?php echo e($postTitle); ?>

                            </h3>
                        </div>
                    </div>

                    <!-- Album Modal -->
                    <div id="album-<?php echo e(Str::slug($postTitle)); ?>"
                        class="fixed inset-0 z-50 hidden bg-black/95 backdrop-blur-sm">
                        <div class="min-h-screen p-4 md:p-8">
                            <div class="relative max-w-7xl mx-auto" onclick="event.stopPropagation();">
                                <!-- Header -->
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-2xl md:text-3xl font-bold text-white"><?php echo e($postTitle); ?></h3>
                                    <button type="button"
                                        onclick="event.stopPropagation(); closeAlbum('album-<?php echo e(Str::slug($postTitle)); ?>')"
                                        class="text-white hover:text-gray-300 transition-colors p-2 rounded-full hover:bg-white/10">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Photo Grid -->
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                    <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="group relative aspect-square overflow-hidden rounded-lg cursor-pointer"
                                        onclick="event.stopPropagation(); openLightbox('<?php echo e(asset('storage/' . $foto->file)); ?>', '<?php echo e($foto->judul); ?>')">
                                        <img src="<?php echo e(asset('storage/' . $foto->file)); ?>" alt="<?php echo e($foto->judul); ?>"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        <!-- Hover Overlay -->
                                        <div
                                            class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                            </svg>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Peta Sekolah Section -->
        <div class="mt-12 text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Peta Sekolah</h2>
            <p class="text-gray-600 mb-4">Lokasi sekolah kami dapat ditemukan pada peta berikut:</p>

            <!-- Gambar Peta -->
            <div class="relative w-full max-w-4xl mx-auto overflow-hidden rounded-lg shadow-lg">
                <img src="<?php echo e(asset('storage/photos/denahsekolah.jpg')); ?>" class="w-full h-auto">
            </div>
        </div>
    </main>

    <!-- footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Kolom 1: EXPLORE PROPERTIES -->
                <div>
                    <h3 class="text-lg font-bold mb-4 text-blue-400">EXPLORE PROPERTIES</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Galeri Kegiatan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Prestasi Siswa</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Ekstrakurikuler</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Fasilitas Sekolah</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Karya Seni & Proyek</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Dokumentasi Alumni</a></li>
                    </ul>
                </div>

                <!-- Kolom 2: OVERVIEW -->
                <div>
                    <h3 class="text-lg font-bold mb-4 text-blue-400">OVERVIEW</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">About</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Press</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: COMMUNITY -->
                <div>
                    <h3 class="text-lg font-bold mb-4 text-blue-400">COMMUNITY</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Community Central</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Support</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Help</a></li>
                    </ul>
                </div>

                <!-- Kolom 4: LOKASI -->
                <div>
                    <h3 class="text-lg font-bold mb-4 text-blue-400">LOKASI KAMI</h3>
                    <div class="space-y-4">
                        <div class="h-40 rounded-lg overflow-hidden">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31704.398742240563!2d106.824694!3d-6.640733000000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8b16ee07ef5%3A0x14ab253dd267de49!2sSMK%20Negeri%204%20Bogor%20(Nebrazka)!5e0!3m2!1sid!2sid!4v1731982276757!5m2!1sid!2sid"
                                class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                        <div class="text-gray-400 text-sm">
                            <p class="mb-2">Jl.Raya Tajur, Kp.Buntar RT.02/RW.08</p>
                            <p class="mb-2">Muarasari, Bogor Selatan</p>
                            <p class="mb-2">Kota Bogor, Jawa Barat 16137</p>
                            <p class="mb-2">(0251) 7547381</p>
                            <p>smkn4@smkn4bogor.sch.id</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media & Copyright -->
            <div class="border-t border-gray-700 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="flex space-x-4 mb-4 md:mb-0">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm4.441 16.892c-2.102.144-6.784.144-8.883 0C5.282 16.736 5.017 15.622 5 12c.017-3.629.285-4.736 2.558-4.892 2.099-.144 6.782-.144 8.883 0C18.718 7.264 18.982 8.378 19 12c-.018 3.629-.285 4.736-2.559 4.892zM10 9.658l4.917 2.338L10 14.342V9.658z" />
                            </svg>
                        </a>
                    </div>
                    <p class="text-gray-400 text-sm">
                        &copy; <?php echo e(date('Y')); ?> SMK Negeri 4 Bogor. All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-black/95 backdrop-blur-sm" onclick="closeLightbox()"></div>
        <div class="relative z-10 h-full flex items-center justify-center p-4">
            <button onclick="closeLightbox()"
                class="absolute top-4 right-4 text-white p-2 hover:bg-white/20 rounded-lg transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
            <img id="lightbox-image" src="" alt="" class="max-h-[90vh] max-w-[90vw] object-contain">
            <h4 id="lightbox-caption"
                class="absolute bottom-4 left-1/2 -translate-x-1/2 text-white text-lg font-semibold bg-black/50 px-4 py-2 rounded-lg">
            </h4>
        </div>
    </div>
    </script>
    <script>
    function toggleText(postId) {
        const shortText = document.getElementById(`short-text-${postId}`);
        const fullText = document.getElementById(`full-text-${postId}`);

        if (shortText.classList.contains('hidden')) {
            shortText.classList.remove('hidden');
            fullText.classList.add('hidden');
        } else {
            shortText.classList.add('hidden');
            fullText.classList.remove('hidden');
        }
    }
    </script>
    <script>
    function openAlbum(albumId) {
        document.getElementById(albumId).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeAlbum(albumId) {
        document.getElementById(albumId).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openLightbox(imageSrc, caption) {
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightbox-image');
        const lightboxCaption = document.getElementById('lightbox-caption');

        lightboxImage.src = imageSrc;
        lightboxCaption.textContent = caption;
        lightbox.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    </script>
    <script>
    function toggleAgenda(postId) {
        const shortText = document.getElementById(`short-agenda-${postId}`);
        const fullText = document.getElementById(`full-agenda-${postId}`);

        shortText.style.opacity = '0';
        fullText.style.opacity = '0';

        setTimeout(() => {
            if (shortText.classList.contains('hidden')) {
                shortText.classList.remove('hidden');
                fullText.classList.add('hidden');
            } else {
                shortText.classList.add('hidden');
                fullText.classList.remove('hidden');
            }

            setTimeout(() => {
                shortText.style.opacity = '1';
                fullText.style.opacity = '1';
            }, 50);
        }, 300);
    }
    </script>
</body>

</html><?php /**PATH C:\MyProject\schoolensa\resources\views/welcome.blade.php ENDPATH**/ ?>