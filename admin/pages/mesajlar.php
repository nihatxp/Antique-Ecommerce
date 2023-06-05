<?php
require_once "system/config.php";
session_write_close();
require_once "admin/inc/header.php";


if (isset($_POST['sil'])) {
    $id = $_POST['id'];
    mesajSil($id);
}
?>



<style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap");

    .bg {
        z-index: -2;
        position: relative;
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .block {
        display: block;
        width: 100%;
    }

    .date {
        text-align: center;
        font-size: 27px;
        color: rgba(255, 255, 255, 1);
        margin-bottom: -4px;
        cursor: default;
    }

    .time {
        text-align: center;
        font-size: 70px;
        color: rgba(255, 255, 255, 1);
        margin-bottom: 20px;
        cursor: default;
    }

    .card {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 20px;
        color: #444;
        margin-bottom: 20px;
        cursor: pointer;
        transition: .3s;
    }

    .card:last-child {
        margin-bottom: 0;
    }

    .card__blur__fx {
        backdrop-filter: blur(15px) saturate(100%);
        -webkit-backdrop-filter: blur(15px) saturate(100%);
        background-color: rgba(255, 255, 255, 0.75);
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 1;
        border-radius: 0.75rem;
        border: 2px solid transparent;

        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.75),
            background-color 0.25s, box-shadow 0.4s;
    }

    .card:hover .card__blur__fx {
        transition: .3s;
        border-color: #333;
    }

    .card:active .card__blur__fx {
        box-shadow: none;
    }

    .content_to_front {
        z-index: 1;
        width: 100%;
    }

    .card__header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 8px;
        color: rgba(30, 30, 30, 0.6);
        font-weight: 500;
    }

    .card__header__icon {
        display: flex;
        align-items: center;
    }

    .icon {
        width: 24px;
        height: 24px;
        margin-right: 8px;
    }

    .card__header__time__right {
        margin-left: auto;
    }

    h3,
    p {
        color: #0b1a28;
        text-align: left;
    }

    h3 {
        font-size: 19px;
        margin-bottom: 2px;
        font-weight: 600;
    }

    p {
        font-size: 16px;
        font-weight: 400;
    }

    @media only screen and (max-width: 600px) {
        body {
            padding: 12px;
        }

        .date {
            font-size: 19px;
            margin-bottom: 4px;
            color: rgba(255, 255, 255, 0.8);
        }

        .time {
            font-size: 46px;
        }

        .card {
            margin-bottom: 12px;
            color: rgba(255, 255, 255, 0.8);
        }

        .card__header {
            font-size: 15px;
        }

        .icon {
            width: 22px;
            height: 22px;
        }

        .card__header__time__right {
            font-size: 15px;
        }

        h3 {
            font-size: 16px;
        }

        p {
            font-size: 15px;
        }
    }
</style>
<main class="content">
    <?php require_once "admin/inc/navbar.php" ?>


    <body class="bg">
        <div class="block">
            <div class="date" style="color:#0b1a28"><?php

                                $dt = new DateTime;

                                $formatter = new IntlDateFormatter('tr_TR', IntlDateFormatter::SHORT, IntlDateFormatter::SHORT);
                                $formatter->setPattern('E d.M.yyyy');

                                echo $formatter->format($dt);



                                ?></div>
            <div class="time">
                <h1 id='time'></h1>
            </div>

            <?php
          if (isset($_GET['page'])) {
            $page = htmlspecialchars($_GET["page"]);
            $page = (int) $page;
          } else {
            $page = 1;
          }

          $limit = 3; // Her sayfada gösterilecek mesaj sayısı


          $mesajSayisi = kacMesajVar()[0];

          $sayfalar = ceil($mesajSayisi / $limit);


          if ($page > $sayfalar) {
            $start = 0;
          } else {
            $start = ($page > 1) ? ($page * $limit) - $limit : 0;
          }

          $mesajlar = getirMesajlar($start, $limit);

          ?>

            <?php
            foreach ($mesajlar as $mesaj) {
            ?>

                <div class="card">
                    <div class="card__blur__fx"></div>
                    <div class="content_to_front">
                        <div class="card__header">
                            <div class="card__header__icon">
                                <img src="https://res.cloudinary.com/diod8pjhj/image/upload/v1670798811/apple_message_icon_a7gshk.svg" class="icon" alt="message icon">
                                <?= $mesaj['mail'] ?>
                            </div>
                            <div class="card__header__time__right"><?= $mesaj['zaman'] ?>

                            </div>&nbsp;&nbsp;&nbsp;&nbsp;

                            <form action="mesajlar.php" method="post">
                                <input type="hidden" name="id" value="<?= $mesaj['id'] ?>">
                                <button type="submit" name="sil" class="btn btn-danger">Sil</button>
                            </form>


                        </div>
                        <h3><?= $mesaj['isim'] ?></h3>
                        <p><?= $mesaj['mesaj'] ?></p>
                    </div>
                </div>
            <?php

            } ?>



        </div>


        <form method='GET' action="">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center m-4">
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo ($page > 1) ? $page - 1 : 1; ?>">Geri</a>
                    </li>
                    <?php for ($i = 1; $i <= $sayfalar; $i++) : ?>
                        <li class="page-item <?php if ($i === $page) echo "active"; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>" <?php if ($i === $page) echo 'class="selected";' ?>><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo ($page < $sayfalar) ? $page + 1 : $sayfalar; ?>">İleri</a>
                    </li>
                </ul>
            </nav>
        </form>




<?php require_once "admin/inc/footer.php" ?>