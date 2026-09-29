# 🪜 CETAK BIRU CASCADING KINERJA SAKIP JAM PIDMIL (JAKSA AGUNG MUDA BIDANG PIDANA MILITER)
## Sesuai Renstra Kejaksaan RI 2025–2029 dan Juknis Pengukuran SAKIP/LKjIP

Dokumen ini menyajikan arsitektur penjenjangan kinerja (*cascading structure*) secara utuh, rigid, mendalam, tanpa singkatan, dan terperinci untuk seluruh Sasaran Program (SP), Indikator Kinerja Program (IKP/IKSP), Sasaran Kegiatan (SK/Saskeg), dan Indikator Kinerja Kegiatan (IKK/IKSK) di bawah pengampuan **Jaksa Agung Muda Bidang Pidana Militer (JAM PIDMIL)**.

Platform **SICANA** mengimplementasikan struktur ini dengan pola **Self-Referencing Adjacency List** menggunakan field `parent_id` untuk menghubungkan relasi dinamis tanpa batas (*Infinite Hierarchy*).

---

## 🪜 PETA HIERARKI TANGGA CASCADING & FORMULA PENGUKURAN

### 🎯 [SP 9] Sasaran Program: Meningkatnya keberhasilan penanganan perkara koneksitas tindak pidana korupsi, tindak pidana pencucian uang, dan tindak pidana lain
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Pidana Militer (JAM PIDMIL) / Eselon I
*   **Target (2025-2029):** Terdistribusi per IKP (Rata-rata 80% -> 81% -> 82% -> 83% -> 84%)

#### 📊 [IKP 9.1] Indikator Kinerja Program: Tingkat keberhasilan penanganan perkara koneksitas pada tahap penyelidikan
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Target (2025-2029):** 80% -> 81% -> 82% -> 83% -> 84%
*   **Formula Capaian:** Rata-rata dari capaian Sasaran Kegiatan di bawahnya (Tingkat Kejati/Kejari yang memiliki aspidmil).

##### 🪜 [SK 9.1.1] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara koneksitas tindak pidana korupsi, tindak pidana pencucian uang, dan tindak pidana lain pada tahap penyelidikan
*   **Unit Kerja Penanggung Jawab:** Direktorat Penindakan JAM PIDMIL (Pusat) & Asisten Pidana Militer (Aspidmil) Kejaksaan Tinggi

###### 📌 [IKK 9.1.1.1] Tingkat penyelesaian perkara koneksitas pada Tahap Penyelidikan
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Rumus Capaian IKK:**
    $$K = \left( rac{	ext{NUM\_PIDMIL\_LID}}{	ext{DEN\_PIDMIL\_LID}} ight) 	imes 100\%$$

####### 📐 LEVEL 7: Parameter Agregat (Mathematical Node)
*   **`NUM_PIDMIL_LID` (Pembilang):** `IN_PIDMIL_LID_SELESAI` (Jumlah perkara koneksitas selesai lidik).
*   **`DEN_PIDMIL_LID` (Penyebut):** `IN_PIDMIL_LID_TOTAL` (Total perkara koneksitas ditangani lidik).

####### 🍃 LEVEL 8: Elemen Data Transaksional (Leaf Node - RAW INPUT)
*   `IN_PIDMIL_LID_TOTAL` [Leaf]: Jumlah total perkara koneksitas yang diselidiki (Total Surat Perintah Penyelidikan / Sprint-Lid aktif) (Data ditarik otomatis dari CMS Pidmil).
*   `IN_PIDMIL_LID_SELESAI` [Leaf]: Jumlah perkara koneksitas yang selesai pada tahap penyelidikan yang dapat dilanjutkan ke tahap penyidikan (PRADIK) atas persetujuan bersama antara Jaksa Peneliti dan Ankum, Perwira Penyerah Perkara (Papera), dan Oditur Militer.

---

#### 📊 [IKP 9.2] Indikator Kinerja Program: Tingkat keberhasilan penanganan perkara koneksitas pada tahap penyidikan
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Target (2025-2029):** 80% -> 81% -> 82% -> 83% -> 84%
*   **Formula Capaian:** Rata-rata dari capaian Sasaran Kegiatan di bawahnya.

