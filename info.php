<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Jadwal Penerimaan - PMB UDSA</title>

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
    font-family: "Cormorant Garamond", serif;
}

/* ROOT COLOR */
:root {
    --cream-bg: #f6f2d9;
    --navbar-bg: #d6d4de;
    --pmb-color: #7c6c2d;
    --udsa-color: #1a355c;
    --login-btn: #7a6b23;
}

/* ============= TOPBAR ============= */

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

/* ================= NAVBAR ================= */

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

/* ============= MAIN ============= */

.main-panel{
    background:#f6f2d9;
}

/* HERO TITLE */
.jadwal-hero {
    background: #efe6bd;              /* kuning lembut sesuai foto */
    padding: 70px 20px 60px;          /* jarak atas & bawah meniru foto */
    text-align: center;
}

.jadwal-hero h1{
    font-size: 42px;
    font-weight: 700;
    line-height: 1.3;
    color: #1b1308;
    font-family: "Cormorant Garamond", serif;
}

/* WRAPPER TABEL */
.jadwal-wrapper{
    max-width: 1250px;
    margin: 0 auto 60px;
    padding: 0 20px;
}

/* TABEL SESUAI FOTO */
.jadwal-table{
    width: 100%;
    border-collapse: collapse;
    font-family: "Jaldi", sans-serif;
    background: #fbf7e7;
    font-size: 17px;
}

.jadwal-table thead th{
    background: #8c7a24;
    color: #fff;
    padding: 14px 12px;
    border: 1px solid #685b17;
    font-size: 18px;
}

.jadwal-table td{
    padding: 15px 14px;
    border: 1px solid #6d6d6d;
    color: #222;
}

/* ============= FOOTER ============= */

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

/* responsive sederhana */
@media (max-width:900px){
    .jadwal-hero{
        padding:50px 16px 40px;
    }
    .jadwal-hero h1{
        font-size:30px;
    }
    .jadwal-wrapper{
        padding:0 10px;
    }
    .jadwal-table{
        font-size:14px;
    }
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
            <a href="info.php" class="active">Info</a> <!-- underline pindah ke Info -->
            <a href="daftar.php">Daftar</a>
            <a href="logoin.php" class="login">Login</a>
        </div>
    </div>
</div>

<!-- MAIN -->
<div class="main-panel">

    <!-- HERO TITLE -->
    <section class="jadwal-hero">
        <h1>Jadwal Penerimaan Mahasiswa Baru Universitas<br>Dua Sembilan April</h1>
    </section>

    <!-- TABEL JADWAL -->
    <div class="jadwal-wrapper">
        <table class="jadwal-table">
            <thead>
                <tr>
                    <th>Seleksi</th>
                    <th>Jalur</th>
                    <th>Pendaftaran</th>
                    <th>Ujian</th>
                    <th>Pengumuman</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nasional</td>
                    <td>SNBP</td>
                    <td>06 Januari s.d. 18 Februari 2026</td>
                    <td>Tidak ada</td>
                    <td>18 Maret 2026</td>
                </tr>
                <tr>
                    <td>Nasional</td>
                    <td>SPAN-PTKIN</td>
                    <td>06 Januari s.d. 06 Maret 2026</td>
                    <td>Tidak ada</td>
                    <td>27 Maret 2026</td>
                </tr>
                <tr>
                    <td>Nasional</td>
                    <td>UTBK-SNBT</td>
                    <td>13 Januari s.d. 27 Maret 2026</td>
                    <td>23 April – 03 Mei 2026</td>
                    <td>27 Maret 2026</td>
                </tr>
                <tr>
                    <td>Nasional</td>
                    <td>UM-PTKIN</td>
                    <td>22 April s.d. 28 Mei 2026</td>
                    <td>10 – 12 Juni 2025 &amp; 14 – 18 Juni 2026</td>
                    <td>30 Juni 2026</td>
                </tr>
                <tr>
                    <td>UDSA Salatiga</td>
                    <td>Undangan</td>
                    <td>14 April s.d. 05 Juni 2026</td>
                    <td>Tidak ada</td>
                    <td>01 Juli 2026</td>
                </tr>
                <tr>
                    <td>UDSA Salatiga</td>
                    <td>Ujian Mandiri</td>
                    <td>02 Juni s.d. 04 Juli 2026</td>
                    <td>08 – 11 Juli 2025</td>
                    <td>17 Juli 2026</td>
                </tr>
                <tr>
                    <td>UDSA Salatiga</td>
                    <td>Ujian Mandiri Online</td>
                    <td>28 Juli s.d. 04 Agustus 2026</td>
                    <td>30 Juli, 1 atau 4 Agustus 2026</td>
                    <td>Setelah Ujian</td>
                </tr>
            </tbody>
        </table>
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
