<?php

// header section
require_once 'app_header.php';


/*
$isPostBack = false;
$referer = "";
$thisPage = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

if (isset($_SERVER['HTTP_REFERER'])) {
    $referer = $_SERVER['HTTP_REFERER'];
}

if ($referer == $thisPage) {
    $isPostBack = true;
}
*/

?>
<div class="row">
    <div class="col-sm-8">





        <h1 class="text-center">Course File App</h1>
        <h4 class="text-center text-dagder">
            Sorry This Page Have Not Cached Yet :/
        </h4>




    </div>

    <?php
  //student message
  require_once 'student_message.php';

  // require_once  'google_adesens.php';
  ?>

</div>


<!-- End of side area -->
<?php
require_once 'app_footer.php'
?>
