<?php
require_once('inc/header.php');
require_once('inc/sidebar-sepet.php');
$kategoriler = getirKategoriler();
sayfaHit(3); // Ana Sayfa Hit
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>




<div class="header-space"></div>
<?php require_once('inc/sidebar-sepet.php'); ?>
<div class="main-search-active">
    <div class="sidebar-search-icon">
        <button class="search-close"><span class="ion-android-close"></span></button>
    </div>
    <div class="sidebar-search-input">
        <form>
            <div class="form-search">
                <input id="search" class="input-text" value="" placeholder="Search Entire Store" type="search">
                <button>
                    <i class="ion-ios-search-strong"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<?php require_once('inc/sidebar-menu.php'); ?>

<div class="container">
    <div class="breadcrumb-content">
        <h2>Alisveris</h2>
        <ul>
            <li><a href="">Ana Sayfa</a></li>
            <li>Alisveris</li>
        </ul>
    </div>
</div>
</div>
<div class="shop-page-wrapper hidden-items padding-filter">
    <div class="container-fluid">
        <div class="shop-filters-left">
            <div class="shop-sidebar">
                <div class="sidebar-widget mb-50">
                    <h3 class="sidebar-title">Urunleri Ara</h3>
                    <div class="sidebar-search">
                        <form action="" method="POST">
                            <input placeholder="Urunleri Ara..." name="search" type="text">
                            <button><i class="ion-ios-search-strong"></i></button>
                        </form>
                        <br>
                        <?php
                        if (isset($_POST['search'])) {
                            $search = $_POST['search'];
                            $q = explode(" ", $search);
                            $sonuc = Search($q);
                            //print_r($urunler);
                            if (count($sonuc) == 0) {
                                echo "Aradiginiz urun bulunamadi";
                            }
                            foreach ($sonuc as $urun) {
                                $urunler = cekUrun($urun['urun_id'])[0];
                                //print_r($urunler);
                        ?>
                                <div class="sidebar-top-rated mb-30">
                                    <div class="single-top-rated">
                                        <div class="top-rated-img">
                                            <a href="urun-detay.php?id=<?php echo $urun['urun_id'] ?>"><img src="assets/img/urunler/<?php echo $urunler['urun_img'] ?>" width="91" alt=""></a>
                                        </div>
                                        <div class="top-rated-text">
                                            <h4><a href="urun-detay.php?id=<?php echo $urun['urun_id'] ?>"><?php echo $urunler['urun_ad'] ?></a></h4>
                                            <div class="top-rated-rating">
                                                <ul>
                                                    <li><i class="reting-color ion-android-star"></i></li>
                                                    <li><i class="reting-color ion-android-star"></i></li>
                                                    <li><i class="ion-android-star-outline"></i></li>
                                                    <li><i class="ion-android-star-outline"></i></li>
                                                    <li><i class="ion-android-star-outline"></i></li>
                                                </ul>
                                            </div>
                                            <span><?php echo $urunler['urun_fiyat'] ?> TL</span>
                                        </div>
                                    </div>
                                </div>

                        <?php
                            }
                        }

                        ?>

                    </div>
                </div>
                <div class="sidebar-widget mb-40">

                </div>


                <div class="sidebar-widget mb-45">
                    <h3 class="sidebar-title">Kategoiler</h3>
                    <div class="sidebar-categories">
                        <?php


                        $kategoriler = getirKategoriler();


                        ?>
                        <ul>
                            <?php
                            foreach ($kategoriler as $kategori) {
                                echo '<li><a href="alisveris.php?kategori=' . $kategori['kategori_id'] . '">' . $kategori['kategori_ad'] . '<span>' . KacUrunKategori($kategori['kategori_id'])[0] . '</span></a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>


                <div class="sidebar-widget mb-50">
                    <h3 class="sidebar-title">Yonetici Onerileri</h3>
                    <div class="sidebar-top-rated-all">
                        <div class="sidebar-top-rated mb-30">

                            <?php
                            foreach (oneCikanUrunler() as $urun) {
                            ?>
                                <div class="single-top-rated">
                                    <div class="top-rated-img">
                                        <a href="urun-detay.php?id=<?php echo $urun['urun_id'] ?>"><img src="assets/img/urunler/<?php echo $urun['urun_img'] ?>" width="75"></a>
                                    </div>
                                    <div class="top-rated-text">
                                        <h4><a href=""><?php echo $urun['urun_ad'] ?></a></h4>

                                        <span><?php echo $urun['urun_fiyat'] ?> TL</span>
                                    </div>
                                </div><br>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="shop-filters-right">
            <div class="shop-bar-area pb-60">
                <div class="shop-bar">
                    <div class="shop-found-selector">
                        <div class="shop-found">

                            <p>

                                <span><?php echo KacUrunVar()[0] ?></span>

                                Ürün Bulundu
                            </p>
                        </div>

                        <?php

                        if (isset($_POST['select'])) {
                            $select = $_POST['select'];
                            if ($select == 'default') {
                                $sirala = 'default';
                            }
                            if ($select == 'az') {
                                $sirala = 'az';
                            }
                            if ($select == 'za') {
                                $sirala = 'za';
                            }
                            if ($select == 'stok') {
                                $sirala = 'stok';
                            }
                        } else {
                            $sirala = 'default';
                        }
                        ?>
                        <div class="shop-selector">
                            <form action="" method="post">
                                <label>Sort By : </label>
                                <select name="select" onchange="this.form.submit()">
                                    <option <?php if ($sirala == 'default') {
                                                echo "selected";
                                            } ?> value="default">Varsayılan</option>
                                    <option <?php if ($sirala == 'az') {
                                                echo "selected";
                                            } ?> value="az">A - Z</option>
                                    <option <?php if ($sirala == 'za') {
                                                echo "selected";
                                            } ?> value="za"> Z - A</option>
                                    <option <?php if ($sirala == 'stok') {
                                                echo "selected";
                                            } ?> value="stok">Stokta Var</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="shop-filter-tab">
                        <div class="shop-filter">
                            <a class="shop-filter-active">Filtrele <i class="ion-android-options"></i></a>
                        </div>
                        <div class="shop-tab nav" role=tablist>
                            <a class="active" href="#grid-5-col1" data-toggle="tab" role="tab" aria-selected="false">
                                <i class="ion-android-apps"></i>
                            </a>
                            <a href="#grid-5-col2" data-toggle="tab" role="tab" aria-selected="true">
                                <i class="ion-android-menu"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shop-product-content tab-content">
                <div id="grid-5-col1" class="tab-pane fade active show">
                    <div class="row custom-row">
                        <?php
                        if (isset($_GET['page'])) {
                            $page = htmlspecialchars($_GET["page"]);
                            $page = (int) $page;
                        } else {
                            $page = 1;
                        }
                        $limit = 3;
                        $urunSayisi = KacUrunVar()[0];
                        $sayfalar = ceil($urunSayisi / $limit);
                        if ($page > $sayfalar) {
                            $start = 0;
                        } else {
                            $start = ($page > 1) ? ($page * $limit) - $limit : 0;
                        }
                        $urunler = ListeleUrun($start, $limit, null, $sirala);
                        $i = 0;
                        foreach ($urunler as $urun) {
                        ?>
                            <div class="custom-col-5 custom-col-style">
                                <div class="single-product mb-35">
                                    <div class="product-img">
                                        <a href="urun-detay.php?id=<?php echo $urun['urun_id'] ?>"><img width="400px" height="300px" src="assets/img/urunler/<?php echo $urun['urun_img'] ?>" alt=""></a>
                                        <div class="product-action">
                                            <a title="Wishlist" style="<?php

                                                                        if (isset($_SESSION['urun-istek'])) {
                                                                            foreach ($_SESSION['urun-istek'] as $key => $value) {
                                                                                if ($key == $urun['urun_id']) {
                                                                                    echo "background:red; color:aliceblue;";
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>" class="animate-left" <?php

                                                                                                    if (isset($_SESSION['urun-istek'])) {
                                                                                                        if (in_array($urun['urun_id'], array_keys($_SESSION['urun-istek']))) {
                                                                                                            echo "href='backend/istek-listesi-islem.php?id=$key&islem=sil'";
                                                                                                        } else {
                                                                                                            echo "href='./backend/istek-listesi-islem.php?id=" . $urun['urun_id'] . "&islem=ekle'";
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo "href='./backend/istek-listesi-islem.php?id=" . $urun['urun_id'] . "&islem=ekle'";
                                                                                                    }
                                                                                                    ?> "><i class=" ion-ios-heart-outline"></i></a>

                                            <a title="Quick View" data-toggle="modal" data-target="#urunModal<?php echo $i ?>" class="animate-right"><i class="ion-ios-eye-outline"></i></a>

                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-title-price">
                                            <div class="product-title">
                                                <h4><a href="urun-detay.php?id=<?php echo $urun['urun_id'] ?>"><?php echo $urun['urun_ad'] ?></a></h4>
                                            </div>
                                            <div class="product-price">
                                                <span><?php echo $urun['urun_fiyat'] ?>TL</span>
                                            </div>
                                        </div>
                                        <div class="product-cart-categori">
                                            <div class="product-cart">
                                                <span>
                                                    <?php
                                                    foreach ($kategoriler as $kategori) {
                                                        if ($kategori["kategori_id"] == $urun['kategori_id']) {
                                                            echo "Kategori : " . $kategori["kategori_ad"];
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="product-categori">
                                                <a href="backend/sepetislem.php?id=<?php echo $urun['urun_id'] ?>&islem=ekle&redirect=<?php echo $link ?>"><i class="ion-bag"></i>Sepete Ekle</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="urunModal<?php echo $i ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="ion-android-close" aria-hidden="true"></span>
                                </button>
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="qwick-view-left">
                                                <div class="quick-view-learg-img">
                                                    <div class="quick-view-tab-content tab-content">
                                                        <div class="tab-pane active show fade" id="modal1" role="tabpanel">
                                                            <img src="assets/img/urunler/<?php echo $urun['urun_img'] ?>" alt="">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="qwick-view-right">
                                                <div class="qwick-view-content">
                                                    <h3>Urun Adi : <?php echo $urun['urun_ad'] ?></h3>
                                                    <div class="price">
                                                        <span class="new"><?php echo $urun['urun_fiyat'] ?> TL</span>
                                                    </div>

                                                    <p>Urun Aciklamasi : <?php echo $urun['urun_detay'] ?></p>
                                                    <div class="quick-view-select">
                                                        <div class="select-option-part">
                                                            <label>Stok</label>
                                                            <?php echo $urun['urun_stok'] ?>
                                                        </div>
                                                        <div class="select-option-part">
                                                            <label>Kategori : </label>
                                                            <?php
                                                            foreach ($kategoriler as $kategori) {
                                                                if ($kategori["kategori_id"] == $urun['kategori_id']) {
                                                                    echo $kategori["kategori_ad"];
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="quickview-plus-minus">

                                                        <div class="quickview-btn-cart">
                                                            <a class="btn-hover-black" href="backend/sepetislem.php?id=<?php echo $urun['urun_id'] ?>&islem=ekle&redirect=<?php echo $link ?>">Sepete Ekle</a>
                                                        </div>
                                                        <div class="quickview-btn-wishlist">
                                                            <a class="btn-hover" style="<?php
                                                                                        if (isset($_SESSION['urun-istek'])) {
                                                                                            foreach ($_SESSION['urun-istek'] as $key => $value) {
                                                                                                if ($key == $urun['urun_id']) {
                                                                                                    echo "background:red; color:aliceblue;";
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        ?>" <?php
                                                                                            if (isset($_SESSION['urun-istek'])) {
                                                                                                if (in_array($urun['urun_id'], array_keys($_SESSION['urun-istek']))) {
                                                                                                    echo "href='backend/istek-listesi-islem.php?id=$key&islem=sil'";
                                                                                                } else {
                                                                                                    echo "href='./backend/istek-listesi-islem.php?id=" . $urun['urun_id'] . "&islem=ekle'";
                                                                                                }
                                                                                            } else {
                                                                                                echo "href='./backend/istek-listesi-islem.php?id=" . $urun['urun_id'] . "&islem=ekle'";
                                                                                            }
                                                                                            ?>><i class="ion-ios-heart-outline"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                            $i++;
                        } ?>

                    </div>
                </div>
                <div id="grid-5-col2" class="tab-pane fade">
                    <div class="row">
                        <?php
                        $i = 0;
                        foreach ($urunler as $urun) {
                        ?>
                            <div class="col-md-12 col-lg-12 col-xl-6">
                                <div class="single-product single-product-list product-list-right-pr mb-40">
                                    <div class="product-img list-img-width">
                                        <a href="id=<?php ?>"><img src="assets/img/urunler/<?php echo $urun['urun_img'] ?>" alt=""></a>
                                        <div class="product-action">
                                        </div>
                                    </div>
                                    <div class="product-content-list">
                                        <div class="product-list-info">
                                            <h4><a href="urun-detay.php?id=<?php echo $urun['urun_id'] ?>"><?php echo $urun['urun_ad'] ?></a></h4>
                                            <span><?php echo $urun['urun_fiyat'] ?>TL</span>
                                            <p><?php echo mb_substr($urun['urun_detay'], 0, 250) ?></p>
                                        </div>
                                        <div class="product-list-cart-wishlist">
                                            <div class="product-list-cart">
                                                <a class="btn-hover list-btn-style" href="backend/sepetislem.php?id=<?php echo $urun['urun_id'] ?>&islem=ekle&redirect=<?php echo $link ?>">Sepete Ekle</a>
                                            </div>
                                            <div class=" product-list-wishlist">
                                                <a class="btn-hover list-btn-wishlist" style="<?php
                                                                                                if (isset($_SESSION['urun-istek'])) {
                                                                                                    foreach ($_SESSION['urun-istek'] as $key => $value) {
                                                                                                        if ($key == $urun['urun_id']) {
                                                                                                            echo "background:red; color:aliceblue;";
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                                ?>" <?php
                                                                                                    if (isset($_SESSION['urun-istek'])) {
                                                                                                        if (in_array($urun['urun_id'], array_keys($_SESSION['urun-istek']))) {
                                                                                                            echo "href='backend/istek-listesi-islem.php?id=$key&islem=sil'";
                                                                                                        } else {
                                                                                                            echo "href='./backend/istek-listesi-islem.php?id=" . $urun['urun_id'] . "&islem=ekle'";
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo "href='./backend/istek-listesi-islem.php?id=" . $urun['urun_id'] . "&islem=ekle'";
                                                                                                    }

                                                                                                    ?>><i class="ion-ios-heart-outline"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        <?php
                            $i++;
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form method='GET' action="">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center m-4">
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo ($page > 1) ? $page - 1 : 1; ?>">Geri</a>
            </li>
            <?php for ($i = 1; $i <= $sayfalar; $i++) : ?>
                <li class="page-item <?php if ($i === $page) echo "active"; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>" <?php if ($i === $page) echo 'class="selected";' ?>><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo ($page < $sayfalar) ? $page + 1 : $sayfalar; ?>">İleri</a>
            </li>
        </ul>
    </nav>
</form>

</div>
<?php


require_once 'inc/footer.php';

?>
</body>

</html>