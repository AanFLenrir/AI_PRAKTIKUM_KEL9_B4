from pydantic import BaseModel
from src.types import (
    FaseUmurType,
    KategoriBeratType,
    KategoriImunisasiType,
    KategoriTinggiType,
    HasilStatusGiziType
)

class RulesFuzzy(BaseModel):
    id_rule: int
    fase_umur: FaseUmurType
    kategori_berat: KategoriBeratType
    kategori_tinggi: KategoriTinggiType
    kategori_imunisasi: KategoriImunisasiType
    hasil_status_gizi: HasilStatusGiziType
    
    class Config:
        frozen = True # Membuat entitas aturan bersifat immutable (tidak bisa diubah sembarangan)

