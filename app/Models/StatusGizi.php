<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusGizi extends Model
{
    protected $table = 'status_gizi';
    protected $primaryKey = 'id_status_gizi';
    protected $fillable = ['nama_status', 'keterangan'];
    public function pemeriksaan(): HasMany
    {
        return $this->hasMany(Pemeriksaan::class, 'id_status_gizi', 'id_status_gizi');
    }
}