##### 🪜 [SK 9.2.1] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara koneksitas tindak pidana korupsi, tindak pidana pencucian uang, dan tindak pidana lain pada tahap penyidikan
*   **Unit Kerja Penanggung Jawab:** Direktorat Penindakan JAM PIDMIL (Pusat) & Asisten Pidana Militer (Aspidmil) Kejaksaan Tinggi

###### 📌 [IKK 9.2.1.1] Tingkat penyelesaian perkara koneksitas pada Tahap Penyidikan
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Rumus Capaian IKK:**
    $$K = \left( rac{	ext{NUM\_PIDMIL\_DIK}}{	ext{DEN\_PIDMIL\_DIK}} ight) 	imes 100\%$$

####### 📐 LEVEL 7: Parameter Agregat (Mathematical Node)
*   **`NUM_PIDMIL_DIK` (Pembilang):** `IN_PIDMIL_DIK_SELESAI` (Jumlah penyidikan koneksitas selesai tindakan hukum/berkas dilimpahkan).
*   **`DEN_PIDMIL_DIK` (Penyebut):** `IN_PIDMIL_DIK_TOTAL` (Total penyidikan koneksitas ditangani).

####### 🍃 LEVEL 8: Elemen Data Transaksional (Leaf Node - RAW INPUT)
*   `IN_PIDMIL_DIK_TOTAL` [Leaf]: Jumlah total perkara koneksitas yang disidik (Total Surat Perintah Penyidikan / Sprint-Dik aktif).
*   `IN_PIDMIL_DIK_SELESAI` [Leaf]: Jumlah perkara koneksitas pada tahap penyidikan yang selesai dilakukan tindakan hukum dan disetujui bersama antara Jaksa Peneliti dengan Ankum, Papera, dan Oditur Militer (Berita Acara/Tanda Terima penyerahan berkas perkara dari Direktorat Penindakan ke Direktorat Penuntutan).

---

#### 📊 [IKP 9.3] Indikator Kinerja Program: Tingkat keberhasilan penanganan perkara koneksitas pada tahap penuntutan
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Target (2025-2029):** 80% -> 81% -> 82% -> 83% -> 84%
*   **Formula Capaian:** Rata-rata dari capaian Sasaran Kegiatan di bawahnya.

##### 🪜 [SK 9.3.1] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara koneksitas tindak pidana korupsi, tindak pidana pencucian uang, dan tindak pidana lain pada tahap penuntutan
*   **Unit Kerja Penanggung Jawab:** Direktorat Penuntutan JAM PIDMIL & Asisten Pidana Militer (Aspidmil) Kejaksaan Tinggi

###### 📌 [IKK 9.3.1.1] Tingkat penyelesaian perkara koneksitas pada Tahap Penuntutan
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Rumus Capaian IKK:**
    $$K = \left( rac{	ext{NUM\_PIDMIL\_TUT}}{	ext{DEN\_PIDMIL\_TUT}} ight) 	imes 100\%$$

####### 📐 LEVEL 7: Parameter Agregat (Mathematical Node)
*   **`NUM_PIDMIL_TUT` (Pembilang):** `IN_PIDMIL_TUT_SELESAI` (Perkara koneksitas memperoleh putusan pengadilan minimal 2/3 tuntutan).
*   **`DEN_PIDMIL_TUT` (Penyebut):** `IN_PIDMIL_TUT_TOTAL` (Total perkara koneksitas dituntut).

####### 🍃 LEVEL 8: Elemen Data Transaksional (Leaf Node - RAW INPUT)
*   `IN_PIDMIL_TUT_TOTAL` [Leaf]: Jumlah total perkara koneksitas dituntut (Total Surat Perintah Pelimpahan Perkara).
*   `IN_PIDMIL_TUT_SELESAI` [Leaf]: Jumlah perkara koneksitas yang memperoleh putusan pengadilan (inkracht) minimal dua pertiga dari tuntutan bersama Jaksa Penuntut dan Oditur Militer.

---

#### 📊 [IKP 9.4] Indikator Kinerja Program: Tingkat keberhasilan penanganan perkara koneksitas yang telah dieksekusi
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Target (2025-2029):** 80% -> 81% -> 82% -> 83% -> 84%
*   **Formula Capaian:** Rata-rata dari capaian Sasaran Kegiatan di bawahnya.

