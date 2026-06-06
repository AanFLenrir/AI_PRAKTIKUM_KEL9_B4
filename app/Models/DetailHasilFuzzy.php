<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailHasilFuzzy extends Model
{
    protected $table = 'detail_hasil_fuzzy';
    protected $primaryKey = 'id_detail';
    protected $fillable = ['rule_aktif', 'alpha_predikat', 'nilai_defuzzy', 'id_pemeriksaan', 'id_rule'];
    public function pemeriksaan(): BelongsTo
    {
        return $this->belongsTo(Pemeriksaan::class, 'id_pemeriksaan', 'id_pemeriksaan');
    }
    public function ruleFuzzy(): BelongsTo
    {
        return $this->belongsTo(RulesFuzzy::class, 'id_rule', 'id_rule');
    }
}
