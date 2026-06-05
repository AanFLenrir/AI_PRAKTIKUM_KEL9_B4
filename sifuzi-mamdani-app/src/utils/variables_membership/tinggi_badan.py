from src.utils.membership_funcs import (
    kurva_trapesium_kiri,
    kurva_segitiga,
    kurva_trapesium_kanan
)

def hitung_derajat_tinggi_badan(tinggi_cm: float) -> dict:
    """
    Menghitung derajat keanggotaan untuk kategori Tinggi Badan (Rendah, Agak Panjang, Panjang)
    berdasarkan rumus dari Kelompok 9.
    """
    x = tinggi_cm
    
    return {
        "Rendah": kurva_trapesium_kiri(x, a=50.0, b=60.0),
        "AgakPanjang": kurva_segitiga(x, a=50.0, b=65.0, c=80.0),
        "Panjang": kurva_trapesium_kanan(x, a=70.0, b=95.0)
    }