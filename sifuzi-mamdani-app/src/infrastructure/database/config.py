import os
from sqlalchemy.ext.asyncio import create_async_engine, AsyncSession
from sqlalchemy.orm import sessionmaker, declarative_base

DATABASE_URL = os.getenv("DATABASE_URL")

# 1. Membuat engine database berbasis Async
engine = create_async_engine(DATABASE_URL, echo=True)

# 2. Membuat pabrik session untuk query
AsyncSessionLocal = sessionmaker(
    bind=engine,
    class_=AsyncSession,
    expire_on_commit=False
)

# 3. Base class yang akan dipakai oleh model-model tabel kita
Base = declarative_base()

# Helper untuk mendapatkan session DB di FastAPI (Dependency Injection)
async def get_db():
    async with AsyncSessionLocal() as session:
        try:
            yield session
        finally:
            await session.close()