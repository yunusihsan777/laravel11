# Cetak Biru Cascading SAKIP & Renstra Kejaksaan RI 2025-2029
## Bidang Pengampuan: Jaksa Agung Muda Bidang Tindak Pidana Khusus (JAM PIDSUS)

Dokumen ini menyajikan peta penjenjangan kinerja (*cascading structure*) secara utuh, rigid, mendalam, tanpa singkatan, dan terperinci untuk seluruh Sasaran Program (SP), Indikator Kinerja Program (IKP/IKSP), Sasaran Kegiatan (SK/Saskeg), dan Indikator Kinerja Kegiatan (IKK/IKSK) di bawah pengampuan Jaksa Agung Muda Bidang Tindak Pidana Khusus (JAM PIDSUS) sesuai dengan Peraturan Kejaksaan RI No. 4 Tahun 2025.

Sistem SICANA mengimplementasikan struktur ini dengan pola *Self-Referencing Adjacency List* menggunakan field `parent_id` untuk menghubungkan relasi dinamis tanpa batas (*Infinite Hierarchy*).

---

## 🪜 PETA HIERARKI TANGGA CASCADING & FORMULA PENGUKURAN

### 🎯 [SP 5] Sasaran Program: Meningkatnya keberhasilan penanganan perkara tindak pidana khusus secara transparan, akuntabel dan profesional
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Tindak Pidana Khusus (JAM PIDSUS) / Eselon I
*   **Target (2025-2029):** Terdistribusi per IKP

#### 📊 [IKP 5.1] Indikator Kinerja Program: Tingkat keberhasilan penanganan perkara tindak pidana korupsi dan TPPU
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** 77% -> 78% -> 80% -> 81% -> 83%
*   **Formula Capaian:** Rata-rata dari capaian tingkat penyelesaian sub-tahap Penyelidikan, Penyidikan, Prapenuntutan, Penuntutan, dan Eksekusi.
*   **Sumber Data:** API CMS Pidsus.

##### 🪜 [SK 5.1.1] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan Perkara Tipikor dan TPPU
*   **Unit Kerja Penanggung Jawab:** Bidang Tindak Pidana Khusus (Kejati / Kejari / Cabjari)

##### 📌 [IKK 5.1.1.1] Tingkat penyelesaian perkara tindak pidana korupsi dan TPPU pada tahap Penyelidikan
*   **Sifat Node:** Leaf Node (Direct Input dari CMS Pidsus)
*   **Pembilang (Numerator):** Jumlah penyelidikan korupsi yang selesai ditindaklanjuti/dihentikan/dinaikkan (Pidsus-7).
*   **Penyebut (Denominator):** Total penyelidikan korupsi aktif yang ditangani (P-2).
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Jumlah Penyelidikan Selesai (Pidsus-7)}}{\text{Total Penyelidikan Ditangani (P-2)}} \right) \times 100\%$$
*   **Sumber Data:** Register Penyelidikan CMS Pidsus.

##### 📌 [IKK 5.1.1.2] Tingkat penyelesaian perkara tindak pidana korupsi dan TPPU pada tahap Penyidikan
*   **Sifat Node:** Leaf Node (Direct Input dari CMS Pidsus)
*   **Pembilang (Numerator):** Jumlah penyidikan korupsi selesai (Penyerahan tersangka/BB (Tahap II) atau dihentikan (SP3) dengan Berita Acara BA-14/BA-15).
*   **Penyebut (Denominator):** Total penyidikan korupsi aktif yang ditangani (P-8).
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Jumlah Penyidikan Selesai (BA-14 / BA-15)}}{\text{Total Penyidikan Ditangani (P-8)}} \right) \times 100\%$$
*   **Sumber Data:** Register Penyidikan CMS Pidsus.

