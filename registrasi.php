<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrasi PMB - UDSA</title>

<!-- GOOGLE FONTS -->
<link href="https://fonts.googleapis.com/css2?family=Katibeh&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Gravitas+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Jaldi:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Gantari:wght@300;400;500;700&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{
    background:#f6f2d9;
    color:#333;
    font-family:"Cormorant Garamond", serif;
}
:root {
    --cream-bg: #f6f2d9;
    --navbar-bg: #CBC9D3;
    --pmb-color: #7c6c2d;
    --udsa-color: #1a355c;
    --login-btn: #7a6b23;
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
    font-size:14px;
    letter-spacing:0.3px;
}
.topbar-right { display:flex; gap:32px; }
.topbar-item { display:flex; align-items:center; gap:6px; }
.topbar-icon { width:16px; height:16px; opacity:0.85; }

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
.brand{ display:flex; align-items:center; gap:10px; }
.brand img{ height:54px; }
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

/* ================= NAV MENU ================= */
.menu{
    display:flex;
    align-items:center;
}
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

.menu > a.active { color:#79787F !important; }
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
.menu-info{
  position:relative;
  display:flex;
  align-items:center;
}
.menu-info > a.info-link{
  display:inline-flex;
  align-items:center;
  gap:8px;
  line-height:1;
  font-weight:400;
}
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

/* ============= MAIN PANEL (REGISTRASI) ============= */
.main-panel{
    background:#5a574f;
    padding:80px 0;
    display:flex;
    justify-content:center;
    align-items:center;
}
.register-card{
    width:480px;
    background:#ffffff;
    padding:45px 50px 50px;
    border-radius:10px;
    box-shadow:0 4px 14px rgba(0,0,0,0.25);
    text-align:center;
}
.register-title{
    font-size:36px;
    font-weight:600;
    margin-bottom:35px;
}

/* field kuning */
.reg-input{
    width:100%;
    background:#9a8943;
    border:none;
    padding:12px 12px;
    border-radius:4px;
    color:white;
    font-size:17px;
    margin-bottom:15px;
    font-family:"Katibeh", sans-serif;
}
.reg-input::placeholder{ color:#f6eec9; }

/* box "Masukkan kode dibawah ini" */
.reg-label-box{
    width:100%;
    background:#9a8943;
    color:white;
    padding:12px 12px;
    border-radius:4px;
    margin-bottom:10px;
    font-size:17px;
    text-align:left;
}

/* CAPTCHA di bawah box, rata kiri */
.captcha-wrapper{
    width:100%;
    display:flex;
    justify-content:flex-start;
    align-items:flex-start;
    margin-top:2px;
    margin-bottom:25px;
}
.captcha-img{
    width:165px;
    height:auto;
    display:block;
}

/* tombol daftar */
.btn-wrapper{
    text-align:center;
    margin:5px 0 10px;
}
.btn-daftar{
    width:210px;
    padding:11px 0;
    background:#e6c660;
    border:2px solid #000;
    border-radius:8px;
    font-size:24px;
    font-weight:400;
    cursor:pointer;
    font-family:"Katibeh", sans-serif;
}
.btn-daftar:hover{ filter:brightness(0.93); }

/* footer kecil di bawah form */
.register-footer-links{
    margin-top:14px;
    display:flex;
    justify-content:space-between;
    font-size:16px;
    font-family:"Katibeh", sans-serif;
}
.register-footer-links a{
    color:#7a5a28;
    font-weight:400;
    text-decoration:none;
}
.register-footer-links a:hover{ text-decoration:underline; }

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
.footer-left{ display:flex; gap:10px; }
.footer-logo{ height:65px; }
.footer-address{ line-height:1.2; }
.footer-address b{
    color:#1a355c;
    font-size:22px;
    font-family:Georgia, serif;
}
.footer-right{
    display:grid;
    grid-template-columns:0.5fr 0.5fr;
    grid-template-rows:auto auto;
    gap:20px 18px;
    align-items:center;
}
.footer-item{ display:flex; align-items:center; gap:10px; }
.footer-icon{ width:22px; height:auto; }

/* ============= SEARCH OVERLAY (opsional) ============= */
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
/* panel abu-abu 50% tinggi layar, di atas, full width */
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

/* tombol X bulat di pojok kanan atas panel */
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
.search-button:hover { background: #64581d; }

/* HASIL PENCARIAN DI BAWAH INPUT */
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

<!-- TOPBAR -->
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
                <img src="assets/icons/location.png" class="topbar-icon" alt="">
                <span>JL. Lingkar Salatiga - Pulutan</span>
            </div>
            <div class="topbar-item">
                <img src="assets/icons/phone.png" class="topbar-icon" alt="">
                <span>(+62) 0123456</span>
            </div>
        </div>
    </div>
</div>

<!-- NAVBAR -->
<div class="navbar-full">
    <div class="nav-container">
        <div class="brand">
            <img src="assets/images/logo.png" alt="Logo UDSA">
            <div>
                <span class="pmb-title">PMB</span>
                <span class="udsa-title">UDSA</span>
            </div>
        </div>

        <div class="menu">
            <a href="home.php">Home</a>
            <a href="prodi.php">Program Studi</a>
            <a href="biaya.php">Biaya</a>

            <div class="menu-info">
                <a href="info.php" class="info-link">Info <span class="caret">⌄</span></a>
                <div class="info-dropdown">
                    <a href="info.php">Jadwal Penerimaan</a>
                    <a href="pengumuman.php">Pengumuman</a>
                </div>
            </div>

            <a href="daftar.php">Daftar</a>
            <a href="login.php" class="login">Login</a>
        </div>
    </div>
</div>

<!-- MAIN REGISTRASI -->
<div class="main-panel">
    <div class="register-card">

        <div class="register-title">Registrasi PMB</div>

        <form action="login.php" method="post">
            <input type="text" name="nama" class="reg-input" placeholder="Nama Lengkap">
            <input type="text" name="email" class="reg-input" placeholder="Email /Username">
            <input type="text" name="hp" class="reg-input" placeholder="No. Hp">
            <input type="password" name="password" class="reg-input" placeholder="Password">

            <div class="reg-label-box">Masukkan kode dibawah ini</div>

            <!-- Gambar captcha statis, hanya untuk tampilan -->
            <div class="captcha-wrapper">
                <!-- ganti src dengan gambar captcha kamu -->
                <img src="assets/images/captcha.png" class="captcha-img" alt="Captcha">
            </div>

            <div class="btn-wrapper">
                <button type="submit" class="btn-daftar">Daftar</>
            </div>

            <div class="register-footer-links">
                <span>Forget your password?</span>
                <span>Already have an account?<br><a href="login.php">Login</a></span>
            </div>
        </form>
    </div>
</div>

<!-- FOOTER -->
<div class="footer-full">
    <div class="footer-container">
        <div class="footer-left">
            <img src="assets/images/logo.png" class="footer-logo" alt="">
            <div class="footer-address">
                <b>UDSA</b><br>
                Jln. Lingkar Salatiga KM 2 Pulutan<br>
                Kota Salatiga, Jawa Tengah
            </div>
        </div>

        <div class="footer-right">
            <div class="footer-item">
                <img src="assets/icons/ig.png" class="footer-icon" alt="">
                <span>@udsa_salatiga</span>
            </div>
            <div class="footer-item">
                <img src="assets/icons/yt.png" class="footer-icon" alt="">
                <span>UDSA SALATIGA</span>
            </div>
            <div class="footer-item">
                <img src="assets/icons/telp.png" class="footer-icon" alt="">
                <span>(+62) 0123456</span>
            </div>
            <div class="footer-item">
                <img src="assets/icons/mail.png" class="footer-icon" alt="">
                <span>pmb@udsasalatiga.ac.id</span>
            </div>
        </div>
    </div>
</div>

<!-- SEARCH OVERLAY -->
<div class="search-overlay" id="searchOverlay">
    <div class="search-panel">
        <div class="search-close" onclick="closeSearch()">X</div>

        <div class="search-container">
            <div class="search-input-wrapper">
                <input id="searchInput" type="text" class="search-input" placeholder="Type your search">
                <span class="search-icon" onclick="doSearch()">🔍</span>
            </div>

            <button class="search-button" onclick="doSearch()">Search</button>

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
    const overlay = document.getElementById("searchOverlay");
    const input = document.getElementById("searchInput");
    const resultBox = document.getElementById("searchResults");
    overlay.style.display = "none";
    resultBox.innerHTML = "";
    if (input) input.value = "";
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

// ENTER untuk search
document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("searchInput");
    if (input) {
        input.addEventListener("keydown", function(e){
            if(e.key === "Enter"){
                e.preventDefault();
                doSearch();
            }
        });
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
