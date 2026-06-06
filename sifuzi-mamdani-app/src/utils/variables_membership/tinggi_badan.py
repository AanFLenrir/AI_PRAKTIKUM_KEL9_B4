from src.utils.membership_funcs import (
    kurva_trapesium_kiri,
    kurva_segitiga,
    kurva_trapesium_kanan
)
from typing import Dict, Optional

def hitung_derajat_tinggi_badan(tinggi_cm: float, sd_values: Optional[Dict[str, float]] = None) -> dict:
    """
    Menghitung derajat keanggotaan untuk kategori Tinggi Badan (Rendah, Agak Panjang, Panjang)
    berdasarkan tabel WHO Dinamis.
    """
    x = tinggi_cm
    
    if sd_values:
        return {
            "Rendah": kurva_trapesium_kiri(x, a=sd_values["min_2"], b=sd_values["median"]),
            "AgakPanjang": kurva_segitiga(x, a=sd_values["min_2"], b=sd_values["median"], c=sd_values["plus_2"]),
            "Panjang": kurva_trapesium_kanan(x, a=sd_values["median"], b=sd_values["plus_2"])
        }
    
    return {
        "Rendah": kurva_trapesium_kiri(x, a=50.0, b=60.0),
        "AgakPanjang": kurva_segitiga(x, a=50.0, b=65.0, c=80.0),
        "Panjang": kurva_trapesium_kanan(x, a=70.0, b=95.0)
    }