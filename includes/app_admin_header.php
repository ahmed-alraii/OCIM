<?php


// to prevent submit error
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");

session_start();

?>


<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8">



        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <!-- <meta name="msapplication-starturl" content="/index.php"> -->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.3.0/material.indigo-pink.min.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


        <link rel="stylesheet" href="css/style.css">

        <link rel="shortcut icon" href="images/icons/icon-144x144.png">

        <link rel="manifest" href="manifest.json">

        <title>Course Files</title>

    </head>

    <body>

        <div class="container-fuild">


            <div class="row">



                <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
                    <header class="mdl-layout__header">
                        <div class="mdl-layout__header-row">
                            <!-- Title -->
                            <span class="mdl-layout-title">Course Files</span>
                            <!-- Add spacer, to align navigation to the right -->
                            <div class="mdl-layout-spacer"></div>
                            <!-- Navigation. We hide it in small screens. -->
                            <nav class="mdl-navigation mdl-layout--large-screen-only">

                                <a class="mdl-navigation__link" href="add_course.php">Add Course</a>

                                <a class="mdl-navigation__link" href="delete_file.php">Delete File</a>

                                <div class="drawer-option">
                                    <a href="logout.php"
                                       class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color--accent">
                                        Logout
                                    </a>
                                </div>
                            </nav>
                        </div>
                    </header>
                    <div class="mdl-layout__drawer">
                        <span class="mdl-layout-title">Course Files</span>
                        <nav class="mdl-navigation">





                            <a class="mdl-navigation__link text-center" href="add_course.php">Add Course</a>
                            <a class="mdl-navigation__link text-center" href="delete_file.php">Delete File</a>



                            <div class="drawer-option text-center">
                                <a href="logout.php"
                                   class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color--accent">
                                    Logout
                                </a>
                            </div>
                        </nav>
                    </div>
                    <div style="height:10px; background-color:#841818;"></div>