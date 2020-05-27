<?php

include('config.php');
$res = mysqli_query($conn, "select c_code from course");


$courses = array();

if (mysqli_num_rows($res) > 0) {

    while ($rows = mysqli_fetch_array($res)) {
        array_push($courses, $rows);
    }
}

$courses = json_encode($courses);

print_r($courses);
