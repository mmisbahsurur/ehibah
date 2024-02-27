<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hibah extends Model
{
    use HasFactory;
    protected $table= 'tbl_hibah2';
    protected $guarded= [];

    public function poktan()
    {
        return $this->belongsTo(Kelompok::class, 'id_kelompoktani', 'id');
    }

    public function jenis()
    {
        return $this->belongsTo(JenisHibah::class, 'jenis_hibah', 'id');
    }
}
