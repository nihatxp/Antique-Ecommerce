<?php require_once('inc/header.php'); ?>
<div class="header-space"></div>
<?php require_once('inc/sidebar-sepet.php'); ?>
<?php require_once('inc/sidebar-menu.php'); ?>

<div class="container">
    <div class="breadcrumb-content">
        <h2>Istek Listesi</h2>
        <ul>
            <li><a href="#">AnaSayfa</a></li>
            <li> Istek Listesi </li>
        </ul>
    </div>
</div>
</div>
<div class="cart-main-area pt-95 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="cart-heading">wishlist</h1>
                <form action="#">
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-name">Sil</th>
                                    <th class="product-price">Fotograf</th>
                                    <th class="product-name">Urun Adi</th>
                                    <th class="product-price">Urun Fiyati</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $toplam = 0;
                                $i = 0;
                                if (isset($_SESSION['urun-istek'])) {
                                    foreach ($_SESSION['urun-istek'] as $key => $value) {
                                        $urun = cekUrun($key)[0];
                                ?>
                                        <tr>
                                            <td class="product-remove"><a href="backend/istek-listesi-islem.php?id=<?php echo $key; ?>&islem=sil&redirect=istek-listesi"><i class="ion-android-close"></i></a></td>
                                            <td class="product-thumbnail">
                                                <a href="#"><img width="80px" src="assets/img/urunler/<?php echo $urun['urun_img'] ?>" alt=""></a>
                                            </td>
                                            <td class="product-name"><a href="#"><?php echo $urun['urun_ad'] ?></a></td>
                                            <td class="product-price"><span class="amount"><?php echo $urun['urun_fiyat'] ?></span></td>

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
                        <button>Sepete Ekle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once 'inc/footer.php'; ?>
</body>

</html>