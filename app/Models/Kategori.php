<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $primaryKey = 'id_kategori';

    protected $fillable = ['nama_kategori', 'gb'];

    public function produk(): HasMany {
        return $this->hasMany(Produk::class, 'id_kategori');
    }
}
