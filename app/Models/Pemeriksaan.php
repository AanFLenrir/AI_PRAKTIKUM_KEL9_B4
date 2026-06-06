<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pemeriksaan extends Model
{
    protected $table = 'pemeriksaan';
    protected $primaryKey = 'id_pemeriksaan';
    protected $fillable = ['tanggal_periksa', 'umur_bulan', 'berat_badan', 'tinggi_badan', 'nilai_fuzzy', 'id_balita', 'id_user', 'id_status_gizi'];
    public function balita(): BelongsTo
    {
        return $this->belongsTo(Balita::class, 'id_balita', 'id_balita');
    }
    // Petugas (User) yang memeriksa
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    public function statusGizi(): BelongsTo
    {
        return $this->belongsTo(StatusGizi::class, 'id_status_gizi', 'id_status_gizi');
    }
    // Relasi Many-to-Many ke Imunisasi via Pivot
    public function imunisasi(): BelongsToMany
    {
        return $this->belongsToMany(Imunisasi::class, 'pemeriksaan_imunisasi', 'id_pemeriksaan', 'id_imunisasi');
    }
    public function detailHasilFuzzy(): HasMany
    {
        return $this->hasMany(DetailHasilFuzzy::class, 'id_pemeriksaan', 'id_pemeriksaan');
    }
}
