<?php


require '../includes/app_header.php';


require '../includes/app_menu.php';




if (empty($_SESSION['is_login'])) {

    echo "<script> window.location = '../login.php';</script>";
}


if (isset($_GET['c_code'])) {

    include('../includes/config.php');

    $c_code = $_GET['c_code'];

    $u_id = $_SESSION['user_data']['u_id'];
    $res = mysqli_query($conn, "select * from course where u_id = $u_id and c_code = '$c_code'");


    if (mysqli_num_rows($res) > 0) {

        if ($rows = mysqli_fetch_array($res)) {
            $c_name = $rows['c_name'];
            $c_desc = $rows['c_desc'];
        }
    }
}


?>
<div class="countainer-fluid">


    <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
            <fieldset class="my-main">
                <h1 class="text-center"> Update Course</h1>
                <form method="post">
                    <div class="row">



                        <div class="col-sm-offset-3 col-sm-6 courseList">

                            <label for="">Course Code</label>
                            <input class="form-control" type="text" name="course_code" id="course_code" value="<?php echo $c_code; ?>" placeholder="Course Code" required>
                            <br />

                            <label for="">Course Name</label>
                            <input class="form-control" type="text" name="course_name" id="course_name" value="<?php echo $c_name; ?>" placeholder="Course Name" required>
                            <br />

                            <label for="">Course Description</label>
                            <input class="form-control" type="text" name="course_desc" id="course_desc" value="<?php echo $c_desc; ?>" placeholder="Course Description" required>
                            <br />
                            <input class="btn btn-block btn-red" type="submit" value="Update" name="update_course" id="update_course">

                        </div>
                    </div>

                </form>

            </fieldset>


        </div>


    </div>
</div>


<?php require '../includes/footer.php'; ?>


</div>
<?php

// upload files
if (isset($_POST['update_course'])) {








    $c_code = $_POST["course_code"];
    $c_name = $_POST["course_name"];
    $c_desc = $_POST["course_desc"];

    if (isset($_SESSION['user_data']['u_id']))
        $u_id = $_SESSION['user_data']['u_id'];
    else
        $u_id = "";

    print_r($_SESSION['user_data']['u_id']);

    include("../includes/config.php");
    $insert_query = "insert into course(c_code, c_name, c_desc , u_id) values('$c_code' , '$c_name' , '$c_desc' , $u_id)";
    $res = mysqli_query($conn, $insert_query);



    if ($res) {
        ?>
        <script>
            alert("The course added successfully");
        </script>
    <?php } else {

            ?>
        <script>
            alert("The course not added");
        </script>
<?php

    }
}

?>