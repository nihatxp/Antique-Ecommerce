<?php
require_once 'system/config.php';




if (StoktaVarMi($_GET['id']) == null) {
  echo "<script>
          alert(\"Stokta bu ürün bulunmamaktadır. Daha Sonra tekrar Deneyin\");
          window.location.href = '../alisveris.php';
        </script>";
  
} else {

  $action = isset($_GET['islem']) ? $_GET['islem'] : "";
  if ($action == 'ekle' && $_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_SESSION['urun'][$_GET['id']])) {
      $_SESSION['urun'][$_GET['id']] = 0;
    }

    $sonadet = $_SESSION['urun'][$_GET['id']];
    $_SESSION['urun'][$_GET['id']]++;

    $product = '';

    print_r($_SESSION['urun']);

    if(isset($_GET['redirect'])){
    if ($_GET['redirect'] == "sepet") {
      header("Location: ../sepet.php");
    } else {
      header("Location: $_GET[redirect]");
    }
  }

  }

  if ($action == 'sil' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_SESSION['urun'][$_GET['id']])) {
      unset($_SESSION['urun'][$_GET['id']]);
    }
    if ($_GET['redirect'] == "sepet") {
      header("Location: ../sepet.php");
    } else {
      header("Location: ../alisveris.php");
    }
  }
}
