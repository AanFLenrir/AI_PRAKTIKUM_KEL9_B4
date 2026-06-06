from src.utils.membership_funcs import (
    kurva_trapesium_kiri,
    kurva_segitiga,
    kurva_trapesium_kanan
)
from typing import Dict, Optional

def hitung_derajat_berat_badan(berat_kg: float, sd_values: Optional[Dict[str, float]] = None) -> dict:
    """
    Menghitung derajat keanggotaan untuk kategori Berat Badan (Ringan, Sedang, Berat)
    berdasarkan tabel WHO Dinamis.
    """
    x = berat_kg
    
    if sd_values:
        return {
            "Ringan": kurva_trapesium_kiri(x, a=sd_values["min_2"], b=sd_values["median"]),
            "Sedang": kurva_segitiga(x, a=sd_values["min_2"], b=sd_values["median"], c=sd_values["plus_2"]),
            "Berat": kurva_trapesium_kanan(x, a=sd_values["median"], b=sd_values["plus_2"])
        }
    
    return {
        "Ringan": kurva_trapesium_kiri(x, a=3.0, b=7.0),
        "Sedang": kurva_segitiga(x, a=3.0, b=9.0, c=15.0),
        "Berat": kurva_trapesium_kanan(x, a=12.0, b=21.0)
    }