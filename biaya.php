<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Uang Kuliah Tunggal - PMB UDSA</title>

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
    font-size:14px;
}
.topbar-right{
    display:flex;
    gap:25px;
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

/* ============= MAIN CONTENT ============= */

/* HERO */
.ukt-hero{
    background:#7e7028;
    padding:26px 20px;
    text-align:center;
}
.ukt-hero h1{
    color:#fff;
    font-size:42px;
    font-family:"Katibeh", serif;
    letter-spacing:1px;
}

/* DESC */
.ukt-desc{
    text-align:center;
    padding:26px 40px 12px;
}
.ukt-desc p{
    max-width:900px;
    margin:auto;
    font-size:17px;
    line-height:1.7;
}

/* WRAPPER */
.ukt-wrapper{
    max-width:1250px;
    margin:0 auto 60px;
    padding:0 20px;
}

/* SEARCH BOX */
.ukt-toolbar{
    display:flex;
    justify-content:flex-end;
    margin-bottom:10px;
}
.ukt-search{
    display:flex;
    align-items:center;
    background:#f5ecd0;
    border-radius:18px;
    padding:6px 14px 6px 20px;
}
.ukt-search input{
    border:none;
    background:transparent;
    font-size:16px;
    width:150px;
}
.ukt-search button{
    border:none;
    background:#b5913d;
    color:white;
    width:34px;
    height:34px;
    border-radius:50%;
    cursor:pointer;
}

/* TABLE */
.ukt-table{
    width:100%;
    border-collapse:collapse;
    background:#fbf7e7;
    font-family:"Jaldi", sans-serif;
    font-size:17px;
}
.ukt-table th{
    background:#7e7028;
    color:#fff;
    padding:15px;
    border:1px solid #65551a;
}
.ukt-table td{
    padding:14px;
    border:1px solid #d2c7a2;
}
.ukt-fakultas-row td{
    background:#f0e5bf;
    font-weight:700;
    font-size:18px;
}
.ukt-no{
    font-weight:700;
}

/* ============= FOOTER ORIGINAL (RESTORED) ============= */

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
}
.footer-left{
    display:flex;
    gap:10px;
}
.footer-logo{ height:50px; }
.footer-address{ line-height:1.15; }
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
.footer-icon{ width:16px; }

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
            <img src="assets/images/logo.png">
            <div>
                <span class="pmb-title">PMB</span>
                <span class="udsa-title">UDSA</span>
            </div>
        </div>

        <div class="menu">
            <a href="home.php">Home</a>
            <a href="prodi.php">Program Studi</a>
            <a href="biaya.php" class="active">Biaya</a>
            <a href="info.php">Info</a>
            <a href="daftar.php">Daftar</a>
            <a href="login.php" class="login">Login</a>
        </div>
    </div>
</div>

<!-- HERO -->
<section class="ukt-hero">
    <h1>UANG KULIAH TUNGGAL</h1>
</section>

<!-- DESKRIPSI -->
<section class="ukt-desc">
    <p>
        Sistem biaya studi sarjana di Universitas ... umumnya terdiri dari komponen utama yang dibayarkan
        pada awal pendaftaran dan setiap semester, salah satunya dihitung dari jumlah satuan kredit semester (SKS)
    </p>
</section>

<!-- TABEL -->
<div class="ukt-wrapper">

    <div class="ukt-toolbar">
        <div class="ukt-search">
            <input type="text" placeholder="Search">
            <button>&#128269;</button>
        </div>
    </div>

    <table class="ukt-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Fakultas/ Program Studi</th>
                <th>gol I</th>
                <th>gol II</th>
                <th>gol III</th>
                <th>gol IV</th>
                <th>gol V</th>
            </tr>
        </thead>
        <tbody>

            <tr class="ukt-fakultas-row">
                <td colspan="7">Fakultas Sains &amp; Teknologi</td>
            </tr>

            <tr>
                <td class="ukt-no">1.</td>
                <td>Teknologi Informasi</td>
                <td>500.000</td>
                <td>1.000.000</td>
                <td>2.000.000</td>
                <td>3.000.000</td>
                <td>4.000.000</td>
            </tr>

            <tr>
                <td class="ukt-no">2.</td>
                <td>Sistem Informasi</td>
                <td>500.000</td>
                <td>1.000.000</td>
                <td>2.000.000</td>
                <td>3.000.000</td>
                <td>4.000.000</td>
            </tr>

            <tr>
                <td class="ukt-no">3.</td>
                <td>Ilmu Komputer</td>
                <td>500.000</td>
                <td>1.200.000</td>
                <td>2.500.000</td>
                <td>3.400.000</td>
                <td>4.000.000</td>
            </tr>

            <tr>
                <td class="ukt-no">4.</td>
                <td>Data Science</td>
                <td>500.000</td>
                <td>1.200.000</td>
                <td>2.500.000</td>
                <td>3.400.000</td>
                <td>4.350.000</td>
            </tr>

            <tr>
                <td class="ukt-no">5.</td>
                <td>Biologi</td>
                <td>500.000</td>
                <td>1.500.000</td>
                <td>2.500.000</td>
                <td>3.400.000</td>
                <td>4.350.000</td>
            </tr>

            <tr>
                <td class="ukt-no">6.</td>
                <td>Matematika</td>
                <td>650.000</td>
                <td>1.500.000</td>
                <td>2.700.000</td>
                <td>3.700.000</td>
                <td>4.500.000</td>
            </tr>

            <tr>
                <td class="ukt-no">7.</td>
                <td>Fisika</td>
                <td>650.000</td>
                <td>1.500.000</td>
                <td>2.700.000</td>
                <td>3.700.000</td>
                <td>4.500.000</td>
            </tr>

        </tbody>
    </table>

</div>

<!-- FOOTER (ORIGINAL RESTORED) -->
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
                    <img src="assets/icons/ig.png" class="footer-icon">
                    <span>@udsa_salatiga</span>
                </div>
                <div class="footer-item">
                    <img src="assets/icons/yt.png" class="footer-icon">
                    <span>UDSA SALATIGA</span>
                </div>
            </div>

            <div class="footer-row-bottom">
                <div class="footer-item">
                    <img src="assets/icons/telp.png" class="footer-icon">
                    <span>(+62) 0123456</span>
                </div>
                <div class="footer-item">
                    <img src="assets/icons/mail.png" class="footer-icon">
                    <span>pmb@udsa.ac.id</span>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
