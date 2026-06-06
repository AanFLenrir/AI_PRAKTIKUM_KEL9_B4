import asyncio
from typing import Dict, Optional, Tuple
from src.utils.lookup_table_reader import get_sd_values

class ZScoreService:
    def hitung_imt(self, berat_badan: float, tinggi_badan: float) -> float:
        # tinggi_badan diubah ke meter
        tb_m = tinggi_badan / 100.0
        return round(berat_badan / (tb_m**2), 2)
        
    def _kategorisasi_standar(self, val: float, sd: Dict[str, float], tipe: str) -> str:
        # BB/U 
        if tipe == "BB_U":
            if val < sd["min_3"]: return "Berat badan sangat kurang (severely underweight)"
            elif val < sd["min_2"]: return "Berat badan kurang (underweight)"
            elif val <= sd["plus_1"]: return "Berat badan normal"
            else: return "Risiko Berat badan lebih"
            
        elif tipe == "PB_U":
            if val < sd["min_3"]: return "Sangat pendek (severely stunted)"
            elif val < sd["min_2"]: return "Pendek (stunted)"
            elif val <= sd["plus_3"]: return "Normal"
            else: return "Tinggi"
            
        elif tipe == "BB_PB":
            if val < sd["min_3"]: return "Gizi buruk (severely wasted)"
            elif val < sd["min_2"]: return "Gizi kurang (wasted)"
            elif val <= sd["plus_1"]: return "Gizi baik (normal)"
            elif val <= sd["plus_2"]: return "Berisiko gizi lebih (possible risk of overweight)"
            elif val <= sd["plus_3"]: return "Gizi lebih (overweight)"
            else: return "Obesitas (obese)"
            
        elif tipe == "IMT_U":
            # Berdasarkan permenkes anak usia 0-60 bulan format IMT mirip dengan BB/PB
            if val < sd["min_3"]: return "Gizi buruk (severely wasted)"
            elif val < sd["min_2"]: return "Gizi kurang (wasted)"
            elif val <= sd["plus_1"]: return "Gizi baik (normal)"
            elif val <= sd["plus_2"]: return "Berisiko gizi lebih (possible risk of overweight)"
            elif val <= sd["plus_3"]: return "Gizi lebih (overweight)"
            else: return "Obesitas (obese)"
            
        return "Normal"

    async def kategori_bbu(self, jenis_kelamin: str, umur_bulan: int, bb: float) -> str:
        sd = get_sd_values(jenis_kelamin, "BB_U", umur_bulan)
        if not sd: return "Data SD tidak tersedia"
        return self._kategorisasi_standar(bb, sd, "BB_U")

    async def kategori_pbu(self, jenis_kelamin: str, umur_bulan: int, pb: float) -> str:
        sd = get_sd_values(jenis_kelamin, "PB_U", umur_bulan)
        if not sd: return "Data SD tidak tersedia"
        return self._kategorisasi_standar(pb, sd, "PB_U")

    async def kategori_bbpb(self, jenis_kelamin: str, pb: float, bb: float) -> str:
        # Tabel BB_PB dan TB_PB berada di interval kenaikan 0.5 cm.
        pb_rounded = round(pb * 2) / 2
        sd = get_sd_values(jenis_kelamin, "BB_PB", pb_rounded)
        if not sd: return "Data SD tidak tersedia"
        return self._kategorisasi_standar(bb, sd, "BB_PB")

    async def kategori_imtu(self, jenis_kelamin: str, umur_bulan: int, imt: float) -> str:
        sd = get_sd_values(jenis_kelamin, "IMT_U", umur_bulan)
        if not sd: return "Data SD tidak tersedia"
        return self._kategorisasi_standar(imt, sd, "IMT_U")

    async def calculate_all(self, jenis_kelamin: str, umur_bulan: int, bb: float, tb: float) -> Tuple[float, str, str, str, str]:
        imt_val = self.hitung_imt(bb, tb)
        
        # Eksekusi secara paralel menggunakan asyncio.gather
        tasks = [
            self.kategori_bbu(jenis_kelamin, umur_bulan, bb),
            self.kategori_pbu(jenis_kelamin, umur_bulan, tb),
            self.kategori_bbpb(jenis_kelamin, tb, bb),
            self.kategori_imtu(jenis_kelamin, umur_bulan, imt_val)
        ]
        
        res_bbu, res_pbu, res_bbpb, res_imtu = await asyncio.gather(*tasks)
        
        return imt_val, res_bbu, res_pbu, res_bbpb, res_imtu
