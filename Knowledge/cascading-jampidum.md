# Cetak Biru Cascading SAKIP & Renstra Kejaksaan RI 2025-2029
## Bidang Pengampuan: Jaksa Agung Muda Bidang Tindak Pidana Umum (JAM PIDUM)

Dokumen ini menyajikan peta penjenjangan kinerja (*cascading structure*) secara utuh, rigid, mendalam, tanpa singkatan, dan terperinci untuk seluruh Sasaran Program (SP), Indikator Kinerja Program (IKP/IKSP), Sasaran Kegiatan (SK/Saskeg), dan Indikator Kinerja Kegiatan (IKK/IKSK) di bawah pengampuan Jaksa Agung Muda Bidang Tindak Pidana Umum (JAM PIDUM).

Sistem SICANA mengimplementasikan struktur ini dengan pola *Self-Referencing Adjacency List* menggunakan field `parent_id` untuk menghubungkan relasi dinamis tanpa batas (*Infinite Hierarchy*).

---

## 🪜 PETA HIERARKI TANGGA CASCADING & FORMULA PENGUKURAN

### 🎯 [SP 3] Sasaran Program: Meningkatnya keberhasilan penanganan Perkara Tindak Pidana Umum secara transparan, akuntabel dan profesional
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Tindak Pidana Umum (JAM PIDUM) / Eselon I
*   **Target (2025-2029):** Terdistribusi per IKP

#### 📊 [IKP 3.1] Indikator Kinerja Program: Tingkat keberhasilan penanganan perkara Tindak Pidana Umum yang diproses hingga pra penuntutan
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** 80% -> 81% -> 82% -> 83% -> 84%
*   **Formula Capaian:** Rata-rata capaian dari seluruh Satuan Kerja Pusat & Daerah.

##### 🪜 [SK 3.1.1] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara tindak pidana umum (Garis Besar Semua Perkara)
*   **Unit Kerja Penanggung Jawab:** Direktorat di lingkungan JAM PIDUM (Pusat) & Bidang Tindak Pidana Umum (Daerah)

###### 📌 [IKK 3.1.1.1] Tingkat penyelesaian perkara tindak pidana umum yang diproses hingga Pra-Penuntutan
*   **Sifat Node:** Leaf Node (Direct Input / Auto-Sync dari CMS Pidum)
*   **Pembilang (Numerator):** Jumlah Perkara Diselesaikan Pratut (Tahap II + SP3 Penyidik + SPDP Kembali > 7 Hari dari Sprindik + SPDP Kembali Tanpa Berkas + Berkas Kembali > 30 Hari dari P-21A).
*   **Penyebut (Denominator):** Total SPDP perkara tindak pidana umum yang diterima Kejaksaan yang telah diterbitkan P-16.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Perkara Diselesaikan Pratut}}{\text{Total SPDP Terbit P-16}} \right) \times 100\%$$
*   **Sumber Data:** API Terintegrasi Case Management System (CMS) Pidum.

##### 🪜 [SK 3.1.2] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara tindak pidana umum Bidang A (Keamanan negara, ketertiban umum, orang, harta benda, dan pencucian uang)
*   **Unit Kerja Penanggung Jawab:** Direktorat Keamanan Negara, Ketertiban Umum, dan Tindak Pidana Umum Lainnya (Direktorat Oharda / Kamneg)

###### 📌 [IKK 3.1.2.1] Tingkat penyelesaian perkara tindak pidana umum bidang A yang diproses hingga Pra-Penuntutan
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara tindak pidana umum bidang A yang diselesaikan pada tahap prapenuntutan.
*   **Penyebut (Denominator):** Total SPDP perkara tindak pidana umum bidang A yang diterbitkan P-16.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Penyelesaian Bidang A Pratut}}{\text{Total SPDP Bidang A Terbit P-16}} \right) \times 100\%$$
*   **Sumber Data:** CMS Pidum Modul TPUL / Oharda.

##### 🪜 [SK 3.1.3] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara tindak pidana umum Bidang B (Narkotika, psikotropika, zat adiktif lainnya, kesehatan, dan pencucian uang)
*   **Unit Kerja Penanggung Jawab:** Direktorat Tindak Pidana Narkotika dan Zat Adiktif Lainnya

