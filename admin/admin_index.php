<?php

// header section
require '../includes/app_header.php';
require '../includes/admin_menu.php';




if (empty($_SESSION['is_login'])) {

    header("Location:../login.php");
    // echo "<script> window.location = '../login.php';</script>";
}

?>

<div class="countainer-fluid">

    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">

            <fieldset class="m_bottom my-main">

                <h1 class="text-center">Show Users And Courses</h1>

                <form class="" method="post" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-sm-offset-1 col-sm-5 courseList">



                            <select class="form-control" name="selected" id="selected">





                                <option value="users">
                                    All Users
                                </option>

                                <option value="courses">
                                    All Courses
                                </option>



                            </select>

                        </div>

                        <?php


                        ?>


                        <div class="col-sm-4 courseList">

                            <input
                                class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color--darklim"
                                type="submit" value="Show" id="show" name="show">

                        </div>


                    </div>

                </form>



                <?php



                // when clink show button


                if (isset($_POST['show'])) {

                    $selected = $_POST['selected'];

                    if ($selected == 'users') {

                        include("../includes/config.php");


                        $result  = mysqli_query($conn, "Select * from user ");





                        ?>

                <h2>All Users</h2>

                <div class="table-responsive ">
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th class="text-center">Student ID</th>
                                <th class="text-center">Student Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_array($result)) {  ?>

                            <tr class="text-center">
                                <td><?php echo $row['u_s_id']; ?>
                                </td>
                                <td><?php echo $row['f_name']; ?></td>
                            </tr>

                            <?php }
                                            }  ?>

                        </tbody>
                    </table>
                </div>

                <?php } else {


                            include("../includes/config.php");


                            $result  = mysqli_query($conn, "Select distinct c_code , c_name , u_id from course ");





                            ?>

                <h2>All Courses</h2>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Course Code</th>
                                <th class="text-center">Course Name</th>
                                <th class="text-center">Student Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_array($result)) {

                                                    $u_id =  $row['u_id'];

                                                    $res_user  = mysqli_query($conn, "Select * from user where u_id = $u_id ");

                                                    if ($row_user = mysqli_fetch_array($res_user)) {

                                                        $full_name = $row_user['f_name'];
                                                    }


                                                    ?>

                            <tr class="text-center">
                                <td><?php echo $row['c_code']; ?>
                                </td>
                                <td><?php echo $row['c_name']; ?></td>
                                <td><?php echo  $full_name  ?></td>
                            </tr>

                            <?php }
                                            }  ?>

                        </tbody>
                    </table>
                </div>



                <?php

                    }
                }  ?>
            </fieldset>

        </div>


    </div>

    <?php require '../includes/index_footer.php' ?>

</div>

<!-- End of side area -->
