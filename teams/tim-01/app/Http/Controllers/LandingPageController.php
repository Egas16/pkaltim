<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Category;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil semua kategori
        $categories = Category::all();

        // Ambil destinasi + relasinya
        $destinations = Destination::with([
            'category',
            'images',
            'reviews'
        ])->get();

        return view('LandingPage', [
            'destinations' => $destinations,
            'categories'   => $categories,
        ]);
    }
}
