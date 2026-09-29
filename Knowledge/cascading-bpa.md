# Cetak Biru Cascading SAKIP & Renstra Kejaksaan RI 2025-2029
## Bidang Pengampuan: Badan Pemulihan Aset (BPA)

Dokumen ini menyajikan peta penjenjangan kinerja (*cascading structure*) secara utuh, rigid, mendalam, tanpa singkatan, dan terperinci untuk seluruh Sasaran Program (SP), Indikator Kinerja Program (IKP/IKSP), Sasaran Kegiatan (SK/Saskeg), dan Indikator Kinerja Kegiatan (IKK/IKSK) di bawah pengampuan **Badan Pemulihan Aset (BPA)** sesuai dengan Peraturan Kejaksaan RI No. 4 Tahun 2025 dan pedoman evaluasi pengukuran kinerja SAKIP.

Arsitektur database SICANA mengimplementasikan struktur ini dengan pola *Self-Referencing Adjacency List* menggunakan field `parent_id` untuk menghubungkan relasi dinamis tanpa batas (*Infinite Hierarchy*).

---

## 🪜 PETA HIERARKI TANGGA CASCADING & FORMULA PENGUKURAN

### 🎯 [SP 13] Sasaran Program: Terselenggaranya pemulihan aset yang terintegrasi
*   **Unit Pengampu Utama:** Badan Pemulihan Aset (BPA) / Eselon I
*   **Target (2025-2029):** 90% -> 91% -> 92% -> 93% -> 94%

#### 📊 [IKP 13.1] Indikator Kinerja Program: Tingkat keberhasilan kegiatan penelusuran aset
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Formula Capaian:**
    $$\text{Capaian IKP 13.1} = \left( \frac{\text{NUM\_BPA\_TRACE}}{\text{DEN\_BPA\_TRACE}} \right) \times 100\%$$
*   **Sumber Data:** Laporan / Aplikasi ARSSYS (Asset Recovery Secured Data System).

##### 🪜 [SK 13.1.1] Sasaran Kegiatan: Meningkatnya efektivitas pengelolaan, penelusuran, dan perampasan aset
*   **Unit Kerja Penanggung Jawab:** Badan Pemulihan Aset (BPA)

###### 📌 [IKK 13.1.1.1] Persentase pelaksanaan penelusuran aset
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Pembilang (Numerator):** `NUM_BPA_TRACE` (Nilai taksiran aset yang diserahkan ke pemohon / dipulihkan dalam Rp).
*   **Penyebut (Denominator):** `DEN_BPA_TRACE` (Nilai taksiran aset hasil penelusuran/tracing dalam Rp).
*   **Formula Perhitungan:**
    $$\text{Realisasi IKK} = \left( \frac{\text{Nilai Aset Diserahkan ke Pemohon}}{\text{Nilai Taksiran Aset Hasil Tracing}} \right) \times 100\%$$
*   **Sumber Data:** Aplikasi ARSSYS (Asset Recovery Secured Data System) / Laporan Hasil Pelacakan Aset.

###### 🍃 [RAW_INPUT] Elemen Data Transaksional (Level 8 - Leaf Node)
*   `IN_BPA_TRACE_TAKASIRAN_RP` [Leaf]: Nilai nominal taksiran aset hasil penelusuran (tracing) aktif dalam Rp (Direct Input).
*   `IN_BPA_TRACE_REALISASI_RP` [Leaf]: Nilai nominal taksiran aset yang berhasil diserahkan kembali kepada pemohon/negara dalam Rp (Direct Input).

---

#### 📊 [IKP 13.2] Indikator Kinerja Program: Tingkat keberhasilan perampasan aset hasil tindak pidana
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Formula Capaian:**
    $$\text{Capaian IKP 13.2} = \left( \frac{\text{NUM\_BPA\_SEIZE}}{\text{DEN\_BPA\_SEIZE}} \right) \times 100\%$$
*   **Sumber Data:** Laporan / Aplikasi ARSSYS.

##### 🪜 [SK 13.1.2] Sasaran Kegiatan: Pelaksanaan Tindakan Hukum Perampasan/Penyitaan Aset
*   **Unit Kerja Penanggung Jawab:** Badan Pemulihan Aset (BPA)

