<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPIP Terintegrasi 2026</title>

    <!-- Menggunakan Bootstrap untuk reset dasar dan utility -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Mengatur background halaman sesuai gambar */
        body {
            background-color: #ced6da;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 60px;
            padding-bottom: 60px;
            margin: 0;
        }

        .logo-container {
            margin-bottom: 20px;
        }

        /* Sesuaikan path logo dengan lokasi gambar Anda */
        .logo-container img {
            width: 120px;
        }

        .page-title {
            font-weight: 700;
            color: #000000;
            margin-bottom: 10px;
            text-align: center;
        }

        .page-subtitle {
            color: #000000;
            font-size: 1.15rem;
            font-weight: 500;
            margin-bottom: 40px;
            line-height: 1.4;
            text-align: center;
        }

        .links-container {
            width: 100%;
            max-width: 650px;
            padding: 0 20px;
        }

        /* Desain tombol ala neubrutalism (border tegas, shadow solid) */
        .btn-spip {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            background-color: #ffffff;
            color: #000000;
            border: 3px solid #000000;
            border-radius: 16px;
            padding: 18px 25px;
            margin-bottom: 20px;
            text-decoration: none;
            box-shadow: 6px 6px 0px #000000;
            transition: transform 0.1s ease-in-out, box-shadow 0.1s ease-in-out;
        }

        /* Aturan spesifik agar teks di tengah tidak terpotong (hyphenation mati) */
        .btn-spip-text {
            flex-grow: 1;
            text-align: center;
            font-weight: 600;
            font-size: 1.1rem;
            white-space: normal;
            word-wrap: break-word;
            hyphens: none;
            padding: 0 10px;
        }

        /* Ikon tiga titik di kanan */
        .dots-icon {
            color: #888888;
            font-size: 1.5rem;
            font-weight: bold;
            line-height: 1;
        }

        /* Animasi saat tombol ditekan / disorot */
        .btn-spip:hover, .btn-spip:active {
            color: #000000;
            text-decoration: none;
            transform: translate(3px, 3px);
            box-shadow: 3px 3px 0px #000000;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

    <!-- Bagian Logo -->
    {{-- <div class="logo-container">
        <!-- Pastikan direktori gambar benar, sesuaikan jika perlu -->
        <img src="{{ asset('gambar/logo_kejaksaan.png') }}" alt="Logo Kejaksaan">
    </div> --}}

    <!-- Bagian Judul -->
    <h2 class="page-title">SPIP Terintegrasi 2026</h2>
    <p class="page-subtitle">
        Penilaian atas maturitas penyelenggaraan<br>
        SPIP pada Kejaksaan RI Tahun 2026
    </p>

    <!-- Bagian Tombol-tombol Utama -->
    <div class="links-container">

        <a href="/login-spip" class="btn-spip">
            <span class="btn-spip-text">Web Pengisian KK 3.1 Kejati dan Eseleon 1</span>
            <span class="dots-icon">&#8942;</span>
        </a>

        <a href="https://drive.google.com/file/d/1Grvc35c5M_ilx5ME5iAOlDu7Z4qltCUx/view?usp=sharing" target="_blank" class="btn-spip">
            <span class="btn-spip-text">Panduan Pengisian KK 3.1 melalui Web</span>
            <span class="dots-icon">&#8942;</span>
        </a>

        <a href="https://docs.google.com/spreadsheets/d/1NKAF5mzQA2AXzkWiHJ3HtFPY2zC67GaJ/edit?usp=sharing&ouid=109556050232324402632&rtpof=true&sd=true" target="_blank" class="btn-spip">
            <span class="btn-spip-text">Pengisian KK Selain 3.1 (Biro Cana, Biro Uang, Biro Lengkap, &amp; Pengawasan)</span>
            <span class="dots-icon">&#8942;</span>
        </a>

        <a href="https://drive.google.com/drive/folders/1zasJyxscpdPJuc1wtqS1-TmWlp07zjeH?usp=drive_link" target="_blank" class="btn-spip">
            <span class="btn-spip-text">Materi, Juknis, dan Template Laporan</span>
            <span class="dots-icon">&#8942;</span>
        </a>

    </div>

</body>
</html>
