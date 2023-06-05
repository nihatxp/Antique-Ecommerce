<?php require_once('inc/header.php'); ?>
<div class="header-space"></div>
<?php require_once('inc/sidebar-sepet.php'); ?>
<?php require_once('inc/sidebar-menu.php');



sayfaHit(4); // Ana Sayfa Hit
?>
<script src="admin/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script>
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-gray'
        },
        buttonsStyling: false
    });
</script>

<?php


if (!isset($_SESSION['urun']) || count($_SESSION['urun']) == 0) {

    echo "<script>
                                    
    swalWithBootstrapButtons.fire({
        icon: 'error',
        title: 'Hata',
        text: 'Sepetinizde Urun Bulunmamaktadir',
        showConfirmButton: true,
        timer: 1500
    })

</script>";

    
header( "refresh:1.5;url=index.php" );
}


?>


<div class="container">
    <div class="breadcrumb-content">
        <h2>Ödeme</h2>
        <ul>
            <li><a href="./index.php">AnaSayfa</a></li>
            <li> Ödeme </li>
        </ul>
    </div>
</div>
</div>
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="your-order">
                    <h3>Siparişiniz</h3>
                    <div class="your-order-table table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-name">Urun</th>
                                    <th class="product-total">Toplam</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $toplam = 0;
                                $i = 0;
                                if (isset($_SESSION['urun'])) {
                                    foreach ($_SESSION['urun'] as $key => $value) {
                                        $urun = cekUrun($key)[0];
                                ?>
                                        <tr class="cart_item">
                                            <td class="product-name">
                                                <?php echo $urun['urun_ad'] ?><strong class="product-quantity"> × <?php echo $value; ?> </strong>
                                            </td>
                                            <td class="product-total">
                                                <span class="amount"><?php echo $value * $urun['urun_fiyat'] . "TL" ?></span>
                                            </td>
                                        </tr>

                                <?php
                                        $toplam += $urun['urun_fiyat'] * $value;
                                        $i++;
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <th>Ara Toplam</th>
                                    <td><span class="amount"><?php echo $toplam . "TL" ?></span></td>
                                </tr>

                                <tr class="order-total">
                                    <th>Toplam</th>
                                    <td>
                                        <strong><span class="amount">
                                                <?php
                                                if (isset($_SESSION['kupon'][1])) {
                                                    echo "<br>";
                                                    $sonuc = $toplam - ($toplam * $_SESSION["kupon"][1] / 100);

                                                    echo $sonuc . "TL";
                                                } else {
                                                    echo $toplam . "TL";
                                                }
                                                ?>
                                            </span></strong>
                                    </td>
                                <tr>
                                </tr>

                                <td><?php
                                    if (isset($_SESSION['kupon'][1])) {
                                        echo $_SESSION['kupon'][1] . "% indirim uygulandı";
                                    } ?></td>
                                <tr>
                            </tfoot>

                        </table>
                    </div>
                    <?php $veri = satinAlma(); ?>
                    <div class="payment-method">
                        <div class="payment-accordion">
                            <div class="panel-group" id="faq">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><a class="collapsed" data-toggle="collapse" aria-expanded="false" data-parent="#faq" href="#payment-1"><?php echo $veri[0]['baslik'] ?></a></h5>
                                    </div>
                                    <div id="payment-1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <?php print_r($veri[0]["icerik"]) ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><a class="collapsed" data-toggle="collapse" aria-expanded="false" data-parent="#faq" href="#payment-2"><?php echo $veri[1]['baslik'] ?></a></h5>
                                    </div>
                                    <div id="payment-2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <?php print_r($veri[1]["icerik"]) ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="order-button-payment">
                                <form action="" method="post">
                                    <button class="btn btn-success" id="successAlert" name="succes">Satin Al</button>
                                </form>
                                <?php if (isset($_POST['succes']) && isset($_SESSION['urun'])) {
                                    echo "<script>
                                    
                                        swalWithBootstrapButtons.fire({
                                            icon: 'success',
                                            title: 'Success alert',
                                            text: 'Siparişiniz alınmıştır',
                                            showConfirmButton: true,
                                            timer: 1500
                                        })
                          
                                    </script>";
                                    foreach ($_SESSION['urun'] as $key => $value) {
                                        stokAzalt($key);
                                    }
                                    $_SESSION['urun'] = null;
                                    $_SESSION['kupon'] = null;
                                    header("Refresh:1; url=index.php");
                                } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->
<?php require_once 'inc/footer.php'; ?>

</body>

</html>