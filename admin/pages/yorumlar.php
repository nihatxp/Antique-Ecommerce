<?php
require_once 'system/config.php';
session_write_close();
require_once 'admin/inc/header.php'; ?>

<main class="content">

  <?php require_once "admin/inc/navbar.php";

  if (isset($_POST['submitOnayla'])) {
    $id = $_POST['id'];
    yorumOnayla($id);
  }
  if (isset($_POST['submitOnayKaldir'])) {
    $id = $_POST['id'];
    OnayKaldir($id);
  }
  if (isset($_POST['sil'])) {
    $id = $_POST['id'];
    yorumSil($id);
  }


  ?>


  <div class="table-settings mb-4">
    <div class="row align-items-center justify-content-between">

      <div class="card card-body border-0 shadow mb-4 mb-xl-0">
        <h2 class="h5 mb-4">Yorumlar</h2>
        <ul class="list-group list-group-flush">
          <li class="list-group-item ">
            <?php
            $i = 0;
            foreach (ListeleYorumlar() as $row) {

              $kullanici = idIleKullCek($row['kullanici_id'])

            ?>

              <div class="card">
                <div class="card__blur__fx"></div>
                <div class="content_to_front">
                  <div class="card__header">

                    <div class="card__header__icon">


                      <img width="35px" height="50px" src="../../assets/img/kullanici-profiles/<?php print_r($kullanici[0]['kullanici_resim']) ?>" class="icon" alt="message icon">
                      <?php


                      echo $kullanici[0]['kullanici_adsoyad'];
                      if ($urun = cekUrun($row['urun_id']) != null) {
                        $urun = cekUrun($row['urun_id'])[0];
                      } else {
                        echo "Urun Bulunamadi";
                      }


                      ?>

                      Şu Ürüne Yorum Yaptı --> <img height="50px" src="../../assets/img/urunler/<?php echo $urun['urun_img'] ?>" alt="">

                      <div style="float:right; margin:5px;">
                        <form action="" method="post" style="display:inline;">
                          <input type="hidden" name="id" value="<?= $row['yorum_id'] ?>">
                          <?php

                          if ($row['yorum_onay'] == "1") {
                            echo "<button type=\"submit\" name=\"submitOnayKaldir\" class=\"btn btn-warning\">Yorum Onayini Kaldir</button>";
                          } else {
                            echo "<button type=\"submit\" name=\"submitOnayla\" class=\"btn btn-primary\">Yorumu Onayla</button>";
                          }


                          ?>

                        </form>

                        <form action="" method="post" style="display:inline;">
                          <input type="hidden" name="id" value="<?= $row['yorum_id'] ?>">
                          <button type="submitSil" name="sil" class="btn btn-danger">Yorumu Sil</button>
                        </form>
                      </div>

                    </div>
                    <div class="card__header__time__right"><?= $row['yorum_zaman'] ?>

                      <?php


                      if ($row['yorum_onay'] == "1") {
                        echo "<span style='color:green; font-weight:bold;'>Onaylandı</span>";
                      } else {
                        echo "<span style='color:red; font-weight:bold;'>Onaylanmadı</span>";
                      }





                      ?>



                    </div>&nbsp;&nbsp;&nbsp;&nbsp;




                  </div>
                  <h3>
                    <?= $row['yorum_detay'] ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;

                  </h3>
                  <p>
                    <?php



                    if ($urun != null) {
                      echo "Ürün Adı : " . "<a target=\"_blank\" href='urun-duzenle.php?id=" . $urun['urun_id'] . "'>" . $urun['urun_ad'] . "</a>";
                    } else {
                      echo "Urun Bulunamadi Urunu Silmis Olabilirsiniz";
                    }
                    ?>

                  </p>
                </div>
              </div>&nbsp;&nbsp;&nbsp;&nbsp;

            <?php
              $i++;
            }

            ?>
          </li>
        </ul>
      </div>
    </div>
  </div>











<?php require_once 'admin/inc/footer.php'; ?>