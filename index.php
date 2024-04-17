<?php
    $env = parse_ini_file('.env');
    $route_key = $env["COLLECTION_ROUTE_KEY"];
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Next bin day collection dates</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' media='all' />
    </head>
    <body class="container">
        <h1>Next bin day collection dates</h1>
<?php
    $url = 'https://www.bathnes.gov.uk/webapi/api/BinsAPI/v2/getbartecroute/'.$route_key.'/true';
    $data = file_get_contents($url);
    $json = json_decode($data, true);
    print_r($json);
    echo("<p>Next black bin collection date: ".$json['residualNextFullDayandDateText']."</p>");
    echo("<p>Next green bin collection date: ".$json['organicNextFullDayandDateText']."</p>");
?>
    </body>
</html>
