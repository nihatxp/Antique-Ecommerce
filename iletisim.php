<?php require_once('inc/header.php'); ?>
<div class="header-space"></div>
<?php require_once('inc/sidebar-sepet.php'); ?>
<?php require_once('inc/sidebar-menu.php');
sayfaHit(5); // Ana Sayfa Hit
?>

<div class="container">
    <div class="breadcrumb-content">
        <h2>İletişim</h2>
        <ul>
            <li><a href="#">Anasayfa</a></li>
            <li> İletişim </li>
        </ul>
    </div>
</div>
</div>
<div class="contact-area ptb-100">
    <div class="container">
        <div class="contact-info">
            <h2 class="contact-title">İletişim Bilgileri</h2>
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="single-contact-info mb-40">
                        <div class="contact-info-icon">
                            <i class="ion-ios-location-outline"></i>
                        </div>
                        <div class="contact-info-content">
                            <p>
                                Adres : <br> <?php echo IlkAdminiCek()[6] ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-contact-info mb-40">
                        <div class="contact-info-icon">
                            <i class="ion-ios-telephone-outline"></i>
                        </div>
                        <div class="contact-info-content">
                            <p>
                                Telefon : <br> <?php echo IlkAdminiCek()[5] ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-contact-info mb-40">
                        <div class="contact-info-icon">
                            <i class="ion-ios-email-outline"></i>
                        </div>
                        <div class="contact-info-content">
                            <p>E-Mail : <br> <a href=""><?php echo IlkAdminiCek()[3] ?></a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-form-wrap">
            <h2 class="contact-title">Mesaj Gonder</h2>
            <div class="contact-message">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="contact-form-style contact-font-one">
                                <input name="name" placeholder="İsminiz" type="text">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-form-style contact-font-two">
                                <input name="email" placeholder="Emailiniz" type="email">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="contact-form-style contact-font-four">
                                <textarea name="message" placeholder="Mesajınız"></textarea>
                                <button class="submit btn-hover" name="mesajsubmit" type="submit"> Mesaj Gönder </button>
                            </div>
                        </div>
                    </div>
                </form>

                <?php
                if (isset($_POST["mesajsubmit"])) {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $message = $_POST['message'];


                    if (strlen($name) == 0 || strlen($email) == 0 || strlen($message) == 0) {
                        echo "<div class='alert alert-danger'>Lütfen Alanlari Doldurunuz.</div>";
                    } else if (strlen($name) < 100 && strlen($email) < 100 && strlen($message) < 600) {
                        MesajEkle($name, $email, $message);
                    } else {
                        echo "<div class='alert alert-danger'>Lütfen 100-100-600 karakterden fazla karakter girmeyiniz.</div>";
                    }
                }

                ?>

                <p class="form-messege"></p>
            </div>
        </div>
        <div class="contact-map">
            <div id="hastech2"></div>
        </div>
    </div>
</div>
<?php require_once 'inc/footer.php'; ?>
</body>

</html>