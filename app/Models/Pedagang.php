<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pedagang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'no_telpon',
        'lokasi_pasar',
        'blok_pasar',
        'akun_sosmed',
        'bukti_sosmed',
        'permintaan',
        'status',
        'email'
    ];
    protected static function booted()
    {
        static::deleted(function ($model) {
            // Reset ID sequence setelah penghapusan
            DB::statement('SET @count = 0');
            DB::statement('UPDATE `pedagangs` SET `id` = @count:= @count + 1');
            DB::statement('ALTER TABLE `pedagangs` AUTO_INCREMENT = 1');
        });
    }
}