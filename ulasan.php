<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ulasan Teratas Pelayanan Kampus UDSA - PMB UDSA</title>

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

/* ====================== TOPBAR (TIDAK DIUBAH) ====================== */

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

/* ====================== NAVBAR (TIDAK DIUBAH) ====================== */

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

/* ====================== MAIN (ULASAN) ====================== */

.main-panel{
    background:#f6f2d9;
    padding:50px 0 70px;
}
.wrapper{
    max-width:1200px;
    margin:0 auto;
}

/* JUDUL HALAMAN */
.reviews-container{
    margin:0 60px;
    font-family:"Jaldi", serif;
}
.reviews-title{
    font-size:30px;
    font-weight:700;
    margin-bottom:32px;
}

/* LIST ULASAN */
.review-list{
    display:flex;
    flex-direction:column;
    gap:30px;
}

/* ITEM ULASAN */
.review-item{
    display:flex;
    align-items:flex-start;
    gap:18px;
}

/* AVATAR */
.review-avatar{
    width:40px;
    height:40px;
    border-radius:50%;
    background:#f0f0f0;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
}

/* KONTEN ULASAN */
.review-content{
    flex:1;
}

/* NAMA + META */
.review-header{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:4px;
}
.review-name{
    font-size:18px;
    font-weight:700;
}
.review-date{
    font-size:14px;
}

/* RATING BINTANG */
.review-rating{
    font-size:16px;
    color:#e0a800;
    margin-bottom:6px;
}

/* TEKS ULASAN */
.review-text{
    font-size:16px;
    max-width:780px;
    line-height:1.4;
}

/* IKON LIKE */
.review-actions{
    margin-top:10px;
    font-size:18px;
}
.review-actions span{
    cursor:pointer;
}

/* ====================== FOOTER (TIDAK DIUBAH) ====================== */

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
            <a href="daftar.php">Daftar</a>
            <a href="login.php" class="login">Login</a>
        </div>
    </div>
</div>

<!-- MAIN ULASAN -->
<div class="main-panel">
    <div class="wrapper">
        <section class="reviews-container">

            <h1 class="reviews-title">Ulasan Teratas Pelayanan Kampus UDSA</h1>

            <div class="review-list">

                <!-- ULASAN 1 -->
                <div class="review-item">
                    <div class="review-avatar">👤</div>
                    <div class="review-content">
                        <div class="review-header">
                            <span class="review-name">Ajeng Febria</span>
                            <span class="review-date">11/2/25</span>
                        </div>
                        <div class="review-rating">★★★★★</div>
                        <p class="review-text">
                            "Proses pendaftaran melalui Web PMB sangat mudah dan cepat.
                            Tampilan website bersih dan informatif, sehingga saya tidak kesulitan mencari
                            panduan pendaftaran atau jadwal penting. Saya sangat mengapresiasi
                            kemudahan upload dokumen dan konfirmasi pembayaran yang real-time."
                        </p>
                        <div class="review-actions">
                            <span>👍</span>
                        </div>
                    </div>
                </div>

                <!-- ULASAN 2 -->
                <div class="review-item">
                    <div class="review-avatar">👤</div>
                    <div class="review-content">
                        <div class="review-header">
                            <span class="review-name">Andikaqaja</span>
                            <span class="review-date">12/2/25</span>
                        </div>
                        <div class="review-rating">★★★★★</div>
                        <p class="review-text">
                            "Sistem PMB online sangat efisien. Semua langkah pendaftaran dari
                            awal hingga cetak kartu tes terorganisir dengan baik."
                        </p>
                        <div class="review-actions">
                            <span>👍</span>
                        </div>
                    </div>
                </div>

                <!-- ULASAN 3 -->
                <div class="review-item">
                    <div class="review-avatar">👤</div>
                    <div class="review-content">
                        <div class="review-header">
                            <span class="review-name">Feronika Risa</span>
                            <span class="review-date">11/2/25</span>
                        </div>
                        <div class="review-rating">★★★☆☆</div>
                        <p class="review-text">
                            "Saat saya menghubungi hotline, operator tidak memberikan
                            solusi yang konkret dan hanya menyuruh saya mencoba refresh halaman.
                            Saran dan support yang diberikan terasa kurang membantu."
                        </p>
                        <div class="review-actions">
                            <span>👍</span>
                        </div>
                    </div>
                </div>

                <!-- ULASAN 4 -->
                <div class="review-item">
                    <div class="review-avatar">👤</div>
                    <div class="review-content">
                        <div class="review-header">
                            <span class="review-name">Lestariayu</span>
                            <span class="review-date">13/2/25</span>
                        </div>
                        <div class="review-rating">★★☆☆☆</div>
                        <p class="review-text">
                            "Fitur upload dokumen sempat bermasalah. Saya sudah mencoba beberapa
                            kali dengan format dan ukuran file yang sesuai, namun selalu gagal di tengah jalan.
                            Mohon segera diperbaiki."
                        </p>
                        <div class="review-actions">
                            <span>👍</span>
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