###### 📌 [IKK 3.1.3.1] Tingkat penyelesaian perkara tindak pidana umum bidang B yang diproses hingga Pra-Penuntutan
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara tindak pidana umum bidang B yang diselesaikan pada tahap prapenuntutan.
*   **Penyebut (Denominator):** Total SPDP perkara tindak pidana umum bidang B yang diterbitkan P-16.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Penyelesaian Bidang B Pratut}}{\text{Total SPDP Bidang B Terbit P-16}} \right) \times 100\%$$
*   **Sumber Data:** CMS Pidum Modul Narkotika.

##### 🪜 [SK 3.1.4] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara tindak pidana umum Bidang C (Terorisme, perdagangan orang, lintas negara, kekerasan dalam rumah tangga, pelindungan perempuan dan anak)
*   **Unit Kerja Penanggung Jawab:** Direktorat Tindak Pidana Terorisme dan Lintas Negara

###### 📌 [IKK 3.1.4.1] Tingkat penyelesaian perkara tindak pidana umum bidang C yang diproses hingga Pra-Penuntutan
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara tindak pidana umum bidang C yang diselesaikan pada tahap prapenuntutan.
*   **Penyebut (Denominator):** Total SPDP perkara tindak pidana umum bidang C yang diterbitkan P-16.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Penyelesaian Bidang C Pratut}}{\text{Total SPDP Bidang C Terbit P-16}} \right) \times 100\%$$
*   **Sumber Data:** CMS Pidum Modul Teroris & Lintas Negara.

##### 🪜 [SK 3.1.5] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara tindak pidana umum Bidang D (Keuangan, siber, sumber daya alam, dan pencucian uang)
*   **Unit Kerja Penanggung Jawab:** Direktorat Tindak Pidana Keuangan, Siber, dan Sumber Daya Alam

###### 📌 [IKK 3.1.5.1] Tingkat penyelesaian perkara tindak pidana umum bidang D yang diproses hingga Pra-Penuntutan
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara tindak pidana umum bidang D yang diselesaikan pada tahap prapenuntutan.
*   **Penyebut (Denominator):** Total SPDP perkara tindak pidana umum bidang D yang diterbitkan P-16.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Penyelesaian Bidang D Pratut}}{\text{Total SPDP Bidang D Terbit P-16}} \right) \times 100\%$$
*   **Sumber Data:** CMS Pidum Modul Keuangan & Siber.

##### 🪜 [SK 3.1.6] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara tindak pidana umum Bidang E (Peraturan Daerah, hukum yang hidup dalam masyarakat, tindak pidana umum lainnya)
*   **Unit Kerja Penanggung Jawab:** Bidang Tindak Pidana Umum Daerah / Pusdaskrimti

###### 📌 [IKK 3.1.6.1] Tingkat penyelesaian perkara tindak pidana umum bidang E yang diproses hingga Pra-Penuntutan
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara tindak pidana umum bidang E yang diselesaikan pada tahap prapenuntutan.
*   **Penyebut (Denominator):** Total SPDP perkara tindak pidana umum bidang E yang diterbitkan P-16.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Penyelesaian Bidang E Pratut}}{\text{Total SPDP Bidang E Terbit P-16}} \right) \times 100\%$$
*   **Sumber Data:** CMS Pidum / Register Perkara Daerah.

---

#### 📊 [IKP 3.2] Indikator Kinerja Program: Tingkat keberhasilan penanganan perkara Tindak Pidana Umum yang diproses hingga penuntutan
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** 80% -> 81% -> 82% -> 83% -> 84%
*   **Formula Capaian:** Rata-rata capaian seluruh Satuan Kerja.

##### 🪜 [SK 3.2.1] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara tindak pidana umum (Garis Besar)
*   **Unit Kerja Penanggung Jawab:** Direktorat di lingkungan JAM PIDUM (Pusat) & Bidang Tindak Pidana Umum (Daerah)

###### 📌 [IKK 3.2.1.1] Tingkat penyelesaian perkara tindak pidana umum yang diproses hingga Penuntutan
*   **Sifat Node:** Leaf Node (Direct Input / Auto-Sync dari CMS Pidum)
*   **Pembilang (Numerator):** Jumlah perkara diselesaikan tahap penuntutan (Limpah Pengadilan + Restorative Justice + Diversi Penuntutan + Deponering + Alasan Sah Lainnya).
*   **Penyebut (Denominator):** Total perkara tindak pidana umum yang telah diterbitkan P-16A.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Perkara Selesai Tut}}{\text{Total Perkara P-16A Terbit}} \right) \times 100\%$$
*   **Sumber Data:** API Terintegrasi Case Management System (CMS) Pidum.

##### 🪜 [SK 3.2.2] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara tindak pidana umum Bidang A
*   **Unit Kerja Penanggung Jawab:** Direktorat Oharda / Kamneg

