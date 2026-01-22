<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    // Sesuai tabel 'destinations'
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 
        'address', 'price', 'price_note', 
        'latitude', 'longitude', 'opening_hours', 'status'
    ];

    // Relasi ke Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke Images (One to Many)
    public function images()
    {
        return $this->hasMany(DestinationImage::class);
    }

    // Relasi ke Reviews untuk menghitung Rating
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Accessor untuk mengambil gambar pertama (thumbnail)
    public function getThumbnailAttribute()
    {
        return $this->images->first()->image_path ?? 'default.jpg';
    }

    // Accessor untuk menghitung rata-rata rating
    public function getRatingAvgAttribute()
    {
        return $this->reviews->avg('rating') ?? 0;
    }
}