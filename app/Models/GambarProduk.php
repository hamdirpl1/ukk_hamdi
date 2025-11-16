<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GambarProduk extends Model
{
    protected $table = 'gambar_produks';
    protected $primaryKey = 'id_gambar';

    protected $fillable = ['id_produk', 'nama_gambar', 'gambar'];

    public function produk(): BelongsTo {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
