<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mkota extends Model
{
    use HasFactory;
    protected $table = 'tbl_kota';
    protected $guarded = [];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'province_id', 'id');
    }

    public function kecamatan()
    {
        return $this->hasMany(Mkecamatan::class, 'regency_id', 'id');
    }

    public function kelompoktani()
    {
        return $this->hasMany(Kelompok::class, 'kota', 'id');
    }
}
