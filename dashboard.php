<?php
session_start();
require 'koneksi.php';

if (empty($_SESSION['last_pendaftaran_id'])) {
    header("Location: login.php");
    exit;
}

$pid = (int)$_SESSION['last_pendaftaran_id'];

$stmt = $conn->prepare("SELECT id, nama, email, prodi1, foto FROM pendaftaran_snbp WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $pid);
$stmt->execute();
$res = $stmt->get_result();
$user = $res ? $res->fetch_assoc() : null;
$stmt->close();

if (!$user) {
    session_destroy();
    header("Location: login.php");
    exit;
}

$nama  = (string)$user['nama'];
$email = (string)$user['email'];
$prodi = (string)$user['prodi1'];

$fotoUrl = "assets/images/default-user.jpg";
if (!empty($user['foto'])) {
    $fotoUrl = "assets/upload/" . rawurlencode((string)$user['foto']);
}

$kartuHref = "kartu.php?id=" . urlencode((string)$user['id']);

/* ✅ INJEK: tombol navbar dinamis */
$isLoggedIn = !empty($_SESSION['last_pendaftaran_id']);
$authHref   = $isLoggedIn ? "dashboard.php" : "login.php";
$authText   = $isLoggedIn ? "Dashboard" : "Login";
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard - PMB UDSA</title>

<link href="https://fonts.googleapis.com/css2?family=Katibeh&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Miltonian+Tattoo&family=Gravitas+One&family=Cormorant+Garamond:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Jaldi:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Gantari:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
/* RESET */
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:sans-serif;background:#f6f2d9;color:#333;}
:root {--cream-bg:#f6f2d9;--navbar-bg:#CBC9D3;--login-btn:#7a6b23;}

.topbar{background:#f8f6e4;padding:6px 0;border-bottom:1px solid rgba(0,0,0,0.08);font-size:13px;font-family:"Gantari", sans-serif;}
.topbar-content{max-width:1200px;margin:0 auto;padding:0 40px;display:flex;justify-content:space-between;align-items:center;}
.topbar-left a{color:#000;text-decoration:none;margin-right:22px;font-family:"Gantari", sans-serif;font-size:14px;letter-spacing:0.3px;}
.topbar-right{display:flex;gap:32px;}
.topbar-item{display:flex;align-items:center;gap:6px;}
.topbar-icon{width:16px;height:16px;opacity:.85;}

.navbar-full{ background:var(--navbar-bg); width:100%; }
.nav-container{max-width:1200px;padding:16px 40px;margin:0 auto;display:flex;justify-content:space-between;align-items:center;}
.brand{display:flex;align-items:center;gap:10px;}
.brand img{height:54px;}
.pmb-title{font-family:'Gravitas One', serif;font-size:30px;font-weight:400;color:#7F7121;letter-spacing:1px;margin-right:6px;}
.udsa-title{font-family:'Katibeh', serif;font-size:40px;font-weight:400;color:#1a355c;letter-spacing:1px;}

.menu{display:flex;align-items:center;}
.menu > a,.menu > .menu-info > a{position:relative;text-decoration:none;color:#FFFFFF;margin:0 18px;font-size:17px;font-weight:400;letter-spacing:0.5px;padding-bottom:10px;transition:color .3s ease;font-family:"Jaldi", sans-serif;}
.menu > a:hover,.menu > .menu-info > a:hover{ color:#79787F; }
.menu > a::after,.menu > .menu-info > a::after{content:"";position:absolute;left:0;bottom:0;width:0%;height:3px;background:#79787F;border-radius:999px;transition:width .4s ease;}
.menu > a:hover::after,.menu > .menu-info > a:hover::after{ width:100%; }

.menu a.login::after{display:none!important;}
.menu a.login{background:var(--login-btn);border:2px solid var(--login-btn);padding:1px 28px;border-radius:15px;color:#fff!important;font-size:20px;margin-left:24px;}
.menu a.login:hover{ border-color:#cc0000!important; }

.menu-info{position:relative;display:flex;align-items:center;}
.menu-info > a.info-link{display:inline-flex;align-items:center;gap:8px;line-height:1;}
.menu-info > a.info-link .caret{display:inline-block;font-size:12px;line-height:1;transform: translateY(-3px);}
.info-dropdown{position:absolute;top:100%;left:50%;transform:translateX(-50%) translateY(8px);background:#CBC9D3;border-radius:14px;box-shadow:0 8px 18px rgba(0,0,0,0.15);padding:14px 20px;min-width:220px;opacity:0;visibility:hidden;transition:opacity .2s ease, transform .2s ease;z-index:1000;}
.menu-info:hover .info-dropdown{opacity:1;visibility:visible;transform:translateX(-50%) translateY(0);}
.info-dropdown a{display:block;text-decoration:none;font-family:"Karma", serif;font-size:18px;color:#fff;padding:6px 0;letter-spacing:0.3px;white-space:nowrap;}
.info-dropdown a:hover{color:#79787F;}

.main-panel{ background:var(--cream-bg); }

.dashboard-page{padding:40px 0 50px;}
.dashboard-container{max-width:1200px;margin:0 auto;padding:0 40px;}
.dashboard-top{display:flex;align-items:flex-start;justify-content:space-between;gap:20px;margin-bottom:18px;}
.dashboard-greet h1{font-family:"Katibeh", serif;font-size:46px;font-weight:400;color:#111;margin-bottom:6px;}
.dashboard-greet .sub{font-family:"Katibeh", serif;font-size:20px;font-weight:300;color:#111;}
.btn-logout{background:#ff5a5a;color:#000;border:none;padding:12px 40px;border-radius:10px;font-family:"Poppins", sans-serif;font-size:16px;cursor:pointer;}
.dashboard-grid{display:grid;grid-template-columns:360px 1fr;gap:36px;margin-top:18px;}
.profile-row{display:grid;grid-template-columns:110px 1fr;gap:14px;align-items:center;margin-top:8px;}
.avatar{width:98px;height:98px;border-radius:14px;object-fit:cover;}
.profile-name{font-family:"Poppins", sans-serif;font-size:22px;font-weight:600;color:#111;line-height:1.2;}
.profile-email{font-family:"Poppins", sans-serif;font-size:14px;color:#222;margin-top:6px;}
.side-menu{margin-top:22px;display:grid;gap:14px;}
.side-link{display:block;text-decoration:none;text-align:center;padding:16px 18px;font-family:"Poppins", sans-serif;font-size:18px;background:#d9d9d9;color:#111;}
.side-link.active{background:#79b5f2;color:#000;}
.right-col{display:grid;gap:22px;}
.box{background:#fff;padding:26px 28px;}
.box-title{font-family:"Poppins", sans-serif;font-size:22px;letter-spacing:0.5px;color:#111;margin-bottom:12px;}
.status-label{font-family:"Poppins", sans-serif;font-size:22px;color:#111;margin-bottom:8px;}
.status-value{font-family:"Poppins", sans-serif;font-size:26px;font-weight:800;color:#111;}
.progress-list{margin-top:8px;display:grid;gap:18px;}
.progress-item{display:flex;align-items:center;gap:14px;font-family:"Poppins", sans-serif;font-size:18px;color:#111;}
.icon-24{width:26px;height:26px;flex:0 0 26px;}
.muted{color:#333;font-family:"Poppins", sans-serif;font-size:16px;}
.pay-lines{display:grid;gap:10px;margin-top:6px;font-family:"Poppins", sans-serif;font-size:16px;color:#111;}
@media (max-width:980px){.dashboard-grid{grid-template-columns:1fr;}.btn-logout{padding:12px 26px;}.dashboard-greet h1{font-size:36px;}}

.search-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.25);display:none;justify-content:flex-start;align-items:stretch;z-index:9999;animation:fadeIn .3s ease;}
@keyframes fadeIn{from{opacity:0;}to{opacity:1;}}
.search-panel{background:#f5f5f5;width:100%;height:50vh;display:flex;flex-direction:column;align-items:center;padding-top:80px;position:relative;}
.search-close{position:absolute;top:25px;right:40px;font-size:30px;font-family:"Karma", serif;cursor:pointer;background:#e6e6e6;width:42px;height:42px;border-radius:50%;display:flex;justify-content:center;align-items:center;}
.search-container{width:70%;max-width:900px;}
.search-input-wrapper{position:relative;width:100%;}
.search-input{width:100%;border:none;border-bottom:2px solid #333;background:transparent;font-size:28px;font-family:"Karma", serif;padding:10px 0;outline:none;}
.search-icon{position:absolute;right:10px;top:8px;font-size:30px;cursor:pointer;}
.search-button{margin-top:40px;background:#7a6b23;color:#fff;border:none;padding:14px 60px;font-size:20px;font-family:"Karma", serif;border-radius:28px;cursor:pointer;transition:.3s ease;}
.search-button:hover{background:#64581d;}
.search-results{margin-top:28px;max-height:35vh;overflow-y:auto;font-family:"Jaldi", sans-serif;font-size:16px;}
.search-result-item{padding:10px 0;border-bottom:1px solid #ccc;cursor:pointer;}
.search-result-item-title{font-weight:700;}
.search-noresult{color:#777;font-style:italic;margin-top:10px;}

.footer-full{background:#CBC9D3;padding:12px 0;}
.footer-container{max-width:1200px;margin:auto;padding:6px 40px;display:flex;justify-content:space-between;align-items:flex-start;font-family:"Gantari", sans-serif;}
.footer-left{display:flex;gap:10px;}
.footer-logo{height:65px;}
.footer-address{line-height:1.2;}
.footer-address b{color:#1a355c;font-size:22px;font-family:Georgia, serif;}
.footer-right{display:grid;grid-template-columns:.5fr .5fr;grid-template-rows:auto auto;gap:20px 18px;align-items:center;}
.footer-item{display:flex;align-items:center;gap:10px;}
.footer-icon{width:22px;height:auto;}
</style>
</head>
<body>

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
      <a href="prodi.php">Program Studi</a>
      <a href="biaya.php">Biaya</a>

      <div class="menu-info">
        <a href="info.php" class="info-link">Info <span class="caret">⌄</span></a>
        <div class="info-dropdown">
          <a href="info.php">Jadwal Penerimaan</a>
          <a href="pengumuman.php">Pengumuman</a>
          <a href="<?= htmlspecialchars($kartuHref) ?>">Kartu Peserta</a>
        </div>
      </div>

      <!-- ✅ Daftar SELALU tampil -->
      <a href="daftar.php">Daftar</a>

      <!-- ✅ Login berubah jadi Dashboard -->
      <a href="<?= htmlspecialchars($authHref) ?>" class="login"><?= htmlspecialchars($authText) ?></a>
    </div>
  </div>
</div>

<div class="main-panel">
  <div class="dashboard-page">
    <div class="dashboard-container">

      <div class="dashboard-top">
        <div class="dashboard-greet">
          <h1>Selamat Datang, <?= htmlspecialchars($nama) ?> !</h1>
          <div class="sub">No Pendaftaran :<?= (int)$user['id'] ?> | Program Studi: <?= htmlspecialchars($prodi) ?></div>
        </div>

        <form action="logout.php" method="post">
          <button type="submit" class="btn-logout">Logout</button>
        </form>
      </div>

      <div class="dashboard-grid">
        <div class="left-col">
          <div class="profile-row">
            <img class="avatar" src="<?= htmlspecialchars($fotoUrl) ?>" alt="Foto Profil">
            <div>
              <div class="profile-name"><?= htmlspecialchars($nama) ?></div>
              <div class="profile-email"><?= htmlspecialchars($email) ?></div>
            </div>
          </div>

          <div class="side-menu">
            <a class="side-link active" href="dashboard.php">Dashboard</a>
            <a class="side-link" href="<?= htmlspecialchars($kartuHref) ?>">Data Diri</a>
            <a class="side-link" href="snbp.php">Upload Berkas</a>
            <a class="side-link" href="pengumuman.php">Pengumuman</a>
          </div>
        </div>

        <div class="right-col">
          <div class="box">
            <div class="status-label">STATUS PENDAFTARAN :</div>
            <div class="status-value">MENUNGGU VERIFIKASI DOKUMEN</div>
          </div>

          <div class="box">
            <div class="box-title">PROGRES PENDAFTARAN</div>
            <div class="progress-list">
              <div class="progress-item">
                <svg class="icon-24" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2">
                  <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                  <path d="M7 12l3 3 7-7"></path>
                </svg>
                <span>ISI DATA DIRI</span>
              </div>

              <div class="progress-item">
                <svg class="icon-24" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2">
                  <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                  <path d="M7 12l3 3 7-7"></path>
                </svg>
                <span>UPLOAD DOKUMEN</span>
              </div>

              <div class="progress-item">
                <svg class="icon-24" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2">
                  <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                </svg>
                <span>REGISTRASI</span>
              </div>
            </div>
          </div>

          <div class="box">
            <div class="box-title">JADWAL PENTING</div>
            <div class="progress-item">
              <svg class="icon-24" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                <path d="M16 2v4M8 2v4M3 10h18"></path>
              </svg>
              <span class="muted">Batas Akhir Unggah Berkas : 30 Februari 2026</span>
            </div>
          </div>

          <div class="box">
            <div class="box-title">INFORMASI PEMBAYARAN</div>
            <div class="pay-lines">
              <div>Jumlah Tagihan : Rp. 3.500.000</div>
              <div>Status : Belum Lunas</div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

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

<div class="search-overlay" id="searchOverlay">
  <div class="search-panel">
    <div class="search-close" onclick="closeSearch()">X</div>
    <div class="search-container">
      <div class="search-input-wrapper">
        <input id="searchInput" type="text" class="search-input" placeholder="Type your search" />
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

  // ✅ Daftar selalu ada di search
  { title: "Daftar", url: "daftar.php", keywords: ["daftar", "pendaftaran", "registrasi"] },

  // ✅ Login -> Dashboard
  {
    title: "<?= $isLoggedIn ? 'Dashboard' : 'Login' ?>",
    url: "<?= $isLoggedIn ? 'dashboard.php' : 'login.php' ?>",
    keywords: ["<?= $isLoggedIn ? 'dashboard' : 'login' ?>", "akun", "masuk", "profil"]
  },

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
    const inKeywords = (page.keywords || []).some(k => (k || "").toLowerCase().includes(keyword));
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

document.getElementById("searchInput").addEventListener("keydown", function(e){
  if(e.key === "Enter"){
    e.preventDefault();
    doSearch();
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
