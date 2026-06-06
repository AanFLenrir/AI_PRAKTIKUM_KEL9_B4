from sqlalchemy import Column, Integer, String, Enum, Text, DateTime
from datetime import datetime, timezone
from .config import Base
from src.types import (
    FaseUmurType,
    KategoriBeratType,
    KategoriImunisasiType,
    KategoriTinggiType,
    HasilStatusGiziType
)

class RulesFuzzyModel(Base):
    __tablename__ = "rules_fuzzy" 

    id_rule = Column(Integer, primary_key=True, index=True)
    fase_umur = Column(Enum(*FaseUmurType.__args__), nullable=False)
    kategori_berat = Column(Enum(*KategoriBeratType.__args__), nullable=False)
    kategori_tinggi = Column(Enum(*KategoriTinggiType.__args__), nullable=False)
    kategori_imunisasi = Column(Enum(*KategoriImunisasiType.__args__), nullable=False)
    hasil_status_gizi = Column(Enum(*HasilStatusGiziType.__args__), nullable=False)

class ImunisasiModel(Base):
    __tablename__ = "imunisasi" 

    id_imunisasi = Column(Integer, primary_key=True, autoincrement=True)
    nama_imunisasi = Column(String(100), nullable=False)
    umur_bulan = Column(Integer, nullable=False)
    keterangan_imunisasi = Column(Text, nullable=True)
    
    created_at = Column(DateTime, default=lambda: datetime.now(timezone.utc))
    updated_at = Column(DateTime, default=lambda: datetime.now(timezone.utc), onupdate=lambda: datetime.now(timezone.utc))