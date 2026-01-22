<?php
namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Category;
use App\Models\DestinationImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Query dengan relasi dan search logic
        $query = Destination::with(['category', 'images', 'reviews']);

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('address', 'like', '%' . $request->search . '%');
        }

        // Pagination 10 per halaman
        $destinations = $query->latest()->paginate(10);
        
        // Ambil kategori untuk dropdown di form
        $categories = Category::all();

        return view('admin.dashboard', compact('destinations', 'categories'));
    }

    public function store(Request $request)
    {
        // Validasi sesuai kolom database
        $request->validate([
            'name' => 'required',
            'category_id' => 'required', // Wajib ada karena foreign key
            'address' => 'required',
            'price' => 'nullable|numeric',
            'status' => 'required|in:active,inactive', // Sesuai enum di DB
            'image' => 'image|mimes:jpeg,png,jpg|max:2048' // Validasi upload
        ]);

        // 1. Simpan Data Destinasi
        $dest = Destination::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'address' => $request->address,
            'price' => $request->price ?? 0,
            'status' => $request->status,
            'description' => $request->description ?? '-', // Default value jika kosong
            // Field lain bisa diset null atau default
        ]);

        // 2. Simpan Gambar ke tabel 'destination_images'
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('destinations', 'public');
            
            DestinationImage::create([
                'destination_id' => $dest->id,
                'image_path' => $path
            ]);
        }

        return redirect()->back()->with('success', 'Destinasi berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $dest = Destination::findOrFail($id);
        $dest->images()->delete(); // Hapus gambar di DB
        $dest->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}