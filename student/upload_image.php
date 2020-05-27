<?php


// admin header section
require '../includes/app_header.php';
require '../includes/app_menu.php';




if (empty($_SESSION['is_login'])) {

    header("Location:../login.php");
   // echo "<script> window.location = '../login.php';</script>";
}

?>


<div class="row">
    <div class="col-sm-offset-2 col-sm-8">
        <fieldset class="my-main">
            <form class="" method="post" action="upload_image_code.php" enctype="multipart/form-data">

                <h1 class="text-center">Upload Image </h1>

                <div class="row">



                    <div class="col-sm-offset-3 col-sm-6 courseList">





                        <div> <label id="file_course_code">Course Code</label></div>
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
                                    $c_code = $rows['c_code']; ?>

                                    <option value="<?php echo  strtolower($c_code); ?>">
                                        <?php echo strtoupper($c_code); ?>
                                    </option>
                            <?php

                                }
                            }

                            ?>


                        </select>




                        <input class="btn  btn-block btn-red" type="file" name="fileToUpload" id="fileToUpload" required>
                        <br>


                        <input type='text' class="form-control" id='new_name' name='new_name' placeholder='image name' required>

                        <br>
                        <input id="upload_file" class="btn btn-block btn-red file-input" type="submit" value="Upload Images" name="upload_file">


                    </div>
                </div>

            </form>

        </fieldset>





    </div>

    <!-- End of side area -->


    <!-- End of main area -->




</div><!-- End of Container-fluid -->









<?php
// footer section
require '../includes/footer.php'

?>


<script>
    var fileToUpload = document.querySelector("#fileToUpload");

    fileToUpload.addEventListener('change', function(event) {

        var new_name = document.querySelector("#new_name");

        new_name.style.display = "block";


    });
</script>


</body>

</html>