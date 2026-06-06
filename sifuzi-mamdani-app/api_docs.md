# Dokumentasi API - Sifuzi Mamdani

API ini menyediakan endpoint untuk melakukan perhitungan status gizi balita menggunakan logika fuzzy Mamdani dan kelengkapan imunisasi secara stateless.

## Endpoint: Perhitungan Fuzzy & Imunisasi

Melakukan perhitungan derajat keanggotaan fuzzy, mengevaluasi aturan fuzzy (Mamdani), dan menentukan status kelengkapan imunisasi serta kategori status gizi.

* **URL:** `/api/v1/fuzzy-calculation`
* **Method:** `POST`
* **Content-Type:** `application/json`

### Request Payload

| Field | Tipe | Deskripsi | Contoh |
| :--- | :--- | :--- | :--- |
| `jenis_kelamin` | `str` | Jenis kelamin balita (`"L"` untuk Laki-laki, `"P"` untuk Perempuan) | `"L"` |
| `berat_badan` | `float` | Berat badan balita dalam kg (harus > 0) | `9.0` |
| `tinggi_badan` | `float` | Tinggi badan balita dalam cm (harus > 0) | `65.0` |
| `umur_bulan` | `int` | Umur balita dalam bulan (harus >= 0) | `12` |
| `daftar_imunisasi` | `List[Union[str, int]]` | Daftar imunisasi yang telah diterima, dapat berupa nama imunisasi (string) atau ID imunisasi (integer) | `["HB 0", "BCG"]` |

#### Contoh Request Body
```json
{
  "jenis_kelamin": "L",
  "berat_badan": 9.0,
  "tinggi_badan": 65.0,
  "umur_bulan": 12,
  "daftar_imunisasi": ["HB 0", "BCG"]
}
```

### Response Body

| Field | Tipe | Deskripsi | Contoh |
| :--- | :--- | :--- | :--- |
| `status_imunisasi` | `str` | Kategori kelengkapan imunisasi (`"Lengkap"`, `"Sebagian"`, `"Tidak Lengkap"`) | `"Lengkap"` |
| `skor_gizi` | `float` | Nilai tegas (skor status gizi) hasil defuzzifikasi | `57.0` |
| `kategori_status_gizi` | `str` | Klasifikasi status gizi akhir (`"Gizi Buruk"`, `"Gizi Kurang"`, `"Normal"`, `"Gizi Lebih"`, `"Obesitas"`) | `"Normal"` |
| `derajat_keanggotaan` | `dict` | Detail derajat fuzzy keanggotaan input untuk variabel Umur, Berat Badan, Tinggi Badan, dan Imunisasi | `{...}` |
| `detail_hasil` | `List[dict]` | Detail rule fuzzy yang aktif, berisi `rule_aktif`, `alpha_predikat`, `nilai_deffuzy`, `id_pemeriksaan`, dan `id_rule` | `[...]` |

#### Contoh Response Body
```json
{
  "status_imunisasi": "Lengkap",
  "skor_gizi": 57.0,
  "kategori_status_gizi": "Normal",
  "derajat_keanggotaan": {
    "umur": {
      "Fase1": 0.0,
      "Fase2": 1.0,
      "Fase3": 0.0,
      "Fase4": 0.0,
      "Fase5": 0.0
    },
    "berat_badan": {
      "Ringan": 0.0,
      "Sedang": 1.0,
      "Berat": 0.0
    },
    "tinggi_badan": {
      "Rendah": 0.0,
      "AgakPanjang": 1.0,
      "Panjang": 0.0
    },
    "imunisasi": {
      "Lengkap": 1.0,
      "Sebagian": 0.0,
      "Tidak Lengkap": 0.0
    }
  }
}
```

## Endpoint: Z-Score Antropometri

Menghitung kategorisasi Z-Score secara paralel (IMT, BB/U, PB/U, BB/PB, IMT/U) menggunakan panduan SD WHO dan Permenkes 2020. 
*(Catatan: Sementara data tabel BB/PB dan IMT/U belum disusun per jenis kelamin di sistem, Endpoint akan mengembalikan String peringatan data "*Data SD tidak tersedia*").*

* **URL:** `/api/v1/kalkulasi-zscore`
* **Method:** `POST`
* **Content-Type:** `application/json`

### Request Payload

| Field | Tipe | Deskripsi | Contoh |
| :--- | :--- | :--- | :--- |
| `jenis_kelamin` | `str` | `"L"` atau `"P"` | `"L"` |
| `berat_badan` | `float` | Berat dalam kg | `9.0` |
| `tinggi_badan` | `float` | Tinggi/Panjang dalam cm | `65.0` |
| `umur_bulan` | `int` | Umur dalam bulan | `12` |

### Response Body

| Field | Tipe | Deskripsi | Contoh |
| :--- | :--- | :--- | :--- |
| `imt` | `float` | Indeks Massa Tubuh | `21.3` |
| `kategori_bbu` | `str` | Kategori BB/U | `"Berat badan normal"` |
| `kategori_pbu` | `str` | Kategori PB/U atau TB/U | `"Normal"` |
| `kategori_bbpb` | `str` | Kategori BB/PB | `"Data SD tidak tersedia"` |
| `kategori_imtu` | `str` | Kategori IMT/U | `"Data SD tidak tersedia"` |