##### 📌 [IKK 5.1.1.3] Tingkat penyelesaian perkara tindak pidana korupsi dan TPPU pada tahap Prapenuntutan
*   **Sifat Node:** Leaf Node (Direct Input dari CMS Pidsus)
*   **Pembilang (Numerator):** Jumlah perkara selesai prapenuntutan (Penyelesaian penyerahan berkas yang dinyatakan lengkap P-21).
*   **Penyebut (Denominator):** Total SPDP korupsi dan P-16 yang diterima pada tahap prapenuntutan.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Jumlah Prapenuntutan Selesai (P-21)}}{\text{Total Berkas Prapenuntutan Ditangani}} \right) \times 100\%$$
*   **Sumber Data:** Register Prapenuntutan CMS Pidsus.

##### 📌 [IKK 5.1.1.4] Tingkat penyelesaian perkara tindak pidana korupsi dan TPPU pada tahap Penuntutan
*   **Sifat Node:** Leaf Node (Direct Input dari CMS Pidsus)
*   **Pembilang (Numerator):** Jumlah penuntutan korupsi yang diselesaikan (Limpah sidang pengadilan P-31 atau penetapan penghentian penuntutan SKP2).
*   **Penyebut (Denominator):** Total berkas penuntutan korupsi yang ditangani (Tahap II masuk).
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Jumlah Penuntutan Selesai (P-31 / SKP2)}}{\text{Total Perkara Penuntutan Ditangani}} \right) \times 100\%$$
*   **Sumber Data:** Register Penuntutan CMS Pidsus.

##### 📌 [IKK 5.1.1.5] Tingkat penyelesaian perkara tindak pidana korupsi dan TPPU yang berkekuatan hukum tetap (Inkracht) dan telah dieksekusi
*   **Sifat Node:** Leaf Node (Direct Input dari CMS Pidsus)
*   **Pembilang (Numerator):** Jumlah terpidana korupsi yang telah dieksekusi tuntas berdasarkan Berita Acara BA-17 / Pidsus-38.
*   **Penyebut (Denominator):** Total terpidana korupsi yang putusannya berkekuatan hukum tetap (P-48).
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Terpidana Dieksekusi (Pidsus-38)}}{\text{Total Terpidana Inkracht (P-48)}} \right) \times 100\%$$
*   **Sumber Data:** Register Eksekusi CMS Pidsus.

---

#### 📊 [IKP 5.2] Indikator Kinerja Program: Tingkat keberhasilan penanganan perkara tindak pidana perpajakan dan TPPU
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** 84% -> 85% -> 86% -> 87% -> 88%
*   **Formula Capaian:** Rata-rata dari capaian tingkat penyelesaian sub-tahap Prapenuntutan, Penuntutan, dan Eksekusi.
*   **Sumber Data:** API CMS Pidsus (Modul Perpajakan).

##### 🪜 [SK 5.2.1] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan Perkara Tipidsus (Perpajakan) dan TPPU
*   **Unit Kerja Penanggung Jawab:** Bidang Tindak Pidana Khusus (Kejati / Kejari)

##### 📌 [IKK 5.2.1.1] Tingkat penyelesaian perkara tindak pidana khusus (Perpajakan) dan TPPU pada tahap Prapenuntutan
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah berkas prapid pajak yang diselesaikan.
*   **Penyebut (Denominator):** Total berkas prapid pajak yang masuk ditangani.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Berkas Pajak Pratut Selesai}}{\text{Total Berkas Pajak Pratut Ditangani}} \right) \times 100\%$$

##### 📌 [IKK 5.2.1.2] Tingkat penyelesaian perkara tindak pidana khusus (Perpajakan) dan TPPU pada tahap Penuntutan
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah perkara penuntutan pajak selesai (Limpah pengadilan P-31 / SKP2).
*   **Penyebut (Denominator):** Total perkara penuntutan pajak yang ditangani.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Perkara Pajak Penuntutan Selesai}}{\text{Total Perkara Pajak Penuntutan Ditangani}} \right) \times 100\%$$