###### 📌 [IKK 3.2.2.1] Tingkat penyelesaian perkara tindak pidana umum bidang A yang diproses hingga Penuntutan
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara tindak pidana umum bidang A yang diselesaikan pada tahap penuntutan.
*   **Penyebut (Denominator):** Total perkara tindak pidana umum bidang A yang diterbitkan P-16A.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Penyelesaian Bidang A Tut}}{\text{Total Perkara Bidang A P-16A}} \right) \times 100\%$$
*   **Sumber Data:** CMS Pidum Modul Oharda.

##### 🪜 [SK 3.2.3] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara tindak pidana umum Bidang B
*   **Unit Kerja Penanggung Jawab:** Direktorat Narkotika

###### 📌 [IKK 3.2.3.1] Tingkat penyelesaian perkara tindak pidana umum bidang B yang diproses hingga Penuntutan
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara tindak pidana umum bidang B yang diselesaikan pada tahap penuntutan.
*   **Penyebut (Denominator):** Total perkara tindak pidana umum bidang B yang diterbitkan P-16A.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Penyelesaian Bidang B Tut}}{\text{Total Perkara Bidang B P-16A}} \right) \times 100\%$$
*   **Sumber Data:** CMS Pidum Modul Narkotika.

##### 🪜 [SK 3.2.4] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara tindak pidana umum Bidang C
*   **Unit Kerja Penanggung Jawab:** Direktorat Terorisme dan Lintas Negara

###### 📌 [IKK 3.2.4.1] Tingkat penyelesaian perkara tindak pidana umum bidang C yang diproses hingga Penuntutan
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara tindak pidana umum bidang C yang diselesaikan pada tahap penuntutan.
*   **Penyebut (Denominator):** Total perkara tindak pidana umum bidang C yang diterbitkan P-16A.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Penyelesaian Bidang C Tut}}{\text{Total Perkara Bidang C P-16A}} \right) \times 100\%$$
*   **Sumber Data:** CMS Pidum Modul Teroris & Lintas Negara.

##### 🪜 [SK 3.2.5] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara tindak pidana umum Bidang D
*   **Unit Kerja Penanggung Jawab:** Direktorat Keuangan, Siber, dan SDA

###### 📌 [IKK 3.2.5.1] Tingkat penyelesaian perkara tindak pidana umum bidang D yang diproses hingga Penuntutan
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara tindak pidana umum bidang D yang diselesaikan pada tahap penuntutan.
*   **Penyebut (Denominator):** Total perkara tindak pidana umum bidang D yang diterbitkan P-16A.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Penyelesaian Bidang D Tut}}{\text{Total Perkara Bidang D P-16A}} \right) \times 100\%$$
*   **Sumber Data:** CMS Pidum Modul Keuangan & Siber.

##### 🪜 [SK 3.2.6] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara tindak pidana umum Bidang E
*   **Unit Kerja Penanggung Jawab:** Bidang Tindak Pidana Umum Daerah / Pusdaskrimti

###### 📌 [IKK 3.2.6.1] Tingkat penyelesaian perkara tindak pidana umum bidang E yang diproses hingga Penuntutan
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara tindak pidana umum bidang E yang diselesaikan pada tahap penuntutan.
*   **Penyebut (Denominator):** Total perkara tindak pidana umum bidang E yang diterbitkan P-16A.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Penyelesaian Bidang E Tut}}{\text{Total Perkara Bidang E P-16A}} \right) \times 100\%$$
*   **Sumber Data:** CMS Pidum / Register Perkara Daerah.

---

#### 📊 [IKP 3.3] Indikator Kinerja Program: Tingkat keberhasilan penanganan perkara tindak Pidana Umum yang berkekuatan hukum tetap (Inkracht) dan telah dieksekusi
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** 88% -> 89% -> 90% -> 91% -> 92%
*   **Formula Capaian:** Rata-rata capaian seluruh Satuan Kerja.

##### 🪜 [SK 3.3.1] Sasaran Kegiatan: Eksekusi Putusan Hakim Perkara Pidum (Garis Besar)
*   **Unit Kerja Penanggung Jawab:** Bidang Tindak Pidana Umum (Kejati / Kejari)

