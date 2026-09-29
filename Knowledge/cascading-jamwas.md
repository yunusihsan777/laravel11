# Cetak Biru Cascading SAKIP & Renstra Kejaksaan RI 2025-2029
## Bidang Pengampuan: Jaksa Agung Muda Bidang Pengawasan (JAMWAS)

Dokumen ini menyajikan peta penjenjangan kinerja (*cascading structure*) secara utuh, rigid, mendalam, tanpa singkatan, dan terperinci untuk seluruh Sasaran Program (SP), Indikator Kinerja Program (IKP/IKSP), Sasaran Kegiatan (SK/Saskeg), dan Indikator Kinerja Kegiatan (IKK/IKSK) di bawah pengampuan Jaksa Agung Muda Bidang Pengawasan (JAMWAS) sesuai dengan Peraturan Kejaksaan RI No. 4 Tahun 2025 dan pedoman evaluasi SAKIP Kejaksaan RI.

Sistem SICANA mengimplementasikan struktur ini dengan pola *Self-Referencing Adjacency List* menggunakan field `parent_id` untuk menghubungkan relasi dinamis tanpa batas (*Infinite Hierarchy*).

---

## 🪜 PETA HIERARKI TANGGA CASCADING & FORMULA PENGUKURAN

### 🎯 [SP 2] Sasaran Program: Meningkatnya akuntabilitas keuangan Kejaksaan RI
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Pengawasan (JAMWAS) / Eselon I
*   **Target (2025-2029):** Predikat WTP -> WTP -> WTP -> WTP -> WTP

#### 📊 [IKP 2.1] Indikator Kinerja Program: Opini BPK atas Laporan Keuangan Kejaksaan RI
*   **Sifat Node:** 🛑 **Mandiri (Leaf Node - Berhenti di Sini)**
*   **Metode Pengukuran:** Skor kualitatif opini opini kesesuaian laporan keuangan berdasarkan audit BPK RI (WTP, WDP, TW, TMP).
*   **Formula Capaian:** Diisi secara langsung (Direct Input) oleh operator JAMWAS Pusat berdasarkan LHP BPK RI.
*   **Sumber Data:** Laporan Hasil Pemeriksaan (LHP) Keuangan Kejaksaan RI oleh BPK RI.

---

#### 🪜 [SK 2.1.1] Sasaran Kegiatan: Meningkatnya kepatuhan terhadap pengelolaan keuangan dan tata kelola pemerintahan Kejaksaan RI
*   **Unit Kerja Penanggung Jawab:** Bidang Pengawasan (Pusat & Daerah)

##### 📌 [IKK 2.1.1.1] Persentase Batas Tertinggi Temuan Hasil Pemeriksaan BPK di Kejaksaan RI
*   **Sifat Node:** 🛑 **Leaf Node (Raw Input)**
*   **Pembilang (Numerator):** Jumlah temuan hasil pemeriksaan BPK RI tahun berjalan yang belum ditindaklanjuti/diselesaikan.
*   **Penyebut (Denominator):** Total seluruh temuan hasil pemeriksaan BPK RI yang diterbitkan pada tahun berjalan.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Temuan Belum Selesai}}{\text{Total Temuan Terbit}} \right) \times 100\%$$
    *(Catatan Sistem SAKIP: Nilai capaian optimal adalah semakin kecil persentasenya)*
*   **Sumber Data:** Laporan Hasil Pemeriksaan (LHP) BPK RI / Sistem Pemantauan Tindak Lanjut BPK.

---

#### 🪜 [SK 2.1.2] Sasaran Kegiatan: Meningkatnya penyelesaian hasil pemeriksaan keuangan Kejaksaan RI
*   **Unit Kerja Penanggung Jawab:** Bidang Pengawasan (Pusat & Daerah)

