from typing import List, Optional
from sqlalchemy.ext.asyncio import AsyncSession
from sqlalchemy.future import select
from src.domain.repositories.rules_fuzzy import IRulesFuzzyRepository
from src.domain.entities.rules_fuzzy import RulesFuzzy, FaseUmurType
from src.infrastructure.database.models import RulesFuzzyModel

class RulesFuzzyRepository(IRulesFuzzyRepository):
    def init(self, db_session: AsyncSession):
        self._db = db_session

    async def get_by_id(self, id_rule: int) -> Optional[RulesFuzzy]:
        query = select(RulesFuzzyModel).where(RulesFuzzyModel.id_rule == id_rule)
        result = await self._db.execute(query)
        model = result.scalar_one_or_none()
        if not model:
            return None
        return RulesFuzzy(
            id_rule=model.id_rule,
            fase_umur=model.fase_umur,
            kategori_berat=model.kategori_berat,
            kategori_tinggi=model.kategori_tinggi,
            kategori_imunisasi=model.kategori_imunisasi,
            hasil_status_gizi=model.hasil_status_gizi
        )

    async def get_rules_by_fase(self, fase_umur: FaseUmurType) -> List[RulesFuzzy]:
        query = select(RulesFuzzyModel).where(RulesFuzzyModel.fase_umur == fase_umur)
        result = await self._db.execute(query)
        models = result.scalars().all()
        return [
            RulesFuzzy(
                id_rule=m.id_rule,
                fase_umur=m.fase_umur,
                kategori_berat=m.kategori_berat,
                kategori_tinggi=m.kategori_tinggi,
                kategori_imunisasi=m.kategori_imunisasi,
                hasil_status_gizi=m.hasil_status_gizi
            )
            for m in models
        ]

    async def list_all(self) -> List[RulesFuzzy]:
        # 1. Jalankan query SELECT * FROM rules_fuzzy
        query = select(RulesFuzzyModel)
        result = await self._db.execute(query)
        models = result.scalars().all()
        # 2. Mapping dari Model SQLAlchemy (Infrastructure) ke Entity Pydantic (Domain)
        # Langkah ini wajib dalam Clean Architecture agar layer app/domain tidak ketergantungan SQLAlchemy
        return [
            RulesFuzzy(
                id_rule=m.id_rule,
                fase_umur=m.fase_umur,
                kategori_berat=m.kategori_berat,
                kategori_tinggi=m.kategori_tinggi,
                kategori_imunisasi=m.kategori_imunisasi,
                hasil_status_gizi=m.hasil_status_gizi
            )
            for m in models
        ]