<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tim extends Model
{
    use HasFactory;

    public $table = 'tim';
    protected $guarded = ['id'];
    
    public function getGetFotoAttribute()
    {
        return asset('image/user.png');
    }
}