##### 📌 [IKK 5.2.1.3] Tingkat penyelesaian perkara tindak pidana khusus (Perpajakan) dan TPPU yang berkekuatan hukum tetap (Inkracht) dan telah dieksekusi
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah terpidana pajak yang dieksekusi berdasarkan Pidsus-38.
*   **Penyebut (Denominator):** Total terpidana pajak berkekuatan hukum tetap (P-48).
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Terpidana Pajak Dieksekusi}}{\text{Total Terpidana Pajak Inkracht}} \right) \times 100\%$$

---

#### 📊 [IKP 5.3 & 5.4] Indikator Kinerja Program: Tingkat keberhasilan penanganan perkara tindak pidana kepabeanan, cukai dan TPPU
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** 84% -> 85% -> 86% -> 87% -> 88%
*   **Formula Capaian:** Rata-rata dari capaian tingkat penyelesaian sub-tahap Prapenuntutan, Penuntutan, dan Eksekusi Kepabeanan & Cukai.
*   **Sumber Data:** API CMS Pidsus (Modul Kepabeanan & Cukai).

##### 🪜 [SK 5.3.1] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan Perkara Tipidsus (Kepabeanan, Cukai) dan TPPU
*   **Unit Kerja Penanggung Jawab:** Bidang Tindak Pidana Khusus (Kejati / Kejari)

##### 📌 [IKK 5.3.1.1] Tingkat penyelesaian perkara tindak pidana khusus (Kepabeanan, Cukai) dan TPPU pada tahap Prapenuntutan
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah berkas prapenuntutan bea cukai selesai tepat waktu.
*   **Penyebut (Denominator):** Total berkas prapenuntutan bea cukai yang ditangani.

##### 📌 [IKK 5.3.1.2] Tingkat penyelesaian perkara tindak pidana khusus (Kepabeanan, Cukai) dan TPPU pada tahap Penuntutan
*   **Sifat Node:** Leaf Node (Direct Input)

##### 📌 [IKK 5.3.1.3] Tingkat penyelesaian perkara tindak pidana khusus (Kepabeanan, Cukai) dan TPPU yang berkekuatan hukum tetap (Inkracht) dan telah dieksekusi
*   **Sifat Node:** Leaf Node (Direct Input)

---

#### 📊 [IKP 5.5] Indikator Kinerja Program: Tingkat keberhasilan penanganan perkara tindak pidana yang menyebabkan kerugian perekonomian negara dan TPPU
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** 20% -> 52% -> 60% -> 66% -> 72%
*   **Formula Capaian:** Rata-rata dari capaian tingkat penyelesaian sub-tahap Penyelidikan, Penyidikan, Prapenuntutan, Penuntutan, dan Eksekusi Perekonomian Negara.
*   **Sumber Data:** CMS Pidsus.

##### 🪜 [SK 5.5.1] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan Perkara Tindak Pidana Khusus Lainnya (Perekonomian dll) dan TPPU
*   **Unit Kerja Penanggung Jawab:** Bidang Tindak Pidana Khusus (Kejati / Kejari)

##### 📌 [IKK 5.5.1.1] Tingkat penyelesaian perkara tindak pidana perekonomian negara pada tahap Penyelidikan
*   **Sifat Node:** Leaf Node (Direct Input)

##### 📌 [IKK 5.5.1.2] Tingkat penyelesaian perkara tindak pidana perekonomian negara pada tahap Penyidikan
*   **Sifat Node:** Leaf Node (Direct Input)

##### 📌 [IKK 5.5.1.3] Tingkat penyelesaian perkara tindak pidana perekonomian negara pada tahap Prapenuntutan
*   **Sifat Node:** Leaf Node (Direct Input)

##### 📌 [IKK 5.5.1.4] Tingkat penyelesaian perkara tindak pidana perekonomian negara pada tahap Penuntutan
*   **Sifat Node:** Leaf Node (Direct Input)

##### 📌 [IKK 5.5.1.5] Tingkat penyelesaian perkara tindak pidana perekonomian negara yang berkekuatan hukum tetap (Inkracht) dan telah dieksekusi
*   **Sifat Node:** Leaf Node (Direct Input)

---

