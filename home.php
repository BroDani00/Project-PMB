<?php
session_start(); // ✅ INJEK: wajib agar bisa baca session last_pendaftaran_id

// ======================= SETUP DATABASE & API ULASAN =======================
$host = "localhost";
$user = "root";           // ganti jika beda
$pass = "";               // ganti jika ada password
$db   = "pmb_udsa";       // pastikan database ini sudah ada

$conn = @new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    // Kalau API yang dipanggil, balikin error text
    if (isset($_GET['reviews_api'])) {
        http_response_code(500);
        echo "error: db connection failed - " . $conn->connect_error;
        exit;
    }
}

// Buat tabel reviews kalau belum ada
$conn->query("
    CREATE TABLE IF NOT EXISTS reviews (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        rating INT NOT NULL,
        review_text TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        likes INT DEFAULT 0,
        dislikes INT DEFAULT 0
    )
");

// ======================= API HANDLER (AJAX) =======================
if (isset($_GET['reviews_api'])) {
    $action = $_GET['reviews_api'];

    // LIST ULASAN
    if ($action === 'list') {
        header('Content-Type: application/json');
        $rows = [];
        $res = $conn->query("SELECT id, username, rating, review_text, DATE_FORMAT(created_at, '%d/%m/%y %H:%i') AS created_at, likes, dislikes FROM reviews ORDER BY created_at DESC");
        if ($res) {
            while ($r = $res->fetch_assoc()) {
                $rows[] = $r;
            }
        }
        echo json_encode($rows);
        exit;
    }

    // SIMPAN ULASAN BARU
    if ($action === 'save' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: text/plain');

        $username = trim($_POST['username'] ?? '');
        $rating   = intval($_POST['rating'] ?? 0);
        $text     = trim($_POST['review_text'] ?? '');

        if ($username === '' || $text === '' || $rating < 1 || $rating > 5) {
            echo "error: invalid data";
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO reviews (username, rating, review_text) VALUES (?, ?, ?)");
        if (!$stmt) {
            echo "error: prepare failed - " . $conn->error;
            exit;
        }
        $stmt->bind_param("sis", $username, $rating, $text);

        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error: execute failed - " . $stmt->error;
        }
        $stmt->close();
        exit;
    }

    // LIKE / DISLIKE
    if ($action === 'react' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: text/plain');

        $id   = intval($_POST['id'] ?? 0);
        $type = $_POST['type'] ?? '';

        if ($id <= 0 || !in_array($type, ['like', 'dislike'])) {
            echo "error: invalid data";
            exit;
        }

        if ($type === 'like') {
            $sql = "UPDATE reviews SET likes = likes + 1 WHERE id = $id";
        } else {
            $sql = "UPDATE reviews SET dislikes = dislikes + 1 WHERE id = $id";
        }

        if ($conn->query($sql)) {
            echo "success";
        } else {
            echo "error: update failed - " . $conn->error;
        }
        exit;
    }

    // kalau action tidak dikenali
    echo "error: unknown action";
    exit;
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
<title>PMB UDSA</title>

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

/* ================= WELCOME ================= */

.welcome{
    display:flex;
    align-items:center;
    padding:50px 40px 40px;
    gap:40px;
    background:#f6f2d9;
}
.welcome img{
    height:250px;
    object-fit:contain;
}
.welcome-text{
    line-height:1.2;
}
.welcome-text h1{
    font-size:64px;
    font-family:'Miltonian Tattoo', serif;
    color:#6b4d09;
}
.welcome-text h2{
    font-size:36px;
    font-family:'Miltonian Tattoo', serif;
    color:#6b4d09;
}
.welcome-text h3{
    font-size:48px;
    font-family:'Katibeh', serif;
    color:#0f6d1a;
}

/* ================= BANNER ================= */

.banner{
    position:relative;
}
.banner img{
    width:100%;
    height:360px;
    object-fit:cover;
}
.quote-content{
    position:absolute;
    bottom:28px;
    left:0;
    right:0;
    padding:0 40px;
    display:flex;
    justify-content:space-between;
    align-items:flex-end;
}

.quote{
    width:45%;
    max-width:520px;
    color:#FFFFFF;
    font-family:"Katibeh", serif;
    font-size:30px;
    text-shadow:1px 1px 4px rgba(0,0,0,.8);
}

.quote-content button{
    background:#57768D;
    color:#ffffff;
    font-family:"Katibeh",serif;
    font-size:16px;
    font-weight:400;
    padding:12px 38px;
    border:none;
    border-radius:10px;
    text-decoration:none;
    display:inline-block;
    cursor:pointer;
    transition:background .3s ease, transform .2s ease;
}

.quote-content button:hover{
    background:#567080;
    transform:scale(1.02);
}

/* ================= INFO BOX ================= */

.info-box{
    display:flex;
    background:var(--info-box);
    padding:25px 40px;
    justify-content:space-between;
}
.info-box .item{
    color:#FFFFFF;
    flex:1;
    display:flex;
    align-items:center;
    gap:18px;
}
.info-box .item:not(:first-child){
    border-left:2px solid #d7c28d;
}

.icon-container img{ height:60px; }

/* ======== REVIEW & RATING SECTION ======== */

.review-section{
    background:#f3efdd;
    padding:40px 40px 60px;
    font-family:"Katibeh", serif;
}

.review-title{
    font-size:36px;
    font-weight:400;
    margin-bottom:20px;
}

.review-top{
    background:#ffffff;
    padding:24px 26px 30px;
    max-width:560px;
}

.rating-row{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:12px;
    font-family:"Jaldi", sans-serif;
}

.rating-row:last-child{
    margin-bottom:0;
}

.rating-label{
    width:18px;
    font-weight:700;
}

.rating-bar-bg{
    flex:1;
    height:14px;
    background:#e4e4e4;
    border-radius:999px;
    overflow:hidden;
}

.rating-bar-fill{
    height:100%;
    background:#e9b947;
    border-radius:999px;
}

.rating-percent{
    width:50px;
    text-align:right;
    font-size:14px;
}

/* Lebar bar sesuai persentase (saat ini statis) */
.bar-5{ width:95%; }
.bar-4{ width:80%; }
.bar-3{ width:48%; }
.bar-2{ width:10%; }
.bar-1{ width:5%; }

/* ULASAN */
.review-list-wrapper{
    margin-top:28px;
    max-width:720px;
}

.review-subtitle{
    font-family:"Katibeh", sans-serif;
    font-size:20px;
    font-weight:400;
    margin-bottom:16px;
}

/* form ulasan */
.review-form{
    background:#F1ECCF;
    border-radius:15px;
    padding:14px 14px 16px;
    margin-bottom:22px;
    font-family:"Jaldi", sans-serif;
}

.review-form-row{
    display:flex;
    gap:12px;
    margin-bottom:10px;
    flex-wrap:wrap;
}

.review-form input[type="text"],
.review-form select{
    padding:6px 8px;
    border-radius:8px;
    border:1px solid #c9c2a2;
    font-size:14px;
    flex:1;
    min-width:140px;
}

.review-form textarea{
    width:100%;
    min-height:70px;
    padding:8px;
    border-radius:8px;
    border:1px solid #c9c2a2;
    font-size:14px;
    resize:vertical;
    margin-bottom:10px;
}

.review-form button{
    background:#7a6b23;
    border:none;
    color:#fff;
    padding:8px 18px;
    border-radius:999px;
    font-size:14px;
    cursor:pointer;
    font-family:"Jaldi", sans-serif;
}
.review-form button:hover{
    background:#64581d;
}

/* CARD ULASAN */
.review-card{
    display:flex;
    gap:14px;
    margin-bottom:24px;
    font-family:"poppins", sans-serif;
}

.avatar{
    width:38px;
    height:38px;
    border-radius:50%;
    background:#d9d9d9;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
}

.avatar span{
    font-size:18px;
}

.review-content{
    flex:1;
}

.review-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:4px;
}

.review-name{
    font-weight:700;
    font-size:15px;
}

.review-date{
    font-size:13px;
    color:#777;
}

/* bintang */
.stars{
    color:#f1b40a;
    font-size:14px;
    margin-bottom:6px;
}

.review-text{
    font-size:14px;
    line-height:1.6;
    color:#333;
    margin-bottom:8px;
}

.review-actions{
    display:flex;
    gap:14px;
    font-size:13px;
    color:#555;
}

.review-actions span{
    cursor:pointer;
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
    grid-template-columns: 0.5fr 0.5fr;
    grid-template-rows: auto auto;
    gap: 20px 18px;
    align-items: center;
}

.footer-item {
    display: flex;
    align-items: center;
    gap: 10px;
}

.footer-icon {
    width: 22px;
    height: auto;
}


/* responsive sederhana */
@media (max-width:900px){
    .welcome{
        flex-direction:column;
        padding:30px 16px;
    }
    .banner img{
        height:240px;
    }
    .info-box{
        flex-direction:column;
        gap:18px;
    }
    .info-box .item:not(:first-child){
        border-left:none;
        border-top:2px solid #d7c28d;
        padding-top:10px;
    }
    .review-section{
        padding:30px 16px 40px;
    }
    .review-top,
    .review-list-wrapper{
        max-width:100%;
    }
}

/* ================= SEARCH OVERLAY ================= */

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
            <a href="home.php" class="active">Home</a>
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
            <a href="login.php" class="login">Login</a>
        </div>
    </div>
</div>

<!-- MAIN PANEL -->
<div class="main-panel">
    <div class="wrapper">

        <section class="welcome">
            <img src="assets/images/mahasiswa.png">
            <div class="welcome-text">
                <h1>Selamat Datang</h1>
                <h2>Calon Mahasiswa Baru</h2>
                <h3>Universitas Dua Sembilan April</h3>
            </div>
        </section>

        <section class="banner">
            <img src="assets/images/kampus.png">
            <div class="quote-content">
                <div class="quote">
                    "Mulai perjalanan akademikmu di kampus yang unggul dan berintegritas,
                     Wujudkan masa depan cerah bersama UDSA."
                </div>
                <button onclick="window.location.href='prodi.php'">Lihat selengkapnya</button>
            </div>
        </section>

        <section class="info-box">
            <div class="item">
                <div class="icon-container"><img src="assets/images/unggul.png"></div>
                <div>
                    <div class="main-text">Terakreditasi</div>
                    <div class="sub-text">UNGGUL</div>
                </div>
            </div>

            <div class="item">
                <div class="icon-container"><img src="assets/images/prodi.png"></div>
                <div>
                    <div class="main-text">30</div>
                    <div class="sub-text">Program Studi</div>
                </div>
            </div>

            <div class="item">
                <div class="icon-container"><img src="assets/images/dosen.png"></div>
                <div>
                    <div class="main-text">Dosen</div>
                    <div class="sub-text">Profesional</div>
                </div>
            </div>

            <div class="item">
                <div class="icon-container"><img src="assets/images/fasilitas.png"></div>
                <div>
                    <div class="main-text">Fasilitas</div>
                    <div class="sub-text">Modern</div>
                </div>
            </div>
        </section>

        <!-- REVIEW & RATING -->
        <section class="review-section">
            <h2 class="review-title">Review dan Rating Pendaftar</h2>

            <div class="review-top">
                <!-- bar rating 5–1 (statis dulu) -->
                <div class="rating-row">
                    <span class="rating-label">5</span>
                    <div class="rating-bar-bg">
                        <div class="rating-bar-fill bar-5"></div>
                    </div>
                    <span class="rating-percent">95%</span>
                </div>

                <div class="rating-row">
                    <span class="rating-label">4</span>
                    <div class="rating-bar-bg">
                        <div class="rating-bar-fill bar-4"></div>
                    </div>
                    <span class="rating-percent">80%</span>
                </div>

                <div class="rating-row">
                    <span class="rating-label">3</span>
                    <div class="rating-bar-bg">
                        <div class="rating-bar-fill bar-3"></div>
                    </div>
                    <span class="rating-percent">48%</span>
                </div>

                <div class="rating-row">
                    <span class="rating-label">2</span>
                    <div class="rating-bar-bg">
                        <div class="rating-bar-fill bar-2"></div>
                    </div>
                    <span class="rating-percent">10%</span>
                </div>

                <div class="rating-row">
                    <span class="rating-label">1</span>
                    <div class="rating-bar-bg">
                        <div class="rating-bar-fill bar-1"></div>
                    </div>
                    <span class="rating-percent">5%</span>
                </div>
            </div>

            <div class="review-list-wrapper">
                <h3 class="review-subtitle">Ulasan Teratas Pelayanan Kampus UDSA</h3>

                <!-- FORM TULIS ULASAN -->
                <div class="review-form">
                    <div class="review-form-row">
                        <input type="text" id="reviewName" placeholder="Nama kamu">
                        <select id="reviewRating">
                            <option value="5">⭐ 5 - Sangat Puas</option>
                            <option value="4">⭐ 4 - Puas</option>
                            <option value="3">⭐ 3 - Cukup</option>
                            <option value="2">⭐ 2 - Kurang</option>
                            <option value="1">⭐ 1 - Buruk</option>
                        </select>
                    </div>
                    <textarea id="reviewText" placeholder="Tulis ulasan kamu di sini..."></textarea>
                    <button type="button" onclick="submitReview()">Kirim Ulasan</button>
                </div>

                <!-- ULASAN DINAMIS DARI DATABASE -->
                <div id="reviewsContainer"></div>

            </div>
        </section>

    </div>
</div>

<!-- FOOTER -->
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

<!-- SEARCH OVERLAY (SETENGAH HALAMAN) -->
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

// ================== REVIEW: LOAD, SUBMIT, LIKE, DISLIKE ==================

function loadReviews() {
    fetch("home.php?reviews_api=list")
        .then(res => res.json())
        .then(data => {
            let container = document.getElementById("reviewsContainer");
            container.innerHTML = "";

            if (!data || data.length === 0) {
                container.innerHTML = '<div class="review-text" style="font-style:italic;color:#777;">Belum ada ulasan. Jadilah yang pertama menulis ulasan.</div>';
                return;
            }

            data.forEach(r => {
                const stars = "★".repeat(parseInt(r.rating || 0));

                const card = document.createElement("div");
                card.className = "review-card";
                card.innerHTML = `
                    <div class="avatar"><span>👤</span></div>
                    <div class="review-content">
                        <div class="review-header">
                            <span class="review-name">${r.username}</span>
                            <span class="review-date">${r.created_at ?? ""}</span>
                        </div>
                        <div class="stars">${stars}</div>
                        <div class="review-text">${r.review_text}</div>
                        <div class="review-actions">
                            <span class="like-btn" data-id="${r.id}">
                                👍 <span class="like-count">${r.likes}</span>
                            </span>
                            <span class="dislike-btn" data-id="${r.id}">
                                👎 <span class="dislike-count">${r.dislikes}</span>
                            </span>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });

            // event listener tombol like
            document.querySelectorAll(".like-btn").forEach(btn => {
                btn.addEventListener("click", function() {
                    sendReaction(this.dataset.id, "like", this);
                });
            });

            // event listener tombol dislike
            document.querySelectorAll(".dislike-btn").forEach(btn => {
                btn.addEventListener("click", function() {
                    sendReaction(this.dataset.id, "dislike", this);
                });
            });
        })
        .catch(err => {
            console.error("Gagal load review:", err);
        });
}

function submitReview() {
    const nameEl   = document.getElementById("reviewName");
    const ratingEl = document.getElementById("reviewRating");
    const textEl   = document.getElementById("reviewText");

    const username = nameEl.value.trim();
    const rating   = ratingEl.value;
    const text     = textEl.value.trim();

    if (username === "" || text === "") {
        alert("Nama dan isi ulasan wajib diisi.");
        return;
    }

    const formData = new FormData();
    formData.append("username", username);
    formData.append("rating", rating);
    formData.append("review_text", text);

    fetch("home.php?reviews_api=save", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(resp => {
        console.log("Response save:", resp);
        if (resp.trim() === "success") {
            nameEl.value = "";
            ratingEl.value = "5";
            textEl.value = "";
            loadReviews();
        } else {
            alert("Gagal menyimpan ulasan.\nServer: " + resp);
        }
    })
    .catch(err => {
        console.error("Error simpan ulasan:", err);
        alert("Terjadi kesalahan koneksi ke server.");
    });
}

function sendReaction(id, type, element) {
    const formData = new FormData();
    formData.append("id", id);
    formData.append("type", type);

    fetch("home.php?reviews_api=react", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(resp => {
        console.log("Response react:", resp);
        if (resp.trim() === "success") {
            if (type === "like") {
                const countSpan = element.querySelector(".like-count");
                countSpan.innerText = parseInt(countSpan.innerText) + 1;
            } else {
                const countSpan = element.querySelector(".dislike-count");
                countSpan.innerText = parseInt(countSpan.innerText) + 1;
            }
        } else {
            alert("Gagal memproses like/dislike.\nServer: " + resp);
        }
    })
    .catch(err => {
        console.error("Error react:", err);
        alert("Terjadi kesalahan koneksi ke server.");
    });
}

// ================== DOM READY ==================
document.addEventListener("DOMContentLoaded", function(){
    // enter to search
    const input = document.querySelector(".search-input");
    if(input){
        input.addEventListener("keydown", function(e){
            if(e.key === "Enter"){
                doSearch();
            }
        });
    }

    // load review dari database
    loadReviews();
});
</script>

</body>
</html>
