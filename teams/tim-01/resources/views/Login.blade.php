<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Wisata Alam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-[#F9FAF5] to-[#E3F6ED] min-h-screen flex flex-col justify-center items-center relative overflow-hidden">

    <div class="absolute top-0 left-0 w-full p-6 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="flex items-center gap-2 font-bold text-green-600">
      🌿 Wisata Kaltim
    </div>  
        </div>
        <a href="/" class="text-sm text-gray-600 hover:text-green-600 flex items-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Beranda
        </a>
    </div>

    <div class="bg-white rounded-[2rem] shadow-xl w-full max-w-[480px] p-10 z-10 mx-4">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Masuk</h1>
            <p class="text-gray-500 text-sm">Akses pengalaman wisata alam terbaik di Kalimantan Timur</p>
        </div>

        <form method="POST" action="/login">
            @csrf
            
            <div class="mb-5">
                <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    placeholder="Contoh: email@wisata.com" 
                    required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all text-sm placeholder-gray-400 @error('email') border-red-500 focus:ring-red-500 @enderror">
                
                @error('email')
                    <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-2 relative">
                <label for="password" class="block text-sm font-semibold text-gray-900 mb-2">Kata Sandi</label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Masukkan kata sandi" 
                        required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all text-sm placeholder-gray-400 pr-10">
                    
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-green-600 focus:outline-none">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex justify-end mb-6">
                <a href="#" class="text-xs font-semibold text-green-500 hover:text-green-700 transition-colors">Lupa Kata Sandi?</a>
            </div>

            <button type="submit" class="w-full bg-[#10C858] hover:bg-green-600 text-white font-bold py-3 rounded-xl shadow-[0_10px_20px_-10px_rgba(16,200,88,0.5)] transition-all transform active:scale-95 mb-6">
                Masuk
            </button>
        </form>

        <div class="text-center text-sm text-gray-500">
            Belum punya akun? <a href="#" class="font-bold text-[#10C858] hover:underline">Daftar Sekarang</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Ganti icon (opsional, disini saya biarkan warnanya berubah saja sebagai indikator)
                eyeIcon.classList.add('text-green-600');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('text-green-600');
            }
        }
    </script>

</body>
</html>