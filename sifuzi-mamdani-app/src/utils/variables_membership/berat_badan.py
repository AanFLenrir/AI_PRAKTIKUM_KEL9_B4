from src.utils.membership_funcs import (
    kurva_trapesium_kiri,
    kurva_segitiga,
    kurva_trapesium_kanan
)

def hitung_derajat_berat_badan(berat_kg: float) -> dict:
    """
    Menghitung derajat keanggotaan untuk kategori Berat Badan (Ringan, Sedang, Berat)
    berdasarkan rumus dari Kelompok 9.
    """
    x = berat_kg
    
    return {
        "Ringan": kurva_trapesium_kiri(x, a=3.0, b=7.0),
        "Sedang": kurva_segitiga(x, a=3.0, b=9.0, c=15.0),
        "Berat": kurva_trapesium_kanan(x, a=12.0, b=21.0)
    }