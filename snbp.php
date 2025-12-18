<?php
session_start();
require 'koneksi.php';

$err = "";

// ✅ INJEK: tombol auth (Login/Dashboard) + dipakai juga untuk search overlay
$isLoggedIn = !empty($_SESSION['last_pendaftaran_id']);
$authHref   = $isLoggedIn ? "dashboard.php" : "login.php";
$authText   = $isLoggedIn ? "Dashboard" : "Login";

// DAFTAR PRODI (dipakai untuk prodi1 & prodi2)
$daftar_prodi = [
    "Teknologi Informasi",
    "Sistem Informasi",
    "Data Science",
    "Biologi",
    "Matematika",
    "Fisika",
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama        = trim($_POST['nama'] ?? '');
    $nisn        = trim($_POST['nisn'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $hp          = trim($_POST['hp'] ?? '');

    $tgllahir_raw = trim($_POST['tgllahir'] ?? '');
    $tempatlahir  = trim($_POST['tempatlahir'] ?? '');
    $asal         = trim($_POST['asal'] ?? '');

    $provinsi   = trim($_POST['provinsi'] ?? '');
    $kabupaten  = trim($_POST['kabupaten'] ?? '');
    $kecamatan  = trim($_POST['kecamatan'] ?? '');
    $alamat     = trim($_POST['alamat'] ?? '');

    $prodi1     = trim($_POST['prodi1'] ?? '');
    $prodi2     = trim($_POST['prodi2'] ?? '');

    // konversi tgllahir: dd-mm-yyyy -> Y-m-d
    $tgllahir = !empty($_POST['tgllahir']) ? $_POST['tgllahir'] : null;
    if ($tgllahir_raw !== '') {
        $dt = DateTime::createFromFormat('d-m-Y', $tgllahir_raw);
        if ($dt) $tgllahir = $dt->format('Y-m-d');
    }

    if ($nama === '' || $email === '' || $hp === '' || $nisn === '' || $prodi1 === '' || $prodi2 === '') {
        $err = "wajib_isi";
    } elseif ($prodi1 === $prodi2) {
        $err = "prodi_sama";
    } else {

        // ===== UPLOAD FOTO (opsional) =====
        // ✅ SIMPAN DI DB: hanya NAMA FILE
        // ✅ SIMPAN DI FOLDER: assets/upload/
        $fotoDbName = null;

        if (!empty($_FILES['foto']['name'])) {
            $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
            $maxSize = 2 * 1024 * 1024; // 2MB

            if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
                $err = "foto_gagal";
            } elseif ($_FILES['foto']['size'] > $maxSize) {
                $err = "foto_kebesaran";
            } else {
                $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
                if (!in_array($ext, $allowedExt, true)) {
                    $err = "foto_tipe";
                } else {
                    // ✅ folder upload baru
                    $uploadDir = __DIR__ . "/assets/upload";
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0775, true);
                    }

                    $safeName = "snbp_" . time() . "_" . bin2hex(random_bytes(4)) . "." . $ext;
                    $dest = $uploadDir . "/" . $safeName;

                    if (move_uploaded_file($_FILES['foto']['tmp_name'], $dest)) {
                        $fotoDbName = $safeName; // ✅ simpan nama file saja
                    } else {
                        $err = "foto_gagal";
                    }
                }
            }
        }

        if ($err === "") {
            $stmt = $conn->prepare("
                INSERT INTO pendaftaran_snbp
                (nama, nisn, email, hp, tgllahir, tempatlahir, asal,
                 foto, provinsi, kabupaten, kecamatan, alamat, prodi1, prodi2)
                VALUES
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");

            if (!$stmt) die('Gagal prepare statement: ' . $conn->error);

            $stmt->bind_param(
                "ssssssssssssss",
                $nama, $nisn, $email, $hp, $tgllahir, $tempatlahir, $asal,
                $fotoDbName, $provinsi, $kabupaten, $kecamatan, $alamat, $prodi1, $prodi2
            );
            if ($stmt->execute()) {
                $last_id = $stmt->insert_id;

                // SIMPAN ID TERAKHIR KE SESSION -> NAVBAR "KARTU PESERTA" BISA LANGSUNG TAMPILKAN KARTU
                $_SESSION['last_pendaftaran_id'] = $last_id;

                $stmt->close();
                $conn->close();

                header("Location: kartu.php?id=" . $last_id);
                exit;
            } else {
                $err = "db_error";
            }
        }
    }
}

