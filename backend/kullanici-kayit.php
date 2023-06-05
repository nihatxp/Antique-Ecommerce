<?php
require_once('system/config.php');

if (isset($_SESSION['Kullanici'])) {
    header("location: ../index.php");
    exit;
}

$email = $_POST['email'];
if (isset($_FILES['profil']['size']) && $_FILES['profil']['size'] > 0) {
    $profile_img_name = date('dmYHis') . str_replace(" ", "", basename($_FILES["profil"]["name"]));
}else{
    $profile_img_name = "default.jpg";
}

$password = $_POST['password'];
$password2 = $_POST['password2'];
$kull = mailIleIdVeParolaCek($email);

try {
    if (count($kull) > 0) {
        echo '<script language="javascript">';
        echo 'alert("Email Zaten Kullanılmış Lütfen Farklı Bir Email Girin"); window.location.href="../kayit.php";';
        echo '</script>';
    } else {
        if ($password == $password2) {
            $password = md5($password);
            ekleKullanici(isset($_FILES['profil']['name']) ? $profile_img_name : "null", $_POST['email'], $password, $_POST['adsoyad'], $_POST['adres'], '1');

            $id = mailIleIdCek($_POST['email']);
            $_SESSION['Kullanici'] = $id[0]['kullanici_id'];

            try {
                $destination_path = getcwd() . "../../assets/img/kullanici-profiles" . DIRECTORY_SEPARATOR;
                $target_path = $destination_path . $profile_img_name;
                move_uploaded_file($_FILES['profil']['tmp_name'], $target_path);
            } catch (Exception $e) {
                echo $e->getMessage;
            } finally {
                header("location: ../index.php");
                exit;
            }
        } else {
            echo '<script language="javascript">';
            echo 'alert("Parolalar Eşleşmiyor"); window.location.href="../kayit.php";';
            echo '</script>';
        }
    }
} catch (PDOException $e) {
    if (str_contains($e, 'SQLSTATE[23000]')) {
        echo $e;
        // header("location: ../giris.php");
        // exit;
    } else {
        echo "Bir hata olustu";
    }
}
