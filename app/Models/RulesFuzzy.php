<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RulesFuzzy extends Model
{
    protected $table = 'rules_fuzzy';
    protected $primaryKey = 'id_rule';
    protected $fillable = ['fase_umur', 'kategori_berat', 'kategori_tinggi', 'kategori_imunisasi', 'hasil_status_gizi'];
    public function detailHasil(): HasMany
    {
        return $this->hasMany(DetailHasilFuzzy::class, 'id_rule', 'id_rule');
    }
}
