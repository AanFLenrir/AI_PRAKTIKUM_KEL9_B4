from typing import Dict, List, Tuple
from src.domain.repositories.rules_fuzzy import IRulesFuzzyRepository
from src.utils.variables_membership import (
    hitung_derajat_fase_umur,
    hitung_derajat_berat_badan,
    hitung_derajat_tinggi_badan,
    hitung_derajat_status_gizi
)
from src.utils.lookup_table_reader import get_sd_values

class FuzzyInferenceService:
    def __init__(self, repository: IRulesFuzzyRepository):
        self.repository = repository

    async def hitung_status_gizi(
        self,
        jenis_kelamin: str,
        berat_badan: float,
        tinggi_badan: float,
        umur_bulan: int,
        status_imunisasi: str
    ) -> Tuple[float, str, Dict[str, float], List[Dict]]:
        """
        Melakukan inferensi fuzzy Mamdani untuk menentukan skor gizi dan kategori status gizi.
        Returns:
            Tuple[skor_gizi, kategori_status_gizi, derajat_keanggotaan_input]
        """
        # 1. Load SD Dinamis
        sd_bb = get_sd_values(jenis_kelamin, "BB_U", umur_bulan)
        sd_tb = get_sd_values(jenis_kelamin, "PB_U", umur_bulan)

        # 2. Fuzzifikasi
        mu_U_raw = hitung_derajat_fase_umur(float(umur_bulan))
        mu_BB = hitung_derajat_berat_badan(berat_badan, sd_values=sd_bb)
        mu_TB_raw = hitung_derajat_tinggi_badan(tinggi_badan, sd_values=sd_tb)

        # Mapping key agar cocok dengan data database rules
        mu_U = {
            "Fase_1": mu_U_raw.get("Fase1", 0.0),
            "Fase_2": mu_U_raw.get("Fase2", 0.0),
            "Fase_3": mu_U_raw.get("Fase3", 0.0),
            "Fase_4": mu_U_raw.get("Fase4", 0.0),
            "Fase_5": mu_U_raw.get("Fase5", 0.0),
        }

        mu_TB = {
            "Pendek": mu_TB_raw.get("Rendah", 0.0),
            "Agak Panjang": mu_TB_raw.get("AgakPanjang", 0.0),
            "Panjang": mu_TB_raw.get("Panjang", 0.0),
        }

        # Simpan derajat keanggotaan input untuk response
        input_derajat = {
            "umur": mu_U_raw,
            "berat_badan": mu_BB,
            "tinggi_badan": mu_TB_raw,
            "imunisasi": {
                "Lengkap": 1.0 if status_imunisasi == "Lengkap" else 0.0,
                "Sebagian": 1.0 if status_imunisasi == "Sebagian" else 0.0,
                "Tidak Lengkap": 1.0 if status_imunisasi == "Tidak Lengkap" else 0.0
            }
        }

        # 2. Ambil seluruh rules dari DB
        rules = await self.repository.list_all()

        # Evaluasi firing strength (alpha-cut) tiap rule
        active_rules = []
        for rule in rules:
            u_val = mu_U.get(rule.fase_umur, 0.0)
            bb_val = mu_BB.get(rule.kategori_berat, 0.0)
            tb_val = mu_TB.get(rule.kategori_tinggi, 0.0)
            
            # Kategori imunisasi di DB bisa "Tidak Lengkap", "Sebagian", "Lengkap"
            im_val = 1.0 if status_imunisasi == rule.kategori_imunisasi else 0.0
            
            alpha = min(u_val, bb_val, tb_val, im_val)
            if alpha > 0:
                active_rules.append((rule, alpha))

        # 3. Aggregasi & Defuzzifikasi (Centroid / Center of Gravity)
        # Tentukan nilai diskrit z dari 30.0 sampai 95.0 dengan interval 0.1
        z_vals = [30.0 + i * 0.1 for i in range(651)]
        
        status_gizi_key_map = {
            "Gizi Buruk": "GiziBuruk",
            "Gizi Kurang": "GiziKurang",
            "Normal": "Normal",
            "Gizi Lebih": "GiziLebih",
            "Obesitas": "Obesitas"
        }

        numerator = 0.0
        denominator = 0.0

        for z in z_vals:
            deg_gizi = hitung_derajat_status_gizi(z)
            mu_agg_z = 0.0
            
            for rule, alpha in active_rules:
                conseq_class = status_gizi_key_map.get(rule.hasil_status_gizi)
                if conseq_class:
                    conseq_membership = deg_gizi.get(conseq_class, 0.0)
                    implication = min(alpha, conseq_membership)
                    if implication > mu_agg_z:
                        mu_agg_z = implication
            
            numerator += z * mu_agg_z
            denominator += mu_agg_z

        skor_gizi = numerator / denominator if denominator > 0 else 53.0 # Default ke nilai tengah normal jika tidak ada rule aktif

        # 4. Klasifikasi Akhir
        final_deg = hitung_derajat_status_gizi(skor_gizi)
        max_class = max(final_deg, key=final_deg.get)

        key_to_label_map = {
            "GiziBuruk": "Gizi Buruk",
            "GiziKurang": "Gizi Kurang",
            "Normal": "Normal",
            "GiziLebih": "Gizi Lebih",
            "Obesitas": "Obesitas"
        }
        kategori_status_gizi = key_to_label_map.get(max_class, "Normal")

        # 5. Siapkan Detail Hasil Fuzzy
        detail_rules = []
        for rule, alpha in active_rules:
            rule_str = f"IF Umur={rule.fase_umur} AND BB={rule.kategori_berat} AND TB={rule.kategori_tinggi} AND Imunisasi={rule.kategori_imunisasi} THEN StatusGizi={rule.hasil_status_gizi}"
            detail_rules.append({
                "rule_aktif": rule_str,
                "alpha_predikat": alpha,
                "nilai_deffuzy": skor_gizi,
                "id_pemeriksaan": 0,
                "id_rule": rule.id_rule
            })

        return skor_gizi, kategori_status_gizi, input_derajat, detail_rules
