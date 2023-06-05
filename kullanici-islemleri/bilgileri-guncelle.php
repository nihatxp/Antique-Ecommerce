<?php
require_once('system/config.php');
if ($_SESSION['Kullanici'] == null) {
    header("Location: index.php");
} else {
    $kullanici = idIleKullCek($_SESSION['Kullanici']);
}
session_write_close();

echo str_replace('<li><a href="../giris.php">Giris Yap</a></li>', '', str_replace('./', '../', file_get_contents('inc/header.php'))); // ic dizinde oldugum icin header iceriklerinin yuklenmesi icin ../ koydum ve Giris Yap butonunu kaldirdim
echo file_get_contents('inc/sidebar-menu.php');
echo file_get_contents('inc/sidebar-sepet.php');
session_start();
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
<!-- main-search start -->
<?php require_once('inc/sidebar-menu.php'); ?>
<div class="breadcrumb-area pt-205 pb-210" style="background-image: url(../assets/img/bg/breadcrumb.jpg)">
    <div class="container">
        <div class="breadcrumb-content">
            <h2>Guncelleme Ekrani</h2>
            <ul>
                <li><a href="#">home</a></li>
                <li> Guncelleme Ekrani | <?php echo inp_filter(idIleKullCek($_SESSION['Kullanici'])[0][5]) ?></li>
            </ul>
        </div>
    </div>
</div>
<!-- Bilgileri Guncelle-area start -->
<div class="Bilgileri Guncelle-area ptb-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-12 col-lg-6 col-xl-6 ml-auto mr-auto">
                <div class="login">
                    <div class="login-form-container">
                        <div class="login-form">
                            <div class="inner">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <h3>Guncelle | <?php echo inp_filter(idIleKullCek($_SESSION['Kullanici'])[0][5]) ?></h3>
                                    <div class="form-group">
                                        <div class="form-wrapper">
                                            <label for="">Ad Soyad:</label>
                                            <div class="form-holder">
                                                <input type="text" name='adsoyad' class="form-control" value="<?php echo inp_filter(idIleKullCek($_SESSION['Kullanici'])[0][5]) ?>">
                                            </div>
                                        </div>
                                        <div class="form-wrapper">
                                            <label for="">Email:</label>
                                            <div class="form-holder">
                                                <input type="text" name="email" class="form-control" value="<?php echo inp_filter(idIleKullCek($_SESSION['Kullanici'])[0][3]) ?>">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="form-wrapper">
                                            <div class="form-holder">
                                                <img class='avat' height=90px id='avat' src='../assets/img/kullanici-profiles/<?php echo inp_filter(idIleKullCek($_SESSION['Kullanici'])[0][2]) ?>' alt='img'>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-wrapper">
                                        <label for="">Profil Fotografi</label>

                                        <div class="form-holder">
                                            <input type="file" name="profilg" id='inpfile' accept="image/png, image/jpeg" class="form-control" value="Profil Fotografi">
                                        </div>
                                    </div>



                            </div>

                            <div class="form-group">
                                <div class="form-wrapper">
                                    <label for="">Country:</label>
                                    <div class="form-holder">
                                        <select name="adres" id="" class="form-control">
                                            <?php
                                            require_once('../inc/countries.php');

                                            foreach ($countries as $key => $value) {
                                                idIleKullCek($_SESSION['Kullanici'])[0][6] == $key ? $selected = 'selected' : $selected = '';
                                                echo  "<option " . $selected . " value='$key'>$value</option>";
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-end">
                                <div class="button-holder">
                                    <button class="button" name='submit'>Bilgileri Guncelle</button>
                                </div>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php echo str_replace('./', '../', file_get_contents('../inc/footer.php')); ?>


<?php

try {

    if (isset($_POST['submit'])) {

        //dosyalar ust uste yazilmasin diye tarih damgasi ekliyoruz

        if ($_FILES['profilg']['size'] != 0) {   //eger fotograf varsa
            $fileName = date('dmYHis') . str_replace(" ", "", basename($_FILES["profilg"]["name"]));
            if (selectKullaniciPhoto($_SESSION['Kullanici'])[0][0] != "default.jpg") {
                unlink('../assets/img/kullanici-profiles/' . selectKullaniciPhoto($_SESSION['Kullanici'])[0][0]);
            }
            try {
                $destination_path = getcwd() . "../../assets/img/kullanici-profiles" . DIRECTORY_SEPARATOR;
                $target_path = $destination_path . $fileName;
                move_uploaded_file($_FILES['profilg']['tmp_name'], $target_path);
            } catch (Exception $e) {
                echo $e->getMessage();
            }


            guncelleKullaniciWithPhoto(isset($_FILES['profilg']['name']) ? $fileName : "null", $_POST['email'], $_POST['adsoyad'], $_POST['adres'], '1', $kullanici[0][0]);
        } else {
            echo $_FILES["profilg"]["name"];
            guncelleKullaniciWithoutPhoto($_POST['email'], $_POST['adsoyad'], $_POST['adres'], '1', $kullanici[0][0]);
        }

        echo "<script>window.location.href='../kullanicihesabi.php'; </script>";
        exit;
    }
} catch (PDOException $e) {
    if (str_contains($e, 'SQLSTATE[23000]')) {
        header("location: ../giris.php");
        exit;
    } else {
        echo $e;
    }
}



?>


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    var imgavat = $('#avat');
    var inpfile = $('#inpfile');
    inpfile.on('change', function() {
        if (this.files[0]) {
            var reader = new FileReader();

            reader.readAsDataURL(this.files[0]);

            reader.onloadend = function() {
                imgavat.attr('src', reader.result);
            };
        }
    });
</script>

</html>