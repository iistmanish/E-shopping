<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
 
    protected $casts = [
        'multiple_images' => 'array',
    ];
    protected $table = 'products';
    protected $fillable = [
    'name',
    'product_description',
    'mrp',
    'selling_price',
    'product_image',
    'multiple_image',
    'is_stock',
    'available_quantity',
    'status',
    'category_id',
    'brand_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Define the relationship with Category
    public function orders() {
        return $this->belongsToMany(Product::class);
    }
}
