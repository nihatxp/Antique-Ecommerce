<?php
require_once("inc/header.php");
require_once("inc/sidebar-sepet.php");
require_once("inc/sidebar-menu.php");
sayfaHit(1); // Ana Sayfa Hit
?>

<div class="single-slider single-slider-hm1 bg-img ptb-260" style="background-image: url(https://exploremenomonie.com/wp-content/uploads/2020/10/antique_vases_floral-1536x1024.jpg)">
    <div class="container">
        <div class="slider-content slider-content-style-1 slider-animated-1"><br><br><br>
            <h2 class="animated" style="color:gainsboro;"><?php echo AnaSayfaBasligiCek()[0] ?></h2>
            <p class="animated" style="color:gainsboro;"><?php echo AnaSayfaBasligiCek()[1] ?></p>
            <a style="color:gainsboro;" class="btn-hover slider-btn-style animated" href="alisveris.php">Alisverise Basla</a>
        </div>
    </div>
</div>

</div>
</div>
<div class="banner-area pt-100 pb-70">
    <div class="container">
        <div class="row">
        <?php
            if (isset(getirKategoriler()[0])) {
            ?>
            <div class="col-md-6 col-lg-3 col-12">
                <div class="single-banner mb-30">
                    <a href="alisveris.php"><img src="https://cdn.concreteplayground.com/content/uploads/2017/12/BloodworthBellamy_supplied-1920x1440.jpg" alt=""></a>
                    <div class="banner-content banner-content-position1">
                        <h3 style="color:aliceblue;"><?php echo getirKategoriler()[0]['kategori_ad'] ?></h3>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>


            <?php
            if (isset(getirKategoriler()[1])) {
            ?>
            <div class="d-sm-none d-lg-block col-lg-6 col-12">
                <div class="single-banner mb-30">
                    <a href="alisveris.php"><img src="https://imgix.theurbanlist.com/content/article/005D030C-35B0-416E-B9E6-B80ABABC2D80.jpeg?auto=format,compress&w=1200&h=630&fit=crop" alt=""></a>
                    <div class="banner-content banner-content-position2">
                        <span style="color:aliceblue;">Kategori</span>
                        <h3 style="color:aliceblue;"><?php echo getirKategoriler()[1]['kategori_ad'] ?></h3>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>

            <?php
            if (isset(getirKategoriler()[2])) {
            ?>
                <div class="col-md-6 col-lg-3 col-12">
                    <div class="single-banner mb-30">
                        <a href="alisveris.php"><img src="https://writershelpingwriters.net/wp-content/uploads/2016/05/Antiques-shop.jpg" alt=""></a>
                        <div class="banner-content banner-content-position3">
                            <h3 style="color:aliceblue;"><?php echo getirKategoriler()[2]['kategori_ad'] ?></h3>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<div class="product-area pb-100">
    <div class="container">
        <div class="section-title text-center mb-35">
            <h2>Urun Kategorileri</h2>
            <p>Istediginiz Kategoride Urunleri Hizlica Bulabilirsiniz</p>
        </div>
        <div class="product-style">
            <div class="product-tab-list text-center mb-45 nav product-menu-mrg" role="tablist">
                <?php


                foreach (getirKategoriler() as $kategori) {
                    echo '<a class="active" href="?filter=' . $kategori['kategori_id'] . '"    >
                    <h4>' . $kategori['kategori_ad'] . '</h4>
                </a>';
                }
                ?>

            </div>
            <div class="tab-content jump">
                <div class="" id="" role="">
                    <div class="row">
                        <?php

                        if (isset($_GET['filter'])) {
                            $filter = $_GET['filter'];
                            $urunler = KategoriIleUrunCek($filter);
                            if (count($urunler) == 0) {
                                echo "Bu Kategoride Urun Bulunamadı";
                            }
                            foreach ($urunler as $urun) {
                        ?>
                                <div class="col-md-3 col-lg-3 col-sm-4">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="#"><img src="assets/img/urunler/<?php echo $urun['urun_img'] ?>" alt=""></a>
                                            <div class="product-action">
                                                <a title="Wishlist" class="animate-left" href="#"><i class="ion-ios-heart-outline"></i></a>
                                                <a title="Quick View" data-toggle="modal" data-target="#exampleModal" class="animate-right" href="#"><i class="ion-ios-eye-outline"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <div class="product-title-price">
                                                <div class="product-title">
                                                    <h4><a href="product-details-6.html"><?php echo $urun['urun_ad'] ?></a></h4>
                                                </div>
                                                <div class="product-price">
                                                    <span><?php echo $urun['urun_fiyat'] ?>TL</span>
                                                </div>
                                            </div>
                                            <div class="product-cart-categori">
                                                <div class="product-cart">
                                                    <span>Kategori : <?php
                                                                        foreach (getirKategoriler() as $kategori) {
                                                                            if ($kategori["kategori_id"] == $urun['kategori_id']) {
                                                                                echo $kategori["kategori_ad"];
                                                                            }
                                                                        }
                                                                        ?></span>
                                                </div>
                                                <div class="product-categori">
                                                    <a href="backend/sepetislem.php?id=<?php echo $urun['urun_id'] ?>&islem=ekle"><i class="ion-bag"></i> Sepete Ekle</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }


                        ?>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php 
if(getirKupon() != null){
?>
<div class="shop-limited-area bg-img pt-90 pb-100" style="background-image: url(https://offloadmedia.feverup.com/bostonuncovered.com/wp-content/uploads/2022/01/12044521/CambAntMkt_MedRes-0404-1024x683.jpeg)" data-overlay="3">
    <div class="container">
        <div class="shop-limited-content text-center">
            <h2 style="color:gainsbro;">%<?php echo getirKupon()['kupon_miktar'] ?> Indirimlerimiz Icin Hemen <?php echo getirKupon()['kupon_kodu'] ?> Kupon Kodunu Deneyin..</h2>
            <a class="btn-hover limited-btn" href="sepet.php?coupon_code=<?php echo getirKupon()['kupon_kodu'] ?>">Daha Fazla</a>
        </div>
    </div>
</div>


<?php
}
?>

<div class="product-collection-area pt-100 pb-50">
    <div class="container">
        <div class="section-title text-center mb-55">
            <h2>One Cikan Urunler</h2>
            <p>Yonetici Tarafindan Onerilen Urunler</p>
        </div>
        <div class="row">

            <?php
            foreach (oneCikanUrunler() as $urun) {
            ?>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="single-product mb-35">
                        <div class="product-img">
                            <a href=""><img src="assets/img/urunler/<?php echo $urun['urun_img'] ?>" alt=""></a>
                            <div class="product-action">
                                <a title="Wishlist" class="animate-left" href="#"><i class="ion-ios-heart-outline"></i></a>
                                <a title="Quick View" data-toggle="modal" data-target="#exampleModal" class="animate-right" href="#"><i class="ion-ios-eye-outline"></i></a>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="product-title-price">
                                <div class="product-title">
                                    <h4><a href="product-details-6.html"></a></h4>
                                </div>
                                <div class="product-price">
                                    <span><?php echo $urun['urun_fiyat'] ?> ₺</span>
                                </div>
                            </div>
                            <div class="product-cart-categori">
                                <div class="product-cart">
                                    <span><?php echo $urun['urun_ad'] ?></span>
                                </div>
                                <div class="product-categori">
                                    <a href="#"><i class="ion-bag"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </div>
</div>
<?php require_once 'inc/footer.php'; ?>
</body>

</html>