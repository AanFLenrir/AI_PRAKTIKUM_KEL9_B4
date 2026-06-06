from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.ext.asyncio import AsyncSession

from src.infrastructure.database.config import get_db
from src.infrastructure.repositories.imunisasi import ImunisasiRepository
from src.infrastructure.repositories.rules_fuzzy import RulesFuzzyRepository
from src.services.periksa_imunisasi import PeriksaImunisasiService
from src.services.antropometri import FuzzyInferenceService
from src.services.antropometri.zscore_service import ZScoreService
from .schemas import (
    FuzzyCalculationRequest, FuzzyCalculationResponse,
    ZScoreCalculationRequest, ZScoreCalculationResponse
)

router = APIRouter(prefix="/api/v1", tags=["Fuzzy & Immunization"])

@router.post("/fuzzy-calculation", response_model=FuzzyCalculationResponse)
async def calculate_fuzzy_endpoint(
    payload: FuzzyCalculationRequest,
    db: AsyncSession = Depends(get_db)
):
    try:
        # Inisialisasi Repositories
        imunisasi_repo = ImunisasiRepository()
        imunisasi_repo.init(db)
        
        rules_repo = RulesFuzzyRepository()
        rules_repo.init(db)

        # Inisialisasi Services
        imunisasi_service = PeriksaImunisasiService(imunisasi_repo)
        fuzzy_service = FuzzyInferenceService(rules_repo)

        # 1. Periksa Status Kelengkapan Imunisasi
        status_imunisasi = await imunisasi_service.periksa_kelengkapan(
            umur_bulan=payload.umur_bulan,
            daftar_imunisasi=payload.daftar_imunisasi
        )

        # 2. Hitung Status Gizi dengan Fuzzy Inference
        skor_gizi, kategori_status_gizi, derajat_keanggotaan, detail_hasil = await fuzzy_service.hitung_status_gizi(
            jenis_kelamin=payload.jenis_kelamin,
            berat_badan=payload.berat_badan,
            tinggi_badan=payload.tinggi_badan,
            umur_bulan=payload.umur_bulan,
            status_imunisasi=status_imunisasi
        )

        return FuzzyCalculationResponse(
            status_imunisasi=status_imunisasi,
            skor_gizi=round(skor_gizi, 4),
            kategori_status_gizi=kategori_status_gizi,
            derajat_keanggotaan=derajat_keanggotaan,
            detail_hasil=detail_hasil
        )
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Terjadi kesalahan saat memproses perhitungan: {str(e)}")

@router.post("/kalkulasi-zscore", response_model=ZScoreCalculationResponse)
async def calculate_zscore_endpoint(payload: ZScoreCalculationRequest):
    try:
        zscore_svc = ZScoreService()
        imt, kat_bbu, kat_pbu, kat_bbpb, kat_imtu = await zscore_svc.calculate_all(
            jenis_kelamin=payload.jenis_kelamin,
            umur_bulan=payload.umur_bulan,
            bb=payload.berat_badan,
            tb=payload.tinggi_badan
        )
        
        return ZScoreCalculationResponse(
            imt=imt,
            kategori_bbu=kat_bbu,
            kategori_pbu=kat_pbu,
            kategori_bbpb=kat_bbpb,
            kategori_imtu=kat_imtu
        )
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Terjadi kesalahan saat memproses perhitungan z-score: {str(e)}")
