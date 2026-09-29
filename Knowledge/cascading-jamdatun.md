# Cetak Biru Cascading SAKIP & Renstra Kejaksaan RI 2025-2029
## Bidang Pengampuan: Jaksa Agung Muda Bidang Perdata dan Tata Usaha Negara (JAM DATUN)

Dokumen ini menyajikan peta penjenjangan kinerja (*cascading structure*) secara utuh, rigid, mendalam, tanpa singkatan, dan terperinci untuk seluruh Sasaran Program (SP), Indikator Kinerja Program (IKP/IKSP), Sasaran Kegiatan (SK/Saskeg), dan Indikator Kinerja Kegiatan (IKK/IKSK) di bawah pengampuan Jaksa Agung Muda Bidang Perdata dan Tata Usaha Negara (JAM DATUN) sesuai dengan Peraturan Kejaksaan RI No. 4 Tahun 2025 dan pedoman evaluasi pengukuran kinerja SAKIP.

Sistem SICANA mengimplementasikan struktur ini dengan pola *Self-Referencing Adjacency List* menggunakan field `parent_id` untuk menghubungkan relasi dinamis tanpa batas (*Infinite Hierarchy*).

---

## 🪜 PETA HIERARKI TANGGA CASCADING & FORMULA PENGUKURAN

### 🎯 [SP 1] Sasaran Program: Meningkatnya kualitas pelaksanaan Advocaat Generaal dan Jaksa Pengacara Negara
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Perdata dan Tata Usaha Negara (JAM DATUN) / Eselon I
*   **Target (2025-2029):** 100% -> 100% -> 100% -> 100% -> 100%

#### 📊 [IKP 1.1] Indikator Kinerja Program: Tingkat penjaminan kualitas pengajuan pendapat teknis hukum untuk permohonan kasasi lingkup peradilan umum, TUN, agama, dan militer
*   **Sifat Node:** Cascading Node (`AVERAGE`)
*   **Target (2025-2029):** 100% -> 100% -> 100% -> 100% -> 100%
*   **Formula Capaian:** Rata-rata dari capaian Sasaran Kegiatan di bawahnya.

##### 🪜 [SK 1.1.1] Sasaran Kegiatan: Terlaksananya pertimbangan hukum dan penyelesaian perkara perdata dan tata usaha negara di Jaksa Agung Muda Bidang Perdata dan Tata Usaha Negara
*   **Unit Kerja Penanggung Jawab:** Direktorat di lingkungan JAM DATUN (Pusat)

###### 📌 [IKK 1.1.1.1] Persentase penyelesaian laporan pertimbangan hukum di Jaksa Agung Muda Bidang Perdata dan Tata Usaha Negara
*   **Sifat Node:** Leaf Node (Direct Input / CMS Datun)
*   **Pembilang (Numerator):** Jumlah laporan pertimbangan hukum yang diselesaikan dan diterbitkan secara tuntas oleh JPN Pusat.
*   **Penyebut (Denominator):** Total permohonan laporan pertimbangan hukum dari instansi pemerintah/negara yang masuk.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Jumlah Laporan Pertimbangan Hukum Selesai}}{\text{Total Permohonan Pertimbangan Hukum Masuk}} \right) \times 100\%$$
*   **Sumber Data:** Database internal Register Pertimbangan Hukum / CMS Datun.

###### 📌 [IKK 1.1.1.2] Persentase penyelesaian laporan penyelesaian perkara perdata dan tata usaha negara di Jaksa Agung Muda Bidang Perdata dan Tata Usaha Negara
*   **Sifat Node:** Leaf Node (Direct Input / CMS Datun)
*   **Pembilang (Numerator):** Jumlah laporan penyelesaian perkara perdata dan TUN (gugatan litigasi/non-litigasi) yang diselesaikan.
*   **Penyebut (Denominator):** Total perkara perdata dan TUN berdasarkan Surat Kuasa Khusus (SKK) yang ditangani oleh JPN Pusat.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Jumlah Laporan Perkara Selesai}}{\text{Total SKK Perkara Ditangani}} \right) \times 100\%$$
*   **Sumber Data:** Laporan Tahunan Direktorat Perdata/TUN / CMS Datun.

