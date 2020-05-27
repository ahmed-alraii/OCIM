

<?php
if (isset($_POST['singup'])) {

    include("includes/config.php");


    $u_s_id = mysqli_real_escape_string($conn, $_POST['s_id']);
    $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass  = mysqli_real_escape_string($conn, $_POST['pass']);
    $r_id = 2; // student role no. is 2



    $res  = mysqli_query($conn, "Select * from user where u_s_id = '$u_s_id'");


    if (mysqli_num_rows($res) > 0) {


        echo "<script>
    alert('Student ID Exists. Please Try Again'); 
    window.location= 'signup.php';
     </script>";
    }


    $qry = "insert into user(u_s_id,f_name , u_email ,  u_pass , r_id )
   VALUES( $u_s_id,'$f_name', '$email' ,'$pass', $r_id )";


    $result  = mysqli_query($conn, $qry);

    if ($result) {


        echo "<script>
    alert('User Registration Success. Please Login'); 
    window.location= 'login.php';
     </script>";
    } else {

        echo "<script>
    alert('Registration Failed. Try Again..'); 
    //window.location= 'signup.php';
     </script>";
    }
}

?>