##### 🪜 [SK 9.4.1] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara koneksitas tindak pidana korupsi, tindak pidana pencucian uang, dan tindak pidana lain yang telah dieksekusi
*   **Unit Kerja Penanggung Jawab:** Direktorat Penuntutan JAM PIDMIL (Seksi Eksekusi) & Asisten Pidana Militer (Aspidmil) Kejaksaan Tinggi

###### 📌 [IKK 9.4.1.1] Tingkat penyelesaian pelaksanaan Putusan Hakim Perkara Koneksitas yang telah Dieksekusi
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Rumus Capaian IKK:**
    $$K = \left( rac{	ext{NUM\_PIDMIL\_EKS}}{	ext{DEN\_PIDMIL\_EKS}} ight) 	imes 100\%$$

####### 📐 LEVEL 7: Parameter Agregat (Mathematical Node)
*   **`NUM_PIDMIL_EKS` (Pembilang):** `IN_PIDMIL_EKS_SELESAI` (Jumlah perkara koneksitas dieksekusi tepat waktu).
*   **`DEN_PIDMIL_EKS` (Penyebut):** `IN_PIDMIL_EKS_TOTAL` (Total putusan perkara koneksitas berkekuatan hukum tetap).

####### 🍃 LEVEL 8: Elemen Data Transaksional (Leaf Node - RAW INPUT)
*   `IN_PIDMIL_EKS_TOTAL` [Leaf]: Jumlah total putusan perkara koneksitas yang telah berkekuatan hukum tetap (Inkracht / Surat Perintah Pelaksanaan Putusan Pengadilan).
*   `IN_PIDMIL_EKS_SELESAI` [Leaf]: Jumlah perkara koneksitas yang telah dieksekusi sesuai isi putusan pengadilan secara tepat waktu (maksimal 7 hari setelah putusan berkekuatan hukum tetap / Berita Acara Pelaksanaan Putusan Pengadilan).

---

#### 📊 [IKP 9.5] Indikator Kinerja Program: Tingkat keberhasilan pengembalian Kerugian Negara Perkara Koneksitas yang dilimpahkan ke peradilan umum
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Target (2025-2029):** 80% -> 81% -> 82% -> 83% -> 84%
*   **Formula Capaian:** Rata-rata dari capaian Sasaran Kegiatan di bawahnya.

##### 🪜 [SK 9.5.1] Sasaran Kegiatan: Meningkatnya penyelesaian pengembalian kerugian negara perkara koneksitas yang dilimpahkan ke peradilan umum
*   **Unit Kerja Penanggung Jawab:** Direktorat Penuntutan JAM PIDMIL & Asisten Pidana Militer (Aspidmil) Kejaksaan Tinggi

###### 📌 [IKK 9.5.1.1] Tingkat penyelesaian pengembalian Kerugian Negara Perkara Koneksitas yang dilimpahkan ke peradilan umum
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Rumus Capaian IKK:**
    $$K = \left( rac{	ext{NUM\_PIDMIL\_KN}}{	ext{DEN\_PIDMIL\_KN}} ight) 	imes 100\%$$

####### 📐 LEVEL 7: Parameter Agregat (Mathematical Node)
*   **`NUM_PIDMIL_KN` (Pembilang):** `IN_PIDMIL_KN_RECOVERED` (Nilai kerugian negara yang berhasil dipulihkan, denda, dan uang pengganti).
*   **`DEN_PIDMIL_KN` (Penyebut):** `IN_PIDMIL_KN_TOTAL` (Nilai total kerugian negara, denda, dan uang pengganti berdasarkan putusan inkracht).

####### 🍃 LEVEL 8: Elemen Data Transaksional (Leaf Node - RAW INPUT)
*   `IN_PIDMIL_KN_TOTAL` [Leaf]: Nilai total kerugian negara, denda, dan uang pengganti yang ditetapkan dalam putusan pengadilan perkara koneksitas (peradilan umum) yang berkekuatan hukum tetap.
*   `IN_PIDMIL_KN_RECOVERED` [Leaf]: Nilai kerugian negara yang berhasil dipulihkan, denda, dan uang pengganti sesuai putusan pengadilan (Bukti Penerimaan Negara Bukan Pajak / bukti setor ke kas negara).

