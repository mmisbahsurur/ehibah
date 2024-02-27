<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mkecamatan extends Model
{
    use HasFactory;
    protected $table = 'tbl_kecamatan';
    protected $guarded = [];

    public function kota()
    {
        return $this->belongsTo(Mkota::class, 'regency_id', 'id');
    }

    public function desa()
    {
        return $this->hasMany(Mdesa::class, 'district_id', 'id');
    }
}