##### 🪜 [SK 1.1.2] Sasaran Kegiatan: Terpenuhinya ketersediaan pendapat teknis hukum
*   **Unit Kerja Penanggung Jawab:** Direktorat Pertimbangan Hukum JAM DATUN

###### 📌 [IKK 1.1.2.1] Persentase pendapat teknis hukum yang tersusun sesuai tenggat waktu
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah dokumen pendapat teknis hukum (LO/LA) yang berhasil disusun tepat waktu sesuai dengan ketentuan SLA.
*   **Penyebut (Denominator):** Total keseluruhan permohonan pendapat teknis hukum yang wajib diselesaikan dalam tahun berjalan.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Pendapat Teknis Tersusun Tepat SLA}}{\text{Total Target Penyusunan Pendapat Teknis}} \right) \times 100\%$$
*   **Sumber Data:** Register Surat Opini Hukum JAM DATUN.

---

### 🎯 [SP 2] Sasaran Program: Meningkatnya efektivitas pelayanan hukum dalam rangka pelaksanaan fungsi Jaksa Pengacara Negara
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Perdata dan Tata Usaha Negara (JAM DATUN) / Eselon I
*   **Target (2025-2029):** Skor 3.6 -> 3.7 -> 3.8 -> 3.9 -> 4.0

#### 📊 [IKP 2.1] Indikator Kinerja Program: Indeks Persepsi atas pelayanan hukum
*   **Sifat Node:** Cascading Node (`AVERAGE`)
*   **Target (2025-2029):** Skor 3.6 -> 3.7 -> 3.8 -> 3.9 -> 4.0
*   **Formula Capaian:** Rata-rata dari indeks kepuasan layanan yang diperoleh satker daerah dan pusat.

##### 🪜 [SK 2.1.1] Sasaran Kegiatan: Terpenuhinya penyelesaian pelayanan hukum
*   **Unit Kerja Penanggung Jawab:** Direktorat Pemulihan dan Perlindungan Hak (PPH) JAM DATUN (Pusat) & Bidang Datun (Daerah)

<h6> 📌 [IKK 2.1.1.1] Persentase penyelesaian pelayanan hukum
*   **Sifat Node:** Leaf Node (Direct Input / Halo JPN)
*   **Pembilang (Numerator):** Jumlah konsultasi pelayanan hukum gratis masyarakat/BUMN/BUMD yang diselesaikan dan diberikan solusi hukum.
*   **Penyebut (Denominator):** Total seluruh permohonan konsultasi pelayanan hukum yang masuk (baik tatap muka maupun online via Halo JPN).
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Jumlah Pelayanan Hukum Selesai Dilayani}}{\text{Total Permohonan Pelayanan Hukum Masuk}} \right) \times 100\%$$
*   **Sumber Data:** Rekapitulasi Portal Digital Halo JPN / Register Pelayanan Hukum Satker.

---

### 🎯 [SP 7] Sasaran Program: Meningkatnya keberhasilan penyelamatan dan pemulihan keuangan negara melalui jalur perdata
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Perdata dan Tata Usaha Negara (JAM DATUN)
*   **Target (2025-2029):** 80% -> 81% -> 82% -> 83% -> 84%

#### 📊 [IKP 7.1] Indikator Kinerja Program: Tingkat keberhasilan penyelamatan keuangan negara melalui jalur perdata
*   **Sifat Node:** Cascading Node (`AVERAGE`)
*   **Target (2025-2029):** 80% -> 81% -> 82% -> 83% -> 84%
*   **Formula Capaian:** Rata-rata dari capaian SK penyelamatan keuangan negara di bawahnya.

