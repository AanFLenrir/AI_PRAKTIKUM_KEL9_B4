<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Balita extends Model
{
    protected $table = 'balita';
    protected $primaryKey = 'id_balita';
    protected $fillable = ['nama_balita', 'jenis_kelamin', 'tanggal_lahir', 'id_orang_tua'];
    // Balita dimiliki oleh Orang Tua (M:1)
    public function orangTua(): BelongsTo
    {
        return $this->belongsTo(OrangTua::class, 'id_orang_tua', 'id');
    }
    // Balita punya riwayat pemeriksaan gizi (1:M)
    public function pemeriksaan(): HasMany
    {
        return $this->hasMany(Pemeriksaan::class, 'id_balita', 'id_balita');
    }
}
