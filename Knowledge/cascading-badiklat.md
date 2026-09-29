# 🪜 CETAK BIRU CASCADING KINERJA SAKIP BADIKLAT (JAKSA AGUNG MUDA SEKTORAL / BADAN DIKLAT)

Dokumen ini menyajikan seluruh arsitektur penjenjangan kinerja (*cascading*) secara utuh, rigid, mendalam, tanpa singkatan, dan terperinci untuk **Sasaran Program (SP)**, **Indikator Kinerja Program (IKP)**, **Sasaran Kegiatan (SK)**, dan **Indikator Kinerja Kegiatan (IKK)** di bawah pengampuan **Badan Pendidikan dan Pelatihan (Badiklat) Kejaksaan RI** sesuai dengan Peraturan Kejaksaan RI No. 4 Tahun 2025 (Renstra Kejaksaan RI 2025-2029) dan pedoman akuntabilitas kinerja SAKIP.

Sistem SICANA mengimplementasikan struktur ini dengan pola *Self-Referencing Adjacency List* menggunakan field `parent_id` untuk menghubungkan relasi dinamis tanpa batas (*Infinite Hierarchy*).

---

## 🪜 PETA HIERARKI TANGGA CASCADING & FORMULA PENGUKURAN (CORE DIKLAT)

### 🎯 [SP 9] Sasaran Program: Meningkatnya kualitas program Pendidikan dan Pelatihan Kejaksaan RI [cite: 19, 29]
*   **Unit Pengampu Utama:** Badan Pendidikan dan Pelatihan (Badiklat) / Eselon I [cite: 19]
*   **Target (2025-2029):** Terdistribusi per IKP [cite: 26]

#### 📊 [IKP 9.1] Indikator Kinerja Program: Indeks Kepuasan pengguna hasil pendidikan dan pelatihan [cite: 19, 29]
*   **Sifat Node:** Cascading Node (`AVERAGE` - Rolls-up secara rata-rata dari seluruh SK di bawahnya) [cite: 19]
*   **Target (2025-2029):** 3.6 -> 3.7 -> 3.8 -> 3.9 -> 4.0 [cite: 26]
*   **Formula Capaian:** Rata-rata dari capaian Sasaran Kegiatan (SK) di bawahnya [cite: 19, 29].
*   **Sumber Data:** Laporan Hasil Evaluasi / Kuesioner Pengguna Hasil Diklat [cite: 19, 26].

##### 🪜 [SK 9.1.1] Sasaran Kegiatan: Meningkatnya keberhasilan penyelenggaraan diklat Kejaksaan RI [cite: 19, 29]
*   **Unit Kerja Penanggung Jawab:** Bidang Penyelenggaraan Diklat / Pusat Diklat (Eselon II) [cite: 19]

###### 📌 [IKK 9.1.1.1] Indeks kualitas penyelenggaraan diklat Kejaksaan RI [cite: 19, 29]
*   **Sifat Node:** Cascading Node (`AVERAGE` - Rolls-up secara rata-rata dari 3 parameter tingkat Level 8) [cite: 19]
*   **Target (2025-2029):** 3.2 -> 3.4 -> 3.6 -> 3.8 -> 4.0 [cite: 29]
*   **Formula Perhitungan:**
    $$\text{Realisasi IKK 9.1.1.1} = \frac{\text{IN\_BADIKLAT\_INDEX\_KURIKULUM} + \text{IN\_BADIKLAT\_INDEX\_SARPRAS} + \text{IN\_BADIKLAT\_INDEX\_PENGAJAR}}{3} \quad \text{\cite: 19, 29}$$
*   **Sumber Data:** Laporan Evaluasi / LHP Badiklat [cite: 19].

####### 🍃 LEVEL 8: Elemen Data Transaksional (Leaf Node - RAW INPUT)
*   `IN_BADIKLAT_INDEX_KURIKULUM` [Leaf]: Nilai indeks kualitas kurikulum diklat (skala 1-5) berdasarkan hasil evaluasi kurikulum dan silabus pembelajaran oleh peserta [cite: 19, 37].
*   `IN_BADIKLAT_INDEX_SARPRAS` [Leaf]: Nilai indeks kepuasan sarana dan prasarana diklat (skala 1-5) berdasarkan survei fasilitas asrama, kelas, dan prasarana pendukung di lingkungan Badiklat [cite: 19, 32].
*   `IN_BADIKLAT_INDEX_PENGAJAR` [Leaf]: Nilai indeks kualitas pengajaran widyaiswara/narasumber (skala 1-5) berdasarkan kuesioner harian kepuasan pengajaran oleh peserta diklat [cite: 19, 37].

---

##### 🪜 [SK 9.1.2] Sasaran Kegiatan: Meningkatnya keberhasilan penyelenggaraan sertifikasi kompetensi Kejaksaan RI [cite: 19, 29]
*   **Unit Kerja Penanggung Jawab:** Bidang Sertifikasi Kompetensi / Pusat Diklat (Eselon II) [cite: 19]

