<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Project extends Model
{
    use HasFactory;

    public $table = 'project';
    protected $guarded = ['id'];
    
    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
    
    public function leader()
    {
        return $this->belongsTo(Tim::class, 'leader_id');
    }

    public function tim()
    {
        return $this->hasMany(Tim::class);
    }

    public function getGetTanggalMulaiAttribute()
    {
        return Carbon::parse(($this->attributes['tanggal_mulai']))
            ->translatedFormat('d M Y');
    }

    public function getGetTanggalSelesaiAttribute()
    {
        return Carbon::parse(($this->attributes['tanggal_selesai']))
            ->translatedFormat('d M Y');
    }
}