##### 🪜 [SK 7.1.1] Sasaran Kegiatan: Terpenuhinya ketersediaan laporan identifikasi kerugian negara
*   **Unit Kerja Penanggung Jawab:** Direktorat Pemulihan dan Perlindungan Hak (PPH) JAM DATUN

###### 📌 [IKK 7.1.1.1] Tingkat ketersediaan laporan identifikasi potensi penyelamatan dan pemulihan keuangan negara melalui jalur perdata
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah laporan identifikasi potensi kerugian negara/daerah yang selesai disusun tuntas.
*   **Penyebut (Denominator):** Total target laporan identifikasi potensi penyelamatan keuangan negara yang dianggarkan tahun berjalan.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Laporan Identifikasi Selesai Disusun}}{\text{Total Target Laporan Identifikasi Dianggarkan}} \right) \times 100\%$$
*   **Sumber Data:** Laporan Kinerja Seksi Pemulihan Hak Direktorat PPH.

##### 🪜 [SK 7.1.2] Sasaran Kegiatan: Meningkatnya penyelesaian penyelamatan dan pemulihan keuangan negara melalui jalur perdata
*   **Unit Kerja Penanggung Jawab:** Direktorat Bantuan Hukum (Pusat) & Bidang Datun (Daerah)

###### 📌 [IKK 7.1.2.1] Tingkat penyelesaiaan penyelamatan dan pemulihan keuangan negara melalui jalur perdata
*   **Sifat Node:** Leaf Node (Direct Input / CMS Datun)
*   **Pembilang (Numerator):** Nilai nominal uang/keuangan negara yang berhasil diselamatkan atau dipulihkan (masuk kembali ke kas negara/BUMN/BUMD) dalam mata uang Rupiah.
*   **Penyebut (Denominator):** Total tuntutan nominal kerugian keuangan negara yang digugat atau dimohonkan melalui jalur perdata dalam mata uang Rupiah.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Nominal Keuangan Negara Terselamatkan/Dipulihkan (Rp)}}{\text{Total Tuntutan Kerugian Perdata yang Digugat (Rp)}} \right) \times 100\%$$
*   **Sumber Data:** Berita Acara Penyerahan Pemulihan Keuangan Negara / Putusan Hakim Perdata Inkracht.

#### 📊 [IKP 7.2] Indikator Kinerja Program: Tingkat keberhasilan pemulihan keuangan negara melalui jalur perdata
*   **Sifat Node:** Cascading Node (`AVERAGE`)
*   **Target (2025-2029):** 80% -> 81% -> 82% -> 83% -> 84%
*   **Formula Capaian:** Rerata capaian pemulihan hak keuangan negara JPN se-Indonesia (Roll-up dari SK 7.1.2).

---

### 🎯 [SP 8] Sasaran Program: Meningkatnya keberhasilan penanganan Perkara Perdata dan Tata Usaha Negara secara transparan, akuntabel, dan profesional
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Perdata dan Tata Usaha Negara (JAM DATUN)
*   **Target (2025-2029):** 80% -> 81% -> 83% -> 84% -> 85%

#### 📊 [IKP 8.1] Indikator Kinerja Program: Tingkat keberhasilan penanganan perkara perdata melalui jalur litigasi
*   **Sifat Node:** Cascading Node (`AVERAGE`)
*   **Target (2025-2029):** 80% -> 81% -> 83% -> 84% -> 85%
*   **Formula Capaian:** Rata-rata tingkat penyelesaian gugatan perdata litigasi di seluruh satuan kerja.

##### 🪜 [SK 8.1.1] Sasaran Kegiatan: Terpenuhinya pelaksanaan penyelesaian perkara perdata
*   **Unit Kerja Penanggung Jawab:** Bidang Perdata & Tata Usaha Negara (Kejati / Kejari / Cabjari)