###### 📌 [IKK 3.3.1.1] Tingkat penyelesaian perkara tindak pidana umum yang berkekuatan hukum tetap dan telah dieksekusi
*   **Sifat Node:** Leaf Node (Direct Input / Auto-Sync dari CMS Pidum)
*   **Pembilang (Numerator):** Jumlah pelaksanaan eksekusi terpidana berdasarkan Berita Acara BA-17.
*   **Penyebut (Denominator):** Jumlah terpidana yang putusannya telah berkekuatan hukum tetap (inkracht / P-48).
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Jumlah Terpidana Dieksekusi (BA-17)}}{\text{Jumlah Terpidana Inkracht (P-48)}} \right) \times 100\%$$
*   **Sumber Data:** CMS Pidum (BA-17).

##### 🪜 [SK 3.3.2] Sasaran Kegiatan: Eksekusi Putusan Hakim Perkara Pidum Bidang A
*   **Unit Kerja Penanggung Jawab:** Direktorat Oharda / Kamneg

###### 📌 [IKK 3.3.2.1] Tingkat penyelesaian perkara tindak pidana umum bidang A yang berkekuatan hukum tetap dan telah dieksekusi
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah pelaksanaan eksekusi terpidana bidang A berdasarkan Berita Acara BA-17.
*   **Penyebut (Denominator):** Jumlah terpidana bidang A yang putusannya telah berkekuatan hukum tetap (P-48).
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Jumlah Terpidana Bidang A Dieksekusi}}{\text{Jumlah Terpidana Bidang A Inkracht}} \right) \times 100\%$$
*   **Sumber Data:** CMS Pidum.

##### 🪜 [SK 3.3.3] Sasaran Kegiatan: Eksekusi Putusan Hakim Perkara Pidum Bidang B
*   **Unit Kerja Penanggung Jawab:** Direktorat Narkotika

###### 📌 [IKK 3.3.3.1] Tingkat penyelesaian perkara tindak pidana umum bidang B yang berkekuatan hukum tetap dan telah dieksekusi
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah pelaksanaan eksekusi terpidana bidang B berdasarkan Berita Acara BA-17.
*   **Penyebut (Denominator):** Jumlah terpidana bidang B yang putusannya telah berkekuatan hukum tetap (P-48).
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Jumlah Terpidana Bidang B Dieksekusi}}{\text{Jumlah Terpidana Bidang B Inkracht}} \right) \times 100\%$$
*   **Sumber Data:** CMS Pidum.

##### 🪜 [SK 3.3.4] Sasaran Kegiatan: Eksekusi Putusan Hakim Perkara Pidum Bidang C
*   **Unit Kerja Penanggung Jawab:** Direktorat Terorisme dan Lintas Negara

###### 📌 [IKK 3.3.4.1] Tingkat penyelesaian perkara tindak pidana umum bidang C yang berkekuatan hukum tetap dan telah dieksekusi
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah pelaksanaan eksekusi terpidana bidang C berdasarkan Berita Acara BA-17.
*   **Penyebut (Denominator):** Jumlah terpidana bidang C yang putusannya telah berkekuatan hukum tetap (P-48).
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Jumlah Terpidana Bidang C Dieksekusi}}{\text{Jumlah Terpidana Bidang C Inkracht}} \right) \times 100\%$$
*   **Sumber Data:** CMS Pidum.

##### 🪜 [SK 3.3.5] Sasaran Kegiatan: Eksekusi Putusan Hakim Perkara Pidum Bidang D
*   **Unit Kerja Penanggung Jawab:** Direktorat Keuangan, Siber, dan SDA

###### 📌 [IKK 3.3.5.1] Tingkat penyelesaian perkara tindak pidana umum bidang D yang berkekuatan hukum tetap dan telah dieksekusi
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah pelaksanaan eksekusi terpidana bidang D berdasarkan Berita Acara BA-17.
*   **Penyebut (Denominator):** Jumlah terpidana bidang D yang putusannya telah berkekuatan hukum tetap (P-48).
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Jumlah Terpidana Bidang D Dieksekusi}}{\text{Jumlah Terpidana Bidang D Inkracht}} \right) \times 100\%$$
*   **Sumber Data:** CMS Pidum.

##### 🪜 [SK 3.3.6] Sasaran Kegiatan: Eksekusi Putusan Hakim Perkara Pidum Bidang E
*   **Unit Kerja Penanggung Jawab:** Bidang Tindak Pidana Umum Daerah / Pusdaskrimti

