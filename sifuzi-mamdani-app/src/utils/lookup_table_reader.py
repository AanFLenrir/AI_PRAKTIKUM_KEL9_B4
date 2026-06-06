import os
import csv
from typing import Dict, Optional

BASE_DIR = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
LOOKUP_DIR = os.path.join(BASE_DIR, "utils", "lookup_table_gizi")

def get_sd_values(jenis_kelamin: str, kategori: str, key_val: float) -> Optional[Dict[str, float]]:
    """
    Membaca batas SD dari CSV berdasarkan jenis kelamin dan kategori.
    jenis_kelamin: 'L' atau 'P'
    kategori: 'BB_U', 'PB_U', 'BB_PB', atau 'IMT_U'
    key_val: umur (bulan) atau tinggi/panjang badan (cm)
    """
    gender_dir = "laki_laki" if jenis_kelamin == "L" else "perempuan"
    target_dir = os.path.join(LOOKUP_DIR, gender_dir, kategori)
    
    if not os.path.exists(target_dir):
        return None
        
    for filename in os.listdir(target_dir):
        if not filename.endswith(".csv"):
            continue
            
        filepath = os.path.join(target_dir, filename)
        with open(filepath, 'r') as f:
            reader = csv.reader(f)
            for row in reader:
                if not row: 
                    continue
                
                try:
                    row_key = float(row[0].replace('*', '').strip())
                except ValueError:
                    continue
                
                # Match toleransi untuk cover perbandingan float
                if abs(row_key - key_val) < 0.01:
                    try:
                        return {
                            "min_3": float(row[2]),
                            "min_2": float(row[5]),
                            "min_1": float(row[8]),
                            "median": float(row[11]),
                            "plus_1": float(row[14]),
                            "plus_2": float(row[17]),
                            "plus_3": float(row[20])
                        }
                    except (IndexError, ValueError):
                        continue
                        
    return None
