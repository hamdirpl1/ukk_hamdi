<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    protected $table = 'produks';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_kategori', 'nama_produk', 'harga', 'stok', 'deskripsi',
        'tanggal_upload', 'id_toko'
    ];

    public function kategori(): BelongsTo {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function toko(): BelongsTo {
        return $this->belongsTo(Toko::class, 'id_toko');
    }

    public function gambar(): HasMany {
        return $this->hasMany(GambarProduk::class, 'id_produk');
    }
}
