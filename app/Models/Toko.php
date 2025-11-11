<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Toko extends Model
{
    protected $table = 'tokos';
    protected $primaryKey = 'id_toko';

    protected $fillable = [
        'nama_toko', 'deskripsi', 'gambar', 'id_user', 'kontak_toko', 'alamat'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function produk(): HasMany {
        return $this->hasMany(Produk::class, 'id_toko');
    }
}
