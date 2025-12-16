<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Prodi Favorit - PMB UDSA</title>

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

/* ============= MAIN PANEL (PRODI FAVORIT) ============= */

.main-panel{
    background:#f6f2d9;
}
.wrapper{
    max-width:1200px;
    margin:auto;
}

/* PANEL KUNING BESAR */
.favorite-panel{
    margin:40px;
    background:#e9c880;              /* kuning kecokelatan mirip foto */
    padding:28px 34px 34px;
}

/* JUDUL ATAS */
.favorite-heading{
    margin-bottom:24px;
}
.favorite-heading h2{
    font-size:26px;
    font-weight:700;
    color:#3a2803;
    line-height:1.2;
}

/* GRID 3 KARTU */
.favorite-grid{
    display:flex;
    gap:24px;
}

/* CARD UMUM */
.favorite-card{
    flex:1;
    border-radius:8px;
    padding:22px 18px 26px;
    display:flex;
    flex-direction:column;
    align-items:center;
    text-align:left;
}

/* WARNA PER CARD */
.card-ti{ background:#76b3d7; }      /* biru TI */
.card-math{ background:#57a78e; }    /* hijau math */
.card-bio{ background:#e3924c; }     /* oranye bio */

/* GAMBAR DALAM CARD */
.favorite-card img{
    width:220px;
    height:auto;
    margin-bottom:18px;
    background:#fff;
    border-radius:12px;
    object-fit:cover;
}

/* TEKS CARD */
.card-title{
    font-size:22px;
    font-weight:700;
    margin-bottom:10px;
    color:#1e1507;
}
.card-body{
    font-size:15px;
    line-height:1.5;
    font-family:"Jaldi", sans-serif;
}

/* TOMBOL DETAIL */
.card-footer{
    margin-top:20px;
    width:100%;
    display:flex;
    justify-content:center;
}
.btn-detail{
    border:none;
    border-radius:18px;
    padding:10px 30px;
    background:#fdf7dd;
    font-size:15px;
    font-weight:600;
    font-family:"Jaldi", sans-serif;
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

<!-- MAIN: PRODI FAVORIT -->
<div class="main-panel">
    <div class="wrapper">

        <section class="favorite-panel">
            <div class="favorite-heading">
                <h2>Pilihan Favorit:<br>Program Studi Unggulan Kami</h2>
            </div>

            <div class="favorite-grid">

                <!-- TI -->
                <div class="favorite-card card-ti">
                    <img src="assets/images/ti-favorit.png" alt="Teknologi Informasi">
                    <h3 class="card-title">Teknologi Informasi</h3>
                    <div class="card-body">
                        Akreditasi : unggul<br>
                        Peminat : 1.500 pendaftar/thn<br>
                        Keunggulan : Fokus pada pemrograman, software, dan teknologi
                        digital. Didukung dengan lap komputer modern. Lulusan banyak
                        terserap industri IT.
                    </div>
                    <div class="card-footer">
                        <button class="btn-detail">Lihat Detail Prodi</button>
                    </div>
                </div>

                <!-- Matematika -->
                <div class="favorite-card card-math">
                    <img src="assets/images/math-favorit.png" alt="Matematika">
                    <h3 class="card-title">Matematika</h3>
                    <div class="card-body">
                        Akreditasi : unggul<br>
                        Peminat : 900 pendaftar/thn<br>
                        Keunggulan : Penguatan logika &amp; analisis. Dosen berkualitas
                        dan berpengalaman. Prospek luas : Pendidikan, Riset, Data analyst.
                    </div>
                    <div class="card-footer">
                        <button class="btn-detail">Lihat Detail Prodi</button>
                    </div>
                </div>

                <!-- Biologi -->
                <div class="favorite-card card-bio">
                    <img src="assets/images/bio-favorit.png" alt="Biologi">
                    <h3 class="card-title">Biologi</h3>
                    <div class="card-body">
                        Akreditasi : unggul<br>
                        Peminat : 800 pendaftar/thn<br>
                        Keunggulan : Fokus pada penelitian biologi, lingkungan &amp;
                        bioteknologi. Praktikum lengkap di laboratorium modern.
                        Prospek luas : analis lab, pendidikan, penelitian, konservasi.
                    </div>
                    <div class="card-footer">
                        <button class="btn-detail">Lihat Detail Prodi</button>
                    </div>
                </div>

            </div>
        </section>

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
