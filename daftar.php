<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pilihan Jalur Masuk - PMB UDSA</title>

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
    font-size:14px;
}
.topbar-right{
    display:flex;
    gap:25px;
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

/* ============= MAIN: PILIHAN JALUR MASUK ============= */

.main-panel{
    background:#f6f2d9;
}

/* panel kuning besar */
.jalur-section{
    padding:40px 0 60px;
}
.jalur-wrapper{
    max-width:1200px;
    margin:0 auto;
    padding:0 20px;
}
.jalur-panel{
    background:#e1c681;
    padding:30px 34px 40px;
}

/* heading */
.jalur-heading{
    text-align:center;
    margin-bottom:26px;
}
.jalur-heading h1{
    font-size:30px;
    font-weight:700;
    color:#22130a;
    margin-bottom:8px;
}
.jalur-heading p{
    font-size:18px;
    line-height:1.5;
}

/* grid kartu jalur */
.jalur-grid{
    display:flex;
    flex-wrap:wrap;
    gap:26px;
}

/* card */
.jalur-card{
    flex:1 1 calc(50% - 13px);
    background:#fff;
    padding:34px 40px 32px;
    text-align:center;
}
.jalur-label{
    font-size:13px;
    letter-spacing:1.5px;
    text-transform:uppercase;
    margin-bottom:6px;
}
.jalur-nama{
    font-size:24px;
    font-weight:700;
    margin-bottom:22px;
}
.jalur-body{
    font-size:17px;
    line-height:1.9;
}
.jalur-body b{
    font-weight:700;
}

/* tombol */
.jalur-footer{
    margin-top:26px;
}
.btn-jalur{
    border:none;
    background:#6ca5e4;
    color:#fff;
    padding:10px 36px;
    border-radius:999px;
    font-size:16px;
    font-weight:700;
    cursor:pointer;
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
}
.footer-left{
    display:flex;
    gap:10px;
}
.footer-logo{ height:50px; }
.footer-address{ line-height:1.15; }
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
.footer-icon{ width:16px; }

/* responsive sederhana */
@media(max-width:900px){
    .jalur-card{
        flex:1 1 100%;
        padding:26px 24px 28px;
    }
    .jalur-heading h1{
        font-size:26px;
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

<!-- NAVBAR (TIDAK DIUBAH) -->
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
            <a href="daftar.php" class="active">Daftar</a><!-- jika tidak mau ubah navbar, hilangkan class="active" di sini -->
            <a href="login.php" class="login">Login</a>
        </div>
    </div>
</div>

<!-- MAIN: PILIHAN JALUR MASUK -->
<div class="main-panel">
    <section class="jalur-section">
        <div class="jalur-wrapper">
            <div class="jalur-panel">

                <div class="jalur-heading">
                    <h1>Pilihan Jalur Masuk</h1>
                    <p>Universitas Dua Sembilan April memiliki beberapa jalur untuk Calon Mahasiswa Baru</p>
                </div>

                <div class="jalur-grid">

                    <!-- SNPMB SNBP -->
                    <div class="jalur-card">
                        <div class="jalur-label">NASIONAL</div>
                        <div class="jalur-nama">SNPMB SNBP</div>
                        <div class="jalur-body">
                            <b>Pendaftaran :</b> 06 Januari s.d. 18 Februari 2026<br>
                            <b>Ujian :</b> Tidak Ada<br>
                            <b>Pengumuman :</b> 18 Maret 2026
                        </div>
                        <div class="jalur-footer">
                            <a href="snbp.php">
                                <button class="btn-jalur">KLIK DISINI</button>
                            </a>
                        </div>
                    </div>

                    <!-- SNPMB SNBT -->
                    <div class="jalur-card">
                        <div class="jalur-label">NASIONAL</div>
                        <div class="jalur-nama">SNPMB SNBT</div>
                        <div class="jalur-body">
                            <b>Pendaftaran :</b> 13 Januari s.d. 27 Maret 2026<br>
                            <b>Ujian :</b> 23 April - 03 Mei 2026<br>
                            <b>Pengumuman :</b> 28 Mei 2026
                        </div>
                        <div class="jalur-footer">
                            <button class="btn-jalur">KLIK DISINI</button>
                        </div>
                    </div>

                    <!-- SPAN PTKIN -->
                    <div class="jalur-card">
                        <div class="jalur-label">NASIONAL</div>
                        <div class="jalur-nama">SPAN PTKIN</div>
                        <div class="jalur-body">
                            <b>Pendaftaran :</b> 06 Januari s.d. 06 Maret 2025<br>
                            <b>Ujian :</b> Tidak Ada<br>
                            <b>Pengumuman :</b> 27 Maret 2025
                        </div>
                        <div class="jalur-footer">
                            <button class="btn-jalur">KLIK DISINI</button>
                        </div>
                    </div>

                    <!-- UM PTKIN -->
                    <div class="jalur-card">
                        <div class="jalur-label">NASIONAL</div>
                        <div class="jalur-nama">UM PTKIN</div>
                        <div class="jalur-body">
                            <b>Pendaftaran :</b> 22 April s.d. 28 Mei 2025<br>
                            <b>Ujian :</b> 10-12 Juni 2025 &amp; 14-18 Juni 2025<br>
                            <b>Pengumuman :</b> 30 Juni 2025
                        </div>
                        <div class="jalur-footer">
                            <button class="btn-jalur">KLIK DISINI</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
</div>

<!-- FOOTER (TIDAK DIUBAH) -->
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
