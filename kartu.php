<?php
require 'koneksi.php';

if (!isset($_GET['id'])) {
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

// bikin nomor peserta
$nomor_peserta = "SNBP-2026-" . str_pad($data['id'], 4, "0", STR_PAD_LEFT);

$nama     = $data['nama']   ?? '-';
$nisn     = $data['nisn']   ?? '-';
$sekolah  = $data['asal']   ?? '-';
$kabkota  = "-";            // belum ada di DB, nanti bisa ditambah kolom
$provinsi = "-";            // sama
$prodi1   = $data['prodi1'] ?? 'Belum diisi';
$prodi2   = $data['prodi2'] ?? 'Belum diisi';

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
    --navbar-bg: #d6d4de;
    --pmb-color: #7c6c2d;
    --udsa-color: #1a355c;
    --login-btn: #7a6b23;
}

/* ============= TOPBAR (TIDAK DIUBAH) ============= */

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

/* ================= NAVBAR (TIDAK DIUBAH) ================= */

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
    transition:border .3s ease, background .3s ease;
}
.menu a.login:hover{ border-color:#cc0000 !important; }

/* ============= MAIN PANEL (KARTU PESERTA) ============= */

.main-panel{
    background:#f3ebc8;
    padding:50px 0 70px;
}
.wrapper{
    max-width:1200px;
    margin:0 auto;
}

/* CARD BESAR */
.kartu-container{
    background:#ffffff;
    margin:0 40px;
    padding:35px 60px 45px;
    font-family:"Jaldi", serif;
}

/* JUDUL */
.kartu-title{
    font-size:24px;
    font-weight:700;
    letter-spacing:0.5px;
    margin-bottom:24px;
}

/* BAGIAN IDENTITAS PESERTA */
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
    font-size:15px;
    font-weight:700;
    text-transform:uppercase;
}
.kartu-value{
    font-size:18px;
    font-weight:700;
}

/* SECTION PILIHAN PRODI */
.kartu-subtitle{
    font-size:18px;
    font-weight:700;
    margin:28px 0 14px;
}

/* TABEL PILIHAN PRODI */
.kartu-prodi{
    border:1px solid #000;
    border-collapse:collapse;
    width:100%;
    font-size:17px;
}
.kartu-prodi tr{
    border-bottom:1px solid #000;
}
.kartu-prodi td{
    padding:12px 18px;
    border-right:1px solid #000;
}
.kartu-prodi td:last-child{
    border-right:none;
}

/* HEADER PILIHAN 1 & 2 */
.kartu-prodi-header{
    font-weight:700;
    text-align:center;
}

/* KODE & NAMA PRODI */
.kartu-prodi-nama{
    font-weight:700;
}
.kartu-prodi-ptn{
    font-size:16px;
    color:#777;
    text-transform:uppercase;
}

/* ============= FOOTER (TIDAK DIUBAH) ============= */

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
</style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
    <div class="topbar-content">
        <div>
            <a href="#">www.udsa.ac.id</a>
            <a href="#">Career</a>
            <a href="#">Berita</a>
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
            <a href="prodi.php">Program Studi</a>
            <a href="biaya.php">Biaya</a>
            <a href="info.php">Info</a>
            <a href="daftar.php">Daftar</a>
            <a href="login.php" class="login">Login</a>
        </div>
    </div>
</div>

<!-- MAIN KARTU PESERTA -->
<div class="main-panel">
    <div class="wrapper">
        <section class="kartu-container">

            <h1 class="kartu-title">KARTU PESERTA SNBP 2026</h1>

            <!-- IDENTITAS PESERTA -->
            <div class="kartu-identitas">
                <!-- FOTO -->
                <div class="kartu-photo">
                    <div class="kartu-photo-inner">
                        &#128100;
                    </div>
                </div>

                <!-- NOMOR PESERTA -->
                <div class="kartu-cell">
                    <div class="kartu-label">NOMOR PESERTA</div>
                    <div class="kartu-value">
                        <?php echo htmlspecialchars($nomor_peserta); ?>
                    </div>
                </div>

                <!-- NAMA SISWA -->
                <div class="kartu-cell">
                    <div class="kartu-label">NAMA SISWA</div>
                    <div class="kartu-value">
                        <?php echo htmlspecialchars($nama); ?>
                    </div>
                </div>

                <!-- NISN -->
                <div class="kartu-cell">
                    <div class="kartu-label">NISN</div>
                    <div class="kartu-value">
                        <?php echo htmlspecialchars($nisn); ?>
                    </div>
                </div>

                <!-- SEKOLAH -->
                <div class="kartu-cell">
                    <div class="kartu-label">SEKOLAH</div>
                    <div class="kartu-value">
                        <?php echo htmlspecialchars($sekolah); ?>
                    </div>
                </div>

                <!-- KAB/KOTA -->
                <div class="kartu-cell">
                    <div class="kartu-label">KABUPATEN/KOTA</div>
                    <div class="kartu-value">
                        <?php echo htmlspecialchars($kabkota); ?>
                    </div>
                </div>

                <!-- PROVINSI -->
                <div class="kartu-cell">
                    <div class="kartu-label">PROVINSI</div>
                    <div class="kartu-value">
                        <?php echo htmlspecialchars($provinsi); ?>
                    </div>
                </div>
            </div>

            <!-- PILIHAN PRODI -->
            <h2 class="kartu-subtitle">Pilihan PTN &amp; Program Studi</h2>

            <table class="kartu-prodi">
                <tr>
                    <td class="kartu-prodi-header">PILIHAN 1</td>
                    <td class="kartu-prodi-header">PILIHAN 2</td>
                </tr>
                <tr>
                    <td>
                        <div class="kartu-prodi-nama">
                            <?php echo htmlspecialchars($prodi1); ?>
                        </div>
                        <div class="kartu-prodi-ptn">UDSA SALATIGA</div>
                    </td>
                    <td>
                        <div class="kartu-prodi-nama">
                            <?php echo htmlspecialchars($prodi2); ?>
                        </div>
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