##### 📌 [IKK 2.1.2.1] Persentase Penyelesaian Tindak Lanjut Hasil Pemeriksaan BPK di Kejaksaan RI (tahun berjalan dan tahun sebelumnya)
*   **Sifat Node:** 🛑 **Leaf Node (Raw Input)**
*   **Pembilang (Numerator):** Jumlah rekomendasi hasil pemeriksaan BPK RI (periode tahun berjalan & tahun sebelumnya) yang telah tuntas ditindaklanjuti dan dinyatakan sesuai oleh BPK RI.
*   **Penyebut (Denominator):** Total seluruh rekomendasi hasil pemeriksaan BPK RI yang wajib ditindaklanjuti.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Rekomendasi Selesai Sesuai}}{\text{Total Rekomendasi Wajib TL}} \right) \times 100\%$$
*   **Sumber Data:** Laporan Pemantauan Tindak Lanjut Hasil Pemeriksaan BPK RI (Aplikasi SIPTL BPK).

---

### 🎯 [SP 3] Sasaran Program: Menguatnya pengendalian internal pada Kejaksaan RI
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Pengawasan (JAMWAS) / Eselon I
*   **Target (2025-2029):** Skor 3.2 -> 3.3 -> 3.4 -> 3.5 -> 3.6

#### 📊 [IKP 3.1] Indikator Kinerja Program: Nilai Maturitas Penyelenggaraan SPIP secara terintegrasi pada Kejaksaan RI
*   **Sifat Node:** 🛑 **Mandiri (Leaf Node - Berhenti di Sini)**
*   **Metode Pengukuran:** Skor indeks tingkat kematangan penyelenggaraan SPIP Terintegrasi yang dinilai oleh BPKP (Skala 1.0 - 5.0).
*   **Formula Capaian:** Diisi secara langsung (Direct Input) berdasarkan skor maturitas nasional.
*   **Sumber Data:** Laporan Hasil Evaluasi (LHE) Maturitas SPIP Kejaksaan RI oleh BPKP.

---

#### 🪜 [SK 3.1.1] Sasaran Kegiatan: Meningkatnya efektivitas pengendalian internal Kejaksaan RI
*   **Unit Kerja Penanggung Jawab:** Inspektorat I s.d V JAMWAS (Pusat)

##### 📌 [IKK 3.1.1.1] Nilai maturitas penyelenggaraan Sistem Pengendalian Intern Pemerintah (SPIP) Kejaksaan RI
*   **Sifat Node:** 🛑 **Leaf Node (Raw Input dari LHP BPKP)**
*   **Formula Perhitungan:** Diinput langsung secara manual oleh operator pusat sesuai draf LHE BPKP (Skala 1.0 - 5.0).
*   **Sumber Data:** LHE Penyelenggaraan SPIP Sektoral/Pusat.

##### 📌 [IKK 3.1.1.2] Manajemen Risiko Indeks (MRI)
*   **Sifat Node:** 🛑 **Leaf Node (Raw Input)**
*   **Formula Perhitungan:** Diinput langsung berdasarkan hasil penilaian indeks manajemen risiko (Skala 1.0 - 5.0) yang dirilis oleh BPKP.
*   **Sumber Data:** Laporan Hasil Evaluasi Pengelolaan Risiko Instansi oleh BPKP.

##### 📌 [IKK 3.1.1.3] Indeks Efektivitas Pengendalian Korupsi (IEPK)
*   **Sifat Node:** 🛑 **Leaf Node (Raw Input)**
*   **Formula Perhitungan:** Diinput langsung berdasarkan hasil penilaian indeks efektivitas pencegahan fraud dan korupsi (Skala 1.0 - 5.0).
*   **Sumber Data:** Sertifikat / Laporan Penilaian IEPK dari BPKP.

##### 📌 [IKK 3.1.1.4] Level Kapabilitas APIP
*   **Sifat Node:** 🛑 **Leaf Node (Raw Input)**
*   **Formula Perhitungan:** Menggunakan tingkat level kematangan kapabilitas aparat pengawas intern pemerintah (Skala Level 1 s.d 5).
*   **Sumber Data:** Piagam/Sertifikat Penilaian Level Kapabilitas APIP Kejaksaan Agung dari BPKP.

