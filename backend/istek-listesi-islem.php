<?php
require_once 'system/config.php';



if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  if (!isset($_SESSION['urun-istek'][$_GET['id']])) {
    $_SESSION['urun-istek'][$_GET['id']] = 0;
  }

  if ($_GET['islem'] == "ekle") {
    $sonadet = $_SESSION['urun-istek'][$_GET['id']];
    $_SESSION['urun-istek'][$_GET['id']] = true;
    print_r($_SESSION['urun-istek']);

    if (isset($_GET['redirect'])) {
      if ($_GET['redirect'] == "istek-listesi") {
        header("Location: ../istek-listesi.php");
      } else {
        $link = $_GET['redirect'];
        header("Location: $link");
      }
    } else {
      header("Location: ../alisveris.php");
    }
    
  }

  if ($_GET['islem'] == "sil") {
    unset($_SESSION['urun-istek'][$_GET['id']]);
    if (isset($_GET['redirect'])) {
      if ($_GET['redirect'] == "istek-listesi") {
        header("Location: ../istek-listesi.php");
      } else {
        $link = $_GET['redirect'];
        header("Location: $link");
      }
    } else {
      header("Location: ../alisveris.php");
    }
  }



  
}