#### 📊 [IKP 5.6] Indikator Kinerja Program: Tingkat keberhasilan penanganan perkara pelanggaran HAM Berat
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** 85% -> 87% -> 90% -> 92% -> 95%
*   **Formula Capaian:** Rerata gabungan penyelesaian Rencana Aksi Nasional HAM dan progress penanganan perkara.
*   **Sumber Data:** Laporan Pelaksanaan Direktorat HAM Berat JAM PIDSUS.

##### 🪜 [SK 5.6.1] Sasaran Kegiatan: Meningkatnya keberhasilan penanganan perkara pelanggaran HAM berat
*   **Unit Kerja Penanggung Jawab:** Direktorat Pelanggaran HAM Berat JAM PIDSUS

##### 📌 [IKK 5.6.1.1] Tingkat penyelesaian rencana aksi dalam penanganan perkara pelanggaran HAM berat
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Formula:** Berdasarkan persentase rencana aksi nasional HAM terimplementasikan.

##### 📌 [IKK 5.6.1.2] Tingkat pencapaian kemajuan (progress) penanganan perkara pelanggaran HAM yang berat
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Formula:** Berdasarkan kuantitas draf/berkas yang naik tahap dari penyelidikan ke penyidikan.

---

#### 📊 [IKP 5.7] Indikator Kinerja Program: Tingkat keberhasilan pengendalian operasi dalam penyelesaian penanganan perkara tindak pidana khusus
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** 72% -> 76% -> 79% -> 83% -> 87%

##### 🪜 [SK 5.7.1] Sasaran Kegiatan: Meningkatnya penyelesaian pengendalian operasi dalam penanganan perkara tindak pidana khusus
*   **Unit Kerja Penanggung Jawab:** Bidang Tindak Pidana Khusus (Kejati / Kejari)

##### 📌 [IKK 5.7.1.1] Tingkat penyelesaian tindak lanjut penyelesaian laporan dan pengaduan masyarakat dalam penyelesaian penanganan perkara tindak pidana khusus
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah laporan pengaduan masyarakat yang ditindaklanjuti/diselesaikan.
*   **Penyebut (Denominator):** Total laporan pengaduan masyarakat yang diterima.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Laporan Pengaduan Selesai}}{\text{Total Laporan Pengaduan Diterima}} \right) \times 100\%$$

##### 📌 [IKK 5.7.1.2] Tingkat penyelesaian kegiatan operasi bantuan teknis dan tindakan hukum lain dalam penyelesaian penanganan perkara tindak pidana khusus
*   **Sifat Node:** Leaf Node (Direct Input)

##### 📌 [IKK 5.7.1.3] Tingkat penyelesaian kegiatan monitoring dan evaluasi dalam penyelesaian penanganan perkara tindak pidana khusus
*   **Sifat Node:** Leaf Node (Direct Input)

---

### 🎯 [SP 6] Sasaran Program: Meningkatnya keberhasilan penyelamatan dan pengembalian kerugian negara serta pembayaran denda dalam penanganan perkara tindak pidana khusus
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Tindak Pidana Khusus (JAM PIDSUS) / Eselon I
*   **Target (2025-2029):** Terdistribusi per IKP

#### 📊 [IKP 6.1] Indikator Kinerja Program: Tingkat keberhasilan penyelamatan dan pengembalian kerugian negara dalam penanganan perkara tindak pidana korupsi dan TPPU
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** 27% -> 28% -> 29% -> 30% -> 31%
*   **Sumber Data:** Portal Keuangan SI-PNBP / Bidang Pidsus.

##### 🪜 [SK 6.1.1] Sasaran Kegiatan: Meningkatnya penyelesaian penyelamatan dan pengembalian kerugian negara dalam penanganan perkara tindak pidana korupsi dan TPPU
*   **Unit Kerja Penanggung Jawab:** Bidang Tindak Pidana Khusus (Kejati / Kejari / Cabjari)

