<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <!-- Title -->
            <span class="mdl-layout-title">OCIM</span>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
            <!-- Navigation. We hide it in small screens. -->
            <nav class="mdl-navigation mdl-layout--large-screen-only">





                <a class="mdl-navigation__link" href="find_image.php">Find Image</a>

                <a class="mdl-navigation__link" href="upload_image.php">Upload Image</a>

                <a class="mdl-navigation__link" href="delete_image.php">Delete Image</a>

                <a class="mdl-navigation__link" href="update_course.php">Update/Delete Course</a>

                <a class="mdl-navigation__link" href="add_course.php">Add Course</a>

                <a class="mdl-navigation__link">


                    User : <?php if (isset($_SESSION['user_data']['f_name'])) echo  $_SESSION['user_data']['f_name'] ?>
                </a>


                <div class="drawer-option">

                    <a href="../logout.php"
                       class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color--red">
                        Logout
                    </a>

                </div>


            </nav>
        </div>
    </header>
    <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">OCIM APP</span>
        <nav class="mdl-navigation">




            <a class="mdl-navigation__link text-center" href="find_image.php">Find
                Image</a>

            <a class="mdl-navigation__link text-center" href="upload_image.php">Upload
                Image</a>

            <a class="mdl-navigation__link text-center" href="delete_image.php">Delete Image</a>

            <span class="mdl-navigation__link mdl-js-button mdl-button--raised mdl-button--colored mdl-color-text--white mdl-color--lim mdl-text-white"
                  href="">CS
                Courses</span>

            <a class="mdl-navigation__link text-center" href="update_course.php">Update/Delete Course</a>
            <a class="mdl-navigation__link text-center" href="add_course.php">Add Course</a>

            <a class="mdl-navigation__link text-center">
                User : <?php echo  $_SESSION['user_data']['f_name'] ?>
            </a>



            <div class="drawer-option text-center">
                <a href="../logout.php"
                   class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color--red">
                    Logout
                </a>


            </div>


        </nav>
    </div>
    <div style="height:10px; background-color:#4f5c20;"></div>