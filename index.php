<?php
    $env = parse_ini_file('.env');
    $route_key = $env["COLLECTION_ROUTE_KEY"];
    if (empty($route_key)) {
        die("COLLECTION_ROUTE_KEY not set in .env file");
    }

    $cacheFile = 'cache.json';
    $data = '';

    if (file_exists($cacheFile) && (filemtime($cacheFile) > (time() - 60 * 60 * 24 ))) {
       // Cache file is less than 24 hours old.
       // Don't bother refreshing, just use the file as-is.
       $data = file_get_contents($cacheFile);
    } else {
       // Our cache is out-of-date, so load the data from the remote server,
       // and also save it over the cache for next time.
       $url = 'https://www.bathnes.gov.uk/webapi/api/BinsAPI/v2/getbartecroute/'.$route_key.'/true';
       $data = file_get_contents($url);
       file_put_contents($cacheFile, $data);
    }

    // $url = 'https://www.bathnes.gov.uk/webapi/api/BinsAPI/v2/getbartecroute/'.$route_key.'/true';
    // $data = file_get_contents($url);
    $json = json_decode($data, true);

    $blackBinNextDate = new DateTime($json['residualNextDate']);
    $greenBinNextDate = new DateTime($json['organicNextDate']);

    $nextCollection = "";

    if($blackBinNextDate < $greenBinNextDate) {
        $nextCollection = "black";
    } else {
        $nextCollection = "green";
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Next bin day collection dates</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="webmention" href="https://webmention.io/philwilson.org/webmention" />
        <link rel="pingback" href="https://webmention.io/philwilson.org/xmlrpc" />
        <style type="text/css">
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                margin: 0;
                padding: 0;
                margin: auto;
            }
            h1 {
                margin: 0;
                padding: 10px;
                text-transform: uppercase;
                font-size: 2.5em;
            }
            p {
                margin: 0;
                padding: 10px;
            }
            .black {
                background-color: #000000;
                color: #fff;
            }
            .green {
                background-color: #74986d;
                color: #000;
            }
        </style>
    </head>
    <body class="<?= $nextCollection ?>">
        <h1><?= $nextCollection ?> bin week</h1>
        <p>Next black bin collection date: <?= $json['residualNextFullDayandDateText'] ?></p>
        <p>Next green bin collection date: <?= $json['organicNextFullDayandDateText'] ?></p>
    </body>
</html>