##### 📌 [IKK 6.1.1.1] Tingkat penyelamatan kerugian negara dalam perkara tindak pidana korupsi pada tahap sebelum putusan Inkracht
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Nilai uang sitaan / nilai aset terblokir yang berhasil diselamatkan (Rupiah).
*   **Penyebut (Denominator):** Total taksiran nilai perhitungan kerugian negara (PKN) dari BPK/BPKP.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Nilai Penyelamatan Sebelum Inkracht}}{\text{Total Taksiran Nilai PKN}} \right) \times 100\%$$

##### 📌 [IKK 6.1.1.2] Tingkat penyelamatan kerugian negara dalam perkara tindak pidana korupsi pada tahap setelah putusan Inkracht
*   **Sifat Node:** Leaf Node (Direct Input)

##### 📌 [IKK 6.1.1.3] Tingkat penyelesaian pengembalian kerugian negara (pembayaran uang pengganti) dalam perkara tindak pidana korupsi
*   **Sifat Node:** Leaf Node (Direct Input)

---

#### 📊 [IKP 6.2] Indikator Kinerja Program: Tingkat keberhasilan pembayaran denda dalam penanganan perkara tindak pidana khusus lainnya dan TPPU (Kepabeanan, Perpajakan, Cukai, tindak Pidana yang menyebabkan kerugian perekonomian negara)
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** 35% -> 36% -> 37% -> 38% -> 39%
*   **Sumber Data:** Portal Keuangan SI-PNBP / Bidang Pidsus.

##### 🪜 [SK 6.2.1] Sasaran Kegiatan: Meningkatnya penyelesaiaan pembayaran denda dalam penanganan perkara tindak pidana khusus lainnya dan TPPU
*   **Unit Kerja Penanggung Jawab:** Bidang Tindak Pidana Khusus (Kejati / Kejari)

##### 📌 [IKK 6.2.1.1] Tingkat penyelesaian denda perpajakan
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah pembayaran denda pajak yang berhasil disetor ke kas negara (Rupiah).
*   **Penyebut (Denominator):** Total denda pajak yang berkekuatan hukum tetap (Inkracht).
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Denda Pajak Terealisasi}}{\text{Total Denda Pajak Putusan}} \right) \times 100\%$$

##### 📌 [IKK 6.2.1.2] Tingkat denda kepabeanan
*   **Sifat Node:** Leaf Node (Direct Input)

##### 📌 [IKK 6.2.1.3] Tingkat denda cukai
*   **Sifat Node:** Leaf Node (Direct Input)

##### 📌 [IKK 6.2.1.4] Tingkat denda kerugian perekonomian negara
*   **Sifat Node:** Leaf Node (Direct Input)

---

### 🎯 [SP 15] Sasaran Program: Meningkatnya kualitas sistem penuntutan yang terintegrasi dan transparan (Fokus CMS)
*   **Unit Pengampu:** Lintas Eselon I (JAM PIDUM, JAM PIDSUS, JAM PIDMIL)

#### 📊 [IKP 15.1] Indikator Kinerja Program: Tingkat kualitas penanganan perkara yang terekam dalam Case Management System (CMS)
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** 85% -> 86% -> 87% -> 88% -> 89%

##### 🪜 [SK 15.1.1] Sasaran Kegiatan: Meningkatnya penyelesaian penanganan perkara tindak pidana khusus melalui pemanfaatan CMS
*   **Unit Kerja Penanggung Jawab:** Bidang Tindak Pidana Khusus (Kejati / Kejari)

##### 📌 [IKK 15.1.1.1] Tingkat penyelesaian perkara tindak pidana khusus melalui pemanfaatan CMS
*   **Sifat Node:** Leaf Node (Direct Input dari Telemetri CMS Pidsus)
*   **Pembilang (Numerator):** Jumlah data perkara Pidsus yang diinput ke CMS dengan selisih waktu <= 3 hari sejak penetapan (Data Segar) dan berkas lengkap (Data Sahih).
*   **Penyebut (Denominator):** Total seluruh perkara Pidsus yang terekam dalam CMS.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Jumlah Perkara Pidsus Data Segar \& Sahih}}{\text{Total Perkara Pidsus di CMS}} \right) \times 100\%$$

