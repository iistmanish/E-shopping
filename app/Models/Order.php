<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model

{
    protected $table = 'orders';
    protected $primaryKey = 'id'; 
    use HasFactory;
    

    protected $fillable = [
        'student_id', 'name', 'address', 'email', 'phone', 'total', 'product_name', 'quantities', 'payment_mode', 'status'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
    public function products() {
        return $this->belongsToMany(Product::class);
    }
    
}
