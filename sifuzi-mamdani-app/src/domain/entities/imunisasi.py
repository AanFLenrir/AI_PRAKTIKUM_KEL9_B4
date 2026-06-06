from pydantic import BaseModel
from datetime import datetime
from typing import Optional

class Imunisasi(BaseModel):
    id_imunisasi: int
    nama_imunisasi: str
    umur_bulan: int
    keterangan_imunisasi: Optional[str] = None # Pakai Optional karena ->nullable()
    created_at: datetime
    updated_at: datetime
    class Config:
        from_attributes = True # Agar Pydantic bisa otomatis konversi dari model SQLAlchemy