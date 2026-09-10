# UX Audit & Redesign Plan: PROSAKIP Kejaksaan RI

Berdasarkan tinjauan komprehensif pada struktur `resources/views` (terutama `dashboard.blade.php`, `lke/evaluasi/index.blade.php`, dan sistem `layouts`), berikut adalah hasil evaluasi UX berdasarkan panduan **AI Skill — UI-UX App Design Assistant**, beserta rencana perbaikannya.

## User Review Required

> [!IMPORTANT]  
> Mohon tinjau temuan audit di bawah ini. Jika Anda menyetujui arah perbaikan ini, klik **Proceed** dan saya akan mulai mengeksekusi perbaikan secara bertahap, dimulai dari pembersihan layout utama dan standarisasi komponen.

## Open Questions

> [!WARNING]  
> 1. **Target Pengguna**: Siapa pengguna utama sistem ini? Apakah administrator pusat (expert) atau operator satker daerah (beginner)? Ini akan menentukan apakah kita condong ke *Expert Efficiency* (banyak shortcut/data) atau *Beginner Support* (banyak wizard/helper).
> 2. **Design System**: Saat ini banyak *inline CSS* (contoh: `style="font-size: 0.78rem;"`) yang tersebar di file `.blade.php`. Apakah Anda setuju jika semua itu dipindahkan ke `custom.css` sebagai *Design Tokens*?

---

## 1. Temuan UX Audit (Berdasarkan AI Skill)

### ✅ Yang Sudah Baik (Keep)
- **Progressive Disclosure (Poin 19):** Penggunaan sistem *Accordion* pada halaman Evaluasi LKE untuk menyembunyikan detail Subkomponen & Kriteria sudah sangat tepat untuk mengurangi *Cognitive Load* (Poin 17).
- **Typography (Poin 38):** Pemilihan font *Plus Jakarta Sans* dan *Inter* melalui Google Fonts sudah memberikan kesan modern dan *readable*.

### ❌ Yang Perlu Diperbaiki (Refactor)
1. **Pemisahan UI dan Inline Styling (Poin 59 & 61 - Design Tokens):**
   - **Temuan:** File `dashboard.blade.php` dan `lke/evaluasi/index.blade.php` memiliki sangat banyak baris *inline styles* (`style="..."`).
   - **Dampak:** Sulit dijaga konsistensinya (*Consistency*), melanggar prinsip *reusable components*.
2. **Hierarchy & Cognitive Overload di Dashboard (Poin 17 & 33):**
   - **Temuan:** Di *Dashboard*, terdapat *Hero Banner* dengan banyak badge, persentase, pengumuman, dan *Quick Links* yang bersaing memperebutkan perhatian (kompetisi *Primary Action* - Poin 48).
   - **Dampak:** Mata pengguna tidak dipandu dengan jelas ke mana mereka harus fokus saat pertama kali *login*.
3. **Navigasi Terlalu Mirip Struktur Database (Poin 5.3):**
   - **Temuan:** Form filter satker dan tahun di `lke/evaluasi/index.blade.php` terasa sangat *administrative* dan kaku. 
   - **Dampak:** Tidak terasa seperti *Task Flow* yang natural.

---

## 2. Proposed Changes (Rencana Implementasi)

Berikut adalah urutan perbaikan yang akan dilakukan jika Anda menyetujui rencana ini. Kita akan merombak *views* menjadi lebih bersih, *modular*, dan *user-centered*.

### Fase 1: Standarisasi Design Tokens & Layout Utama
Memindahkan semua inline CSS ke *stylesheet* dan merapikan komponen *wrapper*.

#### [MODIFY] `public/css/custom.css` (Atau pembuatan file token baru)
- Membuat variabel *Design Tokens* untuk *spacing*, *typography* (`text-sm`, `text-xs`), dan warna semantik (`var(--kj-success-bg)`).

#### [MODIFY] `resources/views/layouts/app.blade.php`
- Menghapus CSS *inline script* spinner yang di *hardcode*, dipindahkan ke file *asset* terpisah.

### Fase 2: Restrukturisasi Dashboard
Menerapkan *Visual Hierarchy* dan hukum *Hick's Law* (Poin 47) dengan mengurangi kompetisi elemen visual.

#### [MODIFY] `resources/views/dashboard.blade.php`
- Mengganti *inline CSS* dengan *utility classes* Bootstrap.
- Memperjelas *Primary Action* (CTA). Tombol "Mulai Perencanaan" akan dibuat lebih dominan dibandingkan "Unggah Bukti Dukung" (asumsi berdasarkan *critical path*).
- Menyederhanakan tampilan *Progress Bar* kepatuhan agar lebih mudah dibaca sekilas.

### Fase 3: Optimasi Form & Interaksi LKE Evaluasi
Meningkatkan *Error Prevention* (Poin 52) dan *System Feedback* (Poin 55).

#### [MODIFY] `resources/views/lke/evaluasi/index.blade.php`
- Memecah *file* Blade yang terlalu panjang (400+ baris) ini menjadi *Reusable Components* (Blade Components), contoh: `x-lke.komponen-accordion`.
- Memperbaiki layout filter dropdown Satker dan Tahun agar lebih ramah bagi mata pengguna (mungkin menjadikannya *sticky header*).

---

## Verification Plan

### Manual Verification
- Melakukan *preview* antarmuka di *browser* (Desktop & Mobile) untuk memastikan tidak ada layout yang pecah.
- Memastikan navigasi *Accordion* di LKE masih berfungsi optimal secara *JavaScript/Bootstrap*.
- Memverifikasi kontras warna (*Color Accessibility* Poin 37) menggunakan Lighthouse/Axe tools.
