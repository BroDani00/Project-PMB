<?php
session_start();
require 'koneksi.php';

$err = "";

// fungsi untuk membuat soal captcha baru
function generateCaptcha() {
    $a = rand(1, 9);
    $b = rand(1, 9);

    $_SESSION['captcha_a'] = $a;
    $_SESSION['captcha_b'] = $b;
    $_SESSION['captcha_answer'] = $a + $b;
}

// kalau pertama kali buka (GET) atau session captcha belum ada -> buat soal
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['captcha_a'], $_SESSION['captcha_b'], $_SESSION['captcha_answer'])) {
    generateCaptcha();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama   = $_POST['nama']   ?? '';
    $email  = $_POST['email']  ?? '';
    $hp     = $_POST['hp']     ?? '';
    $nisn   = $_POST['nisn']   ?? '';
    $asal   = $_POST['asal']   ?? '';
    $prodi1 = $_POST['prodi1'] ?? '';
    $prodi2 = $_POST['prodi2'] ?? '';
    $captcha_input = trim($_POST['captcha'] ?? '');

    // ambil jawaban yang benar dari session
    $expected = $_SESSION['captcha_answer'] ?? null;

    // validasi captcha
    if ($expected === null || $captcha_input === '' || !ctype_digit($captcha_input) || (int)$captcha_input !== (int)$expected) {
        $err = "Jawaban kode pengaman salah.";
        generateCaptcha(); // buat soal baru
    } elseif ($nama === '' || $email === '' || $hp === '' || $nisn === '') {
        $err = "Mohon lengkapi Nama, Email, HP, dan NISN.";
        generateCaptcha();
    } else {
        $stmt = $conn->prepare("
            INSERT INTO pendaftaran_snbp (nama, email, hp, nisn, asal, prodi1, prodi2)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        if (!$stmt) {
            die("Gagal prepare statement: " . $conn->error);
        }

        $stmt->bind_param("sssssss", $nama, $email, $hp, $nisn, $asal, $prodi1, $prodi2);

        if ($stmt->execute()) {
            $last_id = $stmt->insert_id;
            $stmt->close();
            $conn->close();

            // reset captcha (opsional)
            unset($_SESSION['captcha_a'], $_SESSION['captcha_b'], $_SESSION['captcha_answer']);

            header("Location: kartu.php?id=" . $last_id);
            exit;
        } else {
            $err = "Terjadi kesalahan saat menyimpan data: " . $stmt->error;
            generateCaptcha();
        }
    }
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
    transition:border .3s ease;
}
.menu a.login:hover{ border-color:#cc0000 !important; }

/* ============= MAIN PANEL (FORM) ============= */

.main-panel{
    background:#f3ebc8;           /* krem lembut */
    padding:40px 0 60px;
}
.wrapper{
    max-width:1200px;
    margin:0 auto;
}

/* KOTAK FORM BESAR */
.form-card{
    background:#ffffff;
    margin:0 40px;
    padding:40px 60px 45px;
    font-family:"Cormorant Garamond", serif;
}

/* JUDUL ATAS */
.form-heading{
    font-size:26px;
    font-weight:700;
    margin-bottom:28px;
    color:#1a1a1a;
}
.form-subtitle{
    font-size:22px;
    font-weight:700;
    margin-bottom:26px;
    color:#1a1a1a;
}

/* GRID 2 KOLOM FORM */
.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    column-gap:80px;
    row-gap:20px;
}

.form-group{
    display:flex;
    flex-direction:column;
    gap:6px;
}

/* LABEL */
.form-label{
    font-size:18px;
    font-weight:700;
    color:#000;
    letter-spacing:0.3px;
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
    font-family:"Cormorant Garamond", serif;
}
.form-control::placeholder{
    color:#9d9d9d;
    font-style:italic;
}

/* KODE PENGAMAN */
.kode-group{
    display:flex;
    flex-direction:column;
    gap:6px;
}
.kode-group .form-label{
    line-height:1.2;
}
.kode-row{
    display:flex;
    align-items:center;
    gap:18px;
    margin-top:4px;
}
.kode-soal{
    font-size:18px;
    font-weight:700;
}
.kode-input{
    width:120px;
}

/* BUTTON BARIS BAWAH */
.form-actions{
    margin-top:30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

/* BUTTON KEMBALI & DAFTAR */
.btn{
    border:none;
    border-radius:8px;
    padding:12px 46px;
    font-size:19px;
    font-weight:700;
    cursor:pointer;
    font-family:"Cormorant Garamond", serif;
}
.btn-kembali{
    background:#e01616;
    color:#fff;
}
.btn-daftar{
    background:#7db5ff;
    color:#000;
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
            <a href="prodi.php">Program Studi</a>
            <a href="biaya.php">Biaya</a>
            <a href="info.php">Info</a>
            <a href="daftar.php" class="active">Daftar</a>
            <a href="login.php" class="login">Login</a>
        </div>
    </div>
</div>

<!-- MAIN FORM -->
<div class="main-panel">
    <div class="wrapper">

        <section class="form-card">
            <h1 class="form-heading">Pendaftaran Online</h1>
            <h2 class="form-subtitle">Jalur SNPMB SNBP</h2>

            <?php if ($err !== ""): ?>
                <div style="margin-bottom:15px;color:red;font-size:16px;">
                    <?php echo htmlspecialchars($err); ?>
                </div>
            <?php endif; ?>

            <form action="" method="post">
                <div class="form-grid">

                    <!-- KOLOM KIRI -->
                    <div>
                        <div class="form-group">
                            <label class="form-label" for="nama">Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="hp">No. HP<br>(WA Aktif)</label>
                            <input type="text" id="hp" name="hp" class="form-control" placeholder="No. HP Aktif">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="asal">Asal Sekolah</label>
                            <select id="asal" name="asal" class="form-select">
                                <option value="">Pilih Jenjang</option>
                                <option>SMA</option>
                                <option>SMK</option>
                                <option>MA</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <!-- KOLOM KANAN -->
                    <div>
                        <div class="form-group">
                            <label class="form-label" for="nisn">NISN</label>
                            <input type="text" id="nisn" name="nisn" class="form-control" placeholder="NISN">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="prodi1">Pilihan Prodi 1</label>
                            <select id="prodi1" name="prodi1" class="form-select">
                                <option value="">Pilih Prodi</option>
                                <option>S1 Teknologi Informasi</option>
                                <option>S1 Sistem Informasi</option>
                                <option>S1 Data Science</option>
                                <option>S1 Matematika</option>
                                <option>S1 Biologi</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="prodi2">Pilihan Prodi 2</label>
                            <select id="prodi2" name="prodi2" class="form-select">
                                <option value="">Pilih Prodi</option>
                                <option>S1 Teknologi Informasi</option>
                                <option>S1 Sistem Informasi</option>
                                <option>S1 Data Science</option>
                                <option>S1 Matematika</option>
                                <option>S1 Biologi</option>
                            </select>
                        </div>

                        <div class="kode-group">
                            <span class="form-label">Kode Pengaman<br>(Jumlahkan)</span>
                            <div class="kode-row">
                                <span class="kode-soal">
                                    <?php
                                    echo htmlspecialchars($_SESSION['captcha_a']) . " + " . htmlspecialchars($_SESSION['captcha_b']) . " =";
                                    ?>
                                </span>
                                <input type="text" name="captcha" class="form-control kode-input" placeholder="Jawaban">
                            </div>
                        </div>
                    </div>

                </div>

                <!-- BUTTONS -->
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
