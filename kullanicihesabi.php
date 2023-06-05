<?php
require_once('./inc/header.php');
if (!isset($_SESSION['Kullanici'])) {
  header("Location: index.php");
} else {
  $kullanici = idIleKullCek($_SESSION['Kullanici']);
}
session_write_close();
require_once('./inc/sidebar-menu.php');
require_once('./inc/sidebar-sepet.php');
?>

<div class="wrapper-card">
  <div class="profile-card js-profile-card">
    <div class="profile-card__img">
      <img src="<?php echo 'assets/img/kullanici-profiles/' . $kullanici[0][2] ?>" alt="profile card">
    </div>

    <div class="profile-card__cnt js-profile-cnt">
      <div class="profile-card__name"><?php echo inp_filter($kullanici[0][5]) ?></div>
      <div class="profile-card__txt">From <strong>
<?php
include_once('./inc/countries.php');
echo $countries[$kullanici[0][6]];
?>
                                                </strong></div>
      <div class="profile-card-inf__item">
        <div class="profile-card-inf__title"><a href="./kullanici-islemleri/bilgileri-guncelle.php">Hesap Ayarlari</a></div>
      </div>

      <div class="profile-card-inf__item">
        <div class="profile-card-inf__title"><a href="kullanici-islemleri/cikis-yap.php">Cikis Yap</a></div>
        <div class="profile-card-inf__txt">
          <hr />
        </div>
      </div>
    </div>

    <script src="./assets/js/vendor/jquery-1.12.0.min.js"></script>
    <script src="./assets/js/popper.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery.magnific-popup.min.js"></script>
    <script src="./assets/js/isotope.pkgd.min.js"></script>
    <script src="./assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="./assets/js/jquery.counterup.min.js"></script>
    <script src="./assets/js/waypoints.min.js"></script>
    <script src="./assets/js/slinky.min.js"></script>
    <script src="./assets/js/ajax-mail.js"></script>
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/plugins.js"></script>
    <script type="text/javascript">
      var myElement = document.querySelector(".intelligent-header");
      var headroom = new Headroom(myElement);
      headroom.init();
    </script>
    <script src="./assets/js/main.js"></script>
    </body>

    </html>