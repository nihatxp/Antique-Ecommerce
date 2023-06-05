<?php
require_once '../../system/config.php';
session_write_close();
require_once "../inc/header.php";
?>


<?php

$kullanicilar  = adminCek($_SESSION['Admin']);


if (isset($_POST['submit'])) {


    $adsoyad = $_POST['adsoyad'];
    $email = $_POST['email'];
    $sifre = $_POST['pwd'];
    $sifre2 = $_POST['pwd2'];
    $tel = $_POST['tel'];
    $kullAdi = $_POST['kullAdi'];

    if($sifre != $sifre2){
        echo '<script>alert("Şifreler Uyuşmuyor")</script>';
    }else{
        adminGuncelle($kullanicilar[0], $kullAdi, $email, $sifre, $adsoyad, $tel);
    }
    header("location: index.php");
}

?>
<main class="content">
    <?php require_once "../inc/navbar.php" ?>


    <div class="col-12">
        <div class="row">
            <div role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card p-3 p-lg-4">
                                <div class="text-center text-md-center mb-4 mt-md-0">
                                    <h1 class="mb-0 h4">Profilim | <?php echo $kullanicilar[2] ?></h1>
                                </div>
                                <form action="" method="post" class="mt-4">
                                    <!-- Form -->

                                    <div class="form-group mb-4">
                                        <label for="email">Ad Soyad</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                                </svg>
                                            </span>
                                            <input type="text" name="adsoyad" class="form-control" value="<?php echo $kullanicilar[2] ?>" autofocus required>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="email">Kullanici Adi</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                                </svg>
                                            </span>
                                            <input type="text" name="kullAdi" class="form-control" value="<?php echo $kullanicilar[1] ?>"  required>
                                        </div>
                                    </div>


                                    <div class="form-group mb-4">
                                        <label for="email">Emailiniz</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                                </svg>
                                            </span>
                                            <input type="email" name="email" class="form-control" value="<?php echo $kullanicilar[3] ?>" placeholder="john@ms.com" id="email" required>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <div class="form-group">
                                        <!-- Form -->
                                        <div class="form-group mb-4">
                                            <label for="password">Parola :</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon2">
                                                    <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                                <input type="password" placeholder="Parola" class="form-control" name="pwd">
                                            </div>
                                        </div>
                                        <!-- End of Form -->
                                        <!-- Form -->
                                        <div class="form-group mb-4">
                                            <label for="confirm_password">Parola Tekrar</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon2">
                                                    <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                                <input type="password" name="pwd2" placeholder="Parola" class="form-control" id="confirm_password">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <!-- Form -->
                                            <div class="form-group mb-4">
                                                <label for="password">Telefon :</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon3">
                                                    </span>
                                                    <input type="text" name="tel" value="<?php echo $kullanicilar[5] ?>" placeholder="Parola" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" name="submit" class="btn btn-gray-800">Onayla</button>
                                        </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <iframe src="./SSS.php" width="100%" frameborder="0"></iframe>
</main>


<?php require_once '../inc/footer.php'; ?>