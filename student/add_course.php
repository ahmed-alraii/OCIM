<?php


require '../includes/app_header.php';


require '../includes/app_menu.php';




if (empty($_SESSION['is_login'])) {

    echo "<script> window.location = '../login.php';</script>";
}



?>
<div class="countainer-fluid">


    <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
            <fieldset class="my-main">
                <h1 class="text-center"> Add Course</h1>
                <form class="" method="post">
                    <div class="row">



                        <div class="col-sm-offset-3 col-sm-6 courseList">


                            <input class="form-control" type="text" name="course_code" id="course_code" placeholder="Course Code" required>
                            <br />

                            <input class="form-control" type="text" name="course_name" id="course_name" placeholder="Course Name" required>
                            <br />
                            <input class="form-control" type="text" name="course_desc" id="course_desc" placeholder="Course Description" required>
                            <br />
                            <input class="btn btn-block btn-red" type="submit" value="Submit" name="add_course" id="add_course">

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
if (isset($_POST['add_course'])) {








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