###### 📌 [IKK 8.1.1.1] Tingkat penanganan perkara perdata sesuai tenggat waktu
*   **Sifat Node:** Leaf Node (Direct Input / CMS Datun)
*   **Pembilang (Numerator):** Jumlah gugatan perdata litigasi (berdasarkan SKK Substitusi) yang diselesaikan tepat waktu sesuai target masa sidang.
*   **Penyebut (Denominator):** Total Surat Kuasa Khusus (SKK) litigasi perdata yang diampu/ditangani oleh JPN Satker.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Perkara Perdata Selesai Tepat Waktu}}{\text{Total SKK Perdata Litigasi Ditangani}} \right) \times 100\%$$
*   **Sumber Data:** Laporan register perkara Datun di aplikasi CMS Datun.

###### 📌 [IKK 8.1.1.2] Tingkat penyelesaian perkara perdata (Daerah)
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara sengketa perdata daerah (Kejati/Kejari) yang berhasil diselesaikan secara damai (mediasi) atau putusan berkekuatan hukum tetap (inkracht) yang memenangkan negara.
*   **Penyebut (Denominator):** Total seluruh berkas sengketa perdata daerah yang masuk dalam periode berjalan.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Sengketa Perdata Daerah Selesai}}{\text{Total Sengketa Perdata Daerah Ditangani}} \right) \times 100\%$$
*   **Sumber Data:** Register Perkara Datun Daerah Kejati/Kejari.

#### 📊 [IKP 8.2] Indikator Kinerja Program: Tingkat keberhasilan penanganan perkara perdata melalui jalur non-litigasi
*   **Sifat Node:** Cascading Node (`AVERAGE`)
*   **Target (2025-2029):** 80% -> 81% -> 83% -> 84% -> 85%
*   **Formula Capaian:** Rata-rata dari persentase keberhasilan negosiasi non-litigasi Datun di daerah.

#### 📊 [IKP 8.3] Indikator Kinerja Program: Tingkat keberhasilan penanganan perkara tata usaha negara melalui jalur litigasi
*   **Sifat Node:** Cascading Node (`AVERAGE`)
*   **Target (2025-2029):** 80% -> 81% -> 83% -> 84% -> 85%
*   **Formula Capaian:** Rata-rata tingkat penyelesaian gugatan TUN litigasi di seluruh satuan kerja.

##### 🪜 [SK 8.3.1] Sasaran Kegiatan: Terpenuhinya pelaksanaan penyelesaian perkara Tata Usaha Negara (TUN)
*   **Unit Kerja Penanggung Jawab:** Bidang Datun (Kejati / Kejari / Cabjari)

###### 📌 [IKK 8.3.1.1] Tingkat penanganan perkara Tata Usaha Negara sesuai tenggat waktu
*   **Sifat Node:** Leaf Node (Direct Input / CMS Datun)
*   **Pembilang (Numerator):** Jumlah gugatan TUN litigasi (berdasarkan SKK Substitusi TUN) yang diputus pengadilan tepat waktu.
*   **Penyebut (Denominator):** Total SKK litigasi TUN yang ditangani oleh JPN Satker.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Perkara TUN Selesai Tepat Waktu}}{\text{Total SKK TUN Litigasi Ditangani}} \right) \times 100\%$$
*   **Sumber Data:** Laporan register perkara TUN di CMS Datun.

###### 📌 [IKK 8.3.1.2] Tingkat penyelesaian perkara Tata Usaha Negara (Daerah)
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara TUN daerah yang dimenangkan oleh JPN (gugatan penggugat ditolak/tidak diterima oleh Hakim TUN).
*   **Penyebut (Denominator):** Total seluruh gugatan TUN daerah yang diampu oleh JPN Satker.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Gugatan TUN Dimenangkan JPN}}{\text{Total Gugatan TUN Ditangani}} \right) \times 100\%$$
*   **Sumber Data:** Laporan Kinerja Seksi TUN Kejati/Kejari.