---

### 🎯 [SP 12] Sasaran Program: Meningkatnya Integritas Aparatur Kejaksaan RI
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Pengawasan (JAMWAS) / Eselon I
*   **Target (2025-2029):** Skor 75 -> 76 -> 77 -> 78 -> 79

#### 📊 [IKP 12.1] Indikator Kinerja Program: Indeks survei perilaku Integritas Kejaksaan RI
*   **Sifat Node:** 🛑 **Mandiri (Leaf Node - Berhenti di Sini)**
*   **Metode Pengukuran:** Skor Survei Perilaku Integritas (SPI) nasional yang dinilai secara mandiri oleh KPK RI (Skala 0 - 100).
*   **Formula Capaian:** Diisi secara langsung (Direct Input) berdasarkan skor indeks nasional dari KPK.
*   **Sumber Data:** Buku Laporan Hasil Pengukuran SPI Kejaksaan RI oleh Komisi Pemberantasan Korupsi (KPK).

---

#### 🪜 [SK 12.1.1] Sasaran Kegiatan: Meningkatnya penguatan budaya kerja integritas di lingkungan Kejaksaan RI
*   **Unit Kerja Penanggung Jawab:** Bidang Pengawasan / Bagian Tata Usaha JAMWAS

##### 📌 [IKK 12.1.1.1] Persentase penyelesaian kegiatan penguatan budaya kerja integritas di internal Kejaksaan RI
*   **Sifat Node:** 🛑 **Leaf Node (Raw Input)**
*   **Pembilang (Numerator):** Jumlah program/layanan tugas fungsional inspeksi pimpinan dan penguatan integritas yang berhasil diselesaikan dan dilaporkan.
*   **Penyebut (Denominator):** Total target layanan/program penguatan budaya kerja integritas yang direncanakan dalam setahun.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Giat Integritas Selesai}}{\text{Total Rencana Kerja Giat Integritas}} \right) \times 100\%$$
*   **Sumber Data:** Laporan Pelaksanaan Giat Kampanye Budaya Kerja / Inspeksi Pimpinan Bidang Pengawasan.

---

### 🎯 [SP 14] Sasaran Program: Menguatnya birokrasi yang bersih, transparan, dan melayani
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Pengawasan (JAMWAS) / Eselon I
*   **Target (2025-2029):** 80% -> 85% -> 90% -> 95% -> 100%

#### 📊 [IKP 14.1] Indikator Kinerja Program: Tingkat kepatuhan terhadap implementasi Zona Integritas
*   **Sifat Node:** 🛑 **Agregatif (Roll-up dari SK di bawahnya)**
*   **Metode Pengukuran:** Rasio jumlah satuan kerja yang berhasil mendapat predikat WBK/WBBM nasional terhadap total satker yang lolos seleksi internal Kejaksaan.
*   **Formula Capaian:**
    $$\text{Realisasi (\%)} = \left( \frac{\text{Jumlah Satker Lolos WBK/WBBM}}{\text{Total Satker Diusulkan Tim Penilai Internal (TPI)}} \right) \times 100\%$$
*   **Sumber Data:** Keputusan MenPAN-RB tentang Penetapan Satker Berpredikat WBK/WBBM.

---

#### 🪜 [SK 14.1.1] Sasaran Kegiatan: Terlaksananya pendampingan, evaluasi, dan penguatan implementasi Zona Integritas menuju WBK/WBBM secara konsisten dan akuntabel di seluruh unit kerja
*   **Unit Kerja Penanggung Jawab:** TPI (Tim Penilai Internal) Kejaksaan RI / Bidang Pengawasan

