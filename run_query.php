<?php
  if(isset($_GET['Page'])){

    $page = 1;
    $showFileFrom = ($page * 6) - 6;

    $res = mysqli_query($conn , "select * from course_file where c_code = '$c_code'  LIMIT $showFileFrom , 6");

    
   }

?>