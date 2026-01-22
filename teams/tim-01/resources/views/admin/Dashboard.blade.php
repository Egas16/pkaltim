<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaltim Nature - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { primary: '#053B28', accent: '#10B981', secondary: '#F3F4F6' } } }
        }
    </script>
</head>
<body class="bg-secondary text-gray-800 flex h-screen overflow-hidden">

    <aside class="w-64 bg-primary text-white flex flex-col flex-shrink-0">
        <div class="p-6 flex items-center gap-3">
            <i class="fa-solid fa-leaf text-accent text-xl"></i>
            <h1 class="font-bold text-lg tracking-wide">Kaltim Nature</h1>
        </div>
        </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        
        <header class="bg-white p-8 flex justify-between items-start border-b border-gray-100">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Panel Dashboard Admin</h2>
                <p class="text-gray-500 text-sm mt-1">Kelola data destinasi sesuai database.</p>
            </div>
            <button onclick="openModal()" class="px-4 py-2 bg-accent hover:bg-emerald-600 text-white rounded-lg font-medium flex items-center gap-2 shadow-lg">
                <i class="fa-solid fa-plus"></i> Tambah Destinasi
            </button>
        </header>

        <div class="px-8 py-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center text-accent text-xl"><i class="fa-solid fa-mountain"></i></div>
                <div>
                    <p class="text-gray-500 text-sm">Total Destinasi</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $destinations->total() }}</p>
                </div>
            </div>
            </div>

        <div class="px-8 pb-8 flex-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                
                <div class="p-6 flex justify-between items-center">
                    <h3 class="font-bold text-lg">Daftar Destinasi Wisata</h3>
                    <form action="{{ route('dashboard') }}" method="GET" class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400 text-sm"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari destinasi..." class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-accent">
                    </form>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 text-xs uppercase">
                            <th class="p-4 font-medium">Nama Destinasi</th>
                            <th class="p-4 font-medium">Lokasi (Address)</th>
                            <th class="p-4 font-medium">Status</th>
                            <th class="p-4 font-medium">Rating</th>
                            <th class="p-4 font-medium text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                        @forelse($destinations as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    @if($item->images->count() > 0)
                                        <img src="{{ asset('storage/' . $item->images->first()->image_path) }}" class="w-12 h-12 rounded-lg object-cover">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center text-xs">No Img</div>
                                    @endif
                                    
                                    <div>
                                        <span class="font-semibold block text-gray-800">{{ $item->name }}</span>
                                        <span class="text-xs text-gray-400">{{ $item->category->name ?? 'Uncategorized' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-gray-500">{{ Str::limit($item->address, 30) }}</td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $item->status == 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $item->status == 'active' ? 'Published' : 'Draft' }}
                                </span>
                            </td>
                            <td class="p-4 text-orange-400 font-medium">
                                ⭐ {{ number_format($item->rating_avg, 1) }}
                            </td>
                            <td class="p-4 text-center flex justify-center gap-2">
                                <form action="{{ route('destinations.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-full text-red-500 hover:bg-red-50"><i class="fa-regular fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-400">Belum ada data destinasi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="p-4">
                    {{ $destinations->links() }}
                </div>
            </div>
        </div>
    </main>

    <div id="destinationModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold">Tambah Destinasi</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-xmark"></i></button>
            </div>
            
            <form action="{{ route('destinations.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium mb-1">Nama Destinasi</label>
                    <input type="text" name="name" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-accent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Kategori</label>
                    <select name="category_id" class="w-full border rounded-lg px-3 py-2 outline-none">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Lokasi (Address)</label>
                    <input type="text" name="address" required class="w-full border rounded-lg px-3 py-2 outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Status</label>
                        <select name="status" class="w-full border rounded-lg px-3 py-2 outline-none">
                            <option value="active">Published (Active)</option>
                            <option value="inactive">Draft (Inactive)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Harga Tiket</label>
                        <input type="number" name="price" class="w-full border rounded-lg px-3 py-2 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Foto Destinasi</label>
                    <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-accent text-white rounded-lg hover:bg-green-600">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() { document.getElementById('destinationModal').classList.remove('hidden'); }
        function closeModal() { document.getElementById('destinationModal').classList.add('hidden'); }
    </script>
</body>
</html>