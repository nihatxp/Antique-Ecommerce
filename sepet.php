<?php
require_once('inc/header.php');
?>
<div class="header-space"></div>
<?php require_once('inc/sidebar-sepet.php'); ?>

<?php

if (isset($_POST['sepeti_bosalt'])) {
    $_SESSION['urun'] = null;
    $_SESSION['kupon'] = null;
}

if (isset($_POST['update_cart'])) {
    $i = 0;

    foreach ($_SESSION['urun'] as $key => $value) {
        if ($_POST[$i] == 0) {
            unset($_SESSION['urun'][$key]);
        } else {
            if ($_POST[$i] > 0) {
                $_SESSION['urun'][$key] = $_POST[$i];
            }
        }
        $i++;
    }
    //header("Location:sepet.php");
    print_r(count($_SESSION['urun']));
}
?>

<?php require_once('inc/sidebar-menu.php'); ?>

<div class="container">
    <div class="breadcrumb-content">
        <h2>Sepet Sayfasi</h2>
        <ul>
            <li><a href="#">Anasayfa</a></li>
            <li> hakkimizda </li>
        </ul>
    </div>
</div>
</div>
<!-- shopping-cart-area start -->
<div class="cart-main-area pt-95 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="cart-heading">Sepet</h1>
                <form action="" method="post">
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-name">Sil</th>
                                    <th class="product-price">Fotograf</th>
                                    <th class="product-name">Urun Adi</th>
                                    <th class="product-price">Urun Fiyati</th>
                                    <th class="product-quantity">Adet</th>
                                    <th class="product-subtotal">Toplam</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST['kupon_kaldir'])) {
                                    $_SESSION['kupon'] = null;
                                }
                                $toplam = 0;
                                $i = 0;
                                if (isset($_SESSION['urun'])) {
                                    foreach ($_SESSION['urun'] as $key => $value) {
                                        $urun = cekUrun($key)[0];


                                ?>
                                        <tr>
                                            <td class="product-remove"><a href="backend/sepetislem.php?id=<?php echo $key; ?>&islem=sil&redirect=sepet"><i class="ion-android-close"></i></a></td>
                                            <td class="product-thumbnail">
                                                <a href="#"><img width="80px" src="assets/img/urunler/<?php echo $urun['urun_img'] ?>" alt="<?php echo $urun['urun_img'] ?>"></a>
                                            </td>
                                            <td class="product-name"><a href="#"><?php echo $urun['urun_ad'] ?></a></td>
                                            <td class="product-price"><span class="amount"><?php echo $urun['urun_fiyat'] ?></span></td>
                                            <td class="product-quantity">
                                                <input name="<?php echo $i ?>" value="<?php echo $value; ?>" type="number">
                                            </td>
                                            <td class="product-subtotal"><?php echo $value * $urun['urun_fiyat']; ?></td>
                                        </tr>
                                <?php
                                        $toplam += $value * $urun['urun_fiyat'];
                                        $i++;
                                    }
                                }
                                $Aratoplam = $toplam;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="coupon-all">

                                <div class="coupon2">
                                    <input class="button" name="update_cart" value="Sepeti Guncelle" type="submit">&nbsp;
                </form>&nbsp;

            </div>

            <form method="POST" action="">
                <input class="button" name="sepeti_bosalt" value="Sepeti Boşalt" type="submit">
            </form>
            <form method="get" action="">
                <div class="coupon">
                    <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder=" Coupon code" type="text">
                    <?php
                    if (!isset($_SESSION['kupon'])) {
                        echo "<input class='button' value='Kupon Uygula' type='submit'>";
                    } else {
                        echo "</form>";
                        echo "<form method='POST' action=''>";
                        echo "<input class='button' name='kupon_kaldir' class='bg-danger' value='Kaldir' type='submit'>";
                    } ?>


                </div>
            </form>

        </div>
    </div>
</div>
<?php

if (isset($_GET['coupon_code'])) {
    if (!isset($_SESSION['urun']) || count($_SESSION['urun']) == 0) {
        echo "Sepetinizde ürün bulunmamaktadır.";
    } else {
        $kupon = $_GET['coupon_code'];
        $kupon = cekKupon($kupon);
        if ($kupon) {
            $toplam = $toplam - ($toplam * $kupon['kupon_miktar'] / 100);
            echo "[" . $kupon["kupon_kodu"] . "]" . " Kupon Kodu Uygulandı";
            $_SESSION['kupon'] = array($kupon['kupon_kodu'], $kupon['kupon_miktar']);
        } else {
            echo "Kupon Kodu Hatalı";
            $_SESSION['kupon'] = null;
        }
        header("location: sepet.php");
    }
}

if (isset($_SESSION['kupon'][0])) {
    $toplam = $toplam - ($toplam * $_SESSION['kupon'][1] / 100);
    echo "[" . $_SESSION['kupon'][0] . "]" . " Kupon Kodu Uygulandı";
}


?>
<div class="row">
    <div class="col-md-5 ml-auto">
        <div class="cart-page-total">
            <h2>Sepet Sonucu</h2>
            <ul>
                <li>Ara toplam<span><?php echo "$Aratoplam" ?></span></li>
                <li>Toplam<span><?php echo "$toplam" ?></span></li>
            </ul>


            <a href="odeme.php">Sepeti Onayla</a>

        </div>
    </div>
</div>
</form>
</div>
</div>
</div>
</div>
<!-- shopping-cart-area end -->
<?php require_once 'inc/footer.php'; ?>

</body>

</html>