// ✅ INJEK: LINK NAVBAR KARTU PESERTA DINAMIS
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
<title>Pendaftaran Online - PMB UDSA</title>

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
.topbar-right { display:flex; gap:32px; }
.topbar-item { display:flex; align-items:center; gap:6px; }
.topbar-icon { width:16px; height:16px; opacity:.85; }

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

/* ============= MAIN PANEL (FORM) ============= */
.main-panel{
    background:#f3ebc8;
    padding:40px 0 60px;
}
.wrapper{
    max-width:1200px;
    margin:0 auto;
}
.form-card{
    background:#ffffff;
    margin:0 40px;
    padding:40px 60px 45px;
    font-family:"Katibeh", serif;
}
.form-heading{
    font-size:40px;
    font-weight:400;
    margin-bottom:4px;
    color:#1a1a1a;
}
.form-subtitle{
    font-size:32px;
    font-weight:400;
    margin-bottom:26px;
    color:#5c29c5;
}

/* 2 kolom */
.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    column-gap:80px;
    row-gap:18px;
}

/* baris field */
.form-group{
    display:grid;
    grid-template-columns: 160px 1fr;
    align-items:center;
    column-gap:16px;
    margin-bottom:14px;
}
.form-label{
    font-size:26px;
    font-weight:400;
    color:#000;
    letter-spacing:0.3px;
    line-height:1.2;
}

/* INPUT & SELECT */
.form-control,
.form-select{
    width:100%;
    padding:10px 12px;
    border:2px solid #000;
    border-radius:0;
    font-size:16px;
    font-weight:400;
    color:#000;
    background:#fafafa;
    font-family:"Katibeh", serif;
}
.form-control::placeholder{
    color:#9d9d9d;
    font-style:italic;
}
input[type="file"].form-control{
  padding:8px 10px;
  background:#fafafa;
}

