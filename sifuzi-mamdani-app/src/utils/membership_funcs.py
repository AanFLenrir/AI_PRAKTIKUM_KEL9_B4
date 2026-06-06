def kurva_segitiga(x: float, a: float, b: float, c: float) -> float:
    """Menghitung derajat keanggotaan kurva segitiga."""
    if x <= a or x >= c:
        return 0.0
    elif a < x <= b:
        return (x - a) / (b - a)
    elif b < x < c:
        return (c - x) / (c - b)
    return 0.0

def kurva_trapesium(x: float, a: float, b: float, c: float, d: float) -> float:
    """Menghitung derajat keanggotaan kurva trapesium."""
    if x <= a or x >= d:
        return 0.0
    elif a < x <= b:
        return (x - a) / (b - a)
    elif b < x <= c:
        return 1.0
    elif c < x < d:
        return (d - x) / (d - c)
    return 0.0

def kurva_trapesium_kiri(x: float, a: float, b: float) -> float:
    """
    Menghitung derajat keanggotaan kurva trapesium kiri (Bahu Kiri).
    a = titik saat nilai mulai turun dari 1.0
    b = titik saat nilai sudah menyentuh 0.0
    """
    if x <= a:
        return 1.0
    elif a < x < b:
        return (b - x) / (b - a)
    else:
        return 0.0
    
def kurva_trapesium_kanan(x: float, a: float, b: float) -> float:
    """
    Menghitung derajat keanggotaan kurva trapesium kanan (Bahu Kanan).
    a = titik saat nilai mulai naik dari 0.0
    b = titik saat nilai sudah mencapai puncak 1.0
    """
    if x <= a:
        return 0.0
    elif a < x < b:
        return (x - a) / (b - a)
    else:
        return 1.0