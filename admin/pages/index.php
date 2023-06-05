<?php

require_once "system/config.php";

session_write_close();
require_once "admin/inc/header.php";

if(isset($_POST['submitSifirla'])){
  sayfaSifirla();
}
?>

<main class="content">
  <?php require_once "admin/inc/navbar.php" ?>
  <div class="py-4">

  </div>
  <div class="row">

    <div class="col-12 col-sm-6 col-xl-4 mb-4">
      <div class="card border-0 shadow">
        <div class="card-body">
          <div class="row d-block d-xl-flex align-items-center">
            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
              <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                </svg>
              </div>
              <div class="d-sm-none">
                <h2 class="h5">Kullanicilar</h2>
                <h3 class="fw-extrabold mb-1"> </h3>
              </div>
            </div>
            <div class="col-12 col-xl-7 px-xl-0">
              <div class="d-none d-sm-block">
                <h2 class="h6 text-gray-400 mb-0">Kullanicilar</h2>
                <h3 class="fw-extrabold mb-2"><?php echo (KacKullaniciVar()[0]) ?></h3>
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
      <div class="card border-0 shadow">
        <div class="card-body">
          <div class="row d-block d-xl-flex align-items-center">
            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
              <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path>
                </svg>
              </div>
            </div>
            <div class="col-12 col-xl-7 px-xl-0">
              <div class="d-none d-sm-block">
                <h2 class="h6 text-gray-400 mb-0">Yorumlar</h2>
                <h3 class="fw-extrabold mb-2"><?php echo (count(ListeleYorumlar())) ?></h3>
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
      <div class="card border-0 shadow">
        <div class="card-body">
          <div class="row d-block d-xl-flex align-items-center">
            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
              <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
              </div>
            </div>
            <div class="col-12 col-xl-7 px-xl-0">
              <div class="d-none d-sm-block">
                <h2 class="h6 text-gray-400 mb-0"> Mesajlar</h2>
                <h3 class="fw-extrabold mb-2"><?php echo (kacMesajVar()[0]) ?></h3>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-12 col-xl-8">
      <div class="row">
        <div class="col-12 mb-4">
          <div class="card border-0 shadow">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col">
                  <h2 class="fs-5 fw-bold mb-0">Sayfa Goruntulenme</h2>
                </div>
                <div class="col text-end">
                  <form action="" method="post">
                  <button name="submitSifirla" class="btn btn-sm btn-primary">Sıfırla</button>
                  <button name="submitYenile" class="btn btn-sm btn-primary">Yenile</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th class="border-bottom" scope="col">Sayfa Adı</th>
                    <th class="border-bottom" scope="col">Sayfa Görüntülenme</th>
                    <th class="border-bottom" scope="col">Kazanç</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th class="text-gray-900" scope="row">
                      <?php echo (ListeleSayfa()[0]['sayfa_ad']) ?>
                    </th>
                    <td class="fw-bolder text-gray-500">
                    <?php echo (ListeleSayfa()[0]['goruntulenme']) ?>
                    </td>
                    <td class="fw-bolder text-gray-500">
                    <?php echo ((ListeleSayfa()[0]['goruntulenme'])/200)."TL" ?>

                    </td>
                  </tr>

                  <tr>
                    <th class="text-gray-900" scope="row">
                      <?php echo (ListeleSayfa()[1]['sayfa_ad']) ?>
                    </th>
                    <td class="fw-bolder text-gray-500">
                    <?php echo (ListeleSayfa()[1]['goruntulenme']) ?>
                    </td>
                    <td class="fw-bolder text-gray-500">
                    <?php echo ((ListeleSayfa()[1]['goruntulenme'])/200)."TL" ?>

                    </td>
                  </tr>

                  <tr>
                    <th class="text-gray-900" scope="row">
                      <?php echo (ListeleSayfa()[2]['sayfa_ad']) ?>
                    </th>
                    <td class="fw-bolder text-gray-500">
                    <?php echo (ListeleSayfa()[2]['goruntulenme']) ?>
                    </td>
                    <td class="fw-bolder text-gray-500">
                    <?php echo ((ListeleSayfa()[2]['goruntulenme'])/200)."TL" ?>

                    </td>
                  </tr>

                  <tr>
                    <th class="text-gray-900" scope="row">
                      <?php echo (ListeleSayfa()[3]['sayfa_ad']) ?>
                    </th>
                    <td class="fw-bolder text-gray-500">
                    <?php echo (ListeleSayfa()[3]['goruntulenme']) ?>
                    </td>
                    <td class="fw-bolder text-gray-500">
                    <?php echo ((ListeleSayfa()[3]['goruntulenme'])/200)."TL" ?>
                    </td>
                  </tr>

                  <tr>
                    <th class="text-gray-900" scope="row">
                      <?php echo (ListeleSayfa()[4]['sayfa_ad']) ?>
                    </th>
                    <td class="fw-bolder text-gray-500">
                    <?php echo (ListeleSayfa()[4]['goruntulenme']) ?>
                    </td>
                    <td class="fw-bolder text-gray-500">
                    <?php echo ((ListeleSayfa()[4]['goruntulenme'])/200)."TL" ?>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>





    <div class="col-12 col-xl-4">
    
      <?php $json = file_get_contents("https://gist.githubusercontent.com/nihatxp/6d30f3404e49e903f61a81a2f2d5eb47/raw/3b25f12abb83ed89392a7b2f40b546bda2e5604b/countries.json");

      $obj = json_decode($json, true);
      $topCountry = array();

      foreach (ListeleKullanicilar() as $kullAdres) {
        foreach ($obj as $country) {
          if ($country['code'] == $kullAdres['kullanici_adres']) {

            if (isset($topCountry[$country['code']])) {
              $topCountry[$country['code']]++;
            } else {
              $topCountry[$country['code']] = 1;
            }
          }
        }
      }
      arsort($topCountry);

      
      /*
      foreach ($obj as $country) {
        if ($country['name'] == 'Turkey') {
          print_r($country['name']);
          print_r($country['capital']);
          print_r($country['region']);
          print_r($country['currency']['code']);
          print_r($country['currency']['name']);
          print_r($country['currency']['symbol']);
          print_r($country['language']['code']);
          print_r($country['language']['name']);
        ?>
          <img src="<?php print_r($country['flag']); ?>" alt="">
      <?php
          print_r($country['dialling_code']);
        }
      }
*/
      ?>


      <div class="col-12 px-0">
        <div class="card border-0 shadow">
          <div class="card-body">
            <h2 class="fs-5 fw-bold mb-1">Ülkeler</h2>
            <p>Kullanicilar Hangi Ulkeden</p>
            <div class="d-block">

              <?php

              $toplamUlke = array_multisum($topCountry);



              foreach ($topCountry as $key => $value) {

                foreach ($obj as $country) {
                  if ($country['code'] == $key) {
              ?>
                    <div class="d-flex align-items-center me-5">
                      <div class="icon-shape icon-sm icon-shape-danger rounded me-3">
                        <img width="50px" src="<?php echo "https://www.countryflagicons.com/SHINY/64/" . $country['code'] . ".png"; ?>" alt="">
                      </div>
                      <div class="d-block">

                        <label class="mb-0"><?php print_r($country['name']); ?></label>
                        <h4 class="mb-0"><?php print_r(substr(((100/$toplamUlke)*$value), 0, 4)   ."%&nbsp;&nbsp;($value)"); ?></h4>
                      </div>
                    </div>
              <?php

                  }
                }
              }
              ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


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



  <?php require_once 'admin/inc/footer.php'; ?>
  </body>

  </html>