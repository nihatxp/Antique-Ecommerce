<?php
session_start();
if (isset($_SESSION['Kullanici'])) {
    header("location:kullanicihesabi.php");
    exit;
}
session_write_close();
require_once('inc/header.php'); ?>
<div class="header-space"></div>
<?php require_once('inc/sidebar-sepet.php'); ?>
<?php require_once('inc/sidebar-menu.php'); ?>
<div class="container">
    <div class="breadcrumb-content">
        <h2>login</h2>
        <ul>
            <li><a href="#">home</a></li>
            <li> login </li>
        </ul>
    </div>
</div>
</div>
<div class="register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12 col-lg-6 col-xl-6 ml-auto mr-auto">
                <div class="login">
                    <div class="login-form-container">
                        <div class="login-form">
                            <form action="" method="post">
                                <input type="text" name="mail" placeholder="mail">
                                <input type="password" name="password" placeholder="Password">
                                <div class="button-box">
                                    <div class="login-toggle-btn">
                                        <input type="checkbox">
                                        <label>Remember me</label>
                                        <a href="#">Forgot Password?</a>
                                    </div>
                                    <button name="submit" type="submit" class="default-btn floatright">Login</button>
                                </div>
                            </form>
                            <div>Hesabin Yok Mu? <a href="kayit.php">Kaydol</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'inc/footer.php';

if (isset($_POST['submit'])) {
    $kulllaniciIdEmail = mailIleIdVeParolaCek($_POST['mail']);
    print_r($kulllaniciIdEmail);

    if (count($kulllaniciIdEmail) > 0) {

        if ($kulllaniciIdEmail[0]['kullanici_password'] == md5($_POST['password'])) {
            $_SESSION['Kullanici'] = $kulllaniciIdEmail[0]['kullanici_id'];
            echo "<script>
                    window.location.href='kullanicihesabi.php';
                  </script>";
        } else {
            echo "Parola Hatali";
        }
    } else {
        echo "Kullanici Bulunamadi";
    }
}
?>
</body>

</html>