---

### 🎯 [SP 10] Sasaran Program: Meningkatnya keberhasilan pelaksanaan koordinasi teknis penuntutan yang dilakukan oleh oditurat militer
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Pidana Militer (JAM PIDMIL) / Eselon I
*   **Target (2025-2029):** Terdistribusi per IKP (Rata-rata 80% -> 81% -> 82% -> 83% -> 84%)

#### 📊 [IKP 10.1] Indikator Kinerja Program: Tingkat keberhasilan pelaksanaan Kegiatan Koordinasi Teknis Tahap Penindakan
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Target (2025-2029):** 80% -> 81% -> 82% -> 83% -> 84%

##### 🪜 [SK 10.1.1] Sasaran Kegiatan: Meningkatnya penyelesaian kegiatan koordinasi teknis penuntutan yang dilakukan oleh oditurat militer pada tahap penindakan
*   **Unit Kerja Penanggung Jawab:** Direktorat Penindakan JAM PIDMIL & Asisten Pidana Militer (Aspidmil) Kejaksaan Tinggi

###### 📌 [IKK 10.1.1.1] Tingkat penyelesaian Kegiatan Koordinasi Teknis (Assurance, Consultative, Pencegahan Fraud, Monitoring dan Evaluasi dan Pelaporan) Tahap Penindakan
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Rumus Capaian IKK:**
    $$K = \left( rac{	ext{NUM\_PIDMIL\_KOOR\_LID}}{	ext{DEN\_PIDMIL\_KOOR\_LID}} ight) 	imes 100\%$$

####### 📐 LEVEL 7: Parameter Agregat (Mathematical Node)
*   **`NUM_PIDMIL_KOOR_LID` (Pembilang):** `IN_PIDMIL_KOOR_LID_SELESAI` (Jumlah kegiatan koordinasi terlaksana sesuai rencana).
*   **`DEN_PIDMIL_KOOR_LID` (Penyebut):** `IN_PIDMIL_KOOR_LID_TOTAL` (Jumlah kegiatan koordinasi direncanakan).

####### 🍃 LEVEL 8: Elemen Data Transaksional (Leaf Node - RAW INPUT)
*   `IN_PIDMIL_KOOR_LID_TOTAL` [Leaf]: Jumlah kegiatan koordinasi teknis yang direncanakan pada tahap penindakan (Surat Perintah Koordinasi / Sprint-Koor Tahap Penindakan).
*   `IN_PIDMIL_KOOR_LID_SELESAI` [Leaf]: Jumlah kegiatan koordinasi teknis yang dilaksanakan sesuai rencana pada tahap penindakan, sehingga dapat menghasilkan persetujuan bersama antara JPU dan Oditur Militer terhadap perkara koneksitas yang dapat dilanjutkan ke tahap penuntutan (Berita Acara Hasil Kesepakatan Bersama dari Kegiatan Koordinasi Teknis antara Oditur dengan Jaksa).

---

#### 📊 [IKP 10.2] Indikator Kinerja Program: Tingkat keberhasilan pelaksanaan Kegiatan Koordinasi Teknis Tahap Penuntutan
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Target (2025-2029):** 80% -> 81% -> 82% -> 83% -> 84%

##### 🪜 [SK 10.2.1] Sasaran Kegiatan: Meningkatnya penyelesaian kegiatan koordinasi teknis penuntutan yang dilakukan oleh oditurat militer pada tahap penuntutan
*   **Unit Kerja Penanggung Jawab:** Direktorat Penuntutan JAM PIDMIL & Asisten Pidana Militer (Aspidmil) Kejaksaan Tinggi

###### 📌 [IKK 10.2.1.1] Tingkat penyelesaian Kegiatan Koordinasi Teknis (Assurance, Consultative, Pencegahan Fraud, Monitoring dan Evaluasi dan Pelaporan) Tahap Penuntutan
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Rumus Capaian IKK:**
    $$K = \left( rac{	ext{NUM\_PIDMIL\_KOOR\_TUT}}{	ext{DEN\_PIDMIL\_KOOR\_TUT}} ight) 	imes 100\%$$

