<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // protected $table = 'produk';
    // protected $primaryKey = 'id_produk';
    // protected $guarded = [];

    protected $table = 'produk';

    protected $fillable = [
        'nama_produk',
        'id_kategori',
        'kode_produk',
        'merk',
        'harga_beli',
        'diskon',
        'harga_jual',
        'stok'
    ];

    protected $hidden = [];

    protected $primaryKey = 'id_produk';

    public function kategori()
    {
        // return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
