from abc import ABC, abstractmethod
from typing import List
from src.domain.entities import ( DetailHasilFuzzy )

class IDetailHasilFuzzyRepository(ABC):
    @abstractmethod
    async def save_bulk(self, details: List[DetailHasilFuzzy]) -> List[DetailHasilFuzzy]:
        """Menyimpan banyak detail hasil fuzzy sekaligus hasil dari proses agregasi"""
        pass
    @abstractmethod
    async def get_by_pemeriksaan(self, id_pemeriksaan: int) -> List[DetailHasilFuzzy]:
        """Mengambil riwayat detail fuzzy berdasarkan ID pemeriksaan tertentu"""
        pass