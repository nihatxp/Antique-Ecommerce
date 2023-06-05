<?php require_once('inc/header.php'); ?>

<?php

if (isset($_POST['sepeteEkle'])) {
    $_SESSION['urun'][$_GET['id']] += $_POST['qtybutton'];
}
?>
<style>
    .comments-section {
        top: 5%;
        width: auto;
        margin-bottom: 10%;
    }

    .comments-section h4 {
        margin: 0;
        margin-top: 40px;
        margin-bottom: 10px;
        font-weight: bold;
        font-size: 1.2rem;
        color: white;
        border-bottom: 1px solid #666;
        padding-bottom: 5px;

    }

    .comments-section .comments {
        color: black;
    }

    .comments-section .comments h4 {
        border: 0;
    }

    .comments-section .comment {
        background: #adadad;
        padding: 20px;
        font-size: 15px;
        margin-bottom: 20px;
        border-radius: 5px;

    }

    .comments-section .comment blockquote {
        color: #eee;
        padding: 1em;
        border-left: 2px solid #76daff;
        background: rgba(0, 0, 0, 0.05);
    }

    .comments-section .comment code {
        font-family: Menlo, Monaco, monospace;
        background: rgba(0, 0, 0, 0.2);
        padding: 2px 5px;
        margin: 0 2px;
        border-radius: 2px;
    }

    .comments-section .comment .box {
        background: #1d1f20;
        padding: 20px;
    }

    .comments-section .comment .box pre {
        overflow: auto;
        margin: 0;
    }

    .comments-section .comment .box pre code {
        background: transparent;
    }

    .comments-section .comment .box+.box {
        padding-top: 0px;
    }

    .comments-section .comment a {
        color: #76daff;
        text-decoration: none;
    }

    .comments-section .comment .comment-user {
        border-bottom: 1px solid #555;
        padding: 10px 45px 20px;
        display: flex;
        align-items: center;
    }

    .comments-section .comment .comment-user .avatar img {
        width: 35px;
        height: 35px;
    }

    .comments-section .comment .comment-user .username {
        color: #1d1f20;
    }

    .comments-section .comment .comment-user .user-details {
        color: #666;
        margin-left: 10px;
    }

    .comments-section .comment .comment-user .user-details span:last-child {
        color: #999;
        font-size: 80%;
    }

    .comments-section .comment .comment-text {
        padding: 10px 45px 20px;
    }

    /* EDITOR STYLE */
    .CodepenCommentEditor-root {
        background: transparent;
        font-family: "Lato", serif;
        font-size: 14px;
    }

    .CodepenCommentEditor-editor {
        background: #fff;
        border: 3px solid #ccc;
        cursor: text;
        font-size: 13px;
        margin-top: 10px;
        font-family: "Lato";
        transition: all 0.2s ease-in;
    }

    .CodepenCommentEditor-focus {
        border-color: #555;
    }

    .CodepenCommentEditor-editor .public-DraftEditorPlaceholder-root,
    .CodepenCommentEditor-editor .public-DraftEditor-content {
        padding-left: 5px;
        padding-top: 5px;
    }

    .CodepenCommentEditor-editor .public-DraftEditor-content {
        min-height: 100px;
    }

    .CodepenCommentEditor-hidePlaceholder .public-DraftEditorPlaceholder-root {
        display: none;
    }

    .CodepenCommentEditor-editor .CodepenCommentEditor-blockquote {
        border-left: 2px solid #76daff;
        background-color: rgba(0, 0, 0, 0.05);
        color: #666;
        font-style: italic;
        margin: 16px 0;
        margin-right: 5px;
        padding: 10px 20px;
    }

    .CodepenCommentEditor-editor .public-DraftStyleDefault-pre {
        margin-right: 5px;
        background-color: rgba(0, 0, 0, 0.05);
        font-family: "Inconsolata", "Menlo", "Consolas", monospace;
        font-size: 16px;
        padding: 20px;
    }

    .CodepenCommentEditor-controls {
        font-family: "Lato", sans-serif;
        font-size: 12px;
        margin-bottom: 2px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .CodepenCommentEditor-styleButton {
        display: inline-block;
        color: #fff;
        cursor: pointer;
        margin-right: 16px;
        padding: 2px 7px;
        border: 1px solid transparent;
        margin: 0 5px 0 0;
        border-radius: 3px;
        background: #343436;
    }

    .CodepenCommentEditor-submitButton {
        color: white;
        cursor: pointer;
        float: left;
        margin-top: 5px;
        padding: 10px 16px;
        background: none;
        border: 3px solid #ccc;
        border-radius: 3px;
    }

    .CodepenCommentEditor-submitButton:hover {
        background: white;
        border-color: white;
        color: black;
    }

    .CodepenCommentEditor-activeButton {
        background: #4d4d50;
        transform: translateY(1px);
    }

    .pd-wrap {
        padding: 40px 0;
        font-family: 'Poppins', sans-serif;
    }

    .heading-section {
        text-align: center;
        margin-bottom: 20px;
    }

    .sub-heading {
        font-family: 'Poppins', sans-serif;
        font-size: 12px;
        display: block;
        font-weight: 600;
        color: #2e9ca1;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .heading-section h2 {
        font-size: 32px;
        font-weight: 500;
        padding-top: 10px;
        padding-bottom: 15px;
        font-family: 'Poppins', sans-serif;
    }

    .user-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        position: relative;
        min-width: 80px;
        background-size: 100%;
    }

    .carousel-testimonial .item {
        padding: 30px 10px;
    }

    .quote {
        position: absolute;
        top: -23px;
        color: #2e9da1;
        font-size: 27px;
    }

    .name {
        margin-bottom: 0;
        line-height: 14px;
        font-size: 17px;
        font-weight: 500;
    }

    .position {
        color: #adadad;
        font-size: 14px;
    }

    .owl-nav button {
        position: absolute;
        top: 50%;
        transform: translate(0, -50%);
        outline: none;
        height: 25px;
    }

    .owl-nav button svg {
        width: 25px;
        height: 25px;
    }

    .owl-nav button.owl-prev {
        left: 25px;
    }

    .owl-nav button.owl-next {
        right: 25px;
    }

    .owl-nav button span {
        font-size: 45px;
    }

    .product-thumb .item img {
        height: 100px;
    }

    .product-name {
        font-size: 22px;
        font-weight: 500;
        line-height: 22px;
        margin-bottom: 4px;
    }

    .product-price-discount {
        font-size: 22px;
        font-weight: 400;
        padding: 10px 0;
        clear: both;
    }

    .product-price-discount span.line-through {
        text-decoration: line-through;
        margin-left: 10px;
        font-size: 14px;
        vertical-align: middle;
        color: #a5a5a5;
    }

    .display-flex {
        display: flex;
    }

    .align-center {
        align-items: center;
    }

    .product-info {
        width: 100%;
    }

    .reviews-counter {
        font-size: 13px;
    }

    .reviews-counter span {
        vertical-align: -2px;
    }

    .rate {
        float: left;
        padding: 0 10px 0 0;
    }

    .rate:not(:checked)>input {
        position: absolute;
        top: -9999px;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 15px;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 21px;
        color: #ccc;
        margin-bottom: 0;
        line-height: 21px;
    }

    .rate:not(:checked)>label:before {
        content: '\2605';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }

    .product-dtl p {
        font-size: 14px;
        line-height: 24px;
        color: #7a7a7a;
    }

    .product-dtl .form-control {
        font-size: 15px;
    }

    .product-dtl label {
        line-height: 16px;
        font-size: 15px;
    }

    .form-control:focus {
        outline: none;
        box-shadow: none;
    }

    .product-count {
        margin-top: 15px;
    }

    .product-count .qtyminus,
    .product-count .qtyplus {
        width: 34px;
        height: 34px;
        background: #212529;
        text-align: center;
        font-size: 19px;
        line-height: 36px;
        color: #fff;
        cursor: pointer;
    }

    .product-count .qtyminus {
        border-radius: 3px 0 0 3px;
    }

    .product-count .qtyplus {
        border-radius: 0 3px 3px 0;
    }

    .product-count .qty {
        width: 60px;
        text-align: center;
    }

    .round-black-btn {
        border-radius: 4px;
        background: #212529;
        color: #fff;
        padding: 7px 45px;
        display: inline-block;
        margin-top: 20px;
        border: solid 2px #212529;
        transition: all 0.5s ease-in-out 0s;
    }

    .round-black-btn:hover,
    .round-black-btn:focus {
        background: transparent;
        color: #212529;
        text-decoration: none;
    }

    .product-info-tabs {
        margin-top: 25px;
    }

    .product-info-tabs .nav-tabs {
        border-bottom: 2px solid #d8d8d8;
    }

    .product-info-tabs .nav-tabs .nav-item {
        margin-bottom: 0;
    }

    .product-info-tabs .nav-tabs .nav-link {
        border: none;
        border-bottom: 2px solid transparent;
        color: #323232;
    }

    .product-info-tabs .nav-tabs .nav-item .nav-link:hover {
        border: none;
    }

    .product-info-tabs .nav-tabs .nav-item.show .nav-link,
    .product-info-tabs .nav-tabs .nav-link.active,
    .product-info-tabs .nav-tabs .nav-link.active:hover {
        border: none;
        border-bottom: 2px solid #d8d8d8;
        font-weight: bold;
    }

    .product-info-tabs .tab-content .tab-pane {
        padding: 30px 20px;
        font-size: 15px;
        line-height: 24px;
        color: #7a7a7a;
    }

    .review-form .form-group {
        clear: both;
    }

    .mb-20 {
        margin-bottom: 20px;
    }

    .review-form .rate {
        float: none;
        display: inline-block;
    }

    .review-heading {
        font-size: 24px;
        font-weight: 600;
        line-height: 24px;
        margin-bottom: 6px;
        text-transform: uppercase;
        color: #000;
    }

    .review-form .form-control {
        font-size: 14px;
    }

    .review-form input.form-control {
        height: 40px;
    }


    .review-form .round-black-btn {
        text-transform: uppercase;
        cursor: pointer;
    }
