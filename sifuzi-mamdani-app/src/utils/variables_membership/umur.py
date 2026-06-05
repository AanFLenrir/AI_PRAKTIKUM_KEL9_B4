from src.utils.membership_funcs import (
    kurva_segitiga
)

def hitung_derajat_fase_umur(umur_tahun: float) -> dict:
    """
    Menghitung derajat keanggotaan untuk semua fase umur (Fase 1 - Fase 5)
    berdasarkan rumus dari Kelompok 9.
    """
    x = umur_tahun
    
    return {
        "Fase1": kurva_segitiga(x, a=0.0, b=6.0, c=12.0),
        "Fase2": kurva_segitiga(x, a=6.0, b=12.0, c=18.0),
        "Fase3": kurva_segitiga(x, a=12.0, b=18.0, c=24.0),
        "Fase4": kurva_segitiga(x, a=18.0, b=24.0, c=30.0),
        "Fase5": kurva_segitiga(x, a=24.0, b=42.0, c=60.0),
    }