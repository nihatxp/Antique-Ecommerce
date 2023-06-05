<?php require_once("system/config.php");

if(bakimDurumu()[0][0] == 1){
    header("Location: bakim.php");
}
?>


<!doctype html>
<html class="no-js" lang="tr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>NihAntika - Antika Satis</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/magnific-popup.css">
    <link rel="stylesheet" href="./assets/css/animate.css">
    <link rel="stylesheet" href="./assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./assets/css/slinky.min.css">
    <link rel="stylesheet" href="./assets/css/slick.css">
    <link rel="stylesheet" href="./assets/css/ionicons.min.css">
    <link rel="stylesheet" href="./assets/css/bundle.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <script src="./assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <div class="wrapper">
    

        <header class="pl-155 pr-155 intelligent-header">
            <div class="header-area header-area-2">
                <div class="container-fluid p-0">
                    <div class="row no-gutters">
                        <div class="col-lg-3 col-md-6 col-6">
                            <div class="logo">
                                <a href="./index.php"><img src="./assets/img/logo/logo.png" alt="" /></a>
                            </div>
                        </div>

                        <div class="col-lg-6 menu-none-block menu-center">
                            <div class="main-menu">
                                <nav>
                                    <ul>
                                        <li><a href="./index.php">Anasayfa</a></li>
                                        <li><a href="./hakkimizda.php">Hakkimizda</a></li>
                                        <li><a href="./alisveris.php">Alisveris</a></li>
                                        <li><a href="">Daha Fazla</a>
                                            <ul class="dropdown">
                                                <li><a href="./hakkimizda.php">Hakkimizda</a></li>
                                                <li><a href="./sepet.php">Sepet</a></li>
                                                <li><a href="./odeme.php">Odeme</a></li>
                                                <li><a href="./istek-listesi.php">Istek Listesi</a></li>
                                                <li><a href="./iletisim.php">Iletisim</a></li>
                                            </ul>
                                            <?php if (isset($_SESSION["Kullanici"])) { ?>
                                        <li><a href="./kullanicihesabi.php">Hesabim</a></li>
                                    <?php } else { ?>
                                        <li><a href="./giris.php">Giris Yap</a></li>
                                    <?php } ?>
                                    </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-6">
                            <div class="header-search-cart">
                                <div class="header-cart common-style">
                                    <button class="sidebar-trigger">
                                        <span class="ion-bag"></span>
                                    </button>
                                </div>
                              
                            </div>
                        </div>
                        <div class="mobile-menu-area d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none">
                            <div class="mobile-menu">
                                <nav id="mobile-menu-active">
                                    <ul class="menu-overflow">
                                        <li><a href="index.php">home</a></li>
                                        <li><a href="hakkimizda.php">about us</a></li>
                                        <li><a href="alisveris.php">shop</a></li>
                                        <li><a href="#">pages</a>
                                            <ul class="dropdown">
                                                <li><a href="./hakkimizda.php">about us</a></li>
                                                <li><a href="./sepet.php">Sepet</a></li>
                                                <li><a href="./odeme.php">Odeme</a></li>
                                                <li><a href="./istek-listesi.php">Istek Listesi</a></li>
                                                <li><a href="./iletisim.php">Iletisim</a></li>
                                            </ul>
                                        <li><a href="./giris.php">Giris Yap</a></li>
                                        <li><a href="./kayit.php">Kaydol</a></li>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>