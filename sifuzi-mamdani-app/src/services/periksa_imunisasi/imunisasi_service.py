from typing import List, Union
from src.domain.repositories.imunisasi import IImunisasiRepository

class PeriksaImunisasiService:
    def __init__(self, repository: IImunisasiRepository):
        self.repository = repository

    async def periksa_kelengkapan(self, umur_bulan: int, daftar_imunisasi: List[Union[str, int]]) -> str:
        """
        Memeriksa kelengkapan imunisasi berdasarkan umur_bulan dan daftar imunisasi yang diterima.
        Status kelengkapan:
        - "Lengkap" jika semua imunisasi wajib up to umur_bulan ada di daftar_imunisasi.
        - "Tidak Lengkap" jika tidak ada satupun imunisasi wajib yang ada di daftar_imunisasi, atau daftar_imunisasi kosong.
        - "Sebagian" jika sebagian imunisasi wajib ada, namun tidak semua.
        """
        # Ambil data master imunisasi wajib up to umur_bulan
        imunisasi_wajib = await self.repository.find_up_to_umur(umur_bulan)
        
        if not imunisasi_wajib:
            return "Lengkap"

        # Buat set dari daftar imunisasi input untuk mempermudah pencarian (case-insensitive & strip untuk string)
        input_set = set()
        for x in daftar_imunisasi:
            if isinstance(x, str):
                input_set.add(x.strip().lower())
            else:
                input_set.add(x)

        # Hitung berapa banyak imunisasi wajib yang sudah terpenuhi
        terpenuhi_count = 0
        for wajib in imunisasi_wajib:
            # Cari kecocokan berdasarkan ID (int) atau nama (str, case-insensitive)
            nama_wajib_normalized = wajib.nama_imunisasi.strip().lower()
            if wajib.id_imunisasi in input_set or nama_wajib_normalized in input_set:
                terpenuhi_count += 1

        if terpenuhi_count == len(imunisasi_wajib):
            return "Lengkap"
        elif terpenuhi_count == 0:
            return "Tidak Lengkap"
        else:
            return "Sebagian"
