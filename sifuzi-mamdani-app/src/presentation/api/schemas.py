from typing import List, Union, Dict, Literal
from pydantic import BaseModel, Field

class FuzzyCalculationRequest(BaseModel):
    jenis_kelamin: Literal['L', 'P'] = Field(..., description="Jenis kelamin balita ('L' untuk Laki-laki, 'P' untuk Perempuan)")
    berat_badan: float = Field(..., gt=0, description="Berat badan dalam kg (contoh: 8.5)")
    tinggi_badan: float = Field(..., gt=0, description="Tinggi badan dalam cm (contoh: 72.0)")
    umur_bulan: int = Field(..., ge=0, description="Umur balita dalam bulan (contoh: 12)")
    daftar_imunisasi: List[Union[str, int]] = Field(
        ..., 
        description="Daftar imunisasi yang sudah diterima, berupa nama (string) atau ID (integer) (contoh: ['BCG', 'HB 0', 3])"
    )

class DetailHasilFuzzySchema(BaseModel):
    rule_aktif: str
    alpha_predikat: float
    nilai_deffuzy: float
    id_pemeriksaan: int
    id_rule: int

class FuzzyCalculationResponse(BaseModel):
    status_imunisasi: str = Field(..., description="Kategori kelengkapan imunisasi ('Lengkap', 'Sebagian', 'Tidak Lengkap')")
    skor_gizi: float = Field(..., description="Skor status gizi hasil defuzzifikasi")
    kategori_status_gizi: str = Field(..., description="Kategori status gizi hasil klasifikasi akhir")
    derajat_keanggotaan: Dict[str, Dict[str, float]] = Field(..., description="Derajat keanggotaan untuk masing-masing variabel input")
    detail_hasil: List[DetailHasilFuzzySchema] = Field(..., description="Detail rule aktif beserta alpha predikat")

class ZScoreCalculationRequest(BaseModel):
    jenis_kelamin: Literal['L', 'P'] = Field(..., description="Jenis kelamin balita ('L' atau 'P')")
    berat_badan: float = Field(..., gt=0, description="Berat badan dalam kg")
    tinggi_badan: float = Field(..., gt=0, description="Tinggi badan atau panjang badan dalam cm")
    umur_bulan: int = Field(..., ge=0, description="Umur balita dalam bulan")

class ZScoreCalculationResponse(BaseModel):
    imt: float = Field(..., description="Nilai Indeks Massa Tubuh")
    kategori_bbu: str = Field(..., description="Kategori Berat Badan menurut Umur")
    kategori_pbu: str = Field(..., description="Kategori Panjang/Tinggi Badan menurut Umur")
    kategori_bbpb: str = Field(..., description="Kategori Berat Badan menurut Panjang/Tinggi Badan")
    kategori_imtu: str = Field(..., description="Kategori IMT menurut Umur")
