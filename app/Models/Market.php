<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'location',
        'jam_operasional',
        'kelurahan',
        'kecamatan',
        'image',
        'image_content',
        'image_tambah',
        'jumlah_pedagang',
        'luas_tanah',
        'luas_bangunan'
    ];
    public function getLokasiLengkapAttribute()
    {
        return "Kel. {$this->kelurahan}, Kec. {$this->kecamatan}";
    }
}