/* BUTTON */
.form-actions{
    margin-top:26px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.btn{
    border:none;
    border-radius:8px;
    padding:12px 46px;
    font-size:19px;
    font-weight:400;
    cursor:pointer;
    font-family:"Katibeh", serif;
}
.btn-kembali{ background:#e01616; color:#fff; }
.btn-daftar{ background:#7db5ff; color:#000; }

/* RESPONSIVE */
@media (max-width: 900px){
  .form-card{ margin:0 16px; padding:28px 18px; }
  .form-grid{ grid-template-columns:1fr; column-gap:0; }
  .form-group{ grid-template-columns: 140px 1fr; }

  .nav-container{ flex-wrap:wrap; }
  .menu-center{ order:3; flex-basis:100%; justify-content:flex-start; }
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
      <a href="career.php">Career</a>
      <a href="berita.php">Berita</a>
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

      <!-- ✅ INJEK: Login → Dashboard dinamis -->
      <a href="<?= htmlspecialchars($authHref) ?>" class="login"><?= htmlspecialchars($authText) ?></a>
    </div>
  </div>
</div>

<!-- MAIN FORM -->
<div class="main-panel">
  <div class="wrapper">
    <section class="form-card">
      <h1 class="form-heading">Pendaftaran Online</h1>
      <h2 class="form-subtitle">Jalur SNPMB SNBP</h2>

      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-grid">

          <!-- KOLOM KIRI -->
          <div>
            <div class="form-group">
              <label class="form-label" for="nama">Nama</label>
              <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap">
            </div>

            <div class="form-group">
              <label class="form-label" for="nisn">NISN</label>
              <input type="text" id="nisn" name="nisn" class="form-control" placeholder="NISN">
            </div>

            <div class="form-group">
              <label class="form-label" for="email">Email</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="Email">
            </div>

            <div class="form-group">
              <label class="form-label" for="tgllahir">Tanggal Lahir</label>
              <input type="date" id="tgllahir" name="tgllahir" class="form-control" placeholder="dd-mm-yy">
            </div>

            <div class="form-group">
              <label class="form-label" for="tempatlahir">Tempat Lahir</label>
              <input type="text" id="tempatlahir" name="tempatlahir" class="form-control" placeholder="">
            </div>

            <div class="form-group">
              <label class="form-label" for="hp">No. HP<br>(WA Aktif)</label>
              <input type="text" id="hp" name="hp" class="form-control" placeholder="">
            </div>

            <div class="form-group">
              <label class="form-label" for="asal">Asal Sekolah</label>
              <input type="text" id="asal" name="asal" class="form-control" placeholder="">
            </div>
          </div>

          <!-- KOLOM KANAN -->
          <div>
            <div class="form-group">
              <label class="form-label" for="foto">Upload foto</label>
              <input type="file" id="foto" name="foto" class="form-control" accept=".jpg,.jpeg,.png,.webp">
            </div>

            <div class="form-group">
              <label class="form-label" for="provinsi">Provinsi</label>
              <select id="provinsi" name="provinsi" class="form-select">
                <option value="">Pilih Provinsi</option>
              </select>
            </div>

            <div class="form-group">
              <label class="form-label" for="kabupaten">Kabupaten</label>
              <select id="kabupaten" name="kabupaten" class="form-select" disabled>
                <option value="">Pilih Kabupaten/Kota</option>
              </select>
            </div>

            <div class="form-group">
              <label class="form-label" for="kecamatan">Kecamatan</label>
              <select id="kecamatan" name="kecamatan" class="form-select" disabled>
                <option value="">Pilih Kecamatan</option>
              </select>
            </div>

            <div class="form-group">
              <label class="form-label" for="alamat">Alamat</label>
              <input type="text" id="alamat" name="alamat" class="form-control" placeholder="">
            </div>

            <div class="form-group">
              <label class="form-label" for="prodi1">Pilihan Prodi 1</label>
              <select id="prodi1" name="prodi1" class="form-select" required>
                <option value="">Pilih Prodi</option>
                <?php foreach($daftar_prodi as $prodi): ?>
                  <option value="<?= htmlspecialchars($prodi) ?>"><?= htmlspecialchars($prodi) ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label class="form-label" for="prodi2">Pilihan Prodi 2</label>
              <select id="prodi2" name="prodi2" class="form-select" required>
                <option value="">Pilih Prodi</option>
                <?php foreach($daftar_prodi as $prodi): ?>
                  <option value="<?= htmlspecialchars($prodi) ?>"><?= htmlspecialchars($prodi) ?></option>
                <?php endforeach; ?>
              </select>
            </div>

          </div>

        </div>

        <div class="form-actions">
          <button type="button" class="btn btn-kembali" onclick="history.back()">Kembali</button>
          <button type="submit" class="btn btn-daftar">Daftar</button>
        </div>
      </form>
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
// ================== DATA HALAMAN NAVBAR/TOPBAR UNTUK SEARCH ==================
const NAV_PAGES = [
  { title: "Home", url: "home.php", keywords: ["home", "beranda", "utama", "pmb"] },
  { title: "Program Studi", url: "prodi.php", keywords: ["prodi", "program studi", "jurusan"] },
  { title: "Biaya", url: "biaya.php", keywords: ["biaya", "uang kuliah", "ukt", "pembayaran"] },
  { title: "Info / Jadwal Penerimaan", url: "info.php", keywords: ["info", "jadwal", "penerimaan", "pengumuman"] },
  { title: "Pengumuman", url: "pengumuman.php", keywords: ["pengumuman", "hasil", "info terbaru"] },
  { title: "Daftar", url: "daftar.php", keywords: ["daftar", "pendaftaran", "registrasi"] },

  // ✅ INJEK: Login/Dashboard dinamis untuk search overlay
  {
    title: "<?= $isLoggedIn ? 'Dashboard' : 'Login' ?>",
    url: "<?= $isLoggedIn ? 'dashboard.php' : 'login.php' ?>",
    keywords: ["<?= $isLoggedIn ? 'dashboard' : 'login' ?>", "masuk", "akun", "profil"]
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

<!-- ================== WILAYAH INDONESIA: PROVINSI -> KAB/KOTA -> KECAMATAN ================== -->
<script>
document.addEventListener("DOMContentLoaded", () => {
  const provSelect = document.getElementById("provinsi");
  const kabSelect  = document.getElementById("kabupaten");
  const kecSelect  = document.getElementById("kecamatan");
  if (!provSelect || !kabSelect || !kecSelect) return;

  const API_BASE = "wilayah_proxy.php?path=";

  function setLoading(selectEl, placeholderText) {
    selectEl.innerHTML = `<option value="">${placeholderText}</option>`;
    selectEl.disabled = true;
  }
  function setReady(selectEl) { selectEl.disabled = false; }

  function fillOptions(selectEl, placeholderText, items) {
    selectEl.innerHTML = `<option value="">${placeholderText}</option>`;
    items.forEach(item => {
      const opt = document.createElement("option");
      opt.textContent = item.name;
      opt.value = item.name;
      opt.dataset.id = item.id;
      selectEl.appendChild(opt);
    });
  }

  async function fetchJSON(url) {
    const res = await fetch(url, { cache: "no-store" });
    if (!res.ok) throw new Error("Gagal load data wilayah");
    return res.json();
  }

  async function loadProvinces() {
    try {
      setLoading(provSelect, "Memuat Provinsi...");
      setLoading(kabSelect, "Pilih Kabupaten/Kota");
      setLoading(kecSelect, "Pilih Kecamatan");

      const provs = await fetchJSON(`${API_BASE}provinces.json`);
      fillOptions(provSelect, "Pilih Provinsi", provs);
      setReady(provSelect);

      kabSelect.innerHTML = `<option value="">Pilih Kabupaten/Kota</option>`;
      kecSelect.innerHTML = `<option value="">Pilih Kecamatan</option>`;
      kabSelect.disabled = true;
      kecSelect.disabled = true;
    } catch (e) {
      provSelect.innerHTML = `<option value="">Gagal memuat provinsi</option>`;
      console.error(e);
    }
  }

  async function loadRegenciesByProvinceId(provId) {
    try {
      setLoading(kabSelect, "Memuat Kabupaten/Kota...");
      setLoading(kecSelect, "Pilih Kecamatan");

      const kabs = await fetchJSON(`${API_BASE}regencies/${provId}.json`);
      fillOptions(kabSelect, "Pilih Kabupaten/Kota", kabs);
      setReady(kabSelect);

      kecSelect.innerHTML = `<option value="">Pilih Kecamatan</option>`;
      kecSelect.disabled = true;
    } catch (e) {
      kabSelect.innerHTML = `<option value="">Gagal memuat kabupaten/kota</option>`;
      console.error(e);
    }
  }

  async function loadDistrictsByRegencyId(kabId) {
    try {
      setLoading(kecSelect, "Memuat Kecamatan...");
      const kecs = await fetchJSON(`${API_BASE}districts/${kabId}.json`);
      fillOptions(kecSelect, "Pilih Kecamatan", kecs);
      setReady(kecSelect);
    } catch (e) {
      kecSelect.innerHTML = `<option value="">Gagal memuat kecamatan</option>`;
      console.error(e);
    }
  }

  provSelect.addEventListener("change", () => {
    const opt = provSelect.options[provSelect.selectedIndex];
    const provId = opt?.dataset?.id;

    if (!provId) {
      kabSelect.innerHTML = `<option value="">Pilih Kabupaten/Kota</option>`;
      kecSelect.innerHTML = `<option value="">Pilih Kecamatan</option>`;
      kabSelect.disabled = true;
      kecSelect.disabled = true;
      return;
    }
    loadRegenciesByProvinceId(provId);
  });

  kabSelect.addEventListener("change", () => {
    const opt = kabSelect.options[kabSelect.selectedIndex];
    const kabId = opt?.dataset?.id;

    if (!kabId) {
      kecSelect.innerHTML = `<option value="">Pilih Kecamatan</option>`;
      kecSelect.disabled = true;
      return;
    }
    loadDistrictsByRegencyId(kabId);
  });

  loadProvinces();
});

// disable prodi2 if same as prodi1
const prodi1 = document.querySelector('select[name="prodi1"]');
const prodi2 = document.querySelector('select[name="prodi2"]');

function syncProdi() {
  if (!prodi1 || !prodi2) return;
  [...prodi2.options].forEach(opt => {
    opt.disabled = opt.value && opt.value === prodi1.value;
  });
}
if (prodi1) prodi1.addEventListener("change", syncProdi);
</script>

</body>
</html>
