<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'product_id']; // Fillable fields in the Wishlist model

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class); // Assuming each wishlist item belongs to a product
    }


    // Define the relationship with the User model (e.g., Student)
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