####### 📐 LEVEL 7: Parameter Agregat (Mathematical Node)
*   **`NUM_PIDMIL_KOOR_TUT` (Pembilang):** `IN_PIDMIL_KOOR_TUT_SELESAI` (Jumlah kegiatan koordinasi penuntutan selesai dilaksanakan).
*   **`DEN_PIDMIL_KOOR_TUT` (Penyebut):** `IN_PIDMIL_KOOR_TUT_TOTAL` (Jumlah kegiatan koordinasi penuntutan direncanakan).

####### 🍃 LEVEL 8: Elemen Data Transaksional (Leaf Node - RAW INPUT)
*   `IN_PIDMIL_KOOR_TUT_TOTAL` [Leaf]: Jumlah kegiatan koordinasi teknis yang direncanakan pada tahap penuntutan (Surat Perintah Koordinasi Tahap Penuntutan / Sprint-Koor).
*   `IN_PIDMIL_KOOR_TUT_SELESAI` [Leaf]: Jumlah kegiatan koordinasi teknis yang dilaksanakan sesuai rencana pada tahap penuntutan, sehingga tercapai kesesuaian putusan pengadilan dengan minimal dua pertiga tuntutan JPU dan Oditur Militer (Berita Acara Hasil Kesepakatan Bersama Tahap Penuntutan antara Oditur dengan Jaksa).

---

#### 📊 [IKP 10.3] Indikator Kinerja Program: Tingkat keberhasilan pelaksanaan Kegiatan Koordinasi Teknis Tahap Eksekusi, Upaya Hukum Luar Biasa dan Eksaminasi
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Target (2025-2029):** 80% -> 81% -> 82% -> 83% -> 84%

##### 🪜 [SK 10.3.1] Sasaran Kegiatan: Meningkatnya penyelesaian kegiatan koordinasi teknis penuntutan yang dilakukan oleh oditurat militer pada tahap eksekusi, upaya hukum luar biasa dan eksaminasi
*   **Unit Kerja Penanggung Jawab:** Direktorat Penuntutan JAM PIDMIL & Asisten Pidana Militer (Aspidmil) Kejaksaan Tinggi

###### 📌 [IKK 10.3.1.1] Tingkat penyelesaian Kegiatan Koordinasi Teknis (Assurance, Consultative, Pencegahan Fraud, Monitoring dan Evaluasi dan Pelaporan) Tahap Eksekusi, Upaya Hukum Luar Biasa dan Eksaminasi
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Rumus Capaian IKK:**
    $$K = \left( rac{	ext{NUM\_PIDMIL\_KOOR\_EKS}}{	ext{DEN\_PIDMIL\_KOOR\_EKS}} ight) 	imes 100\%$$

####### 📐 LEVEL 7: Parameter Agregat (Mathematical Node)
*   **`NUM_PIDMIL_KOOR_EKS` (Pembilang):** `IN_PIDMIL_KOOR_EKS_SELESAI` (Jumlah kegiatan koordinasi eksekusi selesai terlaksana).
*   **`DEN_PIDMIL_KOOR_EKS` (Penyebut):** `IN_PIDMIL_KOOR_EKS_TOTAL` (Jumlah kegiatan koordinasi eksekusi direncanakan).

####### 🍃 LEVEL 8: Elemen Data Transaksional (Leaf Node - RAW INPUT)
*   `IN_PIDMIL_KOOR_EKS_TOTAL` [Leaf]: Jumlah kegiatan koordinasi teknis yang direncanakan pada tahap eksekusi, upaya hukum luar biasa, dan eksaminasi (Surat Perintah Koordinasi Teknis Tahap Eksekusi, UHLB, dan Eksaminasi).
*   `IN_PIDMIL_KOOR_EKS_SELESAI` [Leaf]: Jumlah kegiatan koordinasi teknis pada tahap eksekusi, upaya hukum luar biasa, dan eksaminasi yang terlaksana sesuai rencana, sehingga proses eksekusi putusan sesuai dengan isi putusan pengadilan (Berita Acara Hasil Kesepakatan Bersama Tahap Eksekusi, UHLB, dan Eksaminasi antara Oditur dengan Jaksa).

---