###### 📌 [IKK 3.3.6.1] Tingkat penyelesaian perkara tindak pidana umum bidang E yang berkekuatan hukum tetap dan telah dieksekusi
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah pelaksanaan eksekusi terpidana bidang E berdasarkan Berita Acara BA-17.
*   **Penyebut (Denominator):** Jumlah terpidana bidang E yang putusannya telah berkekuatan hukum tetap (P-48).
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Jumlah Terpidana Bidang E Dieksekusi}}{\text{Jumlah Terpidana Bidang E Inkracht}} \right) \times 100\%$$
*   **Sumber Data:** CMS Pidum / Register Perkara Daerah.

---

### 🎯 [SP 4] Sasaran Program: Meningkatnya penegakan hukum yang adil, humanis, proporsional, dan efisien
*   **Unit Pengampu Utama:** Kolaborasi JAM PIDUM & JAM PIDSUS

#### 📊 [IKP 4.1] Indikator Kinerja Program: Persentase penanganan perkara melalui mediasi penal, diskresi penuntutan, dan denda damai
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** 61% -> 63% -> 65% -> 67% -> 69%
*   **Formula Capaian:** Rata-rata dari Capaian Keadilan Restoratif (Pidum) & Denda Damai (Pidsus)

##### 🪜 [SK 4.1.1] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara tindak pidana umum melalui keadilan restoratif
*   **Unit Kerja Penanggung Jawab:** Bidang Tindak Pidana Umum (Kejati / Kejari)

###### 📌 [IKK 4.1.1.1] Tingkat penyelesaian perkara tindak pidana umum bidang A pada penuntutan melalui keadilan restoratif
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara tindak pidana umum bidang A yang disetujui dihentikan penuntutannya melalui Restorative Justice (Keadilan Restoratif) & Diversi.
*   **Penyebut (Denominator):** Total seluruh perkara tindak pidana umum bidang A yang diusulkan / memenuhi kriteria RJ & Diversi.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Perkara Bidang A Berhasil RJ}}{\text{Total Perkara Bidang A Diusulkan RJ}} \right) \times 100\%$$
*   **Sumber Data:** Dokumen Persetujuan RJ JAM PIDUM / Register RJ Daerah.

###### 📌 [IKK 4.1.1.2] Tingkat penyelesaian perkara tindak pidana umum bidang B pada penuntutan melalui keadilan restoratif
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara tindak pidana umum bidang B yang disetujui dihentikan penuntutannya melalui Restorative Justice & Diversi.
*   **Penyebut (Denominator):** Total seluruh perkara tindak pidana umum bidang B yang diusulkan / memenuhi kriteria RJ & Diversi.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Perkara Bidang B Berhasil RJ}}{\text{Total Perkara Bidang B Diusulkan RJ}} \right) \times 100\%$$
*   **Sumber Data:** Dokumen Persetujuan RJ JAM PIDUM.

###### 📌 [IKK 4.1.1.3] Tingkat penyelesaian perkara tindak pidana umum bidang C pada penuntutan melalui keadilan restoratif
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara tindak pidana umum bidang C yang disetujui dihentikan penuntutannya melalui Restorative Justice & Diversi.
*   **Penyebut (Denominator):** Total seluruh perkara tindak pidana umum bidang C yang diusulkan / memenuhi kriteria RJ & Diversi.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Perkara Bidang C Berhasil RJ}}{\text{Total Perkara Bidang C Diusulkan RJ}} \right) \times 100\%$$
*   **Sumber Data:** Dokumen Persetujuan RJ JAM PIDUM.

###### 📌 [IKK 4.1.1.4] Tingkat penyelesaian perkara tindak pidana umum bidang D pada penuntutan melalui keadilan restoratif
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara tindak pidana umum bidang D yang disetujui dihentikan penuntutannya melalui Restorative Justice & Diversi.
*   **Penyebut (Denominator):** Total seluruh perkara tindak pidana umum bidang D yang diusulkan / memenuhi kriteria RJ & Diversi.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Perkara Bidang D Berhasil RJ}}{\text{Total Perkara Bidang D Diusulkan RJ}} \right) \times 100\%$$
*   **Sumber Data:** Dokumen Persetujuan RJ JAM PIDUM.

###### 📌 [IKK 4.1.1.5] Tingkat penyelesaian perkara tindak pidana umum bidang E pada penuntutan melalui keadilan restoratif
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara tindak pidana umum bidang E yang disetujui dihentikan penuntutannya melalui Restorative Justice & Diversi.
*   **Penyebut (Denominator):** Total seluruh perkara tindak pidana umum bidang E yang diusulkan / memenuhi kriteria RJ & Diversi.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Perkara Bidang E Berhasil RJ}}{\text{Total Perkara Bidang E Diusulkan RJ}} \right) \times 100\%$$
*   **Sumber Data:** Dokumen Persetujuan RJ JAM PIDUM.

