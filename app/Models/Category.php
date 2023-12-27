<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    // Relationship with subcategories
   

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    
    public function furtherSubcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
  
    
    protected $fillable = ['name', 'status','parent_id'];
}
