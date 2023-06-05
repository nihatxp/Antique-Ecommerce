<?php
require_once 'system/config.php';
session_write_close();
require_once 'admin/inc/header.php'; ?>

<main class="content">

  <?php require_once "admin/inc/navbar.php" ?>
  <div class="row">
    <div class="col-12 col-xl-12">
      <div class="card card-body border-0 shadow mb-4">
        <h2 class="h5 mb-4">Urun Ekle</h2>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="col-12">
            <div class="card card-body border-0 shadow">
              <h2 class="h5 mb-4">Urun Fotografi Ekle</h2>
              <div class="d-flex align-items-center">
                <div class="me-3">
                  <!-- Avatar -->
                  <img class="rounded avatar-xl" id='urunresim' src="../assets/img/default-urun.png" alt="change cover">
                </div>
                <div class="file-field">
                  <div class="d-flex justify-content-xl-center ms-xl-3">
                    <div class="d-flex">
                      <svg class="icon text-gray-500 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                      </svg>
                      <input type="file" name="urun-foto" accept="image/*" id='inpfile'>
                      <div class="d-md-block text-left">
                        <div class="fw-normal text-dark mb-1">Choose Image</div>
                        <div class="text-gray small">JPG, GIF or PNG. Max size of 800K</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><br />
          <div class="row">

            <div class="col-md-6 mb-3">
              <div>

                <label for="urun-adi">Urun Adi</label>
                <input class="form-control" name="urun-adi" id="urunadi" type="text" placeholder="Urun Adi" required>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div>
                <label for="urun-aciklama">Urun Aciklamasi</label>
                <input class="form-control" name="urun-aciklama" id="urun-aciklama" type="text" placeholder="Urun Aciklamasi" required>
              </div>
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-md-6 mb-3">
              <label for="urun-fiyat">Urun Fiyati</label>
              <div class="input-group">
                </span>
                <input class="form-control" name="urun-fiyat" id="urun-fiyat" type="number" required>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="kategori">Kategori</label>

              <select class="form-select mb-0" id="kategori" name="kategori" aria-label="Kategori">
                <?php
                foreach (getirKategoriler() as $row) {

                  echo '<option value="' . $row['kategori_id'] . '">' . $row['kategori_ad'] . '</option>';
                }
                ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="detay">Urun Detayi</label>
                <textarea maxlength="1000" class="form-control" name="detay" id="detay" placeholder="Detay" required> </textarea>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="stok">Stok</label>
                <input class="form-control" id="stok" name="stok" value="ekle" type="number" placeholder="50" required>
              </div>
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <div class="form-group">
              <input class="form-control btn-outline-indigo" name="submit" type="submit" placeholder="50" required>
            </div>
          </div>

        </form>

        <?php
        if (isset($_POST['submit'])) {
          
          $urunadi = $_POST['urun-adi'];
          $urunaciklama = $_POST['urun-aciklama'];
          $urunfiyat = $_POST['urun-fiyat'];
          $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : 0 ;
          if($kategori == 0){
            EkleKategori("Ana Kategori", 1);
          }
          $detay = $_POST['detay'];
          $stok = $_POST['stok'];

          print_r($_FILES['urun-foto']['size']);
          if ($_FILES['urun-foto']['size'] == 0) {
            $urunfoto = "default.jpg";
          } else {
            $urunfoto = date('dmYHis').str_replace(" ", "", basename($_FILES['urun-foto']['name']));
            $urunfoto_tmp = $_FILES['urun-foto']['tmp_name'];

            

            move_uploaded_file($urunfoto_tmp, "../../assets/img/urunler/$urunfoto");
          }

          EkleUrun($kategori, date('Y-m-d H:i:s'), $urunadi, $urunaciklama, $detay, $urunfiyat, $urunfoto, $urunadi, $stok, 1, 0);
        }
        ?>


      </div>

    </div>
   
  </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script>
    var imgavat = $('#urunresim');
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


  <div class="card theme-settings bg-gray-800 theme-settings-expand" id="theme-settings-expand">
    <div class="card-body bg-gray-800 text-white rounded-top p-3 py-2">
      <span class="fw-bold d-inline-flex align-items-center h6">
        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
        </svg>
        Settings
      </span>
    </div>
  </div>

  <?php require_once 'inc/footer.php'; ?>

  </div>


  </body>

  </html>