---

#### 📊 [IKP 4.2] Indikator Kinerja Program: Persentase Penuntutan Melalui Alternatif Pemidanaan (KUHP Baru)
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** Terimplementasi bertahap mengikuti pemberlakuan KUHP Baru.
*   **Formula Capaian:** Rata-rata dari persentase penggunaan tuntutan alternatif non-kustodial.

##### 🪜 [SK 4.2.1] Sasaran Kegiatan: Penerapan Tuntutan Alternatif Non-Kustodial (Pidana Kerja Sosial, Pengawasan, Denda, Rehabilitasi)
*   **Unit Kerja Penanggung Jawab:** Seksi Pidum / JPU Satker Daerah

###### 📌 [IKK 4.2.1.1] Rasio Penerapan Surat Tuntutan JPU Berbasis Pemidanaan Alternatif
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara Pidum yang dituntut JPU dengan pidana alternatif (kerja sosial, denda, pengawasan, atau rehabilitasi).
*   **Penyebut (Denominator):** Total seluruh perkara yang secara yuridis memenuhi syarat dituntut dengan pidana alternatif sesuai KUHP Baru.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Tuntutan Alternatif Diterapkan}}{\text{Total Perkara Memenuhi Syarat Tuntutan Alternatif}} \right) \times 100\%$$
*   **Sumber Data:** CMS Pidum (Modul Surat Tuntutan).

---

### 🎯 [SP 15] Sasaran Program: Meningkatnya kualitas sistem penuntutan yang terintegrasi dan transparan
*   **Unit Pengampu Utama:** Kolaborasi JAM PIDUM, JAM PIDSUS, dan JAM PIDMIL

#### 📊 [IKP 15.1] Indikator Kinerja Program: Tingkat kualitas penanganan perkara yang terekam dalam Case Management System (CMS)
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** 85% -> 86% -> 87% -> 88% -> 89%
*   **Formula Capaian:** Rata-rata tingkat sinkronisasi dan ketepatan entry data (*data segar & data sahih*) lintas bidang.

##### 🪜 [SK 15.1.1] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara tindak pidana umum melalui pemanfaatan CMS
*   **Unit Kerja Penanggung Jawab:** Bidang Tindak Pidana Umum (Kejati / Kejari)

###### 📌 [IKK 15.1.1.1] Tingkat penyelesaian perkara tindak pidana umum melalui pemanfaatan CMS
*   **Sifat Node:** Leaf Node (Direct Input / Telemetri DB CMS)
*   **Pembilang (Numerator):** Jumlah berkas perkara tindak pidana umum yang data penanganannya diinput secara segar (ketepatan waktu <= 3 hari setelah penetapan) dan sahih (kelengkapan berkas lengkap).
*   **Penyebut (Denominator):** Total seluruh perkara tindak pidana umum yang ditangani dalam periode berjalan.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Entry Data Segar \& Sahih}}{\text{Total Perkara Ditangani}} \right) \times 100\%$$
*   **Sumber Data:** Server Dashboard Monitoring Sinkronisasi CMS Pusdaskrimti.

---

### 🎯 [SP 17] Sasaran Program: Meningkatnya Kualitas Layanan Publik bidang penegakan hukum
*   **Unit Pengampu Utama:** Kolaborasi JAM PIDUM, JAM PIDSUS, JAM DATUN, dan JAM PIDMIL

#### 📊 [IKP 17.1] Indikator Kinerja Program: Indeks kepuasan layanan publik bidang penegakan hukum
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** 3,6 -> 3,7 -> 3,8 -> 3,9 -> 4,0 (Skala 1 - 5)
*   **Formula Capaian:** Rata-rata dari indeks survei kepuasan masyarakat (SKM) di level daerah.

##### 🪜 [SK 17.1.1] Sasaran Kegiatan: Meningkatnya kualitas layanan publik bidang penegakan hukum di Kejagung, Kejaksaan Tinggi, Kejaksaan Negeri, dan Cabang Kejaksaan Negeri
*   **Unit Kerja Penanggung Jawab:** Kolaborasi Seluruh Satker Bidang Pidum / PTSP Daerah

###### 📌 [IKK 17.1.1.1] Indeks kepuasan layanan publik bidang penegakan hukum di Kejaksaan Agung
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Formula Perhitungan:** Nilai rerata rating kuesioner survei kepuasan masyarakat (Skala Likert 1.0 - 5.0) yang melayani penegakan hukum Pidum di Kejagung.
*   **Sumber Data:** Laporan Survei Kepuasan Masyarakat Bidang Pelayanan Hukum / Humas.

