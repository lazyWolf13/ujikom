<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
    .glass-effect {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    .floating {
        animation: float 6s ease-in-out infinite;
    }
    </style>
</head>

<body
    class="bg-gradient-to-br from-blue-500 via-blue-400 to-blue-600 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md relative">
        <!-- Logo atau Icon -->
        <div class="text-center mb-8 floating">
            <div class="inline-block p-6 rounded-full bg-white shadow-xl">
                <i class="fas fa-user-shield text-5xl text-blue-600"></i>
            </div>
        </div>

        <div class="glass-effect rounded-3xl shadow-2xl p-8 transition-all duration-300 hover:shadow-blue-200/50">
            <h2 class="text-3xl font-bold text-center text-blue-800 mb-2">Welcome Back!</h2>
            <p class="text-center text-blue-600 mb-8">Please sign in to continue</p>

            <form action="{{ url('login') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Username Field -->
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-blue-400 group-focus-within:text-blue-600 transition-colors"></i>
                    </div>
                    <input type="text" name="username" id="username" placeholder="Enter your username"
                        class="w-full pl-10 pr-4 py-3 border-2 border-blue-100 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all"
                        required>
                </div>

                <!-- Password Field -->
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-blue-400 group-focus-within:text-blue-600 transition-colors"></i>
                    </div>
                    <input type="password" name="password" id="password" placeholder="Enter your password"
                        class="w-full pl-10 pr-4 py-3 border-2 border-blue-100 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all"
                        required>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-4 rounded-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 transform transition-all hover:-translate-y-0.5 hover:shadow-lg">
                    <span class="flex justify-center items-center text-lg font-semibold">
                        Login
                    </span>
                </button>

                <!-- Error Messages -->
                @if ($errors->any())
                <div class="bg-red-50 text-red-700 p-4 rounded-xl mt-4 border-2 border-red-100">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle mr-2 text-red-500"></i>
                        <span class="font-semibold">Login Failed</span>
                    </div>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </form>

            <!-- Footer -->
            <div class="mt-8 text-center text-blue-600/80 text-sm">
                <p>Protected by reCAPTCHA and subject to the</p>
                <div class="mt-1">
                    <a href="#" class="text-blue-700 hover:text-blue-800 font-semibold hover:underline">Privacy
                        Policy</a> and
                    <a href="#" class="text-blue-700 hover:text-blue-800 font-semibold hover:underline">Terms of
                        Service</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none overflow-hidden -z-1">
        <div
            class="absolute -top-40 -left-40 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse">
        </div>
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse delay-1000">
        </div>
        <div
            class="absolute bottom-0 left-20 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse delay-2000">
        </div>
    </div>
</body>

</html>