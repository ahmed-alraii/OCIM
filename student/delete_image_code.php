<?php
session_start();

include("../includes/config.php");

require '../vendor/autoload.php';

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;


$region = 'ap-south-1';
// Amazon S3 API credentials
$access_key_id = 'AKIAVRUVQ4QHCJGKQ357';
$secret_access_key = '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';
$bucket = "ocim-app";

// Instantiate an Amazon S3 client
$s3 = new S3Client([
    'region' => $region,
    'credentials' => [
        'key' => $access_key_id,
        'secret' => $secret_access_key
    ]
]);

$client = new S3Client(array(
    'region' => $region,
    'key' => $access_key_id,
    'secret'  => $secret_access_key
));


$f_name = $_GET['f_name'];
$c_code = $_GET['c_code'];
$u_id = $_SESSION['user_data']['u_id'];



try {

//    $res = $s3->deleteObjectAsync([
//        'Bucket' => $bucket,
//         "Key" => "$s3Url".$_SESSION['user_data']['u_s_id']."/$c_code/$f_name",
//    ]);

        $res_delete = mysqli_query($conn, "delete from course_file where c_code = '$c_code' and f_name = '$f_name' and u_id = $u_id ");

        $count = mysqli_affected_rows($conn);


        if ($count > 0) {

                    echo "<script>
             alert('File Deleted Successfully'); 
              window.location='delete_image.php';
             </script>";
                } else {


                    echo "<script>
                 alert('File Not Deleted . Try Again..'); 
                 window.location='delete_image.php';
             </script>";
                }



} catch (S3Exception $e) {
    exit('Error: ' . $e->getAwsErrorMessage() . PHP_EOL);
}


