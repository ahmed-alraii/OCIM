<?php

// header section
require_once 'includes/app_header.php';
require 'includes/index_menu.php';
?>

<body>


    <div class="countainer-fluid">

        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <fieldset class="login-fieldset">
                    <h1> Login Page</h1>
                    <form class="form-login" method="post" action="login_code.php">

                        <input class="form-control" type="text" name="user_name" id="user_name" placeholder="Student Id" required>
                        <br />
                        <input class="form-control" type="password" name="user_pass" id="user_pass" placeholder="Password" required>
                        <br />
                        <input class="btn btn-block btn-red" type="submit" value="Login" name="login" id="login">

                        <p class="">You Do Not Have Account Yet ? SignUp Now</p>

                        <a href="signup.php" class="btn btn-block btn-red">SignUp</a>

                    </form>

                </fieldset>



            </div>
        </div>


        <?php require_once 'includes/index_footer.php'; ?>


    </div>