##### 🪜 [SK 8.4] Sasaran Kegiatan: Meningkatnya standarisasi operasional prosedur penanganan perkara
*   **Unit Kerja Penanggung Jawab:** JAM DATUN (Pusat)

###### 📌 [IKK 8.4.1] Persentase SOP penanganan perkara yang sesuai
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah SOP penanganan perkara Datun yang telah dimutakhirkan dan disesuaikan dengan juknis terbaru.
*   **Penyebut (Denominator):** Total target SOP penanganan perkara Datun wajib (SOP Perdata, SOP TUN, SOP LO, SOP LA, SOP Audit).
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{SOP Datun Disesuaikan/Diterapkan}}{\text{Total Target SOP Wajib}} \right) \times 100\%$$
*   **Sumber Data:** Dokumen Standar Operasional Prosedur Biro Hukum / JAM DATUN.

##### 🪜 [SK 8.5] Sasaran Kegiatan: Meningkatnya akuntabilitas penanganan perkara
*   **Unit Kerja Penanggung Jawab:** JAM DATUN (Pusat) & Satker Daerah

###### 📌 [IKK 8.5.1] Tingkat penyelesaian pelaporan pelaksanaan penanganan perkara secara akuntabel
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah laporan pelaksanaan kinerja penanganan perkara Datun yang diserahkan secara akuntabel dan tepat waktu.
*   **Penyebut (Denominator):** Total laporan kinerja wajib berkala Datun (bulanan, triwulanan, tahunan) dalam setahun.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Laporan Datun Diserahkan Akuntabel}}{\text{Total Laporan Wajib Setahun}} \right) \times 100\%$$
*   **Sumber Data:** Laporan Hasil Evaluasi Akuntabilitas Kinerja Bidang Datun.

---

### 🎯 [SP 16] Sasaran Program: Meningkatnya Kualitas Layanan Publik bidang hukum
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Perdata dan Tata Usaha Negara (JAM DATUN) / Lintas Bidang
*   **Target (2025-2029):** Skor 3.6 -> 3.7 -> 3.8 -> 3.9 -> 4.0

#### 📊 [IKP 16.1] Indikator Kinerja Program: Indeks kepuasan layanan Publik bidang hukum (Layanan hukum gratis, konsultasi hukum, bantuan hukum, pendampingan hukum, dan penyuluhan hukum)
*   **Sifat Node:** Cascading Node (`AVERAGE`)
*   **Target (2025-2029):** Skor 3.6 -> 3.7 -> 3.8 -> 3.9 -> 4.0
*   *Mekanisme Roll-up:* **Terintegrasi secara otomatis** dengan isian kepuasan pelayanan hukum di level IKK 2.1.1.1 (Halo JPN / Posko Pelayanan Hukum Daerah).

---

### 🎯 [SP 17] Sasaran Program: Meningkatnya Kualitas Layanan Publik bidang penegakan hukum
*   **Unit Pengampu Utama:** Kolaborasi Lintas Eselon I (JAM PIDUM, JAM PIDSUS, JAM DATUN, JAM PIDMIL)
*   **Target (2025-2029):** Skor 3.6 -> 3.7 -> 3.8 -> 3.9 -> 4.0

#### 📊 [IKP 17.1] Indikator Kinerja Program: Indeks kepuasan layanan publik bidang penegakan hukum
*   **Sifat Node:** Cascading Node (`AVERAGE`)
*   **Target (2025-2029):** Skor 3.6 -> 3.7 -> 3.8 -> 3.9 -> 4.0

##### 🪜 [SK 17.1.1] Sasaran Kegiatan: Meningkatnya kualitas layanan publik bidang penegakan hukum di Kejaksaan Agung
*   **Unit Kerja Penanggung Jawab:** Sekretariat JAM DATUN

