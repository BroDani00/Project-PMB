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
.topbar-right{
    display:flex;
    gap:25px;
}
.topbar-right span{
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

/* PMB pakai Gravitas One, UDSA pakai Katibeh */
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
    font-weight:600;
    letter-spacing:0.5px;
    padding-bottom:10px;
    transition:color .3s ease;
    font-family:"Jaldi", sans-serif;
}
.menu > a:hover,
.menu > .menu-info > a:hover{ color:#79787F; }

/* underline seperti awal (melebar dari kiri) */
.menu > a.active {
    color:#6d6875 !important;
}
.menu > a::after,
.menu > .menu-info > a::after{
    content:"";
    position:absolute;
    left:0;
    bottom:0;
    width:0%;
    height:3px;
    background:#79787F;
    border-radius:999px;
    transition:width .3s ease;
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
    padding:8px 28px;
    border-radius:15px;
    color:#fff !important;
    font-size:16px;
    font-weight:700;
    margin-left:24px;
    transition:border .3s ease;
}
.menu a.login:hover{ border-color:#cc0000 !important; }

/* ================= DROPDOWN INFO ================= */
.menu-info{
    position:relative;
    display:flex;
    flex-direction:column;
}

.info-dropdown{
    position:absolute;
    top:100%;
    left:50%;
    transform:translateX(-50%) translateY(8px);
    background:#f8f6e4;
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
    font-family:"Cormorant Garamond", serif;
    font-size:18px;
    color:#333;
    padding:6px 0;
    letter-spacing:0.3px;
    white-space:nowrap;
}
.info-dropdown a::after{ display:none !important; }
.info-dropdown a:hover{ color:#7a6b23; }

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
    font-family:'Miltonian Tattoo', serif;
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
    color:#fff;
    font-family:"Katibeh", serif;
    font-size:30px;
    text-shadow:1px 1px 4px rgba(0,0,0,.8);
}

.quote-content button{
    background:#627D91;
    color:#ffffff;
    font-family:"Georgia","Times New Roman",serif;
    font-size:16px;
    font-weight:600;
    padding:7px 38px;
    border:none;
    border-radius:18px;
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
    flex:1;
    display:flex;
    align-items:center;
    gap:18px;
}
.info-box .item:not(:first-child){
    border-left:2px solid #d7c28d;
}

.icon-container img{ height:60px; }

/* ======== REVIEW & RATING SECTION (BARU) ======== */

.review-section{
    background:#f3efdd;
    padding:40px 40px 60px;
    font-family:"Cormorant Garamond", serif;
}

.review-title{
    font-size:26px;
    font-weight:700;
    margin-bottom:20px;
}

.review-top{
    background:#fff;
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

/* Lebar bar sesuai persentase (bisa disesuaikan) */
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
    font-size:20px;
    font-weight:700;
    margin-bottom:16px;
}

.review-input{
    background:#e8e2c2;
    border-radius:24px;
    padding:10px 20px;
    font-size:15px;
    color:#777;
    margin-bottom:22px;
    font-family:"Jaldi", sans-serif;
    width:100%;
}

/* CARD ULASAN */
.review-card{
    display:flex;
    gap:14px;
    margin-bottom:24px;
    font-family:"Jaldi", sans-serif;
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
    height:60px;
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
    width:18px;
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
    background: rgba(0,0,0,0.25); /* bagian bawah sedikit gelap */
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
    font-family:"Cormorant Garamond", serif;
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
    font-family: "Cormorant Garamond", serif;
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
    font-family: "Cormorant Garamond", serif;
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
    font-family: "Cormorant Garamond", serif;
    border-radius: 28px;
    cursor: pointer;
    transition: .3s ease;
}
.search-button:hover {
    background: #64581d;
}
</style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
    <div class="topbar-content">
        <div class="topbar-left">
            <a href="#">www.udsa.ac.id</a>
            <a href="berita.php">Berita</a>
            <a href="career.php">Career</a>
            <a href="#" onclick="openSearch();return false;">Search</a>
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
            <a href="home.php" class="active">Home</a>
            <a href="prodi.php">Program Studi</a>
            <a href="biaya.php">Biaya</a>

            <!-- MENU INFO DROPDOWN -->
            <div class="menu-info">
                <a href="info.php">Info</a>
                <div class="info-dropdown">
                    <a href="info-pendaftaran.php">Info Pendaftaran</a>
                    <a href="jadwal-pmb.php">Jadwal &amp; Tahapan</a>
                    <a href="pengumuman.php">Pengumuman</a>
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

        <!-- REVIEW & RATING (BARU, SESUAI FOTO) -->
        <section class="review-section">
            <h2 class="review-title">Review dan Rating Pendaftar</h2>

            <div class="review-top">
                <!-- bar rating 5–1 -->
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

                <div class="review-input">Tulis Ulasan Kamu...</div>

                <!-- Review 1 -->
                <div class="review-card">
                    <div class="avatar">
                        <span>👤</span>
                    </div>
                    <div class="review-content">
                        <div class="review-header">
                            <span class="review-name">feronikarisra</span>
                            <span class="review-date">11/12/25</span>
                        </div>
                        <div class="stars">★★★★★</div>
                        <div class="review-text">
                            “Proses pendaftaran melalui Web PMB sangat mudah dan cepat.
                            Tampilan website bersih dan informatif, sehingga saya tidak kesulitan
                            mencari panduan pendaftaran atau jadwal penting. Saya sangat mengapresiasi
                            kemudahan upload dokumen dan konfirmasi pembayaran yang real-time.”
                        </div>
                        <div class="review-actions">
                            <span>👍 12</span>
                            <span>🔁 Bagikan</span>
                        </div>
                    </div>
                </div>

                <!-- Review 2 -->
                <div class="review-card">
                    <div class="avatar">
                        <span>👤</span>
                    </div>
                    <div class="review-content">
                        <div class="review-header">
                            <span class="review-name">lestariayu</span>
                            <span class="review-date">13/12/25</span>
                        </div>
                        <div class="stars">★★★★☆</div>
                        <div class="review-text">
                            “Fitur upload dokumen sangat bermanfaat. Saya sempat mencoba beberapa
                            kali dengan format dan ukuran file yang sesuai, namun sekali gagal di tengah jalan.
                            Mohon segera diperbaiki.”
                        </div>
                        <div class="review-actions">
                            <span>👍 8</span>
                            <span>🔁 Bagikan</span>
                        </div>
                    </div>
                </div>

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
            <div class="footer-row-top">
                <div class="footer-item"><img src="assets/icons/ig.png"><span>@udsa_salatiga</span></div>
                <div class="footer-item"><img src="assets/icons/yt.png"><span>UDSA SALATIGA</span></div>
            </div>
            <div class="footer-row-bottom">
                <div class="footer-item"><img src="assets/icons/telp.png"><span>(+62) 0123456</span></div>
                <div class="footer-item"><img src="assets/icons/mail.png"><span>pmb@udsa.ac.id</span></div>
            </div>
        </div>

    </div>
</div>

<!-- SEARCH OVERLAY (SETENGAH HALAMAN) -->
<div class="search-overlay" id="searchOverlay">
    <div class="search-panel">
        <div class="search-close" onclick="closeSearch()">X</div>

        <div class="search-container">
            <label>Type your search</label>

            <div class="search-input-wrapper">
                <input type="text" class="search-input" placeholder="">
                <span class="search-icon" onclick="doSearch()">🔍</span>
            </div>

            <button class="search-button" onclick="doSearch()">Search</button>
        </div>
    </div>
</div>

<script>
function openSearch(){
    document.getElementById("searchOverlay").style.display="flex";
}

function closeSearch(){
    document.getElementById("searchOverlay").style.display="none";
}

/* FUNCTION SEARCH */
function doSearch(){
    let keyword = document.querySelector(".search-input").value.trim();

    if(keyword === ""){
        alert("Masukkan kata pencarian!");
        return;
    }

    // Redirect ke halaman pencarian
    window.location.href = "search.php?q=" + encodeURIComponent(keyword);
}
</script>

</body>
</html>