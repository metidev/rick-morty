<?php

$url = "https://rickandmortyapi.com/api/character";

$rand = mt_rand(0, 820);
$url .= "/$rand";
$data = file_get_contents($url);
$result = json_decode($data, true);
$img = $result['image'];
$name = $result['name'];
$origin = $result['origin']['name'];
$species = $result['species'];
$created = $result['created'];
$status = $result['status'];
$gender = $result['gender'];
$episodeSplit = explode("/", $result['episode'][0]);
$episode = $episodeSplit[5];
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rick And Morty</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Sarala:700|Exo+2:300');

        *,
        *:before,
        *:after {
            box-sizing: border-box;
            -webkit-tap-highlight-color: rgba(255, 255, 255, 0);
            outline: 1px solid transparent;
        }

        body {
            display: flex;
            width: 100vw;
            height: 100vh;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-image: linear-gradient(-55deg, RGB(0, 101, 164) 0%, RGB(0, 36, 93) 100%);
            color: #f5f5f5;
            font-family: 'Exo 2', serif;
            font-weight: 300;
            animation: fadeIn .5s cubic-bezier(0.390, 0.575, 0.565, 1.000) 1;
        }

        #particles-js {
            width: 100vw;
            height: 100vh;
        }

        .wrapper {
            width: 280px;
            height: 480px;
            perspective: 800px;
            position: absolute;
        }

        .card {
            width: 320px;
            height: 450px;
            position: relative;
            transform-style: preserve-3d;
            transform: translateZ(-140px);
            transition: transform 350ms cubic-bezier(0.390, 0.575, 0.565, 1.000);
            cursor: pointer;
        }

        .card > div {
            position: absolute;
            width: 320px;
            height: 450px;
            padding: 34px 21px;
            transition: all 350ms cubic-bezier(0.390, 0.575, 0.565, 1.000);
        }

        .front {
            background-image: linear-gradient(180deg, rgba(145, 141, 144, .5) 0%, rgba(92, 91, 94, 0) 100%);
            transform: rotateY(0deg) translateZ(160px);
            border-radius: 34px 3px 0 0;
        }

        .right {
            background-image: linear-gradient(0deg, rgba(145, 141, 144, .5) 0%, rgba(92, 91, 94, 0) 100%);
            opacity: 0.08;
            transform: rotateY(90deg) translateZ(160px);
            border-radius: 0 0 3px 34px;
        }

        .card:hover {
            transform: translateZ(-160px) rotateY(-90deg);
        }

        .card:hover .front {
            opacity: 0;
        }

        .card:hover .right {
            opacity: 1;
        }

        h1, h2 {
            margin: 0;
            font-size: 38px;
            width: 340px;
            letter-spacing: -.25px;
            transform: translateX(-44px);
            font-family: 'Sarala', serif;
            font-weight: 700;
        }

        h2 {
            font-size: 21px;
            transform: translateX(-34px);
        }

        p {
            margin: 0;
            font-weight: 300;
            font-size: 16px;
        }

        span {
            margin-left: 13px;
            opacity: .55;
        }

        img {
            transform-origin: top right;
            transition: all 300ms cubic-bezier(0.390, 0.575, 0.565, 1.000);
            transition-delay: 100ms;
            transform: translateX(21%) rotateZ(13deg) skewX(3deg);
            width: 200px;
            height: 200px;
            border-radius: 50%;
            pointer-events: none;
        }

        .img-wrapper {
            animation: float 4s cubic-bezier(0.390, 0.575, 0.565, 1.000) infinite alternate;
            position: absolute;
            top: 200px;
            right: 5px;
            pointer-events: none;
            backface-visibility: hidden;
        }

        @keyframes float {
            0% {
                transform: translateZ(20px);
            }
            100% {
                transform: translateY(-21px) translateX(-13px) translateZ(30px);
            }
        }

        .card:hover ~ .img-wrapper img {
            transform: scale(0.9) translateX(77%) translateY(90%) rotateZ(10deg);
            border-radius: 25px;
            width: 150px;
            height: 150px;
        }

        ul {
            margin-left: 21px;
            padding: 0;
            font-size: 16px;
            font-weight: 300;
            list-style: none;
        }

        li {
            padding-bottom: 8px;
            position: relative;
        }

        li:before {
            content: 'x';
            position: absolute;
            left: -21px;
            opacity: .55;
        }


        .card:hover button {
            transform: scale(1) skewY(0);
        }

        .card:not(:hover) button {
            opacity: 0;
        }

        button:hover {
            background-position: left;
        }

        .price {
            position: absolute;
            bottom: 34px;
            left: 21px;
            font-size: 34px;
            opacity: .34;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0.33;
                transform: scale(.89);
            }
        }

        @media only screen and (max-width: 600px) {
            body {
                transform: scale(.67);
            }
        }
    </style>
    <link rel="icon" href="favicon.png" type="image/png">
</head>
<body>
<div id="particles-js"></div>
<div class="wrapper">
    <div class="card">
        <div class="front">
            <h1><?= strlen($name) > 18 ? substr($name, 0, 18) . '...' : $name ?></h1>
            <p>created <span><?= substr($created, 0, 10) ?></span></p>
            <p class="price"><?= $species ?></p>
        </div>
        <div class="right">
            <h2><?= $name ?></h2>
            <ul>
                <li>Status <?= $status ?></li>
                <li>Gender <?= $gender ?></li>
                <li>Origin <?= $origin ?></li>
                <li>Episode <?= $episode ?></li>
            </ul>
        </div>
    </div>
    <div class="img-wrapper">
        <img src='<?= $img ?>' alt='character'>
    </div>
</div>

</body>

<script src="particles.js"></script>
<script>
    /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
    particlesJS.load('particles-js', 'particles.json', function () {
        console.log('callback - particles.js config loaded');
    });
</script>
</html>






