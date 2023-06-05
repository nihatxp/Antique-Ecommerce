<?php
require_once 'system/config.php';
session_write_close();
require_once "admin/inc/header.php";
?>


<?php

if (isset($_POST['kupon-ekle'])) {
  if (is_numeric($_POST['kupon-miktar'])) {
    if($_POST['kupon-miktar'] > 100){
      echo "<script>alert('Kupon miktarı 100'den büyük olamaz.');</script>";
      return;
    }
    $kuponAdi = $_POST['kupon-ad'];
    $kuponMiktari = $_POST['kupon-miktar'];
    EkleKupon($kuponAdi, $kuponMiktari);
  } else {
    echo "<script>alert('Kupon miktarı sayısal olmalıdır.');</script>";
  }
}

if (isset($_POST['kupon-guncelle'])) {
  $key = array_key_first($_POST);
  $id = $_POST[$key];

  $deger = $_POST["degerKod" . $key];
  $deger2 = $_POST["degerMiktar" . $key];

  guncelleKupon($id, $deger, $deger2);
  $_POST = null;
}

if (isset($_POST['kupon-sil'])) {
  $key = array_key_first($_POST);
  $id = $_POST[$key];
  SilKupon($id);
  $_POST = null;
}

?>
<main class="content">
  <?php require_once "admin/inc/navbar.php" ?>


  <div class="col-12">
    <div class="row">
      <div class="col-md-7 mx-auto">
        <div class="card card-body border-0 shadow">
          <h2 class="h5 mb-4">Kuponlar</h2>
          <div class="d-flex align-items-center">
            <div class="file-field">
              <div class="d-flex justify-content-xl-center ms-xl-6">
              </div>
            </div>
          </div>
          <form action="" method="POST">
            <input type="text" name="kupon-ad" placeholder="Kupon Adi" required>
            <input type="text" name="kupon-miktar" placeholder="Kupon Yuzde" required>
            <button class="btn btn-outline-indigo btn-rounded btn-sm px-2 waves-effect waves-light" name="kupon-ekle">Ekle</button>
          </form>
          <hr>

          <?php
          $i = 0;
          foreach (getirKuponlar() as $row) {
            echo "<form action=\"\" method=\"POST\">";
            echo "<input type=\"hidden\" value=\"" . $row['id'] . "\" name=\"" . $row['id'] . "\" >";

            echo "<input type=\"text\" oninput=\"onclickhandler(this)\" value=\"" . $row['kupon_kodu'] . "\" placeholder=\"Kupon Kodu\"  id=\"" . $i . "\"   name=\"" . "degerKod" . $row['id'] . "\"  >";

            echo "<input type=\"text\" oninput=\"onclickhandler(this)\" value=\"" . $row['kupon_miktar'] . "\" placeholder=\"Kupon Adi\"  id=\"" . $i . "\"   name=\"" . "degerMiktar" . $row['id'] . "\"  > &nbsp;";

            echo "<button class=\"btn btn-outline-indigo btn-rounded btn-sm px-2 waves-effect waves-light\" name=\"kupon-link\" id=\"btn" . $i . "\" >Link Al</button> &nbsp;";

            echo "<button class=\"btn btn-outline-indigo btn-rounded btn-sm px-2 waves-effect waves-light\" name=\"kupon-guncelle\" id=\"btn" . $i . "\" >Güncelle</button> &nbsp;";

            echo "<button class=\"btn btn-outline-danger btn-rounded btn-sm px-2 waves-effect waves-light\" name=\"kupon-sil\" id=\"btn" . $i . "\" >Sil</button> &nbsp;";

            echo "</form>";

            $i++;
          }
          ?>
        </div>


        <?php 

        if (isset($_POST['kupon-link'])) {
          $key = array_key_first($_POST);
          $id = $_POST[$key];
          $kupon = getirKupon($id);
          $kuponKodu = $kupon['kupon_kodu'];
          $kuponLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[SERVER_NAME]"."/Antika/sepet.php"."?coupon_code=$kuponKodu";
          echo "<div class=\"alert alert-success\" role=\"alert\">Kupon Linki: 
          <a href=$kuponLink> $kuponLink</a> </div>";

        }

?>

      </div>
    </div>
  </div>


<?php require_once 'admin/inc/footer.php'; ?>