##### 📌 [IKK 14.1.1.1] Persentase unit kerja yang mendapatkan pendampingan pembangunan Zona Integritas
*   **Sifat Node:** 🛑 **Leaf Node (Raw Input)**
*   **Pembilang (Numerator):** Jumlah satuan kerja (Kejati, Kejari, Cabjari) daerah yang tuntas mendapatkan asistensi pendampingan/penilaian mandiri LKE ZI oleh TPI Pengawasan.
*   **Penyebut (Denominator):** Total seluruh unit kerja Kejaksaan Agung/Daerah yang diusulkan masuk saringan awal pembangunan ZI.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Satker Didampingi TPI}}{\text{Total Satker Usulan Pembangunan ZI}} \right) \times 100\%$$
*   **Sumber Data:** Laporan Kerja Pendampingan TPI / Dokumen Evaluasi LKE ZI Bidang Pengawasan.

---

### 🎯 [SP_WAS_OPS] Sasaran Program: Meningkatnya Kualitas Pengawasan Aparatur Kejaksaan RI
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Pengawasan (JAMWAS) / Eselon I
*   **Target (2025-2029):** 70% -> 72% -> 75% -> 77% -> 80%

#### 📊 [IKP_WAS_OPS.1] Indikator Kinerja Program: Persentase Penyelesaian Temuan Hasil Pengawasan Sektoral Lintas Bidang
*   **Sifat Node:** 🛑 **Agregatif (Roll-up Rerata Capaian SK/IKK di bawahnya)**
*   **Formula Capaian:** Rata-rata dari persentase penyelesaian tindak lanjut temuan lima pilar inspektorat [cite: 22].
    $$\text{Realisasi (\%)} = \frac{\text{Capaian IKK Pegawai} + \text{Capaian IKK Pidum/Datun} + \text{Capaian IKK Pidsus/Pidmil} + \text{Capaian IKK Keuangan}}{4}$$

---

#### 🪜 [SK_WAS_OPS.1] Sasaran Kegiatan: Meningkatnya kualitas pengawasan aparatur Kejaksaan RI
*   **Unit Kerja Penanggung Jawab:** Inspektorat I s.d V JAMWAS (Pusat)

##### 📌 [IKK_WAS_OPS.1.1] Persentase temuan hasil pengawasan bidang kepegawaian dan pemulihan aset yang berhasil ditindaklanjuti/diselesaikan
*   **Sifat Node:** 🛑 **Leaf Node (Raw Input)**
*   **Pembilang (Numerator):** Jumlah temuan hasil inspeksi (inspeksi umum/khusus) Bidang Kepegawaian dan Pemulihan Aset yang dinyatakan selesai ditindaklanjuti.
*   **Penyebut (Denominator):** Total seluruh temuan hasil pengawasan Bidang Kepegawaian dan Pemulihan Aset yang diterbitkan dalam periode berjalan.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Temuan Kepegawaian Selesai TL}}{\text{Total Temuan Kepegawaian Terbit (LHP)}} \right) \times 100\%$$
*   **Sumber Data:** Pangkalan Data Rekapitulasi Pemantauan LHP Inspektorat I/V JAMWAS.

##### 📌 [IKK_WAS_OPS.1.2] Persentase temuan hasil pengawasan bidang tindak pidana umum, perdata, dan tata usaha negara yang berhasil ditindaklanjuti/diselesaikan
*   **Sifat Node:** 🛑 **Leaf Node (Raw Input)**
*   **Pembilang (Numerator):** Jumlah temuan hasil inspeksi yustisial (Pidum, Perdata, TUN) yang dinyatakan selesai ditindaklanjuti.
*   **Penyebut (Denominator):** Total seluruh temuan hasil pengawasan yustisial (Pidum/Datun) yang diterbitkan.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Temuan Pidum/Datun Selesai TL}}{\text{Total Temuan Pidum/Datun Terbit (LHP)}} \right) \times 100\%$$
*   **Sumber Data:** Laporan Hasil Pengawasan (LHP) Inspektorat II/IV JAMWAS.

