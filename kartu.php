<?php
require 'koneksi.php';

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("ID peserta tidak ditemukan di URL.");
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM pendaftaran_snbp WHERE id = ?");
if (!$stmt) {
    die("Gagal prepare: " . $conn->error);
}
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Data peserta tidak ditemukan di database.");
}

// nomor peserta
$nomor_peserta = "SNBP-2026-" . str_pad((string)$data['id'], 4, "0", STR_PAD_LEFT);

// data yang ditampilkan (sesuai kartu awal)
$nama     = $data['nama']      ?? '-';
$nisn     = $data['nisn']      ?? '-';
$sekolah  = $data['asal']      ?? '-';
$kabkota  = $data['kabupaten'] ?? '-';   // sekarang dari DB
$provinsi = $data['provinsi']  ?? '-';   // sekarang dari DB
$prodi1   = $data['prodi1']    ?? 'Belum diisi';
$prodi2   = $data['prodi2']    ?? 'Belum diisi';

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kartu Peserta SNBP 2026 - PMB UDSA</title>

<!-- GOOGLE FONTS -->
<link href="https://fonts.googleapis.com/css2?family=Katibeh&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Miltonian+Tattoo&family=Gravitas+One&family=Cormorant+Garamond:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Jaldi:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Gantari:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

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

/* PMB + UDSA */
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

/* ============= MAIN PANEL (KARTU PESERTA) ============= */
.main-panel{
    background:#f3ebc8;
    padding:50px 0 70px;
}
.wrapper{
    max-width:1200px;
    margin:0 auto;
}
.kartu-container{
    background:#ffffff;
    margin:0 40px;
    padding:35px 60px 45px;
    font-family:"Katibeh", sans-serif;
}
.kartu-title{
    font-size:36px;
    font-weight:400;
    letter-spacing:0.5px;
    margin-bottom:24px;
}

/* GRID 3 BARIS (ASLI) */
.kartu-identitas{
    border:1px solid #000;
    display:grid;
    grid-template-columns:200px 1fr 1fr;
    grid-template-rows:repeat(3, 90px);
}

/* FOTO */
.kartu-photo{
    grid-row:1 / 4;
    border-right:1px solid #000;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#e5e5e5;
}
.kartu-photo-inner{
    width:130px;
    height:130px;
    background:#d0d0d0;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:60px;
    font-family:"Katibeh", sans-serif;
    color:#555;
}

/* CELL TEKS */
.kartu-cell{
    border-bottom:1px solid #000;
    padding:14px 18px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    gap:4px;
}
.kartu-cell:nth-child(3),
.kartu-cell:nth-child(5),
.kartu-cell:nth-child(7){
    border-left:1px solid #000;
}
.kartu-label{
    font-size:18px;
    font-weight:400;
    font-family:"Katibeh", sans-serif;
    text-transform:uppercase;
}
.kartu-value{
    font-size:22px;
    font-weight:600;
    font-family:"Katibeh", sans-serif;
}

/* SECTION PILIHAN PRODI */
.kartu-subtitle{
    font-size:30px;
    font-weight:400;
    font-family:"Katibeh", sans-serif;
    margin:28px 0 14px;
}

