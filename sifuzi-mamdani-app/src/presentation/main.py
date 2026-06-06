from fastapi import FastAPI
from src.presentation.api.routes import router

app = FastAPI(
    title="Sifuzi Mamdani API",
    description="API untuk perhitungan status gizi balita menggunakan logika fuzzy Mamdani dan kelengkapan imunisasi secara stateless.",
    version="1.0.0"
)

# Include routes
app.include_router(router)
