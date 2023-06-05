<div class="sidebar-cart onepage-sidebar-area">
    <div class="wrap-sidebar">
        <div class="sidebar-cart-all">
            <div class="sidebar-cart-icon">
                <button class="op-sidebar-close"><span class="ion-android-close"></span></button>
            </div>
            <div class="cart-content">
                <h3>Sepet</h3>
                <ul>
                    <?php
                    $toplam = 0;
                    if (isset($_SESSION['urun'])) {
                        foreach ($_SESSION['urun'] as $key => $value) {
                            $urun = cekUrun($key)[0];
                    ?>
                            <li class="single-product-cart">
                                <div class="cart-img">
                                    <a href="#"><img width="80px" src="assets/img/urunler/<?php echo $urun['urun_img'] ?>" alt="<?php echo $urun['urun_img'] ?>"></a></a>
                                </div>
                                <div class="cart-title">
                                    <h3><a href="#"><?php echo $urun['urun_ad'] ?></a></h3>
                                    <span><?php echo $value ?> x <?php echo $urun['urun_fiyat'] ?>TL</span>
                                </div>
                                <div class="cart-delete">
                                    <a href="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" . "/../backend/sepetislem.php?id=" . $urun['urun_id'] . "&islem=sil" ?>"><i class="ion-ios-trash-outline"></i></a>
                                </div>
                            </li><?php
                                    $toplam += $value * $urun['urun_fiyat'];
                                }
                            }
                                    ?>
                    <li class="single-product-cart">
                        <div class="cart-total">
                            <h4>Toplam : <span><?php echo $toplam ?> TL</span></h4>
                            <?php


                            ?>
                        </div>
                    </li>
                    <li class="single-product-cart">
                        <div class="cart-checkout-btn">
                            <a class="btn-hover cart-btn-style" href="sepet.php"> Sepet </a>
                            <a class="no-mrg btn-hover cart-btn-style" href="odeme.php">Odeme Yap</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>