<?php
require_once 'system/config.php';
session_write_close();
require_once 'admin/inc/header.php'; ?>


<?php

if (isset($_POST['urunSil'])) {

  if (SelectUrunFoto($_POST['urunSil']) != "default.jpg" && SelectUrunFoto($_POST['urunSil']) != null) {
    try {
      if(SelectUrunFoto($_POST['urunSil'])[0] != "default.jpg"){
        unlink("../../assets/img/urunler/" . SelectUrunFoto($_POST['urunSil'])[0]);
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  urunSil($_POST['urunSil']);
}

?>



<main class="content">

  <?php require_once "admin/inc/navbar.php" ?>
  <div class="row">


    <?php

    if (isset($_POST['select'])) {
      $select = $_POST['select'];
      if ($select == "0") {
        $filter = null;
      }
      if ($select == "oneCikanUrunler") {
        $filter = 'onecikan';
        echo "<h3>One Cikan Urunler</h3>";
      } else if ($select == "pasifUrunler") {
        $filter = 'pasif';
        echo "<h3>Pasif Urunler</h3>";
      } else if ($select == "fotografsizUrunler") {
        $filter = 'fotografsiz';
        echo "<h3>Fotografsiz Urunler</h3>";
      } else if ($select == "aciklamasizUrunler") {
        $filter = 'aciklamasiz';
        echo "<h3>Aciklamasiz Urunler</h3>";
      } else if ($select == "stoktaYok") {
        $filter = 'stoktaYok';
        echo "<h3>Stokta Olmayan Urunler</h3>";
      }
    } else {
      $filter = null;
    }


    ?>

    <div class="shop-selector">
      <form action="" method="post">
        <label>Filtrele - <?php echo $filter ?></label>
        <select name="select" onchange="this.form.submit()">
          <option <?php if ($filter == null) {
                    echo "selected";
                  } ?> value="0">Tüm Kategoriler</option>
          <option <?php if ($filter == 'onecikan') {
                    echo "selected";
                  } ?> value="oneCikanUrunler">One Cikan Urunler</option>
          <option <?php if ($filter == 'pasif') {
                    echo "selected";
                  } ?> value="pasifUrunler">Pasif Urunler</option>
          <option <?php if ($filter == 'fotografsiz') {
                    echo "selected";
                  } ?> value="fotografsizUrunler">Fotografsiz Urunler</option>
          <option <?php if ($filter == 'aciklamasiz') {
                    echo "selected";
                  } ?> value="aciklamasizUrunler">Aciklamasiz Urunler</option>
          <option value="stoktaYok">Stokta Olmayan Urunler</option>
        </select>
      </form>
    </div>


    <?php


    if (isset($_POST['submitUrun'])) {
      $urunAdi = $_POST["urunAd" . array_key_first($_POST)];
      $urunFiyat = $_POST["urunFiyat" . array_key_first($_POST)];
      $urunDetay = $_POST["urunDetay" . array_key_first($_POST)];
      $kategori = $_POST["kategori" . array_key_first($_POST)];
      $urunStok = $_POST["urunStok" . array_key_first($_POST)];
      $urunId = array_key_first($_POST);

      $urunAktif = 0;
      if (isset($_POST["urunAktif" . array_key_first($_POST)])) {
        $urunAktif = 1;
      }

      $oneCikar = 0;
      if (isset($_POST["oneCikar" . array_key_first($_POST)])) {
        $oneCikar = 1;
      }

      if ($_FILES['urun-foto' . array_key_first($_POST)]['size'] != 0) {
        $urunFoto = $_FILES['urun-foto' . array_key_first($_POST)]['name'];
        $urunFotoTmp = $_FILES['urun-foto' . array_key_first($_POST)]['tmp_name'];
        $urunFotoSize = $_FILES['urun-foto' . array_key_first($_POST)]['size'];
        $urunFotoType = $_FILES['urun-foto' . array_key_first($_POST)]['type'];

        $fileName = date('dmYHis') . str_replace(" ", "", basename($urunFoto));

        try {
          if (!SelectUrunFoto($urunId)[0] == "default.jpg") {
            unlink('../../assets/img/urunler/' . SelectUrunFoto($urunId))[0];
          }
        } catch (Exception $e) {
          echo $e->getMessage();
        }

        
        move_uploaded_file($urunFotoTmp, "../../assets/img/urunler/" . $fileName);
        try {
          $destination_path = getcwd() . "../../assets/img/urunler" . DIRECTORY_SEPARATOR;
          $target_path = $destination_path . $fileName;
        } catch (Exception $e) {
          echo $e->getMessage();
        }

       
      } else {
        $urunFoto = "0";
      }

      if ($urunFoto == "0") {
        GuncelleUrunFotografsiz($kategori, date("Y-m-d H:i:s"), $urunAdi, "", $urunDetay, $urunFiyat, "w", $urunStok, $urunAktif, $oneCikar, $urunId);
      } else {
        GuncelleUrun($kategori, date("Y-m-d H:i:s"), $urunAdi, "", $urunDetay, $urunFiyat, $fileName, "w", $urunStok, $urunAktif, $oneCikar, $urunId);
      }
    }
    ?>




    <div class="card card-body border-0 shadow table-wrapper table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th class="border-gray-200">Ürün ID</th>
            <th class="border-gray-200">Ürün Adı</th>
            <th class="border-gray-200">Ürün Açıklaması</th>
            <th class="border-gray-200">Ürün Durumu</th>
            <th class="border-gray-200">Ürün Fotoğrafı</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($_GET['page'])) {
            $page = htmlspecialchars($_GET["page"]);
            $page = (int) $page;
          } else {
            $page = 1;
          }

          $limit = 6; // Her sayfada gösterilecek urun sayısı


          $urunSayisi = KacUrunVar($filter)[0];

          $sayfalar = ceil($urunSayisi / $limit);


          if ($page > $sayfalar) {
            $start = 0;
          } else {
            $start = ($page > 1) ? ($page * $limit) - $limit : 0;
          }

          $urunler = ListeleUrun($start, $limit, $filter);

          $i = 0;
          foreach ($urunler as $urun) {
          ?>
            <tr>
              <td>
                <div ondblclick="document.getElementById('test<?php echo $i ?>').disabled=false;">
                  <input type="text" id="test<?php echo $i ?>" value="<?php echo $urun['urun_id'] ?>" disabled="disabled">
                </div>
              </td>
              <td>
                <div ondblclick="document.getElementById('test<?php echo $i . $i ?>').disabled=false;">
                  <input type="text" id="test<?php echo $i . $i ?>" value="<?php echo $urun['urun_ad'] ?>" disabled="disabled">
                </div>
              </td>

              <td>
                <div ondblclick="document.getElementById('test<?php echo $i . $i . $i ?>').disabled=false;">
                  <input type="text" id="test<?php echo $i . $i . $i ?>" value="<?php echo $urun['urun_detay'] ?>" disabled="disabled">
                </div>
              </td>
              <td><?php
                  if ($urun['urun_durum'] == 1) {
                    echo "<span class=\"fw-bold text-succes\">Aktif</span>";
                  } else {
                    echo "<span class=\"fw-bold text-warning\">Pasif</span>";
                  }

                  ?></td>
              <td><img src="../../assets/img/urunler/<?php echo $urun['urun_img'] ?>" alt="" width="50px" height="50px"></td>
              <td>
                <div class="col-lg-4">
                  <!-- Button Modal -->
                  <button type="button" class="btn btn-block btn-gray-800 mb-3" data-bs-toggle="modal" data-bs-target="#modal-form-signup<?php echo $i ?>">Duzenle</button>

                  <form method="POST" style="display:inline">
                    <button type="submit" class="btn btn-block btn-danger mb-3" name="urunSil" value="<?php echo $urun['urun_id'] ?>">Sil</button>
                  </form>
                  <!-- Modal Content -->
                  <div class="modal fade" id="modal-form-signup<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form-signup" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-body p-0">
                          <div class="card p-3 p-lg-4">
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center text-md-center mb-4 mt-md-0">
                              <h1 class="mb-0 h4">Ürün Düzenle</h1>
                            </div>
                            <form action="" method="post" class="mt-4" enctype="multipart/form-data">
                              <!-- Form -->
                              <div class="form-group mb-4">
                                <label for="email">Ürün Adı</label>
                                <div class="input-group">
                                  <span class="input-group-text" id="basic-addon1">
                                  </span>
                                  <input type="hidden" name="<?php echo $urun['urun_id'] ?>" value="<?php echo $urun['urun_id'] ?>">
                                  <input type="text" name="<?php echo "urunAd" . $urun['urun_id'] ?>" value="<?php echo $urun['urun_ad'] ?>" class="form-control" placeholder="Ürün Adı" id="text" autofocus required>
                                </div>
                              </div>

                              <div class="row align-items-center">
                                <div class="col-md-6 mb-3">
                                  <label>Ürün Fiyati</label>
                                  <div class="input-group">
                                    <span class="input-group-text">
                                    </span>
                                    <input type="number" name="<?php echo "urunFiyat" . $urun['urun_id'] ?>" value="<?php echo $urun['urun_fiyat'] ?>" class="form-control" placeholder="Ürün Fiyati" required>
                                  </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label>Ürün Stok</label>
                                  <div class="input-group">
                                    <span class="input-group-text">
                                    </span>
                                    <input type="number" name="<?php echo "urunStok" . $urun['urun_id'] ?>" value="<?php echo $urun['urun_stok'] ?>" class="form-control" placeholder="Ürün Stok" required>
                                  </div>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="form-group mb-4">
                                  <label for="password">Ürün Açıklaması</label>
                                  <div class="input-group">
                                    <textarea type="text" name="<?php echo "urunDetay" . $urun['urun_id'] ?>" placeholder="Password" class="form-control" id="password" required>
                                    <?php echo $urun['urun_detay'] ?>
                                    </textarea>
                                  </div>
                                </div>

                                <select class="form-select mb-0" id="kategori" name="kategori<?php echo $urun['urun_id'] ?>" aria-label="Kategori">

                                  <?php
                                  foreach (getirKategoriler() as $row) {
                                    if ($row['kategori_id'] == $urun['kategori_id']) {
                                      echo '<option value="' . $row['kategori_id'] . '" selected>' . $row['kategori_ad'] . '</option>';
                                    } else {
                                      echo '<option value="' . $row['kategori_id'] . '">' . $row['kategori_ad'] . '</option>';
                                    }
                                  }
                                  ?>
                                </select><br />

                                <div class="form-group mb-4">
                                  <div class="input-group">

                                    <div class="d-flex align-items-center">
                                      <div class="me-3">
                                        <!-- Avatar -->
                                        <img class="rounded avatar-xl" id='urunresim' src="../../assets/img/urunler/<?php echo $urun['urun_img'] ?>" alt="change cover">
                                      </div>
                                      <div class="file-field">
                                        <div class="d-flex justify-content-xl-center ms-xl-3">
                                          <div class="d-flex">
                                            <svg class="icon text-gray-500 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                              <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                                            </svg>
                                            <input type="file" name="urun-foto<?php echo $urun['urun_id'] ?>" accept="image/*" id='inpfile<?php echo $urun['urun_id'] ?>'>
                                            <div class="d-md-block text-left">
                                              <div class="fw-normal text-dark mb-1">Foroğraf Seç</div>
                                              <div class="text-gray small">JPG, GIF veya PNG.</div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- End of Form -->
                              <div class="mb-4">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" name="urunAktif<?php echo $urun['urun_id'] ?>" <?php
                                                                                                                                  if ($urun['urun_durum'] == 1) {
                                                                                                                                    echo "checked";
                                                                                                                                  }                                                                                      ?>>
                                  <label class="form-check-label fw-normal mb-0" for="remember">
                                    Ürün Aktiflik Durumu</a>
                                  </label>
                                </div>
                              </div>

                              <div class="mb-4">
                                <div class="form-check">
                                  <input class="form-check-input" name="oneCikar<?php echo $urun['urun_id'] ?>" type="checkbox" value="" <?php
                                                                                                                                          if ($urun['urun_durum'] == 1) {
                                                                                                                                            echo "checked";
                                                                                                                                          }                                                                                      ?>>
                                  <label class="form-check-label fw-normal mb-0" for="remember">
                                    Ürün One Cikar</a>
                                  </label>
                                </div>
                              </div>


                          </div>
                          <div class="d-grid">
                            <button type="submit" name="submitUrun" class="btn btn-gray-800">Duzenle</button>


                          </div>
                          </form>
                          <div class="mt-3 mb-4 text-center">
                            <span class="fw-normal"></span>
                          </div>


                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End of Modal Content -->
    </div>

    </td>
    </tr>
  <?php
            $i++;
          }
  ?>



  </tbody>
  </table>
  <br />
  </div>


  <form method='GET' action="">
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center m-4">
        <li class="page-item">
          <a class="page-link" href="?page=<?php echo ($page > 1) ? $page - 1 : 1; ?>">Geri</a>
        </li>
        <?php for ($i = 1; $i <= $sayfalar; $i++) : ?>
          <li class="page-item <?php if ($i === $page) echo "active"; ?>">
            <a class="page-link" href="?page=<?php echo $i; ?>" <?php if ($i === $page) echo 'class="selected";' ?>><?php echo $i; ?></a>
          </li>
        <?php endfor; ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?php echo ($page < $sayfalar) ? $page + 1 : $sayfalar; ?>">İleri</a>
        </li>
      </ul>
    </nav>
  </form>


  </div>





  <?php require_once 'admin/inc/footer.php'; ?>

  </div>


  </body>

  </html>