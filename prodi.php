<?php
session_start(); // ✅ INJEK: agar bisa baca session last_pendaftaran_id

// ✅ INJEK: link kartu peserta dinamis
$kartuHref = "kartu.php";
if (!empty($_SESSION['last_pendaftaran_id'])) {
    $kartuHref = "kartu.php?id=" . urlencode($_SESSION['last_pendaftaran_id']);
}
?>
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
<link href="https://fonts.googleapis.com/css2?family=Gantari:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

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
    --navbar-bg: #CBC9D3;
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
    font-family:"Gantari", sans-serif;
}
.topbar-content{
    max-width:1200px;
    margin:0 auto;
    padding:0 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.topbar-left a{
    color:#000;
    text-decoration:none;
    margin-right:22px;
    font-family:"Gantari", sans-serif;
    font-size:14px;
    letter-spacing:0.3px;
}
.topbar-right {
    display: flex;
    gap: 32px;
}

.topbar-item {
    display: flex;
    align-items: center;
    gap: 6px;
}

.topbar-icon {
    width: 16px;
    height: 16px;
    opacity: 0.85;
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
.brand img{ height:54px; }

/* PMB pakai Gravitas One, UDSA pakai Katibeh */
.pmb-title{
    font-family: 'Gravitas One', serif;
    font-size: 30px;
    font-weight: 400;
    color: #7F7121;
    letter-spacing: 1px;
    margin-right: 6px;
}
.udsa-title{
    font-family: 'Katibeh', serif;
    font-size: 40px;
    font-weight: 400;
    color: #1a355c;
    letter-spacing: 1px;
}

/* ================= NAV MENU (UNDERLINE KLASIK) ================= */

.menu{
    display:flex;
    align-items:center;
}

/* menu utama */
.menu > a,
.menu > .menu-info > a{
    position:relative;
    text-decoration:none;
    color:#FFFFFF;
    margin:0 18px;
    font-size:17px;
    font-weight:400;
    letter-spacing:0.5px;
    padding-bottom:10px;
    transition:color .3s ease;
    font-family:"Jaldi", sans-serif;
}
.menu > a:hover,
.menu > .menu-info > a:hover{ color:#79787F; }

/* underline seperti awal (melebar dari kiri) */
.menu > a.active {
    color:#79787F !important;
}
.menu > a::after,
.menu > .menu-info > a::after{
    content: "";
    position:absolute;
    left:0;
    bottom:0;
    width:0%;
    height:3px;
    background:#79787F;
    border-radius:999px;
    transition:width .4s ease;
}
.menu > a:hover::after,
.menu > .menu-info > a:hover::after{ width:100%; }
.menu > a.active::after,
.menu > .menu-info > a.active::after{ width:100%; }

/* LOGIN BUTTON */
.menu a.login::after{ display:none !important; }
.menu a.login{
    background:var(--login-btn);
    border:2px solid var(--login-btn);
    padding:1px 28px;
    border-radius:15px;
    color:#ffffff !important;
    font-size:20px;
    font-weight:400;
    margin-left:24px;
    transition:border .3s ease;
}
.menu a.login:hover{ border-color:#cc0000 !important; }

 /* ================= DROPDOWN INFO ================= */
/* WRAPPER */
.menu-info{
  position:relative;
  display:flex;
  align-items:center;
}

/* LINK INFO (TEKS + PANAH SEJAJAR) */
.menu-info > a.info-link{
  display:inline-flex;
  align-items:center;
  gap:8px;
  line-height:1;
  font-weight:400;
}

/* PANAH ▼ */
.menu-info > a.info-link .caret{
  display:inline-block;
  font-size:12px;
  line-height:1;
  transform: translateY(-3px);
}


.info-dropdown{
    position:absolute;
    top:100%;
    left:50%;
    transform:translateX(-50%) translateY(8px);
    background:#CBC9D3;
    border-radius:14px;
    box-shadow:0 8px 18px rgba(0,0,0,0.15);
    padding:14px 20px;
    min-width:220px;
    opacity:0;
    visibility:hidden;
    transition:opacity .2s ease, transform .2s ease;
    z-index:1000;
}

.menu-info:hover .info-dropdown{
    opacity:1;
    visibility:visible;
    transform:translateX(-50%) translateY(0);
}

.info-dropdown a{
    display:block;
    text-decoration:none;
    font-family:"Karma", serif;
    font-size:18px;
    color:#ffffff;
    padding:6px 0;
    letter-spacing:0.3px;
    white-space:nowrap;
}
.info-dropdown a::after{ display:none !important; }
.info-dropdown a:hover{ color:#79787F; }

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
    font-family:"Karma", serif;
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
    flex:0 0 280px;
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
    font-family:"Katibeh", sans-serif;
    font-size:40px;
    color:#3b2200;
    margin-bottom:6px;
}

.prodi-card-sub{
    font-family:"Katibeh", sans-serif;
    font-size:40px;
    color:#3b2200;
}

/* ============= FOOTER ============= */

.footer-full{
    background:#CBC9D3;
    padding:12px 0;
}
.footer-container{
    max-width:1200px;
    margin:auto;
    padding:6px 40px;
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    font-family:"Gantari", sans-serif;
}

.footer-left{
    display:flex;
    gap:10px;
}
.footer-logo{
    height:65px;
}
.footer-address{
    line-height:1.2;
}
.footer-address b{
    color:#1a355c;
    font-size:22px;
    font-family:Georgia, serif;
}

.footer-right {
    display: grid;
    grid-template-columns: 0.5fr 0.5fr; /* dua kolom */
    grid-template-rows: auto auto; /* dua baris */
    gap: 20px 18px; /* jarak antar item: vertical | horizontal */
    align-items: center;
}

.footer-item {
    display: flex;
    align-items: center;
    gap: 10px;
}

.footer-icon {
    width: 22px;  /* ukuran icon sesuai foto */
    height: auto;
}

/* ================= SEARCH OVERLAY (SETENGAH HALAMAN) ================= */
.search-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.25);
    display: none;
    justify-content: flex-start;
    align-items: stretch;
    z-index: 9999;
    animation: fadeIn .3s ease;
}

@keyframes fadeIn {
    from {opacity: 0;}
    to {opacity: 1;}
}

/* panel putih hanya setengah tinggi layar */
.search-panel {
    background:#f5f5f5;
    width:100%;
    height:50vh;
    display:flex;
    flex-direction:column;
    align-items:center;
    padding-top:80px;
    position:relative;
}

/* tombol X di pojok kanan atas panel */
.search-close {
    position: absolute;
    top:25px;
    right:40px;
    font-size:30px;
    font-family:"Karma", serif;
    cursor:pointer;
    background:#e6e6e6;
    width:42px;
    height:42px;
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
}

.search-container {
    width: 70%;
    max-width: 900px;
}

.search-container label {
    font-size: 32px;
    font-family: "Karma", serif;
    margin-bottom: 12px;
    display: block;
}

.search-input-wrapper {
    position: relative;
    width: 100%;
}

.search-input {
    width: 100%;
    border: none;
    border-bottom: 2px solid #333;
    background: transparent;
    font-size: 28px;
    font-family: "Karma", serif;
    padding: 10px 0;
    outline: none;
}

.search-icon {
    position: absolute;
    right: 10px;
    top: 8px;
    font-size: 30px;
    cursor: pointer;
}

.search-button {
    margin-top: 40px;
    background: #7a6b23;
    color: #fff;
    border: none;
    padding: 14px 60px;
    font-size: 20px;
    font-family: "Karma", serif;
    border-radius: 28px;
    cursor: pointer;
    transition: .3s ease;
}
.search-button:hover {
    background: #64581d;
}

/* ================= SEARCH RESULTS ================= */
.search-results{
    margin-top: 28px;
    max-height: 35vh;
    overflow-y: auto;
    font-family: "Jaldi", sans-serif;
    font-size: 16px;
}

.search-result-item{
    padding: 10px 0;
    border-bottom: 1px solid #ccc;
    cursor: pointer;
}

.search-result-item-title{
    font-weight: 700;
}

.search-noresult{
    color: #777;
    font-style: italic;
    margin-top: 10px;
}
</style>
</head>
<body>

<!-- TOPBAR (UPDATED) -->
<div class="topbar">
    <div class="topbar-content">
        <div class="topbar-left">
            <a href="home.php">www.udsa.ac.id</a>
            <a href="berita.php">Berita</a>
            <a href="career.php">Career</a>
            <a href="#" onclick="openSearch();return false;">Search</a>
        </div>
        <div class="topbar-right">

            <div class="topbar-item">
                <img src="assets/icons/location.png" class="topbar-icon">
                <span>JL. Lingkar Salatiga - Pulutan</span>
            </div>

            <div class="topbar-item">
                <img src="assets/icons/phone.png" class="topbar-icon">
                <span>(+62) 0123456</span>
            </div>

        </div>

    </div>
</div>

<!-- NAVBAR -->
<div class="navbar-full">
    <div class="nav-container">

        <div class="brand">
            <img src="assets/images/logo.png">
            <div>
                <span class="pmb-title">PMB</span>
                <span class="udsa-title">UDSA</span>
            </div>
        </div>

        <div class="menu">
            <a href="home.php">Home</a>
            <a href="prodi.php" class="active">Program Studi</a>
            <a href="biaya.php">Biaya</a>

            <!-- MENU INFO DROPDOWN -->
             <div class="menu-info">
                <a href="info.php" class="info-link">Info <span class="caret">⌄</span></a>
                <div class="info-dropdown">
                    <a href="info.php">Jadwal Penerimaan</a>
                    <a href="pengumuman.php">Pengumuman</a>
                    <a href="<?= htmlspecialchars($kartuHref) ?>">Kartu Peserta</a>
                </div>
            </div>

            <a href="daftar.php">Daftar</a>
            <a href="login.php" class="login">Login</a>
        </div>
    </div>
</div>

<!-- MAIN: PROGRAM STUDI (TIDAK DIUBAH) -->
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
                <a href="saintek.php" class="prodi-card-link">
                    <div class="prodi-card">
                        <div class="prodi-image-wrapper">
                            <img src="assets/images/fakultas_febi.png" alt="Fakultas Ekonomi & Bisnis">
                        </div>
                        <div class="prodi-card-title">Fakultas</div>
                        <div class="prodi-card-sub">Ekonomi &amp; Bisnis</div>
                    </div>
                </a>

                <!-- CARD 3 -->
                <a href="saintek.php" class="prodi-card-link">
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

<!-- FOOTER (TIDAK DIUBAH) -->
<div class="footer-full">
    <div class="footer-container">

        <div class="footer-left">
            <img src="assets/images/logo.png" class="footer-logo">
            <div class="footer-address">
                <b>UDSA</b><br>
                Jln. Lingkar Salatiga KM 2 Pulutan<br>
                Kota Salatiga, Jawa Tengah
            </div>
        </div>

        <div class="footer-right">

            <div class="footer-item">
                <img src="assets/icons/ig.png" class="footer-icon">
                <span>@udsa_salatiga</span>
            </div>

            <div class="footer-item">
                <img src="assets/icons/yt.png" class="footer-icon">
                <span>UDSA SALATIGA</span>
            </div>

            <div class="footer-item">
                <img src="assets/icons/telp.png" class="footer-icon">
                <span>(+62) 0123456</span>
            </div>

            <div class="footer-item">
                <img src="assets/icons/mail.png" class="footer-icon">
                <span>pmb@udsasalatiga.ac.id</span>
            </div>

        </div>


    </div>
</div>

<!-- SEARCH OVERLAY (opsional tapi dibuat agar Search topbar berfungsi) -->
<div class="search-overlay" id="searchOverlay">
    <div class="search-panel">
        <div class="search-close" onclick="closeSearch()">X</div>

        <div class="search-container">
            <div class="search-input-wrapper">
                <input id="searchInput" type="text" class="search-input" placeholder="Type your search" />
                <span class="search-icon" onclick="doSearch()">🔍</span>
            </div>

            <button class="search-button" onclick="doSearch()">Search</button>

            <!-- HASIL PENCARIAN DI BAWAH INPUT -->
            <div id="searchResults" class="search-results"></div>
        </div>
    </div>
</div>

<script>
// ================== DATA HALAMAN NAVBAR/TOPBAR UNTUK SEARCH ==================
const NAV_PAGES = [
    { title: "Home", url: "home.php", keywords: ["home", "beranda", "utama", "pmb"] },
    { title: "Program Studi", url: "prodi.php", keywords: ["prodi", "program studi", "jurusan"] },
    { title: "Biaya", url: "biaya.php", keywords: ["biaya", "uang kuliah", "ukt", "pembayaran"] },
    { title: "Info / Jadwal Penerimaan", url: "info.php", keywords: ["info", "jadwal", "penerimaan", "pengumuman"] },
    { title: "Pengumuman", url: "pengumuman.php", keywords: ["pengumuman", "hasil", "info terbaru"] },
    { title: "Daftar", url: "daftar.php", keywords: ["daftar", "pendaftaran", "registrasi"] },
    { title: "Login", url: "login.php", keywords: ["login", "masuk", "akun"] },
    { title: "Berita", url: "berita.php", keywords: ["berita", "news", "informasi"] },
    { title: "Career", url: "career.php", keywords: ["career", "karir", "lowongan"] }
];

function openSearch(){
    const overlay = document.getElementById("searchOverlay");
    overlay.style.display = "flex";
    setTimeout(() => {
        const input = document.getElementById("searchInput");
        if(input) input.focus();
    }, 50);
}

function closeSearch(){
    document.getElementById("searchOverlay").style.display = "none";
    document.getElementById("searchResults").innerHTML = "";
    document.getElementById("searchInput").value = "";
}

/* FUNCTION SEARCH NAVBAR PAGES */
function doSearch(){
    const input = document.getElementById("searchInput");
    const keyword = (input.value || "").trim().toLowerCase();
    const resultBox = document.getElementById("searchResults");
    resultBox.innerHTML = "";

    if(keyword === ""){
        alert("Masukkan kata pencarian!");
        return;
    }

    const results = NAV_PAGES.filter(page => {
        const inTitle = page.title.toLowerCase().includes(keyword);
        const inKeywords = page.keywords.some(k => k.toLowerCase().includes(keyword));
        return inTitle || inKeywords;
    });

    if(results.length === 0){
        resultBox.innerHTML = '<div class="search-noresult">Halaman tidak ditemukan. Coba kata kunci lain.</div>';
        return;
    }

    results.forEach(page => {
        const item = document.createElement("div");
        item.className = "search-result-item";
        item.onclick = () => { window.location.href = page.url; };
        item.innerHTML = `<div class="search-result-item-title">${page.title}</div>`;
        resultBox.appendChild(item);
    });
}
// tekan ENTER untuk search
document.getElementById("searchInput").addEventListener("keydown", function(e){
    if(e.key === "Enter"){
        e.preventDefault(); // mencegah reload / submit default
        doSearch();
    }
});

/* opsional: tekan ESC untuk tutup search */
document.addEventListener("keydown", (e) => {
    if(e.key === "Escape"){
        const overlay = document.getElementById("searchOverlay");
        if(overlay && overlay.style.display === "flex") closeSearch();
    }
});
</script>

</body>
</html>
