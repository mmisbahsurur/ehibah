<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mdesa extends Model
{
    use HasFactory;
    protected $table = 'tbl_desa';
    protected $guarded = [];

    public function kecamatan()
    {
        return $this->belongsTo(Mkecamatan::class, 'district_id', 'id');
    }
}
