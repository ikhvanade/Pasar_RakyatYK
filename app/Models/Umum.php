<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Umum extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'no_telpon',
        'lokasi',
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
            DB::statement('UPDATE `umums` SET `id` = @count:= @count + 1');
            DB::statement('ALTER TABLE `umums` AUTO_INCREMENT = 1');
        });
    }
}