###### 📌 [IKK 13.1.2.1] Persentase pelaksanaan perampasan aset
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Pembilang (Numerator):** `NUM_BPA_SEIZE` (Nilai nominal aset hasil tindak pidana yang berhasil dirampas berdasarkan Berita Acara Penerimaan/Penyitaan dalam Rp).
*   **Penyebut (Denominator):** `DEN_BPA_SEIZE` (Nilai nominal aset target eksekusi putusan hakim yang berhasil ditelusuri dalam Rp).
*   **Formula Perhitungan:**
    $$\text{Realisasi IKK} = \left( \frac{\text{Nilai Aset Dirampas (BA Penerimaan)}}{\text{Nilai Aset Hasil Penelusuran}} \right) \times 100\%$$
*   **Sumber Data:** Berita Acara (BA) Penitipan/Penyitaan / Aplikasi ARSSYS.

###### 🍃 [RAW_INPUT] Elemen Data Transaksional (Level 8 - Leaf Node)
*   `IN_BPA_SEIZE_TARGET_RP` [Leaf]: Nilai nominal target eksekusi penyitaan aset sesuai amar putusan hakim/tuntutan dalam Rp (Direct Input).
*   `IN_BPA_SEIZE_BA_PENERIMAAN_RP` [Leaf]: Nilai nominal riil aset yang berhasil disita berdasarkan Berita Acara Penyitaan dalam Rp (Direct Input).

---

#### 📊 [IKP 13.3] Indikator Kinerja Program: Tingkat keberhasilan pemulihan aset hasil tindak pidana
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Formula Capaian:**
    $$\text{Capaian IKP 13.3} = \left( \frac{\text{NUM\_BPA\_RECOVERY}}{\text{DEN\_BPA\_RECOVERY}} \right) \times 100\%$$
*   **Sumber Data:** Laporan / Aplikasi ARSSYS.

##### 🪜 [SK 13.1.3] Sasaran Kegiatan: Pelaksanaan Monetisasi dan Likuidasi Aset Rampasan
*   **Unit Kerja Penanggung Jawab:** Badan Pemulihan Aset (BPA)

###### 📌 [IKK 13.1.3.1] Persentase pelaksanaan pemulihan aset
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Pembilang (Numerator):** `NUM_BPA_RECOVERY` (Nilai uang riil hasil lelang, hibah, atau Penetapan Status Penggunaan [PSP] yang disetor ke Kas Negara dalam Rp).
*   **Penyebut (Denominator):** `DEN_BPA_RECOVERY` (Nilai taksiran harga pasar / nilai appraisal resmi aset rampasan dalam Rp).
*   **Formula Perhitungan:**
    $$\text{Realisasi IKK} = \left( \frac{\text{Nilai Uang Hasil Lelang/Hibah/PSP Disetor}}{\text{Nilai Taksiran Penilaian Aset Rampasan}} \right) \times 100\%$$
*   **Sumber Data:** Register Bukti Eksekusi Lelang PNBP / Kuitansi Penyetoran Kas Negara (Aplikasi SAKTI / SIMAN / ARSSYS).

###### 🍃 [RAW_INPUT] Elemen Data Transaksional (Level 8 - Leaf Node)
*   `IN_BPA_LIQUID_APPRAISAL_RP` [Leaf]: Nilai nominal taksiran harga limit lelang/appraisal resmi dari tim penilai dalam Rp (Direct Input).
*   `IN_BPA_LIQUID_SETOR_PNBP_RP` [Leaf]: Nilai uang riil hasil lelang/monetisasi aset yang resmi disetor ke kas negara (PNBP) dalam Rp (Direct Input).

###### 📌 [IKK 13.1.3.2] Persentase pelaksanaan pengembalian aset
*   **Sifat Node:** Leaf Node (`DIRECT_INPUT`)
*   **Formula Perhitungan:**
    $$\text{Realisasi IKK} = \left( \frac{\text{Jumlah Paket Aset Berhasil Dikembalikan}}{\text{Total Paket Aset yang Harus Dikembalikan Sesuai Amar Putusan}} \right) \times 100\%$$
*   **Sumber Data:** BA Pengembalian Barang Bukti kepada Pemilik / Aplikasi ARSSYS.

---

### 🎯 [SP 14] Sasaran Program: Terwujudnya pengelolaan aset tindak pidana yang transparan, akuntabel, dan modern
*   **Unit Pengampu Utama:** Badan Pemulihan Aset (BPA) / Eselon I
*   **Target (2025-2029):** Indeks Kematangan Kinerja 4.0 -> 4.1 -> 4.2 -> 4.3 -> 4.4

#### 📊 [IKP 14.1] Indikator Kinerja Program: Tingkat efektivitas pengelolaan Rupbasan
*   **Sifat Node:** Cascading Node (`AVERAGE`)
*   **Formula Capaian:** Rata-rata dari nilai indeks tata kelola aset titipan di daerah.
*   **Sumber Data:** Laporan Pengelolaan Rupbasan Adhyaksa / Aplikasi ARSSYS.

