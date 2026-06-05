from abc import ABC, abstractmethod
from typing import List, Optional
from src.domain.entities import ( Imunisasi )

class IImunisasiRepository(ABC):
    
    @abstractmethod
    async def fetch_all(self) -> List[Imunisasi]:
        pass
    @abstractmethod
    async def find_by_id(self, id_imunisasi: int) -> Optional[Imunisasi]:
        pass
    @abstractmethod
    async def find_by_umur(self, umur_bulan: int) -> List[Imunisasi]:
        pass