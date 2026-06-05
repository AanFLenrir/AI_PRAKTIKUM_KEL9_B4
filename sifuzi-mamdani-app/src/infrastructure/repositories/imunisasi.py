from typing import List, Optional
from sqlalchemy.ext.asyncio import AsyncSession
from sqlalchemy.future import select
from src.domain.repositories.imunisasi import IImunisasiRepository
from src.domain.entities.imunisasi import Imunisasi
from src.infrastructure.database.models import ImunisasiModel

class ImunisasiRepository(IImunisasiRepository):
    def init(self, db_session: AsyncSession):
        # Menerima session database async dari FastAPI
        self._db = db_session
        
    async def fetch_all(self) -> List[Imunisasi]:
        """Query: SELECT * FROM imunisasi"""
        query = select(ImunisasiModel)
        result = await self._db.execute(query)
        models = result.scalars().all()
        
        # Konversi dari model SQLAlchemy ke Pydantic Entity Domain
        return [Imunisasi.model_validate(m) for m in models]
    
    async def find_by_id(self, id_imunisasi: int) -> Optional[Imunisasi]:
        """Query: SELECT * FROM imunisasi WHERE id_imunisasi = :id"""
        query = select(ImunisasiModel).where(ImunisasiModel.id_imunisasi == id_imunisasi)
        result = await self._db.execute(query)
        model = result.scalar_one_or_none()
        
        if not model:
            return None
        return Imunisasi.model_validate(model)
    
    async def find_by_umur(self, umur_bulan: int) -> List[Imunisasi]:
        """Query: SELECT * FROM imunisasi WHERE umur_bulan = :umur"""
        query = select(ImunisasiModel).where(ImunisasiModel.umur_bulan == umur_bulan)
        result = await self._db.execute(query)
        models = result.scalars().all()
        
        return [Imunisasi.model_validate(m) for m in models]