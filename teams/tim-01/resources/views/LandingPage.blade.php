<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Wisata Kaltim</title>

<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = { darkMode: 'class' }
</script>
</head>

<body class="min-h-screen flex flex-col bg-gray-50 text-gray-900 dark:bg-black dark:text-gray-100 transition-colors duration-300">

<nav class="bg-white dark:bg-zinc-950 border-b border-gray-200 dark:border-zinc-800 transition-colors duration-300">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <div class="flex items-center gap-2 font-bold text-green-600">
      🌿 Wisata Kaltim
    </div>

    <div class="flex items-center gap-4 text-sm">
      <button>Jelajahi</button>
      <button>Lihat Detail</button>

    <a href="{{ route('login') }}"
         class="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition">
        Login
      </a>

      <button id="darkToggle"
        class="w-9 h-9 rounded-full bg-gray-200 dark:bg-zinc-800 flex items-center justify-center transition-colors text-lg">
        </button>
    </div>
  </div>
</nav>

<main class="flex-1">

<section class="text-center mt-12">
  <h1 class="text-3xl font-bold">
    Eksplorasi Keajaiban
    <span class="text-green-500">Kalimantan Timur</span>
  </h1>
</section>

<section class="max-w-7xl mx-auto px-6 mt-12 grid grid-cols-12 gap-8">

<aside class="col-span-3">
  <div class="bg-white dark:bg-zinc-900 border border-gray-200 dark:border-zinc-800 rounded-2xl p-6">
    <h3 class="font-semibold mb-4">Kategori</h3>

    @if (isset($categories) && $categories->count())
      <ul class="space-y-3 text-sm">
        @foreach ($categories as $category)
          <li class="hover:text-green-500 cursor-pointer">
            {{ $category->name }}
          </li>
        @endforeach
      </ul>
    @else
      <p class="text-sm text-gray-500 dark:text-gray-400">
        Belum ada kategori
      </p>
    @endif
  </div>
</aside>

<div class="col-span-9 grid grid-cols-3 gap-6">

@if (isset($destinations) && $destinations->count())

  @foreach ($destinations as $destination)
  <div class="bg-white dark:bg-zinc-900 border border-gray-200 dark:border-zinc-800 rounded-2xl overflow-hidden flex flex-col h-[360px]">

    <div class="relative h-1/2">
      <img
        src="{{ asset('storage/' . optional($destination->images->first())->image_path) }}"
        class="h-full w-full object-cover"
        onerror="this.src='https://via.placeholder.com/400'"
      >

      <span class="absolute top-3 left-3 bg-green-500 text-white text-xs px-2 py-1 rounded-full">
        {{ strtoupper(optional($destination->category)->name ?? 'LAINNYA') }}
      </span>

      @php
        $rating = $destination->reviews->avg('rating');
      @endphp

      <span class="absolute top-3 right-3 flex items-center gap-1
                   bg-white/90 dark:bg-zinc-800
                   text-yellow-500 text-xs px-2 py-1 rounded-full">
        ⭐ <span class="text-gray-900 dark:text-gray-100">
          {{ number_format($rating ?? 0, 1) }}
        </span>
      </span>
    </div>

    <div class="p-4 flex flex-col flex-1">
      <h3 class="font-semibold">{{ $destination->name }}</h3>
      <p class="text-sm text-gray-500 dark:text-gray-400">
        {{ $destination->location }}
      </p>

      <div class="mt-auto">
        <p class="text-sm">Mulai dari</p>
        <p class="font-bold">
          IDR {{ number_format($destination->price, 0, ',', '.') }}
        </p>
      </div>
    </div>

  </div>
  @endforeach

@else
  <div class="col-span-3">
    <div class="h-[300px] flex flex-col items-center justify-center text-center
                bg-white dark:bg-zinc-900 border border-dashed border-gray-300
                dark:border-zinc-700 rounded-2xl">
      <p class="text-gray-500 dark:text-gray-400">
        🌴 Belum ada destinasi wisata tersedia
      </p>
    </div>
  </div>
@endif

</div>
</section>

</main>

<footer class="border-t border-gray-200 dark:border-zinc-800 py-10 text-center text-sm text-gray-500 transition-colors">
  © 2026 Wisata Kaltim.
</footer>

<script>
  const root = document.documentElement
  const toggle = document.getElementById('darkToggle')

  // Fungsi untuk update ikon
  function updateIcon() {
    if (root.classList.contains('dark')) {
      toggle.textContent = '🌙' // Mode Gelap = Bulan
    } else {
      toggle.textContent = '☀️' // Mode Terang = Matahari
    }
  }

  // 1. Cek local storage saat loading
  if (localStorage.theme === 'dark') {
    root.classList.add('dark')
  } else {
    root.classList.remove('dark')
  }
  
  // Set ikon awal sesuai kondisi saat loading
  updateIcon()

  // 2. Event Listener saat tombol diklik
  toggle.onclick = () => {
    root.classList.toggle('dark')
    
    // Simpan preferensi user
    localStorage.theme = root.classList.contains('dark') ? 'dark' : 'light'
    
    // Update ikon setelah klik
    updateIcon()
  }
</script>

</body>
</html>