---

### 🎯 [SP 17] Sasaran Program: Meningkatnya Kualitas Layanan Publik bidang penegakan hukum
*   **Unit Pengampu:** Lintas Eselon I (JAM PIDUM, JAM PIDSUS, JAM DATUN, JAM PIDMIL)

#### 📊 [IKP 17.1] Indikator Kinerja Program: Indeks kepuasan layanan publik bidang penegakan hukum
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** Skor 3.6 -> 3.7 -> 3.8 -> 3.9 -> 4.0

##### 🪜 [SK 17.1.1] Sasaran Kegiatan: Meningkatnya kualitas layanan publik bidang penegakan hukum di Kejaksaan Agung
*   **Unit Kerja Penanggung Jawab:** Sekretariat JAM PIDSUS

##### 📌 [IKK 17.1.1.1] Indeks kepuasan layanan publik bidang penegakan hukum di Kejaksaan Agung (Sektor Pidsus)
*   **Sifat Node:** Leaf Node (Direct Input dari SKM)
*   **Formula:** Rata-rata dari nilai kuesioner SKM (Skala 1-5) sektor penegakan hukum tindak pidana khusus di tingkat pusat.

---

### 🎯 [SP 18] Sasaran Program: Meningkatnya efektivitas pemanfaatan sarana dan prasarana dalam mendukung penegakan dan pelayanan hukum di Kejaksaan RI
*   **Unit Pengampu:** Lintas Eselon I (JAM INTEL, JAM PIDUM, JAM PIDSUS, JAM DATUN, JAM PIDMIL)

#### 📊 [IKP 18.1] Indikator Kinerja Program: Tingkat utilisasi sarana dan prasarana dalam mendukung penegakan dan pelayanan hukum di Kejaksaan RI
*   **Sifat Node:** Agregatif (Roll-up dari SK di bawahnya)
*   **Target (2025-2029):** 80% -> 82% -> 84% -> 86% -> 90%

##### 🪜 [SK 18.1.1] Sasaran Kegiatan: Peningkatan Sarana dan Prasarana Penegakan Hukum Pidsus
*   **Unit Kerja Penanggung Jawab:** Bidang Tindak Pidana Khusus (Kejati / Kejari)

##### 📌 [IKK 18.1.1.1] Persentase terpenuhi sarana/prasarana penegakan hukum Pidsus
*   **Sifat Node:** Leaf Node (Direct Input)
*   **Pembilang (Numerator):** Jumlah sarpras fungsional (komputer forensik, alat pemindaian) yang aktif digunakan.
*   **Penyebut (Denominator):** Total sarpras yang tersedia di inventaris bidang Pidsus.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Sarpras Pidsus Aktif Dimanfaatkan}}{\text{Total Sarpras Pidsus Tersedia}} \right) \times 100\%$$

---

## 💻 CATATAN ARSITEKTURAL BACKEND LARAVEL

Sistem informasi **SICANA** mengimplementasikan silsilah pohon di atas dengan model tabel relasional tunggal yang kokoh:
1.  **Tabel Master `indicators`:** Menyimpan parameter SP, IKP, SK, dan IKK dalam satu tabel (*Adjacency List Pattern*) dengan relasi `parent_id` ke tabel dirinya sendiri. Atribut `is_leaf` menandai node daun.
2.  **Tabel Transaksi `measurements`:** Menyimpan target dan realisasi berkala satker pusat/daerah, diamankan oleh *Composite Unique Index* `UNIQUE(satker_id, indicator_id, tahun, triwulan)` guna mencegah kebocoran *double entry* data capaian.
3.  **Recursive bottom-up rollup:** Logic calculation engine diletakkan pada Service Class `PidsusCalculationEngine.php` yang secara rekursif menelusuri data isian dari level IKK paling dasar (*leaf node*), merata-ratakan atau memformulasikannya sesuai jenis gerbang kalkulasi, hingga naik mencapai skor capaian puncak di Sasaran Program.