### 🎯 [SP 15] Sasaran Program: Meningkatnya kualitas sistem penuntutan yang terintegrasi dan transparan
*   **Unit Pengampu Utama:** Kolaborasi Lintas Sektoral (JAM PIDUM, JAM PIDSUS, & JAM PIDMIL)
*   **Target (2025-2029):** 85% -> 86% -> 87% -> 88% -> 89%

#### 📊 [IKP 15.1] Indikator Kinerja Program: Tingkat kualitas penanganan perkara yang terekam dalam Case Management System (CMS)
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   *Catatan Strategis:* Indikator ini mengukur andil Bidang Pidmil dalam penginputan berkas perkara koneksitas secara sahih dan tepat waktu ke pangkalan data digital CMS Penanganan Perkara Militer.

##### 🪜 [SK 15.1.1] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara tindak pidana militer melalui pemanfaatan CMS
*   **Unit Kerja Penanggung Jawab:** Bidang Pidana Militer JAM PIDMIL & Asisten Pidana Militer (Aspidmil) Kejaksaan Tinggi

###### 📌 [IKK 15.1.1.1] Tingkat penyelesaian perkara tindak pidana militer melalui pemanfaatan CMS
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Rumus Capaian IKK:**
    $$C = \left( rac{	ext{NUM\_PIDMIL\_CMS}}{	ext{DEN\_PIDMIL\_CMS}} ight) 	imes 100\%$$

####### 📐 LEVEL 7: Parameter Agregat (Mathematical Node)
*   **`NUM_PIDMIL_CMS` (Pembilang):** `IN_PIDMIL_CMS_SAHIH` (Jumlah perkara terekam CMS tanpa deviasi pelaporan).
*   **`DEN_PIDMIL_CMS` (Penyebut):** `IN_PIDMIL_CMS_TOTAL` (Total perkara koneksitas yang ditangani).

####### 🍃 LEVEL 8: Elemen Data Transaksional (Leaf Node - RAW INPUT)
*   `IN_PIDMIL_CMS_TOTAL` [Leaf]: Total jumlah perkara tindak pidana militer yang terekam dalam database terpusat CMS Pidmil.
*   `IN_PIDMIL_CMS_SAHIH` [Leaf]: Jumlah perkara tindak pidana militer yang terekam dalam CMS dengan memenuhi kriteria tidak adanya deviasi data antara CMS dengan sistem pelaporan manual lainnya.

---

### 🎯 [SP 16] Sasaran Program: Meningkatnya Kualitas Layanan Publik bidang hukum
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Perdata dan Tata Usaha Negara (JAM DATUN) / Kolaborasi JAM PIDMIL
*   **Target (2025-2029):** Rerata Skala Likert 3.6 -> 3.7 -> 3.8 -> 3.9 -> 4.0

#### 📊 [IKP 16.1] Indikator Kinerja Program: Indeks kepuasan layanan publik bidang hukum (Layanan hukum gratis, konsultasi hukum, bantuan hukum, pendampingan hukum, dan penyuluhan hukum)
*   **Sifat Node:** Cascading Node (`INDEX_SCORE`)

##### 🪜 [SK 16.1.1] Sasaran Kegiatan: Meningkatnya kepuasan relasi kelembagaan terhadap layanan hukum bidang pidana militer
*   **Unit Kerja Penanggung Jawab:** Sekretariat JAM PIDMIL & Asisten Pidana Militer (Aspidmil) Kejaksaan Tinggi

###### 📌 [IKK 16.1.1.1] Indeks kepuasan relasi kelembagaan terhadap layanan hukum bidang pidana militer
*   **Sifat Node:** Cascading Node (`INDEX_SCORE`)
*   **Rumus Capaian IKK (Skala 1.0 - 5.0):**
    $$C = rac{\sum_{i=1}^{5} (R_i 	imes N_i)}{\sum_{i=1}^{5} N_i}$$

####### 📐 LEVEL 7: Parameter Agregat (Mathematical Node)
*   **`Ri`:** Rating/Skala penilaian ke-i yang diberikan responden pada kuesioner layanan (Skala Likert 1-5).
*   **`Ni`:** Jumlah pertanyaan kuesioner yang memperoleh rating ke-i.