###### 📌 [IKK 9.1.2.1] Tingkat efektivitas pelaksanaan sertifikasi kompetensi [cite: 19, 30]
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`) [cite: 19]
*   **Target (2025-2029):** 80% -> 85% -> 90% -> 95% -> 100% [cite: 30]
*   **Formula Perhitungan:**
    $$\text{Realisasi IKK 9.1.2.1 (\%)} = \left( \frac{\text{IN\_BADIKLAT\_SERT\_LULUS}}{\text{IN\_BADIKLAT\_SERT\_DAFTAR}} \right) \times 100\% \quad \text{\cite: 19}$$
*   **Sumber Data:** Berita Acara Kelulusan Uji Sertifikasi Kompetensi / Database Sertifikasi Badiklat [cite: 19].

####### 🍃 LEVEL 8: Elemen Data Transaksional (Leaf Node - RAW INPUT)
*   `IN_BADIKLAT_SERT_LULUS` [Leaf]: Jumlah total peserta diklat Kejaksaan RI yang dinyatakan lulus dan memperoleh sertifikat kompetensi spesifik yang sah [cite: 19].
*   `IN_BADIKLAT_SERT_DAFTAR` [Leaf]: Jumlah total peserta diklat Kejaksaan RI yang terdaftar dan mengikuti ujian sertifikasi kompetensi [cite: 19].

---

##### 🪜 [SK 9.1.3] Sasaran Kegiatan: Terlaksananya layanan pendidikan dan pelatihan [cite: 19, 30]
*   **Unit Kerja Penanggung Jawab:** Bidang Layanan Diklat / Pusat Diklat (Eselon II) [cite: 19]

###### 📌 [IKK 9.1.3.1] Persentase pendidikan dan pelatihan sesuai standar kualitas [cite: 19, 31]
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`) [cite: 19]
*   **Target (2025-2029):** 100% -> 100% -> 100% -> 100% -> 100% [cite: 31]
*   **Formula Perhitungan:**
    $$\text{Realisasi IKK 9.1.3.1 (\%)} = \left( \frac{\text{IN\_BADIKLAT\_PUAS\_DIKLAT}}{\text{IN\_BADIKLAT\_TOTAL\_DIKLAT}} \right) \times 100\% \quad \text{\cite: 19, 31}$$
*   **Sumber Data:** Kuesioner Pasca-Diklat Badiklat [cite: 19, 31].

####### 🍃 LEVEL 8: Elemen Data Transaksional (Leaf Node - RAW INPUT)
*   `IN_BADIKLAT_PUAS_DIKLAT` [Leaf]: Jumlah peserta diklat yang menyatakan puas/sangat puas terhadap standar kualitas kurikulum, sarpras, dan pengajaran dalam kuesioner pasca-diklat [cite: 19].
*   `IN_BADIKLAT_TOTAL_DIKLAT` [Leaf]: Jumlah total seluruh peserta diklat yang mengisi kuesioner evaluasi pasca-diklat [cite: 19].

---

## 🪜 PETA HIERARKI TANGGA CASCADING & FORMULA PENGUKURAN (SUPPORTING KESEKRETARIATAN)

### 🎯 [SP 10] Sasaran Program: Meningkatnya kualitas layanan internal dukungan manajemen dan kesehatan yustisial [cite: 2, 26]
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Pembinaan (JAMBIN) / Eselon I [cite: 2]
*   *Catatan Arsitektur:* Kesekretariatan Badiklat menginduk secara programatik pada SP Dukungan Manajemen Kejaksaan RI [cite: 18, 31].

#### 📊 [IKP 10.1] Indikator Kinerja Program: Indeks kepuasan layanan dukungan internal manajemen Kejaksaan RI [cite: 2, 26]
*   **Sifat Node:** Cascading Node (`AVERAGE` - dihitung secara berjenjang dari seluruh Kesekretariatan Eselon I) [cite: 2]
*   **Target (2025-2029):** 3.6 -> 3.7 -> 3.8 -> 3.9 -> 4.0 [cite: 26]
*   **Formula Capaian:** Rata-rata indeks kepuasan layanan kesekretariatan internal [cite: 2, 26].

##### 🪜 [SK 10.1.3] Sasaran Kegiatan: Meningkatnya kegiatan layanan kesekretariatan Badan Pendidikan dan Pelatihan Kejaksaan RI [cite: 31]
*   **Unit Kerja Penanggung Jawab:** Kesekretariatan Badan Pendidikan dan Pelatihan Kejaksaan RI (Eselon II) [cite: 31]

