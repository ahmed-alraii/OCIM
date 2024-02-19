<?php

session_start();



include("../includes/config.php");

require '../vendor/autoload.php';

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;




$c_code = $_POST["selected_course"];


if ($c_code == '0') {

    echo "<script> alert('Please Select Course First !!.');
    window.location='upload_image.php';
    </script>";

    exit;
}


if (isset($_POST['upload_file'])) {

    $file_new_name = trim($_POST['new_name']);
    $course_code = trim($_POST['selected_course']);
    $student_id = $_SESSION['user_data']['u_s_id'];


    if(!empty($_FILES["fileToUpload"]["name"])){

        $file_name = basename($_FILES["fileToUpload"]["name"]);
        $file_type = pathinfo($file_name , PATHINFO_EXTENSION);
        $file_new_name .= ".".$file_type;

        // Allow certain file formats

        $allowedTypes = ['pdf' , 'doc' , 'docx' , 'xls' , 'xlsx' , 'jpg' , 'png' , 'jpeg' , 'gif'];

        if(in_array($file_type , $allowedTypes)){

            // File temp source

            $file_temp_src = $_FILES["fileToUpload"]["tmp_name"];

            if(is_uploaded_file($file_temp_src)){

                // Instantiate an Amazon S3 client
                $s3 = new S3Client([
                      //  'version' => $version,
                        'region' => $region,
                        'credentials' => [
                                'key' => $access_key_id,
                                'secret' => $secret_access_key
                        ]
                ]);

                // Upload file to S3 bucket
                try{
                    $requestHeaders['Cache-Control'] = 'public, max-age=31536000';
                    $requestHeaders['Expires'] = gmdate("D, d M Y H:i:s T", strtotime("+1 years"));
                    $result = $s3->putObject([
                       'Bucket' => $bucket,
                        'Key' => "student/uploads/$student_id/$course_code/$file_new_name",
                        'SourceFile' => $file_temp_src,
                        'ContentType' =>"image/$file_type",
                        'ACL' => 'public-read'
                    ]);



                    $result_arr = $result->toArray();

                    if(!empty($result_arr['ObjectURL'])){
                        $s3_file_link = $result_arr['ObjectURL'];
                    }else{
                        $api_error = 'Upload Failed!! S3 Object URL not found';
                    }



                }catch (S3Exception $exception){

                    $api_error = $exception->getMessage();

                }

                if(empty($api_error)){

                    ?>
                    <script>
                        alert("The file uploaded successfully");
                        window.location = "upload_image.php";
                    </script>
                <?php } else {
                    var_dump( $api_error);
                    exit;

                    ?>
                    <script>
                        alert("The file not uploaded");
                        window.location = "upload_image.php";
                    </script>
                    <?php

                }


            }else{  ?>
                <script>
                    alert("The file not uploaded");
                    window.location = "upload_image.php";
                </script>

               <?php }


        }else{ ?>
            <script>
            alert("The file extension not allowed");
            window.location = "upload_image.php";
            </script>

    <?php    }

    }

}


   // store data in table

    $c_code = $_POST["selected_course"];
    //  $f_name = $_FILES["fileToUpload"]["name"];

    $u_id = $_SESSION['user_data']['u_id'];



    $insert_query = "insert into course_file(c_code, f_type, f_name, f_path , u_id) values('$c_code' , '$file_type' , '$file_new_name' , '$image_Path' , $u_id)";
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





// upload files
//if (isset($_POST['upload_file'])) {


//    $target_dir = "uploads/";
//    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//
//
//
//    $ext = pathinfo($target_file, PATHINFO_EXTENSION);
//    $new_name = trim($_POST['new_name']);
//    $file_new_name =  $new_name . '.' . $ext;
//    $course_code = $_POST['selected_course'];
//    $new_name = $new_name . '.' . $ext;
//    $newPath = $target_dir . $course_code . "/";
//
//
//
//    if (!is_dir($newPath)) {
//        mkdir($newPath, 0777, true);
//    }
//
//    $image_Path = $newPath . $new_name;
//
//    // Check if file already exists
//    if (file_exists($image_Path)) {
//        //  echo "Sorry, file already exists.";
//        $uploadOk = 0;
//        echo "<script> alert('Sorry, file already exists.');
//                  window.location='upload_image.php';
//         </script>";
//        exit;
//    }



//
//
//    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],  $image_Path)) {
//        //   echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
//
//        $c_code = $_POST["selected_course"];
//        //  $f_name = $_FILES["fileToUpload"]["name"];
//
//        $u_id = $_SESSION['user_data']['u_id'];
//
//
//
//        include("../includes/config.php");
//        $insert_query = "insert into course_file(c_code, f_type, f_name, f_path , u_id) values('$c_code' , '$ext' , '$file_new_name ' , '$image_Path' , $u_id)";
//        $res = mysqli_query($conn, $insert_query);
//        echo $res;
//        if ($res) {
//            ?>
<!--            <script>-->
<!--                alert("The file uploaded successfully");-->
<!--                window.location = "upload_image.php";-->
<!--            </script>-->
<!--        --><?php //} else { ?>
<!--            <script>-->
<!--                alert("The file not uploaded");-->
<!--                window.location = "upload_image.php";-->
<!--            </script>-->
<!--        --><?php
//
//                }
//            } else {
//                // echo "Sorry, there was an error uploading your file.";
//
//                ?>
<!--        <script>-->
<!--            alert("Sorry, there was an error uploading your file.");-->
<!--            window.location = "upload_image.php";-->
<!--        </script>-->
<!---->
<!---->
<?php
//
//    }
//}
//
?>