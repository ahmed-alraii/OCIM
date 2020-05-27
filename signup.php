<?php

// header section
require 'includes/app_header.php';
require 'includes/index_menu.php';
?>

<div class="countainer-fluid">

    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">

            <fieldset class="login-fieldset">
                <h2 class=""> User Register Here</h2>
                <form class="form-login" action="signup_code.php" method="post">

                    <input class="form-control" type="text" name="s_id" id="s_id" placeholder="student id" required>
                    <br />
                    <input class="form-control" type="text" name="f_name" id="f_name" placeholder="full name" required>
                    <br />
                    <input class="form-control" type="text" name="email" id="email" placeholder="email" required>
                    <br />

                    <input class="form-control" type="password" placeholder="password" name="pass" id="pass" required>
                    <br />


                    <input class="btn btn-block btn-red" type="submit" value="Singup" name="singup" id="singup">

                </form>

            </fieldset>



        </div>
    </div>


    <?php require 'includes/index_footer.php'; ?>


</div>
