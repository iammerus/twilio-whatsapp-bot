<?php
$movie = $_GET['movie'] ?? null;

if (!$movie) {
    http_response_code(500);
    echo 'Movie not supplied';
    die;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Refresh" content="5;URL=https://www.pornhub.com">
    <meta charset="UTF-8">
    <title>Redirecting...</title>
    <meta name="description" content="You're being redirected...">

    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

    <link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>

    <style>

        body {
            font-family: 'Noto Sans', Arial, serif;
            font-weight: 400;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            line-height: 1.618em;
            background: #464646 center center no-repeat fixed;
            background-size: cover;
        }

        h2 {
            font-family: 'Noto Sans', Arial, serif;
            font-weight: 700;
            font-size: 40px;
            line-height: 1.618em;
        }

        section {
            max-width: 800px;
            margin: 8% auto 1em auto;
            background-color: #222;
            opacity: 0.8;
            filter: alpha(opacity=80); /* For IE8 and earlier */
            color: #fff;
            padding: 1em 5%;
        }

        a {
            color: #00CC66;
        }

        a:focus {
            outline: none;
            outline-offset: inherit;
        }

        @media (max-device-width: 1027px) {

            body {
                text-align: center;
                font-size: larger;
            }

            section {
                max-width: 90%;
            }

        }

        @media (max-device-width: 640px) {
            section {
                max-width: 97%;
            }

        }


    </style>
</head>
<body>

<section>
    <h2>Retrieving download link</h2>

    <h3>Please wait. We're finding the best download site for your movie <?= $movie ?></h3>
    <h3>...You will be transferred to the download site in a moment...</h3>

    <p>If you have waited more than a 5 seconds and you are still seeing this message, please refresh the page! Thank
        you.</p>
</section>
</body>
</html>