</style>
<div class="header-space"></div>

<script src="admin/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script>
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-gray'
        },
        buttonsStyling: false
    });
</script>


<?php require_once('inc/sidebar-sepet.php'); ?>
<?php require_once('inc/sidebar-menu.php'); ?>

<?php
if ($_GET['id'] == null) {
    header('Location: ./index.php');
} else {
    $urun = GetirUrun($_GET['id']);
    if ($urun == null) {
        header('Location: ./index.php');
    }
}

?>
<div class="breadcrumb-area bg-img border-top-1 pt-55">
    <div class="container">
        <div class="breadcrumb-content-2">
            <ul>
                <li><a class="active" href="./index.php">Anasayfa</a></li>
                <li><a class="active" href="./alisveris.php">Alisveris</a></li>
                <li>Urun Detaylari</li>
            </ul>
        </div>
    </div>
</div>
<div class="product-details ptb-100 pb-90">
    <div class="container">
        <div class="row">

            <div class="col-md-12">

                <div class="product-details-btn">
                    <div> <?php echo IdIleKatGetir($urun["kategori_id"])[0]['kategori_ad'] ?></div>
                    <a href="?id=<?php echo KategoriyeGoreRandomUrunIdGetir($urun['kategori_id'])[0]['urun_id'] ?>"><i class="ion-arrow-left-c"></i></a>
                    <a class="active" href="?id=<?php echo KategoriyeGoreRandomUrunIdGetir($urun['kategori_id'])[0]['urun_id'] ?>"><i class="ion-arrow-right-c"></i></a><!-- Bakarsin  -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-7 col-12">
                <div class="product-details-img-content">
                    <div class="product-details-tab mr-70">
                        <div class="product-details-large tab-content">
                            <div class="tab-pane active show fade" id="pro-details1" role="tabpanel">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="">
                                        <img src="assets/img/urunler/<?php echo $urun['urun_img'] ?>" alt="">
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <?php

            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            ?>


            <div class="col-md-12 col-lg-5 col-12">
                <div class="product-details-content">
                    <h3><?php echo $urun['urun_ad'] ?></h3>

                    <div class="details-price">
                        <span><?php echo $urun['urun_fiyat'] ?>TL</span>
                    </div>
                    <p><?php echo $urun['urun_detay'] ?></p>
                    <div class="quick-view-select">
                        <div class="select-option-part">
                            <label>Stok</label>
                            <?php echo $urun['urun_stok'] ?>
                        </div>

                    </div>
                    <div class="quickview-plus-minus">
                        <div class="cart-plus-minus">
                            <form action="" method="post">
                                <input type="text" value="1" name="qtybutton" class="cart-plus-minus-box">
                        </div>
                        <div class="quickview-btn-cart">
                            <input type="submit" style="background:red;color:#fff;" value="sepete ekle" name="sepeteEkle" id="">
                            </form>
                        </div>
                        <div class="quickview-btn-wishlist">
                            <a class="btn-hover" style="<?php

                                                        if (isset($_SESSION['urun-istek'])) {
                                                            foreach ($_SESSION['urun-istek'] as $key => $value) {
                                                                if ($key == $urun['urun_id']) {
                                                                    echo "background:red; color:aliceblue;";
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        " <?php

                                                            if (isset($_SESSION['urun-istek'])) {


                                                                if (in_array($urun['urun_id'], array_keys($_SESSION['urun-istek']))) {
                                                                    echo "href='backend/istek-listesi-islem.php?id=$key&islem=sil&redirect=$link'";
                                                                } else {
                                                                    echo "href='./backend/istek-listesi-islem.php?id=" . $urun['urun_id'] . "&islem=ekle&redirect=$link'";
                                                                }
                                                            } else {

                                                                echo "href='./backend/istek-listesi-islem.php?id=" . $urun['urun_id'] . "&islem=ekle&redirect=$link'";
                                                            }
                                                            ?>><i class=" ion-ios-heart-outline"></i></a>
                        </div>



                    </div>
                    <div class="product-categories product-cat-tag">
                        <ul>
                            <li class="categories-title">Kategori :</li>
                            <li><a><?php
                                    $kategoriler = GetirKategoriler();
                                    foreach ($kategoriler as $kategori) {
                                        if ($kategori["kategori_id"] == $urun['kategori_id']) {
                                            echo $kategori["kategori_ad"];
                                        }
                                    }
                                    ?></a></li>
                        </ul>
                    </div>
          
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-description-review-area pb-100">
    <div class="container">
        <div class="product-description-review text-center">
            <div class="description-review-title nav" role=tablist>
                <a class="active" href="#pro-dec" data-toggle="tab" role="tab" aria-selected="true">
                    Urun Aciklamasi
                </a>
                <a href="#pro-review" data-toggle="tab" role="tab" aria-selected="false">
                    Yorumlar (<?php echo    count(onaylanmisYorumlariGetir($_GET['id'])) ?>)
                </a>
            </div>
            <div class="description-review-text tab-content">
                <div class="tab-pane active show fade" id="pro-dec" role="tabpanel">
                    <p><?php echo $urun['urun_detay'] ?></p>
                </div>
                <div class="tab-pane fade" id="pro-review" role="tabpanel">


                    <div class="review-heading">Yorumlar</div>

                    <?php $yorumlar = onaylanmisYorumlariGetir();
                    $inarray = false;

                    foreach ($yorumlar as $yorum) {
                        if ($yorum['urun_id'] == $_GET['id']) {
                            $inarray = true;
                    ?>
                            <div class="comments-section">
                                <div class="comments">
                                    <div id="comments-container">
                                        <div class="comment">
                                            <div class="comment-user">
                                                <div class="avatar">
                                                    <img src="./assets/img/kullanici-profiles/<?php echo selectKullaniciPhoto($yorum['kullanici_id'])[0]['kullanici_resim'] ?>" alt="Riccardo" />
                                                </div><span class="user-details">
                                                    <span class="username"><?php echo idIleKullCek($yorum['kullanici_id'])[0]['kullanici_adsoyad']; ?>
                                                    </span><span>Tarihinde: </span><span><?php echo $yorum['yorum_zaman'] ?></span></span>
                                            </div>
                                            <div class="comment-text">
                                                <?php echo $yorum['yorum_detay'] ?> </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="comment-editor">
                                    <h4 style="color:black;">Daha Fazla</h4>
                                    <div id="comment-form"></div>
                                </div>
                            </div>

                    <?php }
                    } ?>
                    <?php
                    if (!$inarray) {
                        echo "<p class=\"mb-20\">Bu urune ait yorum bulunmamaktadir.</p>";
                        echo "<p class=\"mb-20\">Ilk yorumu siz yapabilirsiniz.</p>";
                        echo "<br /> <br />";
                    }
                    ?>
                    <?php if (isset($_SESSION['Kullanici'])) { ?>
                        <?php
                        $kullanici = idIleKullCek($_SESSION['Kullanici']);
                        $kullaniciIsim = $kullanici[0][3];
                        $kullaniciMail = $kullanici[0][5];

                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" value="<?php echo $kullaniciIsim ?>" class="form-control" placeholder="Isim*" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" value="<?php echo $kullaniciMail ?>" class="form-control" placeholder="Email Id*" readonly>
                                </div>
                            </div>
                        </div>





                        <form class="review-form" action="" method="POST">
                            <div class="form-group">
                                <label>Yorumunuz</label>
                                <textarea name="yorum" cols="30" rows="10"></textarea>
                            </div>


                            <input type="hidden" name="uye_id" value="<?php echo isset($_SESSION['Kullanici']) ? $_SESSION['Kullanici'] : "" ?>">
                            <input type="hidden" name="urun_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : "" ?>">
                            <button type="submit" name="yorumEkle" class="btn-style cr-btn"><span>Yorum Yap</span></button>
                        <?php } else { ?>
                            <a href="giris.php" class="btn-style cr-btn"><span>Yorum Yapmak Icin Giris Yap</span></a>
                        <?php } ?>

                        </form>
                        <?php

                        if (isset($_POST['yorumEkle'])) {
                            if (isset($_SESSION['Kullanici']) && isset($_GET['id'])) {
                                $uye_id = $_POST['uye_id'];
                                $urun_id = $_POST['urun_id'];
                                $yorum = $_POST['yorum'];

                                echo "<script>
                                    
                                        swalWithBootstrapButtons.fire({
                                            icon: 'success',
                                            title: 'Yorumunuz Alindi',
                                            text: 'Yorumunuz Onaylandiktan Sonra Gosterilecektir',
                                            showConfirmButton: true,
                                            timer: 6500
                                        })
                          
                                    </script>";

                                yorumEkle($uye_id, $urun_id, $yorum);
                            }
                        }

                        ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-collection-area pb-60">
    <div class="container">
        <div class="section-title text-center mb-55">
            <h2>Benzer Urunler</h2>
        </div>
        <div class="row">
            <div class="new-collection-slider owl-carousel">

                <?php
                $i = 0;
                $benzerUrunler = KategoriyeGoreRandomUrunGetir($urun['kategori_id']);
                foreach ($benzerUrunler as $ur) { ?>
                    <div class="col-md-3 col-lg-3 col-sm-4 col-xs-12">
                        <div class="single-product mb-35">
                            <div class="product-img">
                                <a href="urun-detay.php?id=<?php echo $ur['urun_id'] ?>"><img src="assets/img/urunler/<?php print_r($ur['urun_img']) ?>" alt=""></a>
                                <span>sale</span>
                                <div class="product-action">
                                    <a title="Wishlist" style="<?php

                                                                if (isset($_SESSION['urun-istek'])) {
                                                                    foreach ($_SESSION['urun-istek'] as $key => $value) {
                                                                        if ($key == $ur['urun_id']) {
                                                                            echo "background:red; color:aliceblue;";
                                                                        }
                                                                    }
                                                                }
                                                                ?>" class="animate-left" <?php

                                                                                            if (isset($_SESSION['urun-istek'])) {


                                                                                                if (in_array($ur['urun_id'], array_keys($_SESSION['urun-istek']))) {
                                                                                                    echo "href='backend/istek-listesi-islem.php?id=$key&islem=sil&redirect=$link'";
                                                                                                } else {
                                                                                                    echo "href='./backend/istek-listesi-islem.php?id=" . $ur['urun_id'] . "&islem=ekle&redirect=$link'";
                                                                                                }
                                                                                            } else {

                                                                                                echo "href='./backend/istek-listesi-islem.php?id=" . $ur['urun_id'] . "&islem=ekle&redirect=$link'";
                                                                                            }
                                                                                            ?> "><i class=" ion-ios-heart-outline"></i></a>

                                </div>
                            </div>
                            <div class="product-content">
                                <div class="product-title-price">
                                    <div class="product-title">
                                        <h4><a href="urun-detay.php?id=<?php echo $ur['urun_id'] ?>"><?php echo $ur['urun_ad'] ?></h4>
                                    </div>
                                    <div class="product-price">
                                        <span><?php print_r($ur['urun_fiyat']) ?></span>
                                    </div>
                                </div>
                                <div class="product-cart">
                                    <a href="">Sepete Ekle</a>
                                </div>
                            </div>
                        </div>
                    </div>







                    <?php $i++; ?>
                <?php } ?>
                <?php

                ?>






            </div>
        </div>
    </div>
</div>


</div>
<?php require_once 'inc/footer.php'; ?>
</body>

</html>