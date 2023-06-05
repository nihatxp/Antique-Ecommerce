<?php
require_once 'system/config.php';
session_write_close();
require_once 'admin/inc/header.php'; ?>

<main class="content">

    <?php require_once "admin/inc/navbar.php" ?>


    <div class="table-settings mb-4">
        <div class="row align-items-center justify-content-between">
          
           
        </div>
    </div>

    <?php



    $bakim = 0;
    if (isset($_POST['bakim'])) {
        $bakim = 1;
    } else {
        $bakim = 0;
    }
    siteDurumunuGuncelle($bakim);

    if (bakimDurumu()[0][0] == 1) {
        echo '<div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Bakım Modu Aktif</h4>
        <p>Site, Bakım Modunda Olduğu İçin Erişilemez</p>
        <hr>
        <p class="mb-0">Bakim Modunu Kapatmak İçin Ayarlar Sayfasından Bakım Modunu Kapatmanız Gerekmektedir</p>
      </div>';
    }
    ?>


    <div class="card card-body border-0 shadow mb-4 mb-xl-0">
        <h2 class="h5 mb-4">Sayfa Durumu</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom">
                <div>
                    <h3 class="h6 mb-1">Bakim Durumu</h3>
                    <p class="small pe-4">Aktif Ederseniz Site Erisilemez Hale Gelir</p>
                </div>
                <form action="" method="post">
                    <div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" <?php if (bakimDurumu()[0][0] == 1) {
                                                                echo "checked";
                                                            } ?> name='bakim' type="checkbox" id="user-notification-1">
                            <button class="btn btn-outline-indigo btn-rounded btn-sm px-2 waves-effect waves-light\">Uygula</button>

                        </div>
                    </div>
                </form>
            </li>
        </ul>
    </div>
    <br />



    <?php
    if (isset($_POST['AnaSayfaSubmit'])) {
        $baslik = $_POST['baslik'];
        $icerik = $_POST['icerik'];
        AnaSayfaBasligiGuncelle($baslik, $icerik);
    }

    if (isset($_POST['HakkimizdaSubmit'])) {
        $baslik = $_POST['baslik'];
        $icerik = $_POST['icerik'];
        HakkimizdaBasligiGuncelle($baslik, $icerik);
    }

    
    ?>
    <div class="card card-body border-0 shadow mb-4 mb-xl-0">
        <h2 class="h5 mb-4">Ana Sayfa</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item ">
                <form action="" method="post">
                    <div class="my-4">
                        <label for="textarea">Sayfa Basligi</label>
                        <textarea name="baslik" class="form-control" rows="2">
                        <?php echo AnaSayfaBasligiCek()[0] ?>
                        </textarea>
                    </div>
                    <div class="my-4">
                        <label for="textarea">Sayfa Icerigi</label>
                        <textarea name="icerik" class="form-control" rows="6"><?php echo AnaSayfaBasligiCek()[1] ?></textarea>
                    </div>
                    <button class="btn btn-outline-indigo btn-rounded btn-sm px-2 waves-effect waves-light\" name="AnaSayfaSubmit">Uygula</button>
                </form>
            </li>
        </ul>
    </div>

    <br />

    <div class="card card-body border-0 shadow mb-4 mb-xl-0">
        <h2 class="h5 mb-4">Hakkimizda</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item ">
                <form action="" method="post">
                    <div class="my-4">
                        <label for="textarea">Sayfa Basligi</label>
                        <textarea name="baslik" class="form-control" rows="2">
                        <?php echo HakkimizdaBasligiCek()[0] ?>
                        </textarea>
                    </div>
                    <div class="my-4">
                        <label for="textarea">Sayfa Icerigi</label>
                        <textarea name="icerik" class="form-control" rows="6"><?php echo HakkimizdaBasligiCek()[1] ?></textarea>
                    </div>
                    <button class="btn btn-outline-indigo btn-rounded btn-sm px-2 waves-effect waves-light\" name="HakkimizdaSubmit">Uygula</button>
                </form>
            </li>
        </ul>
    </div>






    <?php require_once 'admin/inc/footer.php'; ?>