####### 🍃 LEVEL 8: Elemen Data Transaksional (Leaf Node - RAW INPUT)
*   `IN_PIDMIL_SATISFACTION_RESP` [Leaf]: Jumlah kuesioner survei kepuasan relasi kelembagaan militer (Oditurat, Pomdam, Pengadilan Militer) yang diisi secara sahih.
*   `IN_PIDMIL_SATISFACTION_SCORE` [Leaf]: Akumulasi skor penilaian kepuasan relasi kelembagaan militer atas layanan koordinasi teknis penuntutan.

---

### 🎯 [SP_PIDMIL_MGMT] Sasaran Program: Terselenggaranya layanan dukungan teknis dan administrasi perkantoran di Jaksa Agung Muda Bidang Pidana Militer
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Pidana Militer (JAM PIDMIL) / Eselon I
*   **Target (2025-2029):** 100% dari target fungsional terlampaui.

#### 📊 [IKP_PIDMIL_MGMT.1] Indikator Kinerja Program: Persentase penyelesaian laporan penanganan perkara koneksitas di Jaksa Agung Muda Pidana Militer sesuai tenggat waktu
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)

##### 🪜 [SK_PIDMIL_MGMT.1.1] Sasaran Kegiatan: Terselenggaranya layanan dukungan teknis di Jaksa Agung Muda Pidana Militer
*   **Unit Kerja Penanggung Jawab:** Sekretariat JAM PIDMIL (Bagian Tata Usaha)

###### 📌 [IKK_PIDMIL_MGMT.1.1.1] Persentase penyelesaian laporan penanganan perkara koneksitas di Jaksa Agung Muda Pidana Militer sesuai tenggat waktu
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`)
*   **Rumus Capaian IKK:**
    $$P = \left( rac{	ext{NUM\_PIDMIL\_MGMT}}{	ext{DEN\_PIDMIL\_MGMT}} ight) 	imes 100\%$$

####### 📐 LEVEL 7: Parameter Agregat (Mathematical Node)
*   **`NUM_PIDMIL_MGMT` (Pembilang):** `IN_PIDMIL_MGMT_REPORT_SUBMITTED` (Jumlah laporan diserahkan tepat waktu sesuai tenggat).
*   **`DEN_PIDMIL_MGMT` (Penyebut):** `IN_PIDMIL_MGMT_REPORT_TOTAL` (Total wajib laporan periodik).

####### 🍃 LEVEL 8: Elemen Data Transaksional (Leaf Node - RAW INPUT)
*   `IN_PIDMIL_MGMT_REPORT_TOTAL` [Leaf]: Jumlah total laporan pelaksanaan penanganan perkara koneksitas yang seharusnya disampaikan pada periode pelaporan wajib (Bulanan, Triwulanan, Tahunan).
*   `IN_PIDMIL_MGMT_REPORT_SUBMITTED` [Leaf]: Jumlah laporan penanganan perkara koneksitas yang selesai disusun secara akuntabel dan diserahkan tepat waktu sesuai dengan ketentuan perundang-undangan (SLA).

---

## 💻 CATATAN ARSITEKTURAL BACKEND LARAVEL SAKIP (SICANA)

1. **Struktur Relasional Tunggal:** Master data SP, IKP, SK, dan IKK disimpan ke dalam tabel `performance_indicators` dengan pola *Self-Referencing Adjacency List* menggunakan kolom `parent_id` dan `is_leaf` (Biner) guna mereduksi struktur kueri join yang kaku.
2. **Conditional Rollover:** Pada *Calculation Service*, asisten di daerah (Satker Kejaksaan Tinggi yang memiliki struktur **Aspidmil**) akan mengaktifkan kueri rollup untuk rumpun perkara koneksitas (SP 9 & SP 10). Sebaliknya, pada tingkat Kejaksaan Negeri (Kejari), node PIDMIL disembunyikan secara kondisional (`is_active = false`) agar tidak memicu error *division by zero* saat rollup macro penanganan perkara (IKSS 2.1).
3. **Automated Database Trigger:** Setiap kali data isian mentah disimpan ke dalam tabel `sakip_inputs` di level 8 (`RAW_INPUT`), sistem akan secara otomatis menghitung ulang nilai di level parameter (level 7), lalu mengalirkannya naik ke atas untuk memperbarui baris data hasil kalkulasi di tabel `sakip_results`.

---