###### 📌 [IKK 17.1.1.1] Persentase layanan bidang penegakan hukum di Kejaksaan Agung sesuai SLA
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah layanan administrasi penegakan hukum Datun di tingkat pusat selesai tepat SLA.
*   **Penyebut (Denominator):** Total permohonan layanan penegakan hukum Datun pusat yang masuk.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Layanan Datun Pusat Tepat SLA}}{\text{Total Permohonan Layanan Datun Pusat Masuk}} \right) \times 100\%$$
*   **Sumber Data:** Log Persuratan/Layanan Bantuan Hukum Pusat.

---

### 🎯 [SP 18] Sasaran Program: Meningkatnya efektivitas pemanfaatan sarana dan prasarana dalam mendukung penegakan dan pelayanan hukum di Kejaksaan RI
*   **Unit Pengampu Utama:** Kolaborasi Seluruh Bidang (JAM Intel, JAM Pidum, JAM Pidsus, JAM Datun, JAM Pidmil, JAMBIN)
*   **Target (2025-2029):** 80% -> 82% -> 84% -> 86% -> 90%

#### 📊 [IKP 18.1] Indikator Kinerja Program: Tingkat utilisasi sarana dan prasarana dalam mendukung penegakan dan pelayanan hukum di Kejaksaan RI
*   **Sifat Node:** Cascading Node (`AVERAGE`)
*   **Target (2025-2029):** 80% -> 82% -> 84% -> 86% -> 90%

##### 🪜 [SK 18.1.1] Sasaran Kegiatan: Meningkatnya jumlah Sarana dan Prasarana yang Mendukung Penegakan dan Pelayanan Hukum di Kejaksaan RI
*   **Unit Kerja Penanggung Jawab:** Biro Perlengkapan (Pusat) & Bidang Datun (Daerah)

###### 📌 [IKK 18.1.1.1] Persentase Terpenuhinya Peralatan Pengolah Data dan Komunikasi Penegakan dan Pelayanan Hukum di Kejaksaan RI (Sektor Datun)
*   **Sifat Node:** Leaf Node (Direct Input / Inventaris SIMAN)
*   **Pembilang (Numerator):** Jumlah set komputer fungsional, laptop JPN, dan server CMS Datun yang terpenuhi dalam kondisi prima.
*   **Penyebut (Denominator):** Total kebutuhan ideal perangkat teknologi dan pengolah data Datun satker pusat/daerah.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Sarana IT Datun Terpenuhi}}{\text{Total Kebutuhan Ideal Sarana IT Datun}} \right) \times 100\%$$
*   **Sumber Data:** Database Aset SIMAN v2 Kementerian Keuangan / Biro Perlengkapan.

---

## 💻 CATATAN ARSITEKTURAL BACKEND LARAVEL (SICANA ENGINE)

1.  **Struktur Database Tunggal Rekursif:** Tabel master `performance_indicators` menyimpan seluruh simpul di atas menggunakan relasi `parent_id` yang menunjuk dirinya sendiri, dengan field enum `level` ('SP', 'IKP', 'SK', 'IKK'). Atribut `is_leaf` diatur `true` untuk seluruh level IKK (Level 6), dan `false` untuk seluruh level Sasaran Kegiatan (SK) ke atas.
2.  **Logic Roll-up Bottom-Up:** Calculation engine pada `DatunCalculationService.php` akan menelusuri data transaksi mentah (*raw entry*) dari level IKK di satker daerah, merata-ratakannya secara bottom-up sesuai jenis gerbang kalkulasi (`calc_type`), hingga mencapai level Sasaran Program (SP) secara realtime dan otomatis.
3.  **Integritas Data Lintas Bidang:** Atribut composite unique constraint `UNIQUE(satker_id, indicator_id, tahun, triwulan)` pada tabel `sakip_measurements` menjaga keandalan database dari risiko terjadinya tumpang-tindih input data capaian sengketa perdata litigasi maupun non-litigasi.

---