##### 📌 [IKK_WAS_OPS.1.3] Persentase temuan hasil pengawasan bidang intelijen, tindak pidana khusus, dan pidana militer yang berhasil ditindaklanjuti/diselesaikan
*   **Sifat Node:** 🛑 **Leaf Node (Raw Input)**
*   **Pembilang (Numerator):** Jumlah temuan hasil inspeksi yustisial (Intel, Pidsus, Pidmil) yang dinyatakan selesai ditindaklanjuti.
*   **Penyebut (Denominator):** Total seluruh temuan hasil pengawasan yustisial (Intel/Pidsus/Pidmil) yang diterbitkan.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Temuan Intel/Pidsus/Pidmil Selesai TL}}{\text{Total Temuan Intel/Pidsus/Pidmil Terbit (LHP)}} \right) \times 100\%$$
*   **Sumber Data:** Laporan Hasil Pengawasan (LHP) Inspektorat III/V JAMWAS.

##### 📌 [IKK_WAS_OPS.1.4] Persentase temuan hasil pengawasan bidang keuangan yang berhasil ditindaklanjuti/diselesaikan
*   **Sifat Node:** 🛑 **Leaf Node (Raw Input)**
*   **Pembilang (Numerator):** Jumlah temuan hasil inspeksi administratif keuangan (DIPA, realisasi, PNBP, kas negara) yang dinyatakan selesai ditindaklanjuti.
*   **Penyebut (Denominator):** Total seluruh temuan administratif keuangan yang diterbitkan dalam periode berjalan.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Temuan Keuangan Selesai TL}}{\text{Total Temuan Keuangan Terbit (LHP)}} \right) \times 100\%$$
*   **Sumber Data:** Register Pemantauan Temuan Keuangan Bagian Evaluasi/LHP JAMWAS.

---

#### 🪜 [SK_WAS_OPS.2] Sasaran Kegiatan: Meningkatnya kualitas pengawasan aparatur Kejaksaan oleh Kejaksaan Tinggi
*   **Unit Kerja Penanggung Jawab:** Bidang Pengawasan Kejaksaan Tinggi (Daerah)

##### 📌 [IKK_WAS_OPS.2.1] Persentase temuan hasil pengawasan pengawasan aparatur Kejaksaan oleh Kejaksaan Tinggi yang berhasil ditindaklanjuti/diselesaikan
*   **Sifat Node:** 🛑 **Leaf Node (Raw Input Daerah)**
*   **Pembilang (Numerator):** Jumlah rekomendasi hasil inspeksi daerah yang dinyatakan tuntas ditindaklanjuti oleh satuan kerja di wilayah hukum Kejaksaan Tinggi bersangkutan.
*   **Penyebut (Denominator):** Total seluruh rekomendasi hasil inspeksi daerah yang diterbitkan oleh Bidang Pengawasan Kejati.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Rekomendasi Daerah Selesai TL}}{\text{Total Rekomendasi Terbit (LHP Daerah)}} \right) \times 100\%$$
*   **Sumber Data:** Laporan Triwulanan Bidang Pengawasan Kejaksaan Tinggi se-Indonesia.

---

### 🎯 [SP_WAS_MGMT] Sasaran Program: Dukungan Manajemen dan Dukungan Teknis Lainnya di Jaksa Agung Muda Bidang Pengawasan
*   **Unit Pengampu Utama:** Jaksa Agung Muda Bidang Pengawasan (Secretariat JAMWAS) / Eselon I
*   **Target (2025-2029):** 100% Kepatuhan SLA

#### 📊 [IKP_WAS_MGMT.1] Persentase Pemenuhan Dukungan Layanan Kesekretariatan Pengawasan Sesuai SLA
*   **Sifat Node:** 🛑 **Agregatif (Roll-up Rerata Capaian SK di bawahnya)**
*   **Formula Capaian:** Rata-rata capaian dari layanan manajemen dan perkantoran.

---

