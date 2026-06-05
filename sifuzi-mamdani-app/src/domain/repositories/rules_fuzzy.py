from abc import ABC, abstractmethod
from typing import List, Optional
from ..entities.rules_fuzzy import RulesFuzzy, FaseUmurType

class IRulesFuzzyRepository(ABC):
    
    @abstractmethod
    async def get_by_id(self, id_rule: int) -> Optional[RulesFuzzy]:
        """Mencari rule spesifik berdasarkan ID"""
        pass
    @abstractmethod
    async def get_rules_by_fase(self, fase_umur: FaseUmurType) -> List[RulesFuzzy]:
        """Mengambil semua aturan berdasarkan fase umur balita untuk dicocokkan"""
        pass
    @abstractmethod
    async def list_all(self) -> List[RulesFuzzy]:
        """Mengambil seluruh 35 rules fuzzy dari database"""
        pass