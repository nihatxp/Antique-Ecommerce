<?php



require_once('../system/config.php');
echo isset($_SESSION['Admin']);
if (isset($_SESSION['Admin'])) {
    echo "<script> window.location='index.php'; </script>`";
    exit;
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>Volt Premium Bootstrap Dashboard - Forgot password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Volt Premium Bootstrap Dashboard - Forgot password">
    <meta name="author" content="Themesberg">
    <meta name="description" content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, themesberg, themesberg dashboard, themesberg admin dashboard" />
    <link rel="canonical" href="https://themesberg.com/product/admin-dashboard/volt-premium-bootstrap-5-dashboard">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://demo.themesberg.com/volt-pro">
    <meta property="og:title" content="Volt Premium Bootstrap Dashboard - Forgot password">
    <meta property="og:description" content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">
    <meta property="og:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-pro-bootstrap-5-dashboard/volt-pro-preview.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://demo.themesberg.com/volt-pro">
    <meta property="twitter:title" content="Volt Premium Bootstrap Dashboard - Forgot password">
    <meta property="twitter:description" content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">
    <meta property="twitter:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-pro-bootstrap-5-dashboard/volt-pro-preview.jpg">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="assets/img/favicon/safari-pinned-tab.svg" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Sweet Alert -->
    <link type="text/css" href="vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Notyf -->
    <link type="text/css" href="vendor/notyf/notyf.min.css" rel="stylesheet">

    <!-- Volt CSS -->
    <link type="text/css" href="css/volt.css" rel="stylesheet">


</head>
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
?>

<body>
    <main>
        <!-- Section -->
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center form-bg-image">
                    <p class="text-center"><a href="./giris-yap.php" class="d-flex align-items-center justify-content-center">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Back to log in
                        </a>

                        <?php if (isset($_POST['email'])) {
                            $email = $_POST['email'];

                            if (count(AdminMailDogruMu($email)) == 0) {
                                echo '<div class="alert alert-danger" role="alert">';
                            } else {
                                echo '<div class="alert alert-success" role="alert">';

                                try {
                                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                                    $mail->isSMTP();                                            //Send using SMTP
                                    $mail->SMTPAuth = true;
                                    $mail->Host = 'smtp.gmail.com';
                                    $mail->Port = 587;
                                    $mail->SMTPSecure = 'tls';
                                    $mail->Username = 'nihatryzen@gmail.com';
                                    $mail->Password = '';  // parola    
                               
                                    $mail->SetFrom($mail->Username, 'Tayfun Erbilen');
                                    print_r($email);
                                    $mail->AddAddress($email, 'Admin');
                                    $mail->CharSet = 'UTF-8';
                                    $mail->Subject = 'Yeni Sifreniz';
                                    $yeniSifre = random_int(100000, 999999);
                                    $content = '<div style="background: #eee; padding: 10px; font-size: 14px">
                                    Yeni Sifreniz:
                                    '.$yeniSifre.'..</div>';
                                    $mail->MsgHTML($content);
                                
                                    if ($mail->Send()) {
                                        echo "Mail başarıyla gönderildi!";
                                        adminSifreDegistir($email, $yeniSifre);
                                    } else {
                                        //echo $mail->ErrorInfo;
                                    }
                                } catch (Exception $e) {
                                    // bir sorun var, sorunu ekrana bastıralım
                                    echo "Suanda Bu Hizmet Kullanilamiyor Lutfen Daha Sonra Deneyin: {$mail->ErrorInfo}";
                                }

                            }
                        }
                        ?>


                    </p>
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="signin-inner my-3 my-lg-0 bg-white shadow border-0 rounded p-4 p-lg-5 w-100 fmxw-500">
                            <h1 class="h3">Parolanizi Mi Unuttunuz?</h1>
                            <p class="mb-4">Mail Adresinizini Girin Ve Yeni Parolanizi Size Gonderelim.!</p>
                            <form action="" method="post">
                                <!-- Form -->
                                <div class="mb-4">
                                    <label for="email">Emailiniz</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" name="email" placeholder="john@ms.com" required autofocus>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" name='submit' class="btn btn-gray-800">Gonder</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Core -->
    <script src="vendor/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Vendor JS -->
    <script src="vendor/onscreen/dist/on-screen.umd.min.js"></script>

    <!-- Slider -->
    <script src="vendor/nouislider/distribute/nouislider.min.js"></script>

    <!-- Smooth scroll -->
    <script src="vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

    <!-- Charts -->
    <script src="vendor/chartist/dist/chartist.min.js"></script>
    <script src="vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>

    <!-- Datepicker -->
    <script src="vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

    <!-- Sweet Alerts 2 -->
    <script src="vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

    <!-- Vanilla JS Datepicker -->
    <script src="vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

    <!-- Notyf -->
    <script src="vendor/notyf/notyf.min.js"></script>

    <!-- Simplebar -->
    <script src="vendor/simplebar/dist/simplebar.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Volt JS -->
    <script src="assets/js/volt.js"></script>


</body>

</html>
