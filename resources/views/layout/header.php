<?php

?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="https://fonts.googleapis.com/css?family=Kalam|Mansalva|Permanent+Marker|Ranga&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fork-awesome@1.1.7/css/fork-awesome.min.css" integrity="sha256-gsmEoJAws/Kd3CjuOQzLie5Q3yshhvmo7YNtBG7aaEY=" crossorigin="anonymous">
        <!-- login CSS -->
        <link href="<?= url('css/login.css') ?>"  rel="stylesheet">
        <!-- Reset CSS -->
        <link href="<?= url('css/reset.css') ?>"  rel="stylesheet">

        <!-- Really beautiful CSS -->
        <link href="<?= url('css/style.css') ?>"  rel="stylesheet">

        <title>O'Quiz : <?= $pageTitle ?></title>
    </head>

    <body <?php if(isset ($sorted) && $sorted == true){ echo "id='consulter_body'"; } ?>>
