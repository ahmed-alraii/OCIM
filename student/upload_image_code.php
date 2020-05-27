<?php

session_start();

$c_code = $_POST["selected_course"];


if ($c_code == '0') {

    echo "<script> alert('Please Select Course First !!.');
    window.location='upload_image.php';
    </script>";

    exit;
}





// upload files
if (isset($_POST['upload_file'])) {


    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);



    $ext = pathinfo($target_file, PATHINFO_EXTENSION);
    $new_name = trim($_POST['new_name']);
    $file_new_name =  $new_name . '.' . $ext;
    $course_code = $_POST['selected_course'];
    $new_name = $new_name . '.' . $ext;
    $newPath = $target_dir . $course_code . "/";



    if (!is_dir($newPath)) {
        mkdir($newPath, 0777, true);
    }

    $image_Path = $newPath . $new_name;

    // Check if file already exists
    if (file_exists($image_Path)) {
        //  echo "Sorry, file already exists."; 
        $uploadOk = 0;
        echo "<script> alert('Sorry, file already exists.');
                  window.location='upload_image.php';
         </script>";
        exit;
    }







    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],  $image_Path)) {
        //   echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

        $c_code = $_POST["selected_course"];
        //  $f_name = $_FILES["fileToUpload"]["name"];

        $u_id = $_SESSION['user_data']['u_id'];



        include("../includes/config.php");
        $insert_query = "insert into course_file(c_code, f_type, f_name, f_path , u_id) values('$c_code' , '$ext' , '$file_new_name ' , '$image_Path' , $u_id)";
        $res = mysqli_query($conn, $insert_query);
        echo $res;
        if ($res) {
            ?>
            <script>
                alert("The file uploaded successfully");
                window.location = "upload_image.php";
            </script>
        <?php } else { ?>
            <script>
                alert("The file not uploaded");
                window.location = "upload_image.php";
            </script>
        <?php

                }
            } else {
                // echo "Sorry, there was an error uploading your file.";

                ?>
        <script>
            alert("Sorry, there was an error uploading your file.");
            window.location = "upload_image.php";
        </script>


<?php

    }
}

?>