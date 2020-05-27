<?php
session_start();

include("../includes/config.php");



$f_name = $_GET['f_name'];
$c_code = $_GET['c_code'];
$u_id = $_SESSION['user_data']['u_id'];

$res_delete = mysqli_query($conn, "delete from course_file where c_code = '$c_code' and f_name = '$f_name' and u_id = $u_id ");

$count = mysqli_affected_rows($conn);


if ($count > 0) {

     echo "<script>
     alert('File Deleted Successfully'); 
	  window.location='update_image.php';
     </script>";
} else {



     echo "<script>
         alert('File Not Deleted . Try Again..'); 
	     window.location='update_image.php';
     </script>";
}
