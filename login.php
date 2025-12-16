<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - PMB UDSA</title>

<!-- GOOGLE FONTS -->
<link href="https://fonts.googleapis.com/css2?family=Katibeh&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Miltonian+Tattoo&family=Gravitas+One&family=Cormorant+Garamond:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Jaldi:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

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

/* ============= MAIN PANEL (LOGIN) ============= */

.main-panel{
    background:#5c5950;          /* abu gelap seperti foto */
    padding:60px 0 80px;
}
.wrapper{
    max-width:1200px;
    margin:0 auto;
}

/* HEADER DI ATAS CARD (LOGO + TEKS UNIV) */
.login-header{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:30px;
    margin-bottom:30px;
    color:#fff;
}
.login-header-logo{
    height:110px;
    object-fit:contain;
}
.login-header-text{
    text-align:left;
}
.login-header-text .univ-title{
    font-size:26px;
    font-weight:700;
    letter-spacing:1px;
}
.login-header-text .univ-subtitle{
    font-size:22px;
    font-weight:600;
}

/* CARD LOGIN */
.login-card-wrapper{
    display:flex;
    justify-content:center;
}
.login-card{
    background:#ffffff;
    width:480px;
    padding:40px 60px 50px;
    border-radius:10px;
    box-shadow:0 8px 20px rgba(0,0,0,0.25);
    text-align:center;
}

/* JUDUL "Log in" */
.login-title{
    font-family:"Great Vibes", cursive;
    font-size:40px;
    margin-bottom:30px;
    color:#222;
}

/* INPUT GROUP */
.login-group{
    display:flex;
    flex-direction:column;
    gap:6px;
    margin-bottom:18px;
    text-align:left;
}

/* INPUT */
.login-input{
    width:100%;
    padding:12px 14px;
    border-radius:10px;
    border:2px solid #7a6b23;
    background:#a89442;
    color:#fff;
    font-size:16px;
    font-family:"Cormorant Garamond", serif;
}
.login-input::placeholder{
    color:#f1e7c8;
    font-size:15px;
}

/* LOGIN BUTTON */
.btn-login{
    margin-top:14px;
    width:220px;
    padding:12px 0;
    border-radius:10px;
    border:2px solid #000;
    background:#e6c660;
    font-size:20px;
    font-weight:700;
    cursor:pointer;
    font-family:"Cormorant Garamond", serif;
}
.btn-login:hover{
    filter:brightness(0.95);
}

/* LINK BAWAH */
.login-footer-links{
    margin-top:22px;
    display:flex;
    justify-content:space-between;
    font-size:14px;
}
.login-footer-links a{
    color:#7a5a28;
    text-decoration:none;
    font-weight:600;
}
.login-footer-links a:hover{
    text-decoration:underline;
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
            <a href="daftar.php">Daftar</a>
            <a href="login.php" class="login">Login</a>
        </div>
    </div>
</div>

<!-- MAIN LOGIN -->
<div class="main-panel">
    <div class="wrapper">

        <!-- Header di atas card (logo + nama universitas) -->
        <div class="login-header">
            <img src="assets/images/logo.png" alt="Logo UDSA" class="login-header-logo">
            <div class="login-header-text">
                <div class="univ-title">UNIVERSITAS</div>
                <div class="univ-subtitle">Dua Sembilan April</div>
            </div>
        </div>

        <!-- Card Login -->
        <div class="login-card-wrapper">
            <div class="login-card">

                <div class="login-title">Log in</div>

                <form action="#" method="post">
                    <div class="login-group">
                        <input type="text" name="userid" class="login-input"
                               placeholder="ID Pendaftaran/ email">
                    </div>

                    <div class="login-group">
                        <input type="password" name="password" class="login-input"
                               placeholder="Password">
                    </div>

                    <button type="submit" class="btn-login">Log in</button>

                    <div class="login-footer-links">
                        <span>Forget your password?</span>
                        <span>Don't have an account yet?<br>
                            <a href="#">Create account</a>
                        </span>
                    </div>
                </form>

            </div>
        </div>

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
