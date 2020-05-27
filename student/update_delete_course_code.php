<?php
session_start();

include("../includes/config.php");




if (isset($_POST['update_course'])) {

     $c_code = $_POST['selected_course'];

     echo "<script>window.location='update_course_view.php?c_code=$c_code'</script>";
}


if (isset($_POST['delete_course'])) {

     $c_code = $_POST['c_code'];
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
}