###### 📌 [IKK 17.1.1.2] Indeks kepuasan layanan publik bidang penegakan hukum di Kejaksaan Tinggi
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Formula Perhitungan:** Nilai rerata rating kuesioner survei kepuasan masyarakat (Skala Likert 1.0 - 5.0) di level Kejaksaan Tinggi.
*   **Sumber Data:** Laporan Hasil SKM PTSP Kejaksaan Tinggi.

###### 📌 [IKK 17.1.1.3] Indeks kepuasan layanan publik bidang penegakan hukum di Kejaksaan Negeri
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Formula Perhitungan:** Nilai rerata rating kuesioner survei kepuasan masyarakat (Skala Likert 1.0 - 5.0) di level Kejaksaan Negeri (Layanan Tilang, Ambil Barang Bukti, Konsultasi Perkara).
*   **Sumber Data:** Laporan Hasil SKM PTSP Kejaksaan Negeri.

###### 📌 [IKK 17.1.1.4] Indeks kepuasan layanan publik bidang penegakan hukum di Cabang Kejaksaan Negeri
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Formula Perhitungan:** Nilai rerata rating kuesioner survei kepuasan masyarakat (Skala Likert 1.0 - 5.0) di level Cabang Kejaksaan Negeri.
*   **Sumber Data:** Laporan Hasil SKM PTSP Cabang Kejaksaan Negeri.

###### 📌 [IKK 17.1.1.5] Persentase layanan bidang penegakan hukum sesuai dengan standar layanan di Kejaksaan Agung
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah produk layanan penegakan hukum Pidum di Kejagung yang diselesaikan sesuai waktu standar SOP pelayanan publik.
*   **Penyebut (Denominator):** Total seluruh produk layanan penegakan hukum Pidum yang dikeluarkan.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Layanan Tepat Waktu Standar}}{\text{Total Produk Layanan Dikeluarkan}} \right) \times 100\%$$
*   **Sumber Data:** Log Administrasi Pelayanan Publik JAM PIDUM.

###### 📌 [IKK 17.1.1.6] Persentase layanan bidang penegakan hukum sesuai dengan standar layanan di Kejaksaan Tinggi
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah produk layanan di Kejati yang selesai sesuai SLA standar.
*   **Penyebut (Denominator):** Total pelayanan yang diajukan.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Layanan Kejati Sesuai Standar}}{\text{Total Layanan Kejati}} \right) \times 100\%$$
*   **Sumber Data:** Log Pelayanan PTSP Kejaksaan Tinggi.

###### 📌 [IKK 17.1.1.7] Persentase layanan bidang penegakan hukum sesuai dengan standar layanan di Kejaksaan Negeri
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah produk pelayanan di Kejari (Ambil BB/Tilang) yang selesai tepat waktu standar.
*   **Penyebut (Denominator):** Total pelayanan yang diajukan masyarakat.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Layanan Kejari Sesuai Standar}}{\text{Total Layanan Kejari}} \right) \times 100\%$$
*   **Sumber Data:** Log Pelayanan PTSP Kejaksaan Negeri.

###### 📌 [IKK 17.1.1.8] Persentase layanan bidang penegakan hukum sesuai dengan standar layanan di Cabang Kejaksaan Negeri
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah produk pelayanan di Cabjari yang selesai tepat waktu standar.
*   **Penyebut (Denominator):** Total pelayanan yang diajukan masyarakat.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Layanan Cabjari Sesuai Standar}}{\text{Total Layanan Cabjari}} \right) \times 100\%$$
*   **Sumber Data:** Log Pelayanan PTSP Cabang Kejaksaan Negeri.

---

### 🎯 [SP 18] Sasaran Program: Meningkatnya efektivitas pemanfaatan sarana dan prasarana dalam mendukung penegakan dan pelayanan hukum di Kejaksaan RI
*   **Unit Pengampu Utama:** Kolaborasi Lintas Bidang (JAM Intel, JAM PIDUM, JAM PIDSUS, JAM DATUN, JAM PIDMIL, JAMBIN)

#### 📊 [IKP 18.1] Indikator Kinerja Program: Tingkat utilisasi sarana dan prasarana dalam mendukung penegakan dan pelayanan hukum di Kejaksaan RI
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** 80% -> 82% -> 84% -> 86% -> 90%
*   **Formula Capaian:** Rata-rata dari persentase utilitas sarana taktis dan fungsional di daerah.