###### 📌 [IKK 10.1.3.1] Persentase layanan dukungan manajemen Eselon I sesuai SLA [cite: 31, 32]
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`) [cite: 31, 32]
*   **Target (2025-2029):** 100% -> 100% -> 100% -> 100% -> 100% [cite: 32]
*   **Formula Perhitungan:**
    $$\text{Realisasi IKK 10.1.3.1 (\%)} = \left( \frac{\text{IN\_BADIKLAT\_MGMT\_TEPAT}}{\text{IN\_BADIKLAT\_MGMT\_TOTAL}} \right) \times 100\% \quad \text{\cite: 31, 32}$$
*   **Sumber Data:** Sistem Informasi Manajemen Pelayanan / Log Surat & Administrasi Badiklat [cite: 31, 32].

####### 🍃 LEVEL 8: Elemen Data Transaksional (Leaf Node - RAW INPUT)
*   `IN_BADIKLAT_MGMT_TEPAT` [Leaf]: Jumlah layanan dukungan manajemen kesekretariatan (kepegawaian internal, penggajian, kenaikan pangkat, KGB, disposisi surat) yang selesai tepat waktu sesuai standar pelayanan (SLA) [cite: 31, 32].
*   `IN_BADIKLAT_MGMT_TOTAL` [Leaf]: Jumlah total berkas permohonan atau usulan layanan dukungan manajemen kesekretariatan yang masuk dalam setahun [cite: 31, 32].

---

###### 📌 [IKK 10.1.3.2] Persentase layanan sarana dan prasarana internal sesuai SLA [cite: 32]
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`) [cite: 32]
*   **Target (2025-2029):** 100% -> 100% -> 100% -> 100% -> 100% [cite: 32]
*   **Formula Perhitungan:**
    $$\text{Realisasi IKK 10.1.3.2 (\%)} = \left( \frac{\text{IN\_BADIKLAT\_SARPRAS\_TEPAT}}{\text{IN\_BADIKLAT\_SARPRAS\_TOTAL}} \right) \times 100\% \quad \text{\cite: 32}$$
*   **Sumber Data:** Log Perbaikan & Pemeliharaan Sarana Biro Umum / Sekretariat Badiklat [cite: 32].

####### 🍃 LEVEL 8: Elemen Data Transaksional (Leaf Node - RAW INPUT)
*   `IN_BADIKLAT_SARPRAS_TEPAT` [Leaf]: Jumlah layanan pemeliharaan, perbaikan, dan perawatan sarana prasarana diklat (asrama, ruang kelas, AC, genset, utilitas air) yang diselesaikan tuntas tepat waktu sesuai SLA [cite: 32].
*   `IN_BADIKLAT_SARPRAS_TOTAL` [Leaf]: Jumlah total laporan kerusakan atau permohonan pemeliharaan sarana prasarana internal yang masuk [cite: 32].

---

###### 📌 [IKK 10.1.3.3] Persentase layanan perkantoran sesuai SLA [cite: 32]
*   **Sifat Node:** Cascading Node (`RATIO_PERCENTAGE`) [cite: 32]
*   **Target (2025-2029):** 100% -> 100% -> 100% -> 100% -> 100% [cite: 32]
*   **Formula Perhitungan:**
    $$\text{Realisasi IKK 10.1.3.3 (\%)} = \left( \frac{\text{IN\_BADIKLAT\_OFFICE\_TEPAT}}{\text{IN\_BADIKLAT\_OFFICE\_TOTAL}} \right) \times 100\% \quad \text{\cite: 32}$$
*   **Sumber Data:** Laporan Realisasi Anggaran Perkantoran / Inventaris ATK Badiklat [cite: 32].

####### 🍃 LEVEL 8: Elemen Data Transaksional (Leaf Node - RAW INPUT)
*   `IN_BADIKLAT_OFFICE_TEPAT` [Leaf]: Jumlah layanan umum perkantoran (pemenuhan kebutuhan Alat Tulis Kantor/ATK, penyediaan konsumsi, layanan kebersihan, dan langganan daya/jasa) yang selesai tepat waktu sesuai SLA [cite: 32].
*   `IN_BADIKLAT_OFFICE_TOTAL` [Leaf]: Jumlah total target paket layanan perkantoran atau permohonan layanan umum yang harus diselesaikan dalam setahun anggaran [cite: 32].

---

## 💻 CATATAN ARSITEKTURAL BACKEND LARAVEL (SICANA ENGINE)

1.  **Struktur Relasional Dinamis:** Model `PerformanceNode` di Laravel menggunakan relasi rekursif:
    ```php
    public function children() {
        return $this->hasMany(PerformanceNode::class, 'parent_id');
    }
    ```
2.  **Jenis Roll-up (`calc_type`):**
    *   `SP 9` & `IKP 9.1` diset sebagai `calc_type = 'AVERAGE'` untuk merata-ratakan capaian di bawahnya secara berjenjang [cite: 19].
    *   `IKK 9.1.2.1`, `IKK 9.1.3.1`, serta seluruh rumpun Kesekretariatan (`IKK 10.1.3.1` s.d `IKK 10.1.3.3`) menggunakan `calc_type = 'RATIO_PERCENTAGE'` dengan mengagregasikan nilai simpul Level 8 Pembilang (`NUM_`) dan Penyebut (`DEN_`) [cite: 19, 32].
3.  **Safety Guard division-by-zero:**
    ```php
    if ($denominator == 0) {
        return 0.00;
    }
    ```
