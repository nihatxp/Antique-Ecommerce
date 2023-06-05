<?php require_once('inc/header.php'); ?>
<div class="header-space"></div>
<?php require_once('inc/sidebar-sepet.php'); 
sayfaHit(2); // Ana Sayfa Hit
?>
<?php require_once('inc/sidebar-menu.php'); ?>
<div class="breadcrumb-area pt-205 pb-10" style="background-image: url(assets/img/hakkimizda/hakkimizda.jpg)">
    <div class="container">
        <div class="breadcrumb-content">
            <h2 style="color:aliceblue" >Hakkimizda</h2>
            <ul>
                <li><a href="./index.php" style="color:gray">Anasayfa</a></li>
                <li style="color:gray">Hakkimizda</li>
            </ul>
        </div>
    </div>
</div>
<div class="about-story ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
                <div class="about-story">
                    <h3 class="story-title"><?php echo HakkimizdaBasligiCek()[0] ?></h3>
                    <p class="story-subtitle"><?php echo HakkimizdaBasligiCek()[1] ?></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <div class="about-story-img">
                    <div class="about-story-img1">
                        <img width="256px" height="328" src="assets/img/hakkimizda/hakkimizda-alt-1.jpg" alt="">
                    </div>
                    <div class="about-story-img2">
                        <img width="256px" height="328"src="assets/img/hakkimizda/hakkimizda-alt-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'inc/footer.php'; ?>
</body>
</html>