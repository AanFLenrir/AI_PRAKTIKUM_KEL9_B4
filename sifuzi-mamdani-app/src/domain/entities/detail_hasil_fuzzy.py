from pydantic import BaseModel, Field
from typing import Optional

class DetailHasilFuzzy(BaseModel):
    id_detail: Optional[int] = None
    rule_aktif: str
    alpha_predikat: float = Field(..., ge=0.0, le=1.0)
    nilai_deffuzy: float
    
    id_pemeriksaan: int
    id_rule: int
    
    def Is_active(self) -> bool:
        """Contoh metode bisnis: rule dianggap aktif jika alpha predikat di atas 0"""
        return self.alpha_predikat > 0.0
