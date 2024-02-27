<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $table = 'tbl_provinsi';
    protected $guarded = '';

    public function kota()
    {
        return $this->hasMany(Mkota::class, 'province_id', 'id');
    }
}
