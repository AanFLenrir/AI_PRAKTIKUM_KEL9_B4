from src.utils.membership_funcs import (
    kurva_trapesium_kiri,
    kurva_segitiga,
    kurva_trapesium_kanan
)

def hitung_derajat_status_gizi(skor_gizi: float) -> dict:
    """
    Menghitung derajat keanggotaan untuk kategori Status Gizi (Gizi Buruk, Gizi Kurang, 
    Normal, Gizi Lebih, Obesitas) berdasarkan rumus dari Kelompok 9.
    """
    x = skor_gizi
    
    return {
        "GiziBuruk": kurva_trapesium_kiri(x, a=43.0, b=48.0),
        "GiziKurang": kurva_segitiga(x, a=43.0, b=48.0, c=53.0),
        "Normal": kurva_segitiga(x, a=48.0, b=53.0, c=70.0),
        "GiziLebih": kurva_segitiga(x, a=53.0, b=70.0, c=83.0),
        "Obesitas": kurva_trapesium_kanan(x, a=70.0, b=83.0)
    }