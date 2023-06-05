<?php
require_once 'system/config.php';
session_write_close();
require_once 'admin/inc/header.php'; ?>

<?php

if (isset($_POST['silKullanici'])) {
  $kullaniciId = $_POST['kullaniciId'];
  SilKullanici($kullaniciId);
}
?>


<main class="content">


  <?php

  if (isset($_POST['submitkullanici'])) {
    $key = array_key_first($_POST);
    $kullAdi = $_POST["kullaniciAd" . $key];
    $kullMail = $_POST["kullMail" . $key];
    $kullAdres = $_POST["kullAdres" . $key];
    $kullSifre = $_POST["kullParola" . $key];

    isset($_POST["kullDurum" . $key]) == "on" ? $kullDurum = 1 : $kullDurum = 0;

    $kullFoto = "kullanici-foto" . $key;
    $fileName = "";
    // print_r($_FILES[$kullFoto]['name']);
    if ($_FILES[$kullFoto]['size'] > 0) {
      $fileName = date('dmYHis') . str_replace(" ", "", basename($_FILES[$kullFoto]['name']));

      if (selectKullaniciPhoto($key)[0][0] != "default.jpg") {
        try {
          unlink('../../assets/img/kullanici-profiles/' . selectKullaniciPhoto($key)[0][0]);
        } catch (Exception $e) {
          echo $e->getMessage();
        }
      }
      try {
        $destination_path = getcwd() . "../../../assets/img/kullanici-profiles" . DIRECTORY_SEPARATOR;
        $target_path = $destination_path . $fileName;
        move_uploaded_file($_FILES["kullanici-foto" . $key]['tmp_name'], $target_path);
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    } else {
      $fileName = "";
    }

    print_r($kullFoto);
    guncelleKullanici($key, $fileName, $kullMail, $kullSifre, $kullAdi, $kullAdres, $kullDurum);
  }


  ?>
  <?php require_once "admin/inc/navbar.php" ?>
  <div class="row">









    <div class="card card-body border-0 shadow table-wrapper table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th class="border-gray-200">Kullanıcı ID</th>
            <th class="border-gray-200">Kullanıcı Mail</th>
            <th class="border-gray-200">Kullanıcı Ad</th>
            <th class="border-gray-200">Kullanıcı Adres</th>
            <th class="border-gray-200">Kullanıcı Fotoğrafı</th>
            <th class="border-gray-200">Kullanıcı Durum</th>
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

          $limit = 6;


          $kullSayisi = count(ListeleKullanicilar());

          $sayfalar = ceil($kullSayisi / $limit);


          if ($page > $sayfalar) {
            $start = 0;
          } else {
            $start = ($page > 1) ? ($page * $limit) - $limit : 0;
          }

          $kullanicilar = ListeleKullanicilar($start, $limit);

          $i = 0;
          foreach ($kullanicilar as $kullanici) {
          ?>

            <tr>
              <td>
                <?php echo $kullanici['kullanici_id'] ?>
              </td>
              <td>
                <?php echo $kullanici['kullanici_mail'] ?>
              </td>

              <td>
                <?php echo inp_filter($kullanici['kullanici_adsoyad']) ?>
              </td>

              <td>
                <?php echo $kullanici['kullanici_adres'] ?>
              </td>

              <td><img width=50px src="../../assets/img/kullanici-profiles/<?php echo $kullanici['kullanici_resim'] ?>" alt=""></td>

              <td><?php
                  if ($kullanici['kullanici_durum'] == 1) {
                    echo "<span class=\"fw-bold text-succes\">Aktif</span>";
                  } else {
                    echo "<span class=\"fw-bold text-warning\">Pasif</span>";
                  }

                  ?>
              </td>

  

              <td>
                <div class="col-lg-4">

                  <button type="button" class="btn btn-block btn-gray-800 mb-3" name="duzenleKullanici" data-bs-toggle="modal" data-bs-target="#modal-form-signup<?php echo $i ?>">Duzenle</button>
                  <form action="" method="post" style="display:inline" enctype="multipart/form-data">
                    <input type="hidden" name="kullaniciId" value="<?php echo $kullanici['kullanici_id'] ?>">
                    <button class="btn btn-danger btn-red-800 mb-3" name="silKullanici">Sil</button>
                  </form>
                  <!-- Modal Content -->
                  <div class="modal fade" id="modal-form-signup<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form-signup" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-body p-0">
                          <div class="card p-3 p-lg-4">
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center text-md-center mb-4 mt-md-0">
                              <h1 class="mb-0 h4">Kullanici Düzenle</h1>
                            </div>
                            <form action="" method="post" class="mt-4" enctype="multipart/form-data">
                              <!-- Form -->
                              <div class="form-group mb-4">
                                <label for="email">Kullanici Adı</label>
                                <div class="input-group">
                                  <span class="input-group-text" id="basic-addon1">
                                  </span>
                                  <input type="hidden" name="<?php echo $kullanici['kullanici_id'] ?>" value="<?php echo $kullanici['kullanici_id'] ?>">
                                  <input type="text" name="<?php echo "kullaniciAd" . $kullanici['kullanici_id'] ?>" value="<?php echo $kullanici['kullanici_adsoyad'] ?>" class="form-control" placeholder="Kullanici Adi" id="text" autofocus required>
                                </div>
                              </div>

                              <div class="form-group mb-4">
                                <label for="email">Mail</label>
                                <div class="input-group">
                                  <span class="input-group-text" id="basic-addon1">
                                  </span>
                                  <input type="hidden" name="<?php echo $kullanici['kullanici_id'] ?>" value="<?php echo $kullanici['kullanici_id'] ?>">
                                  <input type="text" name="<?php echo "kullMail" . $kullanici['kullanici_id'] ?>" value="<?php echo $kullanici['kullanici_mail'] ?>" class="form-control" placeholder="Mail" id="text" required>
                                </div>
                              </div>

                              <div class="form-group mb-4">
                                <label for="email">Kullanici Parola</label>
                                <div class="input-group">
                                  <span class="input-group-text" id="basic-addon1">
                                  </span>
                                  <input type="hidden" name="<?php echo $kullanici['kullanici_id'] ?>" value="<?php echo $kullanici['kullanici_id'] ?>">
                                  <input type="text" name="<?php echo "kullParola" . $kullanici['kullanici_id'] ?>" class="form-control" placeholder="Parola" id="text">
                                </div>
                              </div>



                              <select class="form-select mb-0" id="kategori" name="kullAdres<?php echo $kullanici['kullanici_id'] ?>" aria-label="Kategori">

                                <?php
                                require_once('../../inc/countries.php');

                                foreach ($countries as $key => $value) {
                                  $kullanici['kullanici_adres'] == $key ? $selected = 'selected' : $selected = '';
                                  echo  "<option " . $selected . " value='$key'>$value</option>";
                                }

                                ?>
                              </select><br />

                              <div class="form-group mb-4">
                                <div class="input-group">

                                  <div class="d-flex align-items-center">
                                    <div class="me-3">

                                      <img class="rounded avatar-xl" id='kullaniciresim' src="../../assets/img/kullanici-profiles/<?php echo $kullanici['kullanici_resim'] ?>" alt="change cover">
                                    </div>
                                    <div class="file-field">
                                      <div class="d-flex justify-content-xl-center ms-xl-3">
                                        <div class="d-flex">
                                          <svg class="icon text-gray-500 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                                          </svg>
                                          <input type="file" name="kullanici-foto<?php echo $kullanici['kullanici_id'] ?>" accept="image/*" id='inpfile<?php echo $kullanici['kullanici_id'] ?>'>
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
                              <input class="form-check-input" type="checkbox" name="kullDurum<?php echo $kullanici['kullanici_id'] ?>" <?php
                                                                                                                                        if ($kullanici['kullanici_durum'] == 1) {
                                                                                                                                          echo "checked";
                                                                                                                                        }                                                                                      ?>>
                              <label class="form-check-label fw-normal mb-0" for="remember">
                                &nbsp;Kullanici Aktiflik Durumu</a>
                              </label>
                            </div>
                          </div>




                        </div>
                        <div class="d-grid">
                          <button type="submit" name="submitkullanici" class="btn btn-gray-800">Sign up</button>
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