<?php
require_once 'system/config.php';
session_write_close();
require_once "admin/inc/header.php";
?>


<?php

if (isset($_POST['kategori-ekle'])) {
  $kategoriadi = $_POST['kategori-adi'];
  EkleKategori($kategoriadi);
}

if (isset($_POST['kategori-guncelle'])) {

  $key = array_key_first($_POST);

  $id = $_POST[$key];
  $deger = $_POST["deger" . $key];

  if ($deger == "") {
    echo $id;
    SilKategori($id);
    $_POST = null;
  } else {
    GuncelleKategori($id, $deger);
    $_POST = null;
  }
}

?>
<main class="content">
  <?php require_once "admin/inc/navbar.php" ?>


  <div class="col-12">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="card card-body border-0 shadow">
          <h2 class="h5 mb-4">Kategoriler</h2>
          <div class="d-flex align-items-center">
            <div class="file-field">
              <div class="d-flex justify-content-xl-center ms-xl-6">
              </div>
            </div>
          </div>
          <form action="" method="POST">
            <input type="text" name="kategori-adi" placeholder="Kategori Adi" required>
            <button class="btn btn-outline-indigo btn-rounded btn-sm px-2 waves-effect waves-light" name="kategori-ekle">Ekle</button>
          </form>
          <hr>

          <?php
          $i = 0;
          foreach (getirKategoriler() as $row) {
            echo "<form action=\"\" method=\"POST\">";
            echo "<input type=\"hidden\" value=\"" . $row['kategori_id'] . "\" name=\"" . $row['kategori_id'] . "\" placeholder=\"Kategori Adi\">";

            echo "<input type=\"text\" oninput=\"onclickhandler(this)\" value=\"" . $row['kategori_ad'] . "\" placeholder=\"Kategori Adi\"  id=\"" . $i . "\"   name=\"" . "deger" . $row['kategori_id'] . "\"  >";

            echo "<button class=\"btn btn-outline-indigo btn-rounded btn-sm px-2 waves-effect waves-light\" name=\"kategori-guncelle\" id=\"btn" . $i . "\" >Güncelle</button>";
            
            echo "</form>";
            $i++;
          }
          ?>
          <label style="display:none;" id="uyari">Uyari : Bu Kategoriyi Silerseniz Ilgili Urunlerinizin Kategorisi Silinecektir. Urunlerinizi Duzenlemeniz Gerekecektir</label>
        </div>

        <script>
          function onclickhandler(e) {
            console.log(e.value);
            buttonname = "btn" + e.id;
            if (e.value == "") {
              console.log(buttonname);
              document.getElementById(buttonname).innerText = "Sil";
              document.getElementById("uyari").style.display = "block";
            } else {
              document.getElementById(buttonname).innerText = "Güncelle";
              document.getElementById("uyari").style.display = "none";
            }
          }
        </script>
      </div>
    </div>
  </div>

</main>


<?php require_once 'admin/inc/footer.php'; ?>