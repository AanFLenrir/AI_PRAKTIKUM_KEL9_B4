<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Imunisasi extends Model
{
    protected $table = 'imunisasi';
    protected $primaryKey = 'id_imunisasi';
    protected $fillable = ['nama_imunisasi',, 'umur_bulan', 'keterangan_imunisasi'];
    // Relasi Many-to-Many ke Pemeriksaan via Pivot
    public function pemeriksaan(): BelongsToMany
    {
        return $this->belongsToMany(Pemeriksaan::class, 'pemeriksaan_imunisasi', 'id_imunisasi', 'id_pemeriksaan');
    }
}