##### 🪜 [SK 18.1.1] Sasaran Kegiatan: Meningkatnya jumlah Sarana dan Prasarana yang Mendukung Penegakan dan Pelayanan Hukum di Kejaksaan RI
*   **Unit Kerja Penanggung Jawab:** Bidang Tindak Pidana Umum Satker Daerah & Biro Perlengkapan

###### 📌 [IKK 18.1.1.1] Persentase Terpenuhinya Kendaraan Tahanan Penegakan dan Pelayanan Hukum di Kejaksaan RI
*   **Sifat Node:** Leaf Node (Direct Input / SIMAN)
*   **Pembilang (Numerator):** Jumlah unit kendaraan tahanan (mobil tahanan) yang berada dalam kondisi prima (baik/rusak ringan layak pakai) dan dimanfaatkan aktif.
*   **Penyebut (Denominator):** Total unit kendaraan tahanan yang terdaftar pada aset Satker Daerah se-Indonesia.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Kendaraan Tahanan Prima \& Aktif}}{\text{Total Kendaraan Tahanan Terdaftar}} \right) \times 100\%$$
*   **Sumber Data:** Laporan Aset Buku Inventaris SIMAN v2 / Seksi Pidum Daerah.

###### 📌 [IKK 18.1.1.2] Persentase Terpenuhinya Peralatan Pengolah Data dan Komunikasi Penegakan dan Pelayanan Hukum di Kejaksaan RI (Sektor Pidum)
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perangkat pengolah data (komputer fungsional, laptop JPU, scanner berkas perkara) yang dimanfaatkan aktif mendukung penegakan hukum Pidum.
*   **Penyebut (Denominator):** Total perangkat pengolah data Pidum yang terdaftar.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Perangkat IT Sektor Pidum Aktif}}{\text{Total Perangkat IT Sektor Pidum Terdaftar}} \right) \times 100\%$$
*   **Sumber Data:** Laporan Inventaris Bagian Tata Usaha / Seksi Pidum.

###### 📌 [IKK 18.1.1.3] Persentase Terpenuhinya Peralatan Perkantoran Penegakan dan Pelayanan Hukum di Kejaksaan RI (Sektor Pidum)
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah set peralatan fungsional kantor Pidum (meubelair ruang sidang, AC ruang pemeriksaan, genset satker) yang berfungsi baik.
*   **Penyebut (Denominator):** Total kebutuhan peralatan perkantoran Pidum sesuai standar sarpras Kejaksaan.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Peralatan Perkantoran Pidum Berfungsi}}{\text{Total Target Standard Peralatan Perkantoran}} \right) \times 100\%$$
*   **Sumber Data:** SIMAN v2 / Seksi Pidum Satker.

---

### 🎯 [SP_PIDUM_MGMT] Sasaran Program: Meningkatnya kuantitas dan kualitas SDM penanganan perkara tindak pidana umum
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Tindak Pidana Umum (JAM PIDUM)

#### 📊 [IKP_PIDUM_MGMT.1] Indikator Kinerja Program: Jumlah Jaksa yang mendapatkan peningkatan kapasitas dalam penanganan perkara tindak pidana umum pada kasus prioritas
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** 460 -> 470 -> 480 -> 490 -> 500 Jaksa (Kumulatif)
*   **Formula Capaian:** `(Jumlah Jaksa Selesai Pelatihan / Target Pelatihan) * 100%`

##### 🪜 [SK_PIDUM_MGMT.1.1] Sasaran Kegiatan: Meningkatnya pemahaman Jaksa terkait kualitas penanganan perkara tindak pidana umum
*   **Unit Kerja Penanggung Jawab:** Sekretariat JAM PIDUM & Biro Kepegawaian (Kolaborasi Badiklat)

###### 📌 [IKK_PIDUM_MGMT.1.1.1] Jumlah Jaksa yang mengikuti kegiatan peningkatan kapasitas penanganan perkara tindak pidana umum pada kasus prioritas
*   **Sifat Node:** Leaf Node (Direct Input / Register Pelatihan)
*   **Formula Perhitungan:** Akumulasi jumlah kuantitatif (angka mutlak) Jaksa aktif yang bersertifikat lulus diklat spesialisasi Pidum (misalnya diklat RJ, diklat TPPO, diklat UU ITE, diklat siber Pidum).
*   **Sumber Data:** Register Badiklat / Laporan Pengembangan Pegawai Sekretariat JAM PIDUM.

---