##### 🪜 [SK 14.1.1] Sasaran Kegiatan: Meningkatnya efektivitas tata kelola aset berupa barang sitaan dan barang rampasan tindak pidana
*   **Unit Kerja Penanggung Jawab:** Badan Pemulihan Aset (BPA)

###### 📌 [IKK 14.1.1.1] Persentase keberhasilan pemeliharaan aset tindak pidana
*   **Sifat Node:** Leaf Node (`DIRECT_INPUT`)
*   **Formula Perhitungan:**
    $$\text{Realisasi IKK} = \left( \frac{\text{Jumlah Aset Terjaga Kondisi Layak Pakai/Sesuai BA}}{\text{Total Seluruh Barang Bukti Titipan yang Ditatausahakan}} \right) \times 100\%$$
*   **Sumber Data:** Buku Register Pemeliharaan Fisik Barang Rampasan Rupbasan / ARSSYS.

---

#### 📊 [IKP 14.2] Indikator Kinerja Program: Tingkat efektivitas penyelesaian penyelamatan aset negara
*   **Sifat Node:** Cascading Node (`AVERAGE`)
*   **Formula Capaian:** Rata-rata dari persentase kepatuhan eksekusi penyelamatan aset negara.

##### 🪜 [SK 14.1.2] Sasaran Kegiatan: Pelaksanaan Penyelamatan Aset Sektoral
*   **Unit Kerja Penanggung Jawab:** Badan Pemulihan Aset (BPA)

###### 📌 [IKK 14.1.2.1] Persentase penyelesaian penyelamatan aset negara tindak pidana
*   **Sifat Node:** Leaf Node (`DIRECT_INPUT`)
*   **Formula Perhitungan:** Kepatuhan pelaksanaan pelelangan, Penetapan Status Penggunaan (PSP), atau hibah aset rampasan negara.
*   **Sumber Data:** Dokumen Keputusan PSP / Keputusan Hibah Kementerian Keuangan / ARSSYS.

---

#### 📊 [IKP 14.3] Indikator Kinerja Program: Tingkat efektivitas pengelolaan data aset negara berbasis teknologi
*   **Sifat Node:** Cascading Node (`AVERAGE`)
*   **Formula Capaian:** Rerata persentase sinkronisasi data antar platform yustisial.

##### 🪜 [SK 14.1.3] Sasaran Kegiatan: Digitalisasi Integrasi Data Aset Terintegrasi
*   **Unit Kerja Penanggung Jawab:** Badan Pemulihan Aset (BPA)

###### 📌 [IKK 14.1.3.1] Persentase sinkronisasi data aset
*   **Sifat Node:** Leaf Node (`DIRECT_INPUT`)
*   **Formula Perhitungan:**
    $$\text{Realisasi IKK} = \left( \frac{\text{Jumlah Record Aset Ter-singkronisasi Otomatis}}{\text{Total Record Aset Baru Terdaftar di CMS Perkara (Pidum/Pidsus)}} \right) \times 100\%$$
*   **Sumber Data:** Log Server Puskarda (Pusat Kendali Data) Integrasi ARSSYS dengan CMS Pidum/Pidsus/SIMAN.

---

## 💻 IMPLIKASI PADA ARSITEKTUR DATABASE LARAVEL (SICANA ENGINE)

Sistem informasi **SICANA** mengintegrasikan seluruh parameter pohon di atas dengan model relasional tunggal yang dinamis:

1.  **Struktur Relasi Rekursif (Adjacency List):**
    Seluruh SP, IKP, SK, dan IKK disimpan dalam satu tabel tunggal `performance_nodes` dengan memanfaatkan foreign key `parent_id` yang menunjuk dirinya sendiri.
2.  **Penanganan Financial Leaf Nodes:**
    Untuk SP 13, isian data transaksional di level terbawah (`RAW_INPUT` / Level 8) bertipe data `DECIMAL(20,2)` untuk memfasilitasi rekaman nominal Rupiah yang presisi dari aplikasi ARSSYS lintas sektoral Kejaksaan, sehingga tidak akan memicu kesalahan pembulatan matematis.
3.  **Safety Logic Engine:**
    Logic calculation diletakkan pada Service Class `BpaCalculationEngine.php`. Jika data penyebut di level terbawah bernilai nol (misal tidak ada target pelacakan aset pada triwulan berjalan), engine otomatis menghasilkan nilai `0.00` guna mencegah crash sistem akibat pembagian dengan nol (*division by zero*).

---
