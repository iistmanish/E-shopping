<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use HasFactory;
    protected $table = 'social_accounts';
    protected $fillable = ['student_id', 'provider_name', 'provider_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
