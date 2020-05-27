<?php
if (isset($_POST['login'])) {

    session_start();


    include("includes/config.php");

    $u_s_id = trim($_POST['user_name']);
    $pass = trim($_POST['user_pass']);



    $u_s_id = mysqli_real_escape_string($conn, $u_s_id);
    $pass  = mysqli_real_escape_string($conn, $pass);

    $result  = mysqli_query($conn, "Select * from user where u_s_id = '$u_s_id' and u_pass = '$pass'");


    if (mysqli_num_rows($result) > 0) {

        if ($row = mysqli_fetch_array($result)) {






            $_SESSION['user_data'] = array(

                "u_id" =>  $row['u_id'],
                "f_name" => $row['f_name'],
                "email" => $row['u_email'],
                "u_s_id" => $u_s_id
            );


            $r_id =  $row['r_id'];

            $_SESSION['is_login'] = true;

            // header("Location:add_course.php");

            if ($r_id == 1) {

?>
<script>
window.location = "admin/admin_index.php";
</script>

<?php } else {

            ?>

<script>
window.location = "student/find_image.php";
</script>


<?php } ?>


<?php
        }
    } else {

        echo "<script>
    alert(\"Login Failed. Try Again................\");
  //  window.location = 'login.php';
    
</script>";
    }
}


?>
