<?php






/*
session_start();
if (!isset($_SESSION['user_name'])) {

    // header('Location:admin_login.php');
    ?>
<script>
window.location = "admin_login.php";
</script>

<?php

}
*/
// header section

require '../includes/app_header.php';
require '../includes/app_menu.php';




if (empty($_SESSION['is_login'])) {

    echo "<script> window.location = '../login.php';</script>";
}


?>





<div class="countainer-fluid">

    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">

            <fieldset class="m_bottom my-main">

                <h1 class="text-center"> Delete Image</h1>
                <form class="" method="post" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-sm-offset-1 col-sm-6 courseList">



                            <select class="form-control" name="selected_course" id="selected_course">


                                <option value="0">
                                    Select Course Code
                                </option>



                                <?php


                                include('../includes/config.php');
                                $u_id = $_SESSION['user_data']['u_id'];
                                $res = mysqli_query($conn, "select c_code from course where u_id = $u_id ");



                                if (mysqli_num_rows($res) > 0) {

                                    while ($rows = mysqli_fetch_array($res)) {
                                        $c_code = $rows['c_code'];



                                        ?>

                                        <option value="<?php echo strtoupper($c_code); ?>">
                                            <?php echo strtoupper($c_code); ?>
                                        </option>
                                <?php
                                    }
                                }




                                ?>



                            </select>

                        </div>


                        <div class="col-sm-4 courseList">

                            <input class="btn btn-block btn-red" type="submit" value="Find Images" id="find_files" name="find_files">

                        </div>



                    </div>
                </form>





                <h1 class="text-center">Images Shows Here</h1>
                <p class="text-center">
                    Find Images about the courses you need
                </p>



                <?php

                $isClicked = true;
                $file_per_page;



                // when clink find_files button

                if (isset($_POST['find_files'])) {

                    $isClicked = true;
                    $c_code = $_POST["selected_course"];
                } elseif (isset($_GET["c_code"])) {

                    $isClicked = true;
                    $c_code = $_GET["c_code"];
                } else {

                    $isClicked = false;
                }


                if ($isClicked == true) {


                    ?>


                    <h1 class="titel_file">
                        <h4 class="titel_file">



                            <?php

                                if ($c_code == '0') {

                                    echo  "<div class='alert alert-danger'> No Course Selected Please Select Course </div>";
                                } else {

                                    echo  strtoupper($c_code);
                                } ?> </h4>


                    </h1>

                    <?php include('../includes/config.php');


                        $total_res = mysqli_query($conn, "select count(*) from course_file where c_code = '$c_code' ");
                        $t_files = mysqli_fetch_array($total_res);
                        $total = array_shift($t_files);

                        $file_per_page = $total / 6;
                        $file_per_page  = ceil($file_per_page);




                        if (isset($_GET['Page'])) {

                            $page = $_GET['Page'];

                            if ($page > $file_per_page) {

                                $page = $file_per_page;
                            }

                            if ($page < 1) {

                                $page = 1;
                            }


                            $showFileFrom = ($page * 6) - 6;



                            $res = mysqli_query($conn, "select * from course_file where c_code = '$c_code'  LIMIT $showFileFrom , 6");
                        } else {

                            $res = mysqli_query($conn, "select * from course_file where c_code = '$c_code'  LIMIT 0 , 6 ");
                        }




                        if (mysqli_num_rows($res) > 0) {

                            while ($rows = mysqli_fetch_array($res)) {
                                $c_code = $rows['c_code'];
                                $f_name = $rows['f_name'];
                                $f_type = $rows['f_type'];
                                $f_path = $rows['f_path'];

                                ?>



                            <div class="col-sm-12 col-md-offset-3 col-md-7">


                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <p class="titel_file"> <?php echo $f_name; ?></p>
                                    </div>
                                    <div class="panel-body">



                                        <?php if ($f_type == 'jpg' || $f_type == 'png' || $f_type == 'jpeg') { ?>


                                            <img class="img-responsive" src="<?php echo $f_path; ?>" width="500" height="200">

                                            <br />



                                            <a href="delete_image_code.php?f_name=<?php echo $f_name; ?>&c_code=<?php echo $c_code; ?>" onclick="return confirm('Are You Sure ?');" class="btn  btn-red show-file"><strong>Delete
                                                    File</strong></a>

                                        <?php
                                                    } elseif ($f_type == 'pdf') { ?>
                                            <iframe src="<?php echo $f_path; ?>" height="200px" width="500px"></iframe>
                                            <br />

                                            <a href="delete_image_code.php?f_name=<?php echo $f_name; ?>&c_code=<?php echo $c_code; ?>" onclick="return confirm('Are You Sure ?');" class="btn  btn-red show-file-pdf text-center"><strong>Delete
                                                    File</strong></a>
                                        <?php
                                                    } else { ?>
                                            <iframe src="" height="200px" width="500px"></iframe>
                                            <br />

                                            <a href="delete_image_code.php?f_name=<?php echo $f_name; ?>&c_code=<?php echo $c_code; ?>" onclick="return confirm('Are You Sure ?');" class="btn  btn-red show-file"><strong>Delete
                                                    File</strong></a>

                                        <?php
                                                    } ?>

                                    </div>
                                </div>

                            </div>




                        <?php
                                } ?>


                        <div class="row">


                            <div class="col-sm-offset-5 col-sm-5 col-xs-offset-3 col-xs-7">




                                <nav>
                                    <ul class="pagination">


                                        <?php


                                                if (isset($_GET['Page'])) {

                                                    $p = $_GET['Page'];

                                                    if ($p > 1) { ?>

                                                <li> <a href="delete_image.php?Page=<?php echo $p - 1; ?>&c_code=<?php echo $c_code; ?>">

                                                        &laquo;
                                                    </a></li>


                                                <?php
                                                            }
                                                        }




                                                        for ($i = 1; $i <= $file_per_page; $i++) {



                                                            if (isset($_GET['Page'])) {

                                                                if ($i == $page) {

                                                                    ?>


                                                    <li class="active"> <a href="delete_image.php?Page=<?php echo $i; ?>&c_code=<?php echo $c_code; ?>">

                                                            <?php $isClicked = true;
                                                                                echo $i; ?>
                                                        </a></li>
                                                <?php
                                                                } else {


                                                                    ?>

                                                    <li> <a href="delete_image.php?Page=<?php echo $i; ?>&c_code=<?php echo $c_code; ?>">

                                                            <?php $isClicked = true;
                                                                                echo $i; ?>
                                                        </a></li>


                                                <?php
                                                                }
                                                            } else {

                                                                if ($i == "1") {

                                                                    ?>



                                                    <li class="active"> <a href="delete_image.php?Page=<?php echo $i; ?>&c_code=<?php echo $c_code; ?>">

                                                            <?php $isClicked = true;
                                                                                echo $i; ?>
                                                        </a></li>


                                                <?php
                                                                } else {  ?>



                                                    <li> <a href="delete_image.php?Page=<?php echo $i; ?>&c_code=<?php echo $c_code; ?>">

                                                            <?php $isClicked = true;
                                                                                echo $i; ?>
                                                        </a></li>



                                                <?php
                                                                }
                                                            }
                                                        }


                                                        if (isset($_GET['Page'])) {

                                                            $p = intval($_GET['Page']);

                                                            if ($p + 1 <= $file_per_page) { ?>

                                                <li> <a href="delete_image.php?Page=<?php echo $p + 1; ?>&c_code=<?php echo $c_code; ?>&next=<?php echo true; ?>">

                                                        &raquo;
                                                    </a></li>


                                            <?php
                                                        }
                                                    } else {

                                                        $p = 1;

                                                        if ($p + 1 <= $file_per_page) { ?>

                                                <li> <a href="delete_image.php?Page=<?php echo $p + 1; ?>&c_code=<?php echo $c_code; ?>&next=<?php echo true; ?>">

                                                        &raquo;
                                                    </a></li>





                                        <?php
                                                    }
                                                }

                                                ?>


                                    </ul>
                                </nav>



                            </div>


                        </div>



                    <?php
                        } else { ?>

                        <h4 class="text-danger" align="center">
                            No Files Available For This Course
                        </h4>


                <?php
                    }
                }

                ?>

            </fieldset>

        </div>
    </div>
</div>

<?php require '../includes/footer.php'; ?>

</div>

<!-- 
-->