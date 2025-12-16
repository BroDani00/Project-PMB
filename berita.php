<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan Bulanan PMB UDSA 2025/2026</title>

<!-- GOOGLE FONTS -->
<link href="https://fonts.googleapis.com/css2?family=Katibeh&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Miltonian+Tattoo&family=Gravitas+One&family=Cormorant+Garamond:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Jaldi:wght@400;700&display=swap" rel="stylesheet">

<style>
/* RESET */
*{margin:0;padding:0;box-sizing:border-box;}
body{
    background:#f6f2d9;
    color:#333;
    font-family:"Cormorant Garamond", serif;
}

/* ROOT COLOR */
:root {
    --cream-bg: #f6f2d9;
    --navbar-bg: #d6d4de;
    --pmb-color: #7c6c2d;
    --udsa-color: #1a355c;
    --login-btn: #7a6b23;
}

/* ============= TOPBAR (TIDAK DIUBAH) ============= */
.topbar{
    background:#f8f6e4;
    padding:6px 0;
    border-bottom:1px solid rgba(0,0,0,0.08);
    font-size:13px;
    font-family:"Cormorant Garamond", serif;
}
.topbar-content{
    max-width:1200px;
    margin:0 auto;
    padding:0 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.topbar-content a{
    color:#000;
    text-decoration:none;
    margin-right:20px;
    font-family:"Cormorant Garamond", serif;
    font-size:14px;
    letter-spacing:0.3px;
}
.topbar-right{
    display:flex;
    gap:25px;
}
.topbar-right span{
    font-family:"Cormorant Garamond", serif;
    font-size:14px;
    letter-spacing:0.3px;
}

/* ============= NAVBAR (TIDAK DIUBAH) ============= */
.navbar-full{ background:var(--navbar-bg); width:100%; }
.nav-container{
    max-width:1200px;
    padding:16px 40px;
    margin:0 auto;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

/* BRAND */
.brand{
    display:flex;
    align-items:center;
    gap:10px;
}
.brand img{ height:56px; }

/* PMB & UDSA logo text */
.pmb-title{
    font-family: 'Gravitas One', serif;
    font-size: 32px;
    font-weight: 400;
    color: #7c6c2d;
    letter-spacing: 1px;
    margin-right: 6px;
}
.udsa-title{
    font-family: 'Katibeh', serif;
    font-size: 36px;
    font-weight: 400;
    color: #1a355c;
    letter-spacing: 1px;
}

/* NAV MENU */
.menu{ display:flex; align-items:center; }
.menu a{
    position:relative;
    text-decoration:none;
    color:#333;
    margin:0 18px;
    font-size:17px;
    font-weight:600;
    letter-spacing:0.5px;
    padding-bottom:10px;
    transition:color .3s ease;
    font-family:"Jaldi", sans-serif;
}
.menu a:hover{ color:#333; }
.menu a::after{
    content:"";
    position:absolute;
    left:0;
    bottom:0;
    width:0%;
    height:3px;
    background:#7c6c2d;
    border-radius:999px;
    transition:width .3s ease;
}
.menu a:hover::after{ width:100%; }
.menu a.active::after{ width:100%; }

/* LOGIN BUTTON */
.menu a.login::after{ display:none !important; }
.menu a.login{
    background:var(--login-btn);
    border:2px solid var(--login-btn);
    padding:8px 28px;
    border-radius:22px;
    color:#fff !important;
    font-size:16px;
    font-weight:700;
    margin-left:24px;
    transition:border .3s ease;
}
.menu a.login:hover{ border-color:#cc0000 !important; }

/* ====================== MAIN – LAPORAN ====================== */

.main-panel{
    background:#f6f2d9;
    padding:45px 0 70px;
}
.wrapper{
    max-width:1200px;
    margin:0 auto;
}

/* HEADER LAPORAN + PILIH BULAN */
.report-header{
    margin:0 40px 20px;
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    font-family:"Jaldi", sans-serif;
}
.report-title-block{
    max-width:700px;
}
.report-title{
    font-size:28px;
    font-weight:700;
    margin-bottom:10px;
}
.report-subtitle{
    font-size:18px;
}

/* SELECT BULAN */
.month-select-wrapper{
    min-width:220px;
}
.month-select{
    width:100%;
    padding:10px 16px;
    font-size:18px;
    border:2px solid #000;
    background:#fdfdfd;
    appearance:none;
    -moz-appearance:none;
    -webkit-appearance:none;
    position:relative;
}
.month-select-wrapper{
    position:relative;
}
.month-select-wrapper::after{
    content:"\25BE";
    position:absolute;
    right:16px;
    top:50%;
    transform:translateY(-50%);
    pointer-events:none;
    font-size:18px;
}

/* BAR JUDUL BULAN */
.report-month-bar{
    margin:0 40px;
    margin-bottom:26px;
    background:#7a6b23;
    color:#fff;
    padding:10px 24px;
    font-size:20px;
    font-weight:700;
    font-family:"Jaldi", sans-serif;
}

/* SUMMARY CARDS */
.summary-row{
    margin:0 40px 32px;
    display:grid;
    grid-template-columns:repeat(4, 1fr);
    gap:24px;
}
.summary-card{
    color:#fff;
    padding:26px 24px;
}
.summary-title{
    font-size:20px;
    font-weight:700;
    font-family:"Jaldi", sans-serif;
    margin-bottom:16px;
}
.summary-number{
    font-size:36px;
    font-weight:700;
    font-family:"Jaldi", sans-serif;
}
.summary-caption{
    margin-top:4px;
    font-size:18px;
}

/* CARD COLORS */
.summary-total{ background:#2b8ab3; }
.summary-lolos{ background:#a23b3b; }
.summary-daftar{ background:#2f8b3a; }
.summary-tidak{ background:#6a5841; }

/* TABEL REKAP */
.report-table-title{
    margin:0 40px 10px;
    font-size:20px;
    font-weight:700;
    font-family:"Jaldi", sans-serif;
}

.table-wrapper{
    margin:0 40px;
    overflow-x:auto;
}

.report-table{
    width:100%;
    border-collapse:collapse;
    font-size:16px;
}

/* HEADER */
.report-table thead tr{
    background:#333335;
    color:#fff;
}
.report-table th,
.report-table td{
    padding:10px 14px;
    border:1px solid #555;
}
.report-table th{
    font-weight:700;
    text-align:left;
}

/* BODY */
.report-table tbody tr:nth-child(odd){
    background:#efefef;
}
.report-table tbody tr:nth-child(even){
    background:#e1e1e1;
}

/* ====================== FOOTER (TIDAK DIUBAH) ====================== */

.footer-full{
    background:#d6d4de;
    padding:12px 0;
}
.footer-container{
    max-width:1200px;
    margin:auto;
    padding:6px 40px;
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    font-family:"Cormorant Garamond", serif;
}

.footer-left{
    display:flex;
    gap:10px;
}
.footer-logo{
    height:50px;
}
.footer-address{
    line-height:1.15;
}
.footer-address b{
    font-size:22px;
    font-family:Georgia, serif;
}

.footer-right{
    display:flex;
    flex-direction:column;
    gap:12px;
}
.footer-row-top,
.footer-row-bottom{
    display:flex;
    gap:45px;
}
.footer-item{
    display:flex;
    align-items:center;
    gap:6px;
}
.footer-icon{
    width:16px;
}
</style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
    <div class="topbar-content">
        <div>
            <a href="#">www.udsa.ac.id</a>
            <a href="career.php">Career</a>
            <a href="berita.php">Berita</a>
        </div>
        <div class="topbar-right">
            <span>JL. Lingkar Salatiga - Pulutan</span>
            <span>(+62) 0123456</span>
        </div>
    </div>
</div>

<!-- NAVBAR -->
<div class="navbar-full">
    <div class="nav-container">
        <div class="brand">
            <img src="assets/images/logo.png" alt="logo">
            <div>
                <span class="pmb-title">PMB</span>
                <span class="udsa-title">UDSA</span>
            </div>
        </div>

        <div class="menu">
            <a href="home.php">Home</a>
            <a href="prodi.php">Program Studi</a>
            <a href="biaya.php">Biaya</a>
            <a href="info.php">Info</a>
            <a href="daftar.php">Daftar</a>
            <a href="login.php" class="login">Login</a>
        </div>
    </div>
</div>

<!-- MAIN LAPORAN -->
<div class="main-panel">
    <div class="wrapper">

        <!-- Header + Pilih Bulan -->
        <section class="report-header">
            <div class="report-title-block">
                <h1 class="report-title">Laporan Bulanan PMB  UDSA Tahun 2025/2026</h1>
                <p class="report-subtitle">
                    Ringkasan aktivitas statistik dan pendaftaran selama satu bulan
                </p>
            </div>

            <div class="month-select-wrapper">
                <select class="month-select">
                    <option>Pilih bulan</option>
                    <option>Januari</option>
                    <option>Februari</option>
                    <option>Maret</option>
                    <option>April</option>
                    <option>Mei</option>
                    <option>Juni</option>
                    <option>Juli</option>
                    <option>Agustus</option>
                    <option>September</option>
                    <option>Oktober</option>
                    <option>November</option>
                    <option>Desember</option>
                </select>
            </div>
        </section>

        <!-- Bar Laporan Bulan -->
        <div class="report-month-bar">Laporan Bulan Januari</div>

        <!-- Summary Cards -->
        <div class="summary-row">
            <div class="summary-card summary-total">
                <div class="summary-title">Total Pendaftar</div>
                <div class="summary-number">1.900</div>
                <div class="summary-caption">Peserta</div>
            </div>

            <div class="summary-card summary-lolos">
                <div class="summary-title">Lolos Seleksi</div>
                <div class="summary-number">1.500</div>
                <div class="summary-caption">Peserta</div>
            </div>

            <div class="summary-card summary-daftar">
                <div class="summary-title">Daftar Ulang</div>
                <div class="summary-number">750</div>
                <div class="summary-caption">Peserta</div>
            </div>

            <div class="summary-card summary-tidak">
                <div class="summary-title">Tidak Lolos Seleksi</div>
                <div class="summary-number">400</div>
                <div class="summary-caption">Peserta</div>
            </div>
        </div>

        <!-- Tabel Rekap -->
        <h2 class="report-table-title">Tabel Rekap Detail Pendaftar per Program Studi</h2>

        <div class="table-wrapper">
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Program Studi</th>
                        <th>Pendaftar</th>
                        <th>Lolos Seleksi</th>
                        <th>Daftar Ulang</th>
                        <th>Kapasitas</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Teknologi Informasi</td>
                        <td>400</td>
                        <td>350</td>
                        <td>190</td>
                        <td>200</td>
                        <td>Overload</td>
                    </tr>
                    <tr>
                        <td>Data Science</td>
                        <td>380</td>
                        <td>240</td>
                        <td>130</td>
                        <td>150</td>
                        <td>Tinggi Minat</td>
                    </tr>
                    <tr>
                        <td>Akuntansi</td>
                        <td>300</td>
                        <td>300</td>
                        <td>140</td>
                        <td>200</td>
                        <td>Tinggi Minat</td>
                    </tr>
                    <tr>
                        <td>Bahasa Inggris</td>
                        <td>250</td>
                        <td>190</td>
                        <td>110</td>
                        <td>150</td>
                        <td>Cukup Stabil</td>
                    </tr>
                    <tr>
                        <td>Fisika</td>
                        <td>210</td>
                        <td>160</td>
                        <td>90</td>
                        <td>120</td>
                        <td>Stabil</td>
                    </tr>
                    <tr>
                        <td>Tafsir Al-Qur'an</td>
                        <td>150</td>
                        <td>110</td>
                        <td>45</td>
                        <td>100</td>
                        <td>Kurang Peminat</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- FOOTER -->
<div class="footer-full">
    <div class="footer-container">

        <div class="footer-left">
            <img src="assets/images/logo.png" class="footer-logo" alt="logo">
            <div class="footer-address">
                <b>UDSA</b><br>
                Jln. Lingkar Salatiga KM. 2 Pulutan,<br>
                Kec. Sidorejo, Kota Salatiga, Jawa Tengah, Indonesia 50716
            </div>
        </div>

        <div class="footer-right">
            <div class="footer-row-top">
                <div class="footer-item">
                    <img src="assets/icons/ig.png" class="footer-icon" alt="Instagram">
                    <span>@udsa_salatiga</span>
                </div>
                <div class="footer-item">
                    <img src="assets/icons/yt.png" class="footer-icon" alt="YouTube">
                    <span>UDSA SALATIGA</span>
                </div>
            </div>
            <div class="footer-row-bottom">
                <div class="footer-item">
                    <img src="assets/icons/telp.png" class="footer-icon" alt="Telepon">
                    <span>(+62) 0123456</span>
                </div>
                <div class="footer-item">
                    <img src="assets/icons/mail.png" class="footer-icon" alt="Email">
                    <span>pmb@udsa.ac.id</span>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
