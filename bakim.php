<?php
require_once 'system/config.php';
echo 'Site bakımda';

if (bakimDurumu()[0][0] == 0) {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakım Arası</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Fira+Mono:400');

        body {
            display: flex;
            width: 100vw;
            height: 100vh;
            align-items: center;
            justify-content: center;
            margin: 0;
            background: #131313;
            color: #fff;
            font-size: 96px;
            font-family: 'Fira Mono', monospace;
            letter-spacing: -7px;
        }

        div {
            animation: glitch 1s linear infinite;
        }

        @keyframes glitchTop {

            2%,
            64% {
                transform: translate(2px, -2px);
            }

            4%,
            60% {
                transform: translate(-2px, 2px);
            }

            62% {
                transform: translate(13px, -1px) skew(-13deg);
            }
        }

        div:after {
            animation: glitchBotom 1.5s linear infinite;
            clip-path: polygon(0 67%, 100% 67%, 100% 100%, 0 100%);
            -webkit-clip-path: polygon(0 67%, 100% 67%, 100% 100%, 0 100%);
        }

        @keyframes glitchBotom {

            2%,
            64% {
                transform: translate(-2px, 0);
            }

            4%,
            60% {
                transform: translate(-2px, 0);
            }

            62% {
                transform: translate(-22px, 5px) skew(21deg);
            }
        }
    </style>
</head>

<body>

</body>

</html>