/* TABEL PILIHAN PRODI */
.kartu-prodi{
    border:1px solid #000;
    border-collapse:collapse;
    width:100%;
    font-size:22px;
}
.kartu-prodi tr{ border-bottom:1px solid #000; }
.kartu-prodi td{
    padding:12px 18px;
    border-right:1px solid #000;
}
.kartu-prodi td:last-child{ border-right:none; }
.kartu-prodi-header{ font-weight:400; text-align:center; }
.kartu-prodi-nama{ font-weight:400; }
.kartu-prodi-ptn{
    font-size:16px;
    color:#777;
    text-transform:uppercase;
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

/* ============ SEARCH OVERLAY (SETENGAH HALAMAN) ============ */
.search-overlay{
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.25);
    display: none;
    justify-content: flex-start;
    align-items: stretch;
    z-index: 9999;
    animation: fadeIn .3s ease;
}
@keyframes fadeIn { from{opacity:0;} to{opacity:1;} }
.search-panel{
    background:#f5f5f5;
    width:100%;
    height:50vh;
    display:flex;
    flex-direction:column;
    align-items:center;
    padding-top:80px;
    position:relative;
}
.search-close{
    position:absolute;
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
.search-container{ width:70%; max-width:900px; }
.search-input-wrapper{ position:relative; width:100%; }
.search-input{
    width:100%;
    border:none;
    border-bottom:2px solid #333;
    background:transparent;
    font-size:28px;
    font-family:"Karma", serif;
    padding:10px 0;
    outline:none;
}
.search-icon{
    position:absolute;
    right:10px;
    top:8px;
    font-size:30px;
    cursor:pointer;
}
.search-button{
    margin-top:40px;
    background:#7a6b23;
    color:#fff;
    border:none;
    padding:14px 60px;
    font-size:20px;
    font-family:"Karma", serif;
    border-radius:28px;
    cursor:pointer;
    transition:.3s ease;
}
.search-button:hover{ background:#64581d; }
.search-results{
    margin-top:28px;
    max-height:35vh;
    overflow-y:auto;
    font-family:"Jaldi", sans-serif;
    font-size:16px;
}
.search-result-item{
    padding:10px 0;
    border-bottom:1px solid #ccc;
    cursor:pointer;
}
.search-result-item-title{ font-weight:700; }
.search-noresult{
    color:#777;
    font-style:italic;
    margin-top:10px;
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
      <img src="assets/images/logo.png" alt="">
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

      <a href="daftar.php" class="active">Daftar</a>
      <a href="login.php" class="login">Login</a>
    </div>
  </div>
</div>

<!-- MAIN KARTU PESERTA -->
<div class="main-panel">
  <div class="wrapper">
    <section class="kartu-container">

      <h1 class="kartu-title">KARTU PESERTA SNBP 2026</h1>

      <div class="kartu-identitas">
        <div class="kartu-photo">
          <div class="kartu-photo-inner">&#128100;</div>
        </div>

        <div class="kartu-cell">
          <div class="kartu-label">NOMOR PESERTA</div>
          <div class="kartu-value"><?php echo htmlspecialchars($nomor_peserta); ?></div>
        </div>

        <div class="kartu-cell">
          <div class="kartu-label">NAMA SISWA</div>
          <div class="kartu-value"><?php echo htmlspecialchars($nama); ?></div>
        </div>

        <div class="kartu-cell">
          <div class="kartu-label">NISN</div>
          <div class="kartu-value"><?php echo htmlspecialchars($nisn); ?></div>
        </div>

        <div class="kartu-cell">
          <div class="kartu-label">SEKOLAH</div>
          <div class="kartu-value"><?php echo htmlspecialchars($sekolah); ?></div>
        </div>

        <div class="kartu-cell">
          <div class="kartu-label">KABUPATEN/KOTA</div>
          <div class="kartu-value"><?php echo htmlspecialchars($kabkota); ?></div>
        </div>

        <div class="kartu-cell">
          <div class="kartu-label">PROVINSI</div>
          <div class="kartu-value"><?php echo htmlspecialchars($provinsi); ?></div>
        </div>
      </div>

      <h2 class="kartu-subtitle">Pilihan PTN &amp; Program Studi</h2>

      <table class="kartu-prodi">
        <tr>
          <td class="kartu-prodi-header">PILIHAN 1</td>
          <td class="kartu-prodi-header">PILIHAN 2</td>
        </tr>
        <tr>
          <td>
            <div class="kartu-prodi-nama"><?php echo htmlspecialchars($prodi1); ?></div>
            <div class="kartu-prodi-ptn">UDSA SALATIGA</div>
          </td>
          <td>
            <div class="kartu-prodi-nama"><?php echo htmlspecialchars($prodi2); ?></div>
            <div class="kartu-prodi-ptn">UDSA SALATIGA</div>
          </td>
        </tr>
      </table>

    </section>
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
document.addEventListener("keydown", (e) => {
  if(e.key === "Escape"){
    const overlay = document.getElementById("searchOverlay");
    if(overlay && overlay.style.display === "flex") closeSearch();
  }
});
</script>

</body>
</html>
