import asyncio
import os
import sys

# Define base path to ensure imports work from this location
sys.path.insert(0, os.path.dirname(os.path.abspath(__file__)))

from src.utils.lookup_table_reader import get_sd_values
from src.services.antropometri.fuzzy_service import FuzzyInferenceService
from sqlalchemy.ext.asyncio import AsyncSession
from src.infrastructure.repositories.rules_fuzzy import RulesFuzzyRepository

async def test_dynamic_sd():
    sd_bb = get_sd_values("L", "BB_U", 12)
    sd_pb = get_sd_values("L", "PB_U", 12)
    print("SD BB (Umur 12 L):", sd_bb)
    print("SD PB (Umur 12 L):", sd_pb)
    
if __name__ == "__main__":
    asyncio.run(test_dynamic_sd())
