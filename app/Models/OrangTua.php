<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrangTua extends Model
{
    protected $table = 'orang_tua';
    protected $fillable = ['id', 'alamat', 'no_hp'];
    protected $primaryKey = 'id';
    public $incrementing = false;

    // Relasi ke User (1:1 Kebalikan)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
    // Orang Tua punya banyak Balita (1:M)
    public function balita(): HasMany
    {
        return $this->hasMany(Balita::class, 'id_orang_tua', 'id');
    }
}
