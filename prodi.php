<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Program Studi - PMB UDSA</title>

<!-- GOOGLE FONTS -->
<link href="https://fonts.googleapis.com/css2?family=Katibeh&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Miltonian+Tattoo&family=Gravitas+One&family=Cormorant+Garamond:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Jaldi:wght@400;700&display=swap" rel="stylesheet">

<style>
/* RESET */
*{margin:0;padding:0;box-sizing:border-box;}
body{
    font-family:sans-serif;
    background:#f6f2d9;
    color:#333;
}

/* ROOT COLOR */
:root {
    --cream-bg: #f6f2d9;
    --navbar-bg: #d6d4de;
    --pmb-color: #7c6c2d;
    --udsa-color: #1a355c;
    --welcome-brown: #6b4d09;
    --welcome-green: #0f6d1a;
    --login-btn: #7a6b23;
    --info-box: #b99950;
}

/* ================= TOPBAR ================= */

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
    font-size:17px;          /* disesuaikan */
    font-weight:600;         /* disesuaikan */
    letter-spacing:0.5px;    /* sedikit rapat seperti gambar */
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
    font-size:16px;   /* disesuaikan */
    font-weight:700;  /* disesuaikan */
    margin-left:24px;
    transition:border .3s ease;
}
.menu a.login:hover{ border-color:#cc0000 !important; }

/* ================= MAIN PANEL ================= */

.main-panel{ background:var(--cream-bg); }
.wrapper{ max-width:1200px; margin:0 auto; }

/* ================= PROGRAM STUDI SECTION ================= */

.prodi-section-outer{
    background:#f1e4a9;
    margin:40px;
    padding:50px 80px 80px;
    border-radius:4px;
}

.prodi-header{
    text-align:center;
    margin-bottom:45px;
}

.prodi-title{
    font-family:'Miltonian Tattoo', serif;
    font-size:48px;
    color:#6b4d09;
    margin-bottom:12px;
}

.prodi-subtitle{
    font-family:"Katibeh", serif;
    font-size:24px;
    color:#c74a2f;
}

/* GRID – 3 kartu di tengah */
.prodi-grid{
    display:flex;
    justify-content:center;
    gap:60px;
}

/* SMOOTH BUTTON WRAPPER */
.prodi-card-link{
    text-decoration:none;
    color:inherit;
    display:block;
    flex:0 0 280px;       /* lebar fix agar mirip gambar */
}

/* CARD (SMOOTH) */
.prodi-card{
    background:#c89b3c;
    padding:70px 26px 40px;
    text-align:center;
    position:relative;
    cursor:pointer;
    border-radius:14px;
    transition:
        transform 0.35s cubic-bezier(.22,.61,.36,1),
        box-shadow 0.35s cubic-bezier(.22,.61,.36,1);
}

.prodi-card-link:hover .prodi-card{
    transform:translateY(-8px);
    box-shadow:0 12px 24px rgba(0,0,0,0.22);
}

/* IMAGE FRAME – sesuai foto */
.prodi-image-wrapper{
    position:absolute;
    top:-35px;
    left:50%;
    transform:translateX(-50%);
    background:#ffffff;
    padding:6px;
    border-radius:10px;
    box-shadow:0 4px 8px rgba(0,0,0,0.25);
}

.prodi-image-wrapper img{
    width:240px;
    height:240px;
    object-fit:cover;
    border-radius:6px;
}

/* TEXT DI DALAM KARTU – Katibeh & 2 baris */
.prodi-card-title{
    margin-top:195px;
    font-family:"Katibeh", serif;
    font-size:24px;
    color:#3b2200;
    margin-bottom:6px;
}

.prodi-card-sub{
    font-family:"Katibeh", serif;
    font-size:22px;
    color:#3b2200;
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
@media (max-width: 900px){
    .favorite-grid{
        flex-direction:column;
    }
    .favorite-panel{
        margin:20px 12px;
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
            <a href="prodi.php" class="active">Program Studi</a>
            <a href="biaya.php">Biaya</a>
            <a href="info.php">Info</a>
            <a href="daftar.php">Daftar</a>
            <a href="login.php" class="login">Login</a>
        </div>
    </div>
</div>

<!-- MAIN: PROGRAM STUDI -->
<div class="main-panel">
    <div class="wrapper">

        <section class="prodi-section-outer">
            <div class="prodi-header">
                <h1 class="prodi-title">Jelajahi Fakultas Kami</h1>
                <p class="prodi-subtitle">Tersedia beragam pilihan untuk jenjang pendidikan terbaikmu</p>
            </div>

            <div class="prodi-grid">

                <!-- CARD 1 -->
                <a href="saintek.php" class="prodi-card-link">
                    <div class="prodi-card">
                        <div class="prodi-image-wrapper">
                            <img src="assets/images/fakultas_saintek.png" alt="Fakultas Sains & Teknologi">
                        </div>
                        <div class="prodi-card-title">Fakultas</div>
                        <div class="prodi-card-sub">Sains &amp; Teknologi</div>
                    </div>
                </a>

                <!-- CARD 2 -->
                <a href="#" class="prodi-card-link">
                    <div class="prodi-card">
                        <div class="prodi-image-wrapper">
                            <img src="assets/images/fakultas_febi.png" alt="Fakultas Ekonomi & Bisnis">
                        </div>
                        <div class="prodi-card-title">Fakultas</div>
                        <div class="prodi-card-sub">Ekonomi &amp; Bisnis</div>
                    </div>
                </a>

                <!-- CARD 3 -->
                <a href="#" class="prodi-card-link">
                    <div class="prodi-card">
                        <div class="prodi-image-wrapper">
                            <img src="assets/images/fakultas_keguruan.png" alt="Fakultas Ilmu Keguruan">
                        </div>
                        <div class="prodi-card-title">Fakultas</div>
                        <div class="prodi-card-sub">Ilmu Keguruan</div>
                    </div>
                </a>

            </div>
        </section>

    </div>
</div>

<!-- FOOTER -->
<div class="footer-full">
    <div class="footer-container">

        <!-- LEFT SIDE -->
        <div class="footer-left">
            <img src="assets/images/logo.png" class="footer-logo" alt="logo">
            <div class="footer-address">
                <b>UDSA</b><br>
                Jln. Lingkar Salatiga KM. 2 Pulutan,<br>
                Kec. Sidorejo, Kota Salatiga, Jawa Tengah, Indonesia 50716
            </div>
        </div>

        <!-- RIGHT SIDE -->
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
