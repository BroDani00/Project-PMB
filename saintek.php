<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Fakultas Sains & Teknologi - PMB UDSA</title>

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

/* ============= MAIN PANEL ============= */

.main-panel{
    background:#f6f2d9;
    font-family:"Katibeh", serif;
}
.wrapper{
    max-width:1200px;
    margin:auto;
}

/* PANEL UTAMA */
.fakultas-panel{
    margin:40px;
    background:#e4c37b;
    padding:18px 26px 28px;
}

/* HEADER DALAM PANEL */
.fakultas-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:16px;
}

.back-wrapper{
    display:flex;
    align-items:center;
    gap:12px;
}
.back-button{
    text-decoration:none;
    color:#3a2803;
    font-size:26px;
    line-height:1;
}
.fakultas-title{
    font-size:26px;
    font-weight:700;
    color:#3a2803;
    font-family:"Cormorant Garamond", serif;
}

/* SEARCH */
.search-area{
    display:flex;
    align-items:center;
    gap:6px;
}
.search-input{
    background:#dcd7e7;
    border:none;
    border-radius:6px;
    padding:8px 14px;
    width:190px;
    font-size:20px;
    font-family:"Katibeh", serif;
    outline:none;
}
.search-input::placeholder{
    color:#333;
}
.search-btn{
    background:#6c6a1b;
    border:none;
    width:40px;
    height:40px;
    border-radius:6px;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
}
.search-btn span{
    color:#000;
    font-size:22px;
}

/* LIST PRODI */
.prodi-list{
    display:flex;
    flex-direction:column;
    gap:14px;
}

.prodi-card{
    background:#fdf7d9;
    border-radius:20px;
    padding:16px 22px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.prodi-left{
    display:flex;
    align-items:center;
    gap:18px;
}

.prodi-icon{
    width:80px;
    height:80px;
    object-fit:contain;
}

.prodi-text{
    display:flex;
    flex-direction:column;
    gap:2px;
}
.prodi-nama{
    font-size:24px;
    color:#111;
    font-weight:600;
}
.prodi-fakultas{
    font-size:20px;
    color:#117323;
}

/* ======================= */
/*  SMOOTH BUTTON ANIMATION */
/* ======================= */
.badge-unggul{
    background:#9b7831;
    color:#fff;
    border:none;
    padding:10px 30px;
    border-radius:18px;
    font-size:19px;
    font-weight:600;
    cursor:pointer;

    /* ANIMASI HALUS */
    transition: all 0.28s ease;
    transform: scale(1);
}

.badge-unggul:hover{
    transform: scale(1.09); /* membesar smooth */
    box-shadow: 0 8px 18px rgba(0,0,0,0.25);
    background:#b48d3d; /* warna lebih cerah */
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

<!-- MAIN -->
<div class="main-panel">
    <div class="wrapper">

        <section class="fakultas-panel">

            <div class="fakultas-header">
                <div class="back-wrapper">
                    <a href="prodi.php" class="back-button">&lt;</a>
                    <span class="fakultas-title">Fakultas Sains &amp; Teknologi</span>
                </div>

                <div class="search-area">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn">
                        <span>&#128269;</span>
                    </button>
                </div>
            </div>

            <!-- LIST PRODI -->
            <div class="prodi-list">

                <div class="prodi-card">
                    <div class="prodi-left">
                        <img src="assets/images/ikon-prodi.png" alt="icon prodi" class="prodi-icon">
                        <div class="prodi-text">
                            <span class="prodi-nama">S1 Teknologi Informasi</span>
                            <span class="prodi-fakultas">Fakultas Sains &amp; Teknologi</span>
                        </div>
                    </div>
                    <!-- tombol diarahkan ke prodiunggul.php -->
                    <button class="badge-unggul" onclick="goToUnggul('S1 Teknologi Informasi')">UNGGUL</button>
                </div>

                <div class="prodi-card">
                    <div class="prodi-left">
                        <img src="assets/images/ikon-prodi.png" alt="icon prodi" class="prodi-icon">
                        <div class="prodi-text">
                            <span class="prodi-nama">S1 Sistem Informasi</span>
                            <span class="prodi-fakultas">Fakultas Sains &amp; Teknologi</span>
                        </div>
                    </div>
                    <button class="badge-unggul" onclick="goToUnggul('S1 Sistem Informasi')">UNGGUL</button>
                </div>

                <div class="prodi-card">
                    <div class="prodi-left">
                        <img src="assets/images/ikon-prodi.png" alt="icon prodi" class="prodi-icon">
                        <div class="prodi-text">
                            <span class="prodi-nama">S1 Data Science</span>
                            <span class="prodi-fakultas">Fakultas Sains &amp; Teknologi</span>
                        </div>
                    </div>
                    <button class="badge-unggul" onclick="goToUnggul('S1 Data Science')">UNGGUL</button>
                </div>

                <div class="prodi-card">
                    <div class="prodi-left">
                        <img src="assets/images/ikon-prodi.png" alt="icon prodi" class="prodi-icon">
                        <div class="prodi-text">
                            <span class="prodi-nama">S1 Matematika</span>
                            <span class="prodi-fakultas">Fakultas Sains &amp; Teknologi</span>
                        </div>
                    </div>
                    <button class="badge-unggul" onclick="goToUnggul('S1 Matematika')">UNGGUL</button>
                </div>

                <div class="prodi-card">
                    <div class="prodi-left">
                        <img src="assets/images/ikon-prodi.png" alt="icon prodi" class="prodi-icon">
                        <div class="prodi-text">
                            <span class="prodi-nama">S1 Biologi</span>
                            <span class="prodi-fakultas">Fakultas Sains &amp; Teknologi</span>
                        </div>
                    </div>
                    <button class="badge-unggul" onclick="goToUnggul('S1 Biologi')">UNGGUL</button>
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

<!-- SCRIPT UNGGUL (SUDAH DIUBAH) -->
<script>
function goToUnggul(prodi) {
    // redirect ke halaman prodiunggul.php dengan parameter prodi
    window.location.href = "prodiunggul.php?prodi=" + encodeURIComponent(prodi);
}
</script>

</body>
</html>