#### 🪜 [SK_WAS_MGMT.1] Sasaran Kegiatan: Meningkatnya kegiatan dukungan manajemen dan dukungan teknis lainnya pada Jaksa Agung Muda Bidang Pengawasan
*   **Unit Kerja Penanggung Jawab:** Bagian Tata Usaha Sekretariat JAMWAS (Pusat)

##### 📌 [IKK_WAS_MGMT.1.1] Persentase layanan dukungan manajemen Eselon I sesuai SLA (Service Level Agreement)
*   **Sifat Node:** 🛑 **Leaf Node (Raw Input)**
*   **Pembilang (Numerator):** Jumlah berkas persuratan, disposisi pimpinan, dan registrasi pimpinan pengawasan selesai tepat waktu sesuai SLA.
*   **Penyebut (Denominator):** Total seluruh berkas permohonan layanan administrasi manajemen pengawasan yang masuk.
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Layanan Persuratan/Disposisi Tepat SLA}}{\text{Total Permohonan Layanan Kesekretariatan Masuk}} \right) \times 100\%$$
*   **Sumber Data:** Log Agenda Registrasi Surat Masuk & Keluar Sekretariat JAMWAS.

##### 📌 [IKK_WAS_MGMT.1.2] Persentase layanan perkantoran sesuai SLA (Service Level Agreement)
*   **Sifat Node:** 🛑 **Leaf Node (Raw Input)**
*   **Pembilang (Numerator):** Jumlah hari dukungan operasional kantor pengawasan (penyediaan ATK, internet, listrik, pemeliharaan sarpras) yang terpenuhi tanpa kendala sesuai SLA.
*   **Penyebut (Denominator):** Total seluruh hari kalender dalam periode pelaporan (365 hari).
*   **Formula Perhitungan:**
    $$P = \left( \frac{\text{Hari Operasional Perkantoran Lancar}}{\text{Total Hari Kalender}} \right) \times 100\%$$
*   **Sumber Data:** Laporan Realisasi DIPA Satker / Log Inventaris Bagian Rumah Tangga JAMWAS.

---

## 💻 CATATAN ARSITEKTURAL LARAVEL (SICANA ENGINE)

1.  **Polymorphic Node Mapping:**
    Bagan penjenjangan kinerja Bidang Pengawasan di atas memiliki pola relasional dinamis yang asimetris. Untuk level IKP seperti **IKP 2.1 (Opini BPK)**, **IKP 3.1 (SPIP Terintegrasi)**, dan **IKP 12.1 (Indeks SPI KPK)**, database SICANA menyimpannya sebagai **Direct/Leaf Node** (`is_leaf = true` pada model `PerformanceNode`) karena murni diisi secara langsung dari penilaian lembaga eksternal [cite: 11, 14, 17, 18].
    Sebaliknya, untuk program operasional seperti **IKP_WAS_OPS.1 (Persentase Penyelesaian Temuan)**, sistem menggunakan **Agregatif Node** (`is_leaf = false` & `calc_type = 'AVERAGE'`) yang secara otomatis menarik and merata-ratakan nilai percentase realisasi di bawahnya [cite: 11, 22].

2.  **Unfavorable Score Handling (IKK 2.1.1.1):**
    Khusus untuk **IKK 2.1.1.1 (Persentase Temuan BPK)**, sistem menerapkan algoritma **Semakin Kecil Semakin Baik (Unfavorable)**. Saat merender visualisasi chart di frontend React, backend Laravel harus memetakan skor capaian dengan formula:
    `Capaian (%) = (Target (%) / Realisasi (%)) * 100` atau `(1 - Realisasi) * 100` bergantung pada batasan target dinamis yang dikunci dalam tabel `performance_targets`.

3.  **Inertia.js Secure Rendering:**
    Saat operator daerah (Aswas Kejati) membuka form pengisian realisasi IKK, controller Laravel hanya akan mengekstrak record anak yang memiliki `unit_code = 'WAS'` dan `is_leaf = true` guna menghemat memori (*